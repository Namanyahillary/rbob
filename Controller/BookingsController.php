<?php
App::uses('AppController', 'Controller');

/**
 * Bookings Controller
 *
 * @property Booking $Booking
 */
class BookingsController extends AppController {
	
	public $uses=array('Booking','Destination','User','Country','Bank','Group','GroupMember','Activity');
	
	public function add_activity($destination,$activity){
		if ($this->Destination->exists($destination)) {
			if($this->Activity->exists($activity)){				
				if($this->Session->read("RoundBob['Booking']['activities']")==null){
					$this->Session->write("RoundBob['Booking']['activities']",
						array(
							'RoundBob'=>array(
								'Booking'=>array(
									'Destination_'.$destination=>array(
										'activities'=>array()
									)									
								)
							)						
						)
					);
				}
				$this->Activity->recursive=-1;
				$activities=$this->Session->read("RoundBob['Booking']['activities']");
				$activities['RoundBob']['Booking']['Destination_'.$destination]['activities'][''.$activity]=$this->Activity->read(null,$activity);
				$this->Session->write("RoundBob['Booking']['activities']",$activities);
			}
		}
		$this->redirect(array('action' => 'view',$destination,'controller'=>'destinations'));
	}
	
	public function remove_activity($destination,$activity){
		if ($this->Destination->exists($destination)) {
			if($this->Activity->exists($activity)){				
				if($this->Session->read("RoundBob['Booking']['activities']")==null){
					$this->Session->write("RoundBob['Booking']['activities']",
						array(
							'RoundBob'=>array(
								'Booking'=>array(
									'Destination_'.$destination=>array(
										'activities'=>array()
									)									
								)
							)						
						)
					);
				}
				
				$activities=$this->Session->read("RoundBob['Booking']['activities']");
				if(isset($activities['RoundBob']['Booking']['Destination_'.$destination]['activities'][''.$activity])){
					unset($activities['RoundBob']['Booking']['Destination_'.$destination]['activities'][''.$activity]);
				}
				$this->Session->write("RoundBob['Booking']['activities']",$activities);
			}
		}
		$this->redirect(array('action' => 'view',$destination,'controller'=>'destinations'));
	}
	
