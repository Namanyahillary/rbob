<?php
App::uses('AppController', 'Controller');
/**
 * Destinations Controller
 *
 * @property Destination $Destination
 */
class DestinationsController extends AppController {
	
	public function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow('view','index','advanced_search');
	}
	
	public function approve($destination_id){
		$this->Destination->id = $destination_id;
		if (!$this->Destination->exists()) {
			$this->Session->setFlash(__('Invalid destination'));
			$this->redirect(array('action' => 'index'));
		}
		
		if($this->Auth->User('role')!='super_admin'){
			$this->Session->setFlash(__('Access denied'));
			$this->redirect(array('action' => 'index'));
		}
		
		$this->request->data['Destination']['id']=$destination_id;
		$this->request->data['Destination']['is_approved']=1;
		
		if ($this->Destination->save($this->request->data)) {
			$this->Session->setFlash(__('Destination approved'));
			$this->redirect(array('action' => 'index'));
		}else{
			$this->Session->setFlash(__('Destination not approved'));
			$this->redirect(array('action' => 'index'));
		}
	}
	
	public function dis_approve($destination_id){
		$this->Destination->id = $destination_id;
		if (!$this->Destination->exists()) {
			$this->Session->setFlash(__('Invalid destination'));
			$this->redirect(array('action' => 'index'));
		}
		
		if($this->Auth->User('role')!='super_admin'){
			$this->Session->setFlash(__('Access denied'));
			$this->redirect(array('action' => 'index'));
		}
		
		$this->request->data['Destination']['id']=$destination_id;
		$this->request->data['Destination']['is_approved']=0;
		
		if ($this->Destination->save($this->request->data)) {
			$this->Session->setFlash(__('Destination disapproved'));
			$this->redirect(array('action' => 'index'));
		}else{
			$this->Session->setFlash(__('Destination not disapproved'));
			$this->redirect(array('action' => 'index'));
		}
	}
	
	public function advanced_search(){
		if ($this->request->is('post')) {
			//$region=$this->Session->read("RoundBob['Destination']['Region']");
			
			$country=$this->request->data['Destination']['country'];
			$category=$this->request->data['Destination']['category'];
			$price=$this->request->data['Destination']['price'];
			
			$this->Destination->recursive = 1;
			$this->paginate=array('conditions'=>array(
				'Destination.country_id'=>$country,
				'Destination.category_id'=>$category,
				'OR'=>array(
					'Destination.cost <='=>$price
				),
			));
			
			$this->set('destinations', $this->paginate());	
			$this->render('index');
		}else{
			$this->redirect('index');
		}
	}
	
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$region=$this->Session->read("RoundBob['Destination']['Region']");
		$country=$this->Session->read("RoundBob['Destination']['Country']");
		$category=$this->Session->read("RoundBob['Destination']['Category']");
		
		$this->Destination->recursive = 1;
		
		$user_role=$this->Auth->User('role');
		if($user_role=='super_admin' || $user_role=='collector1'){
			if($user_role=='collector1'){
				$this->paginate=array(
					'conditions'=>array(
						'Destination.user_id'=>$this->Auth->User('id')
					),
					'order'=>'Destination.date desc'
				);
			}
		}else if($region==null || $country==null){
			$this->Session->setFlash(__('Please select a country.'));
			$this->redirect(Configure::read('domainAddress'));
		}else if($region!=null && $country!=null){
			$this->paginate=array(
				'conditions'=>array(
					'Destination.country_id'=>$country,
					'Destination.category_id'=>$category,
					'Destination.is_approved'=>1
				),
				'order'=>'Destination.date desc'
			);
		}
		
		$this->set('destinations', $this->paginate());	
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Destination->exists($id)) {
			throw new NotFoundException(__('Invalid destination'));
		}
		
		$_activities_selected=$this->Session->read("RoundBob['Booking']['activities']");
		if(!isset($_activities_selected['RoundBob']['Booking']['Destination_'.($id)])){
			$this->Session->delete("RoundBob['Booking']['activities']");
		}
		$options = array('conditions' => array('Destination.' . $this->Destination->primaryKey => $id));
		$this->set('destination', $this->Destination->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function bob_admin_add() {
		if ($this->request->is('post')) {
			
			$func=$this->Func;
			$file_name='';
			if(isset($_FILES['fileField']['name']) and !empty($_FILES['fileField']['name'])){//getting the file extension and testing it
				$fileExtension=pathinfo($_FILES['fileField']['name'], PATHINFO_EXTENSION);
				$FileExtensionAllowed=false;
				switch(strtolower($fileExtension)){
					case 'png':
						$FileExtensionAllowed=true;
						break;
					case 'jpg':
						$FileExtensionAllowed=true;
						break;
					default:
						$FileExtensionAllowed=false;
				}
				
				//redirect the user if the file is not accepted to be uploaded
				if(!$FileExtensionAllowed){
					$this->Session->setFlash(__('File type not allowed...try png or jpeg images.Thanks', true));
					$this->redirect(array('action' => 'bob_admin_add'));					
				}else{
					//create filename if the image type is alowed
					$file_name=($func->getUID1()).'.'.(pathinfo($_FILES['fileField']['name'], PATHINFO_EXTENSION));
				}
			}else{
				$file_name='default.png';
			}
			
			//uploading the file
			if(move_uploaded_file($_FILES['fileField']['tmp_name'],"img/destinations/$file_name")){
				$this->request->data['Destination']['image_file']=$file_name;//filename to use for submitted file
				
				if (copy("img/destinations/$file_name","img/imagecache/destinations/$file_name")) {
					$image ="img/imagecache/destinations/$file_name"; 
					$width = 300; $height = 300; 
					$this->ImageResize->resize($image, $width, $height);
					
					$this->request->data['Destination']['user_id']=$this->Auth->User('id');
					if($this->Auth->User('id')=='super_admin'){
						$this->request->data['Destination']['is_approved']=1;
					}else{
						$this->request->data['Destination']['is_approved']=0;
					}
					
					$this->request->data['Destination']['id']=$func->getUID1();
					date_default_timezone_set ( 'Africa/Nairobi' );
					$this->request->data['Destination']['date']=date('Y-m-d H:i:s');
					$this->Destination->create();
				
					if ($this->Destination->save($this->request->data)) {
						$this->Session->setFlash(__('The Destination has been saved', true));
						$this->redirect(array('action' => 'index'));
					} else {
						$this->Session->setFlash(__('The Destination could not be saved. Please, try again.', true));
						
												
						if(file_exists("img/destinations/$file_name")){
							@unlink("img/destinations/$file_name");
						}
												
						if(file_exists($image)){
							@unlink($image);
						}
						$this->redirect(array('action' => 'bob_admin_add'));
					}
				}else{
					@unlink("img/destinations/$file_name");
					$this->Session->setFlash(__('Picture could not be saved', true));
					$this->redirect(array('action' => 'bob_admin_add'));
					
				}	
									
			}else{
				$this->Session->setFlash(__('Picture could not be saved', true));
				$this->redirect(array('action' => 'bob_admin_add'));
			}			
		}
		$countries = $this->Destination->Country->find('list');
		$categories = $this->Destination->Category->find('list');
		$regions = $this->Destination->Region->find('list');
		$this->set(compact('regions','countries','categories'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function bob_admin_edit($id = null) {
		if (!$this->Destination->exists($id)) {
			throw new NotFoundException(__('Invalid destination'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			
			$this->request->data['Destination']['date']=date('Y-m-d');
			$func=$this->Func;			
			$file_name='';
			
			if(isset($_FILES['fileField']['name']) and !empty($_FILES['fileField']['name'])){//getting the file extension and testing it
				$previous_profile_image=$this->request->data['Destination']['image_file'];
				$file=explode('.',$previous_profile_image);
				
				$fileExtension=pathinfo($_FILES['fileField']['name'], PATHINFO_EXTENSION);
				$FileExtensionAllowed=false;
				switch(strtolower($fileExtension)){
					case 'png':
						$FileExtensionAllowed=true;
						break;
					case 'jpg':
						$FileExtensionAllowed=true;
						break;
					default:
						$FileExtensionAllowed=false;
				}
				
				//redirect the user if the file is not accepted to be uploaded
				if(!$FileExtensionAllowed){
					$this->Session->setFlash(__('File type not allowed...try png or jpeg images.Thanks', true));
					$this->redirect(array('action' => 'bob_admin_add'));					
				}else{
					//create filename if the image type is alowed										
					$file_name=($func->getUID1()).'.'.(pathinfo($_FILES['fileField']['name'], PATHINFO_EXTENSION));	//the new uploaded file but with the same name as before			
					if(file_exists("img/destinations/$previous_profile_image")){
						if($this->request->data['Destination']['image_file']!='default.png')
							@unlink("img/destinations/$previous_profile_image");
					}
					
					if(file_exists("img/imagecache/destinations/$previous_profile_image")){
							@unlink("img/imagecache/destinations/$previous_profile_image");
					}
					
					if(move_uploaded_file($_FILES['fileField']['tmp_name'],"img/destinations/$file_name")){
						$this->request->data['Destination']['image_file']=$file_name;//filename to use for submitted file
						
						if (copy("img/destinations/$file_name","img/imagecache/destinations/$file_name")) {
							$image ="img/imagecache/destinations/$file_name"; 
							$width = 300; $height = 300; 
							$this->ImageResize->resize($image, $width, $height);
						}
					}		
					
				}
			}
			
			
			if ($this->Destination->save($this->request->data)) {
				$this->Session->setFlash(__('The destination has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The destination could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Destination.' . $this->Destination->primaryKey => $id));
			$this->request->data = $this->Destination->find('first', $options);
		}
		$countries = $this->Destination->Country->find('list');
		$categories = $this->Destination->Category->find('list');
		$regions = $this->Destination->Region->find('list');
		$this->set(compact('regions','countries','categories'));
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
		$this->Destination->id = $id;
		if (!$this->Destination->exists()) {
			throw new NotFoundException(__('Invalid destination'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Destination->delete()) {
			$this->Session->setFlash(__('Destination deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Destination was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
