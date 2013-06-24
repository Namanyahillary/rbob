<?php
App::uses('AppController', 'Controller');
/**
 * Activities Controller
 *
 * @property Activity $Activity
 */
class ActivitiesController extends AppController {
	public $uses=array('Activity','User','Destination');
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Activity->recursive = 0;
		$this->paginate=array(
			'order'=>'Activity.date desc'
		);
		$this->set('activities', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Activity->exists($id)) {
			throw new NotFoundException(__('Invalid activity'));
		}
		$options = array('conditions' => array('Activity.' . $this->Activity->primaryKey => $id));
		$this->set('activity', $this->Activity->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add($destination_id) {
		if (!$this->Destination->exists($destination_id)) {
			throw new NotFoundException(__('Invalid destination'));
		}
		if ($this->request->is('post')) {
			if($this->request->data['Activity']['destination_id']!=$destination_id){
				throw new NotFoundException(__('Invalid destination'));
			}
			
			$func = $this->Func;	
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
					$this->redirect(array('action' => 'add',$destination_id));					
				}else{
					//create filename if the image type is alowed
					$file_name=($func->getUID1()).'.'.(pathinfo($_FILES['fileField']['name'], PATHINFO_EXTENSION));
				}
			}else{
				$file_name='default.png';
			}
			
			//uploading the file
			if(move_uploaded_file($_FILES['fileField']['tmp_name'],"img/activities/$file_name")){
				$this->request->data['Activity']['cover_img']=$file_name;//filename to use for submitted file
				
				if (copy("img/activities/$file_name","img/imagecache/activities/$file_name")) {
					$image ="img/imagecache/activities/$file_name"; 
					$width = 300; $height = 300; 
					$this->ImageResize->resize($image, $width, $height);
					
					$this->request->data['Activity']['id']=$func->getUID1();
					$this->request->data['Activity']['user_id']=$this->Auth->User('id');
					$this->request->data['Activity']['date']=date('Y-m-d');
					
					$this->request->data['Activity']['destination_id']=$destination_id;
					
					$this->Activity->create();
					if ($this->Activity->save($this->request->data)) {
						$this->Session->setFlash(__('The Activity has been saved', true));
						$this->redirect(array('action' => 'index'));
					} else {
						$this->Session->setFlash(__('The Activity could not be saved. Please, try again.', true));
						
												
						if(file_exists("img/activities/$file_name")){
							@unlink("img/activities/$file_name");
						}
												
						if(file_exists($image)){
							@unlink($image);
						}
						$this->redirect(array('action' => 'add',$destination_id));
					}
				}else{
					@unlink("img/activities/$file_name");
					$this->Session->setFlash(__('Picture could not be saved', true));
					$this->redirect(array('action' => 'add',$destination_id));
					
				}	
									
			}else{
				$this->Session->setFlash(__('Picture could not be saved', true));
				$this->redirect(array('action' => 'add',$destination_id));
			}			
		}
		$destination = $destination_id;
		$this->set(compact('destination'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Activity->exists($id)) {
			throw new NotFoundException(__('Invalid activity'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Activity->save($this->request->data)) {
				$this->Session->setFlash(__('The activity has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The activity could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Activity.' . $this->Activity->primaryKey => $id));
			$this->request->data = $this->Activity->find('first', $options);
		}
		$destinations = $this->Activity->Destination->find('list');
		$users = $this->Activity->User->find('list');
		$this->set(compact('destinations', 'users'));
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
		$this->Activity->id = $id;
		if (!$this->Activity->exists()) {
			throw new NotFoundException(__('Invalid activity'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Activity->delete()) {
			$this->Session->setFlash(__('Activity deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Activity was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