	public function accept_booking($id){
		if (!$this->Booking->exists($id)) {
			throw new NotFoundException(__('Invalid booking'));
		}
		
		$this->request->data['Booking']['id']=$id;
		$this->request->data['Booking']['user_confirmed']=1;
		
		if($this->Booking->save($this->request->data)){
			$this->Session->setFlash(__('Booking marked as accepted'));
			//<Make notifications after accepting the group booking>
		}else{
			$this->Session->setFlash(__('Booking not marked as accepted! Try again.'));
		}
		
		$this->redirect(array('action' => 'view',$id));
	}
	public function not_accept_booking($id){
		if (!$this->Booking->exists($id)) {
			throw new NotFoundException(__('Invalid booking'));
		}
		
		if(!($this->Booking->find('count',
					array(
						'limit'=>1,
						'order'=>'Booking.booking_date desc',
						'conditions'=>array(
							'Booking.user_id'=>$this->Auth->User('id'),
							'Booking.id'=>$id
						)
					)
				)
			)
		){
			throw new NotFoundException(__('Invalid booking'));
		}
		
		$this->request->data['Booking']['id']=$id;
		$this->request->data['Booking']['user_confirmed']=1;
		
		$this->Booking->id = $id;
		if ($this->Booking->delete()) {
			$this->Session->setFlash(__('Booking deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Booking was not deleted'));
		$this->redirect(array('action' => 'index'));
		
	}
	
	public function book_as(){//1-group,2-user
		if($this->Session->read("RoundBob['Booking']['book_as_Group']")==null){
			$this->Session->write("RoundBob['Booking']['book_as_Group']",0);
		}
		
		
		if((int)$this->Session->read("RoundBob['Booking']['book_as_Group']")==(int)0){
			$this->Session->write("RoundBob['Booking']['book_as_Group']",1);
		}else{
			$this->Session->write("RoundBob['Booking']['book_as_Group']",0);
		}
		
		$this->set('state',$this->Session->read("RoundBob['Booking']['book_as_Group']"));
	}
	
	public function book($destination=null,$payment_mode=null,$country=null,$group=null){
		if (!$this->Destination->exists($destination)) {
			throw new NotFoundException(__('Invalid destination'));
		}
		
		if($country){
			if (!$this->Country->exists($country)) {
				throw new NotFoundException(__('Invalid country'));
			}
			$this->Session->write("RoundBob['Booking']['bank_payment_country']",$country);
		}
		
		if($group){
			if (!$this->Group->exists($group)) {
				throw new NotFoundException(__('Invalid group'));
			}
			$this->Session->write("RoundBob['Booking']['payment_group']",$group);
		}
		
		if($this->Session->read("RoundBob['Booking']['stage']")==null){
				$this->Session->write("RoundBob['Booking']['stage']",1);
				$this->Session->write("RoundBob['Booking']['destination_id']",$destination);
		}
		
		if($this->Auth->User('role')=='bank_admin'){
			$this->Session->write("RoundBob['Booking']['bank_payment_country']",$this->Auth->User('country_id'));
			$this->redirect(array('action' => 'pay_by_bank',$destination));
		}
		
		if($payment_mode){
			$this->Session->write("RoundBob['Booking']['stage']",2);
			$this->Session->write("RoundBob['Booking']['destination_id']",$destination);
			$this->Session->write("RoundBob['Booking']['payment_mode']",$payment_mode);
			switch((int)$payment_mode){
				case 1:
					$this->redirect(array('action' => 'pay_by_bank',$destination));
					break;
				case 2:
					$this->redirect(array('action' => 'pay_by_pay_pal',$destination));
					break;
				default:
					$this->Session->write("RoundBob['Booking']['stage']",1);
					break;
			}
		}
		
		$admin_client_id=$this->Session->read("RoundBob['Booking']['admin_client_id']");
		
		$countries		= $this->Country->find('all');
		$booking_stage	= (int)$this->Session->read("RoundBob['Booking']['stage']");
		$destination	= $this->Destination->find('all',array('conditions'=>array('id'=>$destination),'recursive'=>-1));
		$groups			= $this->Group->find('all',array(
							'recursive'=>-1,
							'conditions'=>array(
								'Group.user_id'=>(($this->Auth->User('role')=='bank_admin' && ($admin_client_id))?$admin_client_id:$this->Auth->User('id'))
							)
						));
		$this->set(compact('booking_stage','destination','countries','groups'));
	}
	
	
	public function pay_by_bank($destination=null,$bank=null,$payment_mode=null,$bank_name=''){
		if (!$this->Destination->exists($destination)) {
			throw new NotFoundException(__('Invalid destination'));
		}
		
		if((int)$bank){
			
			$this->Session->write("RoundBob['Booking']['stage']",3);
			$this->Session->write("RoundBob['Booking']['destination_id']",$destination);
			$this->Session->write("RoundBob['Booking']['bank']",$bank);
			
			if($this->Auth->User('role')=='bank_admin'){
				$this->redirect(array('action' => 'confirm_pay_by_bank',$destination,$bank,$bank_name));
			}
			
			switch((int)$this->Session->read("RoundBob['Booking']['payment_mode']")){
				case 1:
					$this->redirect(array('action' => 'confirm_pay_by_bank',$destination,$bank,$bank_name));
					break;
				case 2:
					$this->redirect(array('action' => 'confirm_pay_by_pay_pal',$destination,$bank));
					break;
				default:
					
					$this->Session->setFlash(__('Invalid payment mode.'));
					$this->Session->write("RoundBob['Booking']['stage']",2);
					break;
			}
		}
		
		if($this->Auth->User('role')=='bank_admin'){
			$banks=$this->Bank->find('all',array('recursive'=>-1,
					'conditions'=>array(
						'Bank.id'=>$this->Auth->User('bank_id'),
						'Bank.country_id'=>$this->Auth->User('country_id')
					)
				)
			);
		}else{
			$banks=$this->Bank->find('all',array('recursive'=>-1,
					'conditions'=>array(
						'Bank.country_id'=>$this->Session->read("RoundBob['Booking']['bank_payment_country']")
					)
				)
			);
		}
		$booking_stage=(int)$this->Session->read("RoundBob['Booking']['stage']");
		$destination=$this->Destination->find('all',array('conditions'=>array('id'=>$destination),'recursive'=>-1));
		$this->set(compact('booking_stage','destination','banks'));
	}
	
	public function confirm_pay_by_bank($destination=null,$bank=null,$bank_name=''){
		if (!$this->Destination->exists($destination)) {
			throw new NotFoundException(__('Invalid destination'));
		}
		
		$destinations=$this->Destination->find('all',array('conditions'=>array('id'=>$destination),'recursive'=>-1));
		
		if($this->Auth->User('role')=='bank_admin' || $this->Auth->User('role')=='super_admin'){
				if($this->Session->read("RoundBob['Booking']['admin_client_id']")!=null){
					$this->request->data['Booking']['user_id']=$this->Session->read("RoundBob['Booking']['admin_client_id']");
				}else{
					$this->Session->setFlash(__('We lost track of who your are booking for.'));
					$this->redirect(array('action' => 'book',$this->Session->read("RoundBob['Booking']['destination_id']")));
				}
		}else{
				$this->request->data['Booking']['user_id']=$this->Auth->User('id');
		}

		
		$this->request->data['Booking']['destination_id']=$destination;
		$this->request->data['Booking']['booking_date']=date('Y-m-d');
		$this->request->data['Booking']['booking_time']=date('H:i:s');
		$this->request->data['Booking']['bank_id']=$bank;
		$this->request->data['Booking']['payment_mode']='bank';		
		$this->request->data['Booking']['amount']=$destinations[0]['Destination']['cost'];
		
		$group_members=array();//contains the group members to book for. If empty, then there were none.
		$insert_IDs=array();
		
		if($this->Session->read("RoundBob['Booking']['book_as_Group']")){
				if($this->Session->read("RoundBob['Booking']['payment_group']")){
					$this->request->data['Booking']['group_id']=$this->Session->read("RoundBob['Booking']['payment_group']");
					$this->request->data['Booking']['book_type']=1;
				}
				//select all the group members
				$group_members=$this->GroupMember->find('all',array(
						'recursive'=>-1,
						'fields'=>array(
							'GroupMember.user_id'
						),
						'conditions'=>array(
							'GroupMember.group_id'=>$this->Session->read("RoundBob['Booking']['payment_group']")
						)
					)
				);
				
				foreach($group_members as $member){
				
					$func=$this->Func;
					$transaction=$func->get_serial_number().''.(date('ymdHis'));
					$this->request->data['Booking']['transaction']=$transaction;
					$this->request->data['Booking']['id']=$func->getUID1();
					$this->request->data['Booking']['user_id']=$member['GroupMember']['user_id'];
					$this->request->data['Booking']['user_confirmed']=0;
					
					$this->Booking->create();
					if($this->Booking->save($this->request->data)){
						array_push($insert_IDs,$this->Booking->getInsertID());
					}
					
					/*else{
						foreach($insert_IDs as $insert_ID){
							<delete all the bookings inserted sofar>
						}
					}*/
				}
				$this->request->data['Booking']['user_id']=$this->Auth->User('id');
		}
		
		$func=$this->Func;
		$transaction=$func->get_serial_number().''.(date('ymdHis'));
		$this->request->data['Booking']['transaction']=$transaction;
		$this->request->data['Booking']['id']=$func->getUID1();
		$this->request->data['Booking']['user_confirmed']=1;
		
		$this->Booking->create();
		if ($this->Booking->save($this->request->data)) {
			$this->Session->setFlash(__('The reservation has been saved'));
			
			//Make notifications
			if($this->Auth->User('role')!='bank_admin'){
				$bank_admins=$this->User->find('all',array('recursive'=>-1,
							'fields'=>'id',
							'conditions'=>array(
								'role'=>'bank_admin',
								'bank_id'=>$bank,
								'id !='=>$this->Auth->User('id')
							)
				));				
				//To bank_admins
				foreach($bank_admins as $bank_admin){
					$this->User->Notification->msg(
						$bank_admin['User']['id']," has booked for ".($destinations[0]['Destination']['name']).'. Bank:'.$bank_name.' Transaction ref: ['.$transaction."]",
						null,(Configure::read('domainAddress')).'/bookings/view/'.$this->Booking->getInsertID(),$this->Auth->User('id')
					);
				}				
				//To super_admins
				foreach(Configure::read('super_admins') as $super_admin){
					$this->User->Notification->msg(
						$super_admin," has booked for ".($destinations[0]['Destination']['name']).'. Bank:'.$bank_name.' Transaction ref: ['.$transaction."]",
						null,(Configure::read('domainAddress')).'/bookings/view/'.$this->Booking->getInsertID(),$this->Auth->User('id')
					);
				}
				
				//To group members
				$c=-1;
				foreach($group_members as $group_member){
					$c++;
					$this->User->Notification->msg(
						$group_member['GroupMember']['user_id']," has booked a Group holiday for ".($destinations[0]['Destination']['name']).'.Payment Bank:'.$bank_name.'. You need to Confirm it.',
						null,(Configure::read('domainAddress')).'/bookings/view/'.($insert_IDs[$c]),$this->Auth->User('id')
					);
				}
				
			}else{
				//To super_admins only if its a bank_admin
				foreach(Configure::read('super_admins') as $super_admin){
					$this->User->Notification->msg(
						$super_admin,($this->Auth->User('name'))." has booked for ".($this->Session->read("RoundBob['Booking']['admin_client_name']"))." for ".($destinations[0]['Destination']['name']).'. Bank:'.$bank_name.' Transaction ref: ['.$transaction."]",
						null,(Configure::read('domainAddress')).'/bookings/view/'.$this->Booking->getInsertID(),$this->Auth->User('id')
					);
				}
				
				//To group members
				$c=-1;
				foreach($group_members as $group_member){
					$c++;
					$this->User->Notification->msg(
						$group_member['GroupMember']['user_id'],($this->Auth->User('name'))." has booked a Group holiday for ".($destinations[0]['Destination']['name']).'.Payment Bank:'.$bank_name.'. You need to Confirm it.',
						null,(Configure::read('domainAddress')).'/bookings/view/'.($insert_IDs[$c]),$this->Auth->User('id')
					);
				}
			}
			
			$this->Session->delete("RoundBob['Booking']");
		} else {
			/*else{
				foreach($insert_IDs as $insert_ID){
					<delete all the bookings inserted sofar>
				}
			}*/
			$this->Session->setFlash(__('The reservation could not be saved. Please, try again.'));
			$this->Session->write("RoundBob['Booking']['stage']",1);
			$this->redirect(array('action' => 'book',$destination));
		}
		
		
		
		$msg="You made a reservation for ".$destinations[0]['Destination']['name'].'. Follow the status of your reservation from your account.<br/><b>Transaction ID:</b> '.$transaction;	
		
		$this->set(compact('msg'));
	}
	
	
	public function pay_by_pay_pal($destination=null,$payment_mode=null){
		if (!$this->Destination->exists($destination)) {
			throw new NotFoundException(__('Invalid destination'));
		}
		
		if((int)$payment_mode){
			
			$this->Session->write("RoundBob['Booking']['stage']",3);
			$this->Session->write("RoundBob['Booking']['destination_id']",$destination);
			
			
			switch((int)$payment_mode){
				case 1:
					$this->redirect(array('action' => 'confirm_pay_by_pay_pal',$destination));
					break;
				case 2:
					$this->redirect(array('action' => 'confirm_pay_by_pay_pal',$destination));
					break;
				default:
					$this->Session->setFlash(__('Invalid payment mode.'));
					$this->Session->write("RoundBob['Booking']['stage']",2);
					break;
			}
		}
		
		$booking_stage=(int)$this->Session->read("RoundBob['Booking']['stage']");
		$destination=$this->Destination->find('all',array('conditions'=>array('id'=>$destination),'recursive'=>-1));
		$this->set(compact('booking_stage','destination'));
	}
	
	public function confirm_pay_by_pay_pal($destination=null){
		if (!$this->Destination->exists($destination)) {
			throw new NotFoundException(__('Invalid destination'));
		}
		
		$destinations=$this->Destination->find('all',array('conditions'=>array('id'=>$destination),'recursive'=>-1));
		
		$this->request->data['Booking']['user_id']=$this->Auth->User('id');
		$this->request->data['Booking']['destination_id']=$destination;
		$this->request->data['Booking']['booking_date']=date('Y-m-d');
		$this->request->data['Booking']['booking_time']=date('H:i:s');
		$this->request->data['Booking']['payment_mode']='pay_pal';
		$this->request->data['Booking']['amount']=$destinations[0]['Destination']['cost'];
		$func=$this->Func;
		$transaction=$func->get_serial_number().''.(date('ymdHis'));
		$this->request->data['Booking']['transaction']=$transaction;
		
		$this->Booking->create();
		if ($this->Booking->save($this->request->data)) {
			$this->Session->setFlash(__('The reservation has been saved'));
			$this->Session->delete("RoundBob['Booking']['stage']");
		} else {
			$this->Session->setFlash(__('The reservation could not be saved. Please, try again.'));
			$this->Session->write("RoundBob['Booking']['stage']",1);
			$this->redirect(array('action' => 'book',$destination));
		}
		
		
		
		$msg="You made a reservation for ".$destinations[0]['Destination']['name'].'. Follow the status of your reservation from your account.<br/><b>Transaction ID:</b> '.$transaction;	
		
		$this->set(compact('msg'));
	}
	


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Booking->recursive = 0;
		$this->paginate=array(
			'conditions'=>array(
				'Booking.user_id'=>$this->Auth->User('id')
			),
			'order'=>'Booking.booking_date desc, Booking.booking_time desc'
		);
		$this->set('bookings', $this->paginate());
	}
	
	

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Booking->exists($id)) {
			throw new NotFoundException(__('Invalid booking'));
		}
		$options=array();
		/*if($this->Auth->User('role')!='bank_admin' || $this->Auth->User('role')!='super_admin'){
			$options = array('conditions' => array(
				'Booking.' . $this->Booking->primaryKey => $id,
				'Booking.user_id' => $this->Auth->User('id')
			));
		}else {
			$options = array('conditions' => array(
				'Booking.' . $this->Booking->primaryKey => $id
			));
		}*/
		
		$options = array('conditions' => array(
				'Booking.' . $this->Booking->primaryKey => $id
			));
		$paymentMethods = $this->Booking->Payment->PaymentMethod->find('list');
		$this->set(compact('paymentMethods'));
		
		
		$this->set('booking', $this->Booking->find('first', $options));
	}
	
