<?php
App::uses('AppController', 'Controller');
/**
 * Payments Controller
 *
 * @property Payment $Payment
 */
class PaymentsController extends AppController {
	public $uses=array('Payment','User','PaymentMethod','Booking');
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Payment->recursive = 0;
		$this->set('payments', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Payment->exists($id)) {
			throw new NotFoundException(__('Invalid payment'));
		}
		$options = array('conditions' => array('Payment.' . $this->Payment->primaryKey => $id));
		$this->set('payment', $this->Payment->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			
			if (!$this->Payment->Booking->exists($this->request->data['Payment']['b'])) {
				throw new NotFoundException(__('Invalid payment'));
			}
			
			$this->request->data['Payment']['booking_id']=$this->request->data['Payment']['b'];
			$this->request->data['Payment']['user_id']=$this->Auth->User('id');
			$this->request->data['Payment']['user_name']=$this->Auth->User('name');
			$this->request->data['Payment']['ip_address']=$_SERVER['REMOTE_ADDR'];
			$this->request->data['Payment']['date']=date('Y-m-d');
			$this->request->data['Payment']['time']=date('H:i:s');
			$this->request->data['Payment']['bank_id']=$this->Auth->User('bank_id');
			
			$this->Payment->create();
			pr($this->request->data);
			if ($this->Payment->save($this->request->data)) {
				$this->Session->setFlash(__('The payment has been saved'));
				
				//Make notification to super admin
				foreach(Configure::read('super_admins') as $super_admin){
					$this->User->Notification->msg(
						$super_admin," has added ".($this->request->data['Payment']['amount_paid'])." as payment for ".($this->request->data['Payment']['u'])." for ".($this->request->data['Payment']['d'])." booking. Ref [".$this->request->data['Payment']['t']."]. ",
						null,(Configure::read('domainAddress')).'/bookings/view/'.($this->request->data['Payment']['booking_id']),$this->Auth->User('id')
					);
				}
				
			} else {
				$this->Session->setFlash(__('The payment could not be saved. Please, try again.'));
			}
			
			$this->redirect(array(
					'action' => 'view',$this->request->data['Payment']['booking_id'],
					'controller'=>'bookings'
			));
		}else{
			throw new NotFoundException(__('Invalid request'));
		}
		
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Payment->exists($id)) {
			throw new NotFoundException(__('Invalid payment'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Payment->save($this->request->data)) {
				$this->Session->setFlash(__('The payment has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The payment could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Payment.' . $this->Payment->primaryKey => $id));
			$this->request->data = $this->Payment->find('first', $options);
		}
		$bookings = $this->Payment->Booking->find('list');
		$paymentMethods = $this->Payment->PaymentMethod->find('list');
		$this->set(compact('bookings', 'paymentMethods'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Payment->id = $id;
		if (!$this->Payment->exists()) {
			throw new NotFoundException(__('Invalid payment'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Payment->delete()) {
			$this->Session->setFlash(__('Payment deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Payment was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
