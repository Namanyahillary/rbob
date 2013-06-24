<?php
App::uses('AppController', 'Controller');
/**
 * ActivityImages Controller
 *
 * @property ActivityImage $ActivityImage
 */
class ActivityImagesController extends AppController {
	public $uses=array('ActivityImage','User','Activity');
	
	public function index_slide_show_get($activity_id=null) {
		$this->set('activity', $activity_id);
	}
	public function index_slide_show($activity_id=null) {
		$this->ActivityImage->recursive = 0;
		if($activity_id){
			$this->paginate=array(
				'conditions'=>array(
					'ActivityImage.activity_id'=>$activity_id
				),
				'order'=>'ActivityImage.date desc'
			);
		}else{
			$this->paginate=array(
				'order'=>'ActivityImage.date desc'
			);
		}
		$this->set('activityImages', $this->paginate());
	}
	
/**
 * index method
 *
 * @return void
 */
	public function index($activity_id=null) {
		$this->ActivityImage->recursive = 0;
		if($activity_id){
			$this->paginate=array(
				'conditions'=>array(
					'ActivityImage.activity_id'=>$activity_id
				),
				'order'=>'ActivityImage.date desc'
			);
		}else{
			$this->paginate=array(
				'order'=>'ActivityImage.date desc'
			);
		}
		$this->set('activityImages', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->ActivityImage->exists($id)) {
			throw new NotFoundException(__('Invalid activity image'));
		}
		$options = array('conditions' => array('ActivityImage.' . $this->ActivityImage->primaryKey => $id));
		$this->set('activityImage', $this->ActivityImage->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add($activity_id) {
		if (!$this->Activity->exists($activity_id)) {
			throw new NotFoundException(__('Invalid activity'));
		}
		if ($this->request->is('post')) {
			if($this->request->data['ActivityImage']['activity_id']!=$activity_id){
				throw new NotFoundException(__('Invalid activity'));
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
					$this->redirect(array('action' => 'add',$activity_id));					
				}else{
					//create filename if the image type is alowed
					$file_name=($func->getUID1()).'.'.(pathinfo($_FILES['fileField']['name'], PATHINFO_EXTENSION));
				}
			}else{
				$file_name='default.png';
			}
			
			//uploading the file
			if(move_uploaded_file($_FILES['fileField']['tmp_name'],"img/activity_images/$file_name")){
				$this->request->data['ActivityImage']['image_file']=$file_name;//filename to use for submitted file
				
				if (copy("img/activity_images/$file_name","img/imagecache/activity_images/$file_name")) {
					$image ="img/imagecache/activity_images/$file_name"; 
					$width = 300; $height = 300; 
					$this->ImageResize->resize($image, $width, $height);
					
					$this->request->data['ActivityImage']['id']=$func->getUID1();
					$this->request->data['ActivityImage']['user_id']=$this->Auth->User('id');
					$this->request->data['ActivityImage']['date']=date('Y-m-d');					
					$this->request->data['ActivityImage']['activity_id']=$activity_id;
					
					$this->ActivityImage->create();
					if ($this->ActivityImage->save($this->request->data)) {
						$this->Session->setFlash(__('The ActivityImage has been saved', true));
						$this->redirect(array('action' => 'index'));
					} else {
						$this->Session->setFlash(__('The ActivityImage could not be saved. Please, try again.', true));
						
												
						if(file_exists("img/activity_images/$file_name")){
							@unlink("img/activity_images/$file_name");
						}
												
						if(file_exists($image)){
							@unlink($image);
						}
						$this->redirect(array('action' => 'add',$activity_id));
					}
				}else{
					@unlink("img/activity_images/$file_name");
					$this->Session->setFlash(__('Picture could not be saved', true));
					$this->redirect(array('action' => 'add',$activity_id));
					
				}	
									
			}else{
				$this->Session->setFlash(__('Picture could not be saved', true));
				$this->redirect(array('action' => 'add',$activity_id));
			}
		}
		$activity = $activity_id;
		$this->set(compact('activity'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->ActivityImage->exists($id)) {
			throw new NotFoundException(__('Invalid activity image'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->ActivityImage->save($this->request->data)) {
				$this->Session->setFlash(__('The activity image has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The activity image could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('ActivityImage.' . $this->ActivityImage->primaryKey => $id));
			$this->request->data = $this->ActivityImage->find('first', $options);
		}
		$activities = $this->ActivityImage->Activity->find('list');
		$users = $this->ActivityImage->User->find('list');
		$this->set(compact('activities', 'users'));
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
		$this->ActivityImage->id = $id;
		if (!$this->ActivityImage->exists()) {
			throw new NotFoundException(__('Invalid activity image'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->ActivityImage->delete()) {
			$this->Session->setFlash(__('Activity image deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Activity image was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