/**
 * index method
 *
 * @return void
 */
	public function bob_admin_search() {
		$this->Booking->recursive = 0;
		$this->paginate=array();
		if($this->Auth->User('role')=='super_admin' || $this->Auth->User('role')=='bank_admin'){
			$search_query_string='';
			if(isset($_REQUEST['search_query_string'])){
					$search_query_string=trim($_REQUEST['search_query_string']);
			}
			
			if($this->Auth->User('role')=='bank_admin'){				
				if(!empty($search_query_string)){				
					$this->paginate = array(
						'conditions' => array(
							'OR' => array(
								'Booking.id LIKE' =>  '%' . $search_query_string . '%',
								'Booking.transaction LIKE' =>  '%' . $search_query_string . '%'
							),
							'Booking.bank_id'=>$this->Auth->User('bank_id')
						),
						'order' => array('Booking.date' => 'desc')
					);
					
				}else{
					$this->paginate=array('conditions'=>array('Booking.bank_id'=>$this->Auth->User('bank_id')));
				}
			}else{				
				if(!empty($search_query_string)){					
					$this->paginate = array(
						'conditions' => array(
							'OR' => array(
								'Booking.id LIKE' =>  '%' . $search_query_string . '%',
								'Booking.transaction LIKE' =>  '%' . $search_query_string . '%'
							)
						),
						'order' => array('Booking.date' => 'desc')
					);
					
				}
			}			
			
		}else if($this->Auth->User('role')!='admin'){
			$this->paginate=array('conditions'=>array('user_id'=>$this->Auth->User('id')));
		}		
		
		$this->set('bookings', $this->paginate());
	}	


	/**
 * index method
 *
 * @return void
 */
	public function bob_admin_index() {
		$this->Booking->recursive = 0;
		
		if($this->Auth->User('role')=='bank_admin'){
			$this->paginate=array(
				'conditions'=>array(
					'Booking.bank_id'=>$this->Auth->User('bank_id'),
					'Booking.destination_id'=>9
				),
				'order'=>'Booking.booking_date desc, Booking.booking_time desc',
				'recursive'=>0
			);
		}else if($this->Auth->User('role')!='super_admin'){
			$this->paginate=array('conditions'=>array('user_id'=>$this->Auth->User('id')),'order'=>'booking_date desc, booking_time desc');
		}
		$this->set('bookings', $this->paginate());
	}

/**
 * add method
 *
 * @return void
 */
	public function bob_admin_add() {
		if ($this->request->is('post')) {
			$this->Booking->create();
			if ($this->Booking->save($this->request->data)) {
				$this->Session->setFlash(__('The booking has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The booking could not be saved. Please, try again.'));
			}
		}
		$users = $this->Booking->User->find('list');
		$destinations = $this->Booking->Destination->find('list');
		$this->set(compact('users', 'destinations'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function bob_admin_edit($id = null) {
		if (!$this->Booking->exists($id)) {
			throw new NotFoundException(__('Invalid booking'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Booking->save($this->request->data)) {
				$this->Session->setFlash(__('The booking has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The booking could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Booking.' . $this->Booking->primaryKey => $id));
			$this->request->data = $this->Booking->find('first', $options);
		}
		$users = $this->Booking->User->find('list');
		$destinations = $this->Booking->Destination->find('list');
		$this->set(compact('users', 'destinations'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param string $id
 * @return void
 */
	public function bob_admin_delete($id = null) {
		$this->Booking->id = $id;
		if (!$this->Booking->exists()) {
			throw new NotFoundException(__('Invalid booking'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Booking->delete()) {
			$this->Session->setFlash(__('Booking deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Booking was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
	
	public function cancel_booking($id = null) {
		$this->Booking->id = $id;
		if (!$this->Booking->exists()) {
			throw new NotFoundException(__('Invalid booking'));
		}
		$this->request->data['Booking']['id']=$this->Booking->id;
		$this->request->data['Booking']['status']=1;
		$this->request->data['Booking']['current_status']='I Canceled';
		if ($this->Booking->save($this->request->data)) {
			$this->Session->setFlash(__('You just canceled your reservation.'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Reservation could not be canceled.'));
		$this->redirect(array('action' => 'index'));
	}
}
