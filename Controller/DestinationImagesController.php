<?php
App::uses('AppController', 'Controller');
/**
 * DestinationImages Controller
 *
 * @property DestinationImage $DestinationImage
 */
class DestinationImagesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->DestinationImage->recursive = 0;
		$this->paginate=array('order'=>'Destination.date desc');
		$this->set('destinationImages', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->DestinationImage->exists($id)) {
			throw new NotFoundException(__('Invalid destination image'));
		}
		$options = array('conditions' => array('DestinationImage.' . $this->DestinationImage->primaryKey => $id));
		$this->set('destinationImage', $this->DestinationImage->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add($id) {
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
			if(move_uploaded_file($_FILES['fileField']['tmp_name'],"img/destination_images/$file_name")){
				$this->request->data['DestinationImage']['image_file']=$file_name;//filename to use for submitted file
				
				if (copy("img/destination_images/$file_name","img/imagecache/destination_images/$file_name")) {
					$image ="img/imagecache/destination_images/$file_name"; 
					$width = 100; $height = 100; 
					$this->ImageResize->resize($image, $width, $height);
					
					$this->request->data['DestinationImage']['user_id']=$this->Auth->User('id');
					$this->request->data['DestinationImage']['destination_id']=$id;
					
					$this->request->data['DestinationImage']['id']=$func->getUID1();
					date_default_timezone_set ( 'Africa/Nairobi' );
					$this->request->data['DestinationImage']['date']=date('Y-m-d');
					$this->DestinationImage->create();
				
					if ($this->DestinationImage->save($this->request->data)) {
						$this->Session->setFlash(__('The DestinationImage has been saved', true));
						$this->redirect(array('action' => 'index'));
					} else {
						$this->Session->setFlash(__('The DestinationImage could not be saved. Please, try again.', true));
						
												
						if(file_exists("img/destination_images/$file_name")){
							@unlink("img/destination_images/$file_name");
						}
												
						if(file_exists($image)){
							@unlink($image);
						}
						$this->redirect(array('action' => 'add',$id));
					}
				}else{
					@unlink("img/destination_images/$file_name");
					$this->Session->setFlash(__('Picture could not be saved', true));
					$this->redirect(array('action' => 'add',$id));					
				}	
									
			}else{
				$this->Session->setFlash(__('Picture could not be saved', true));
				$this->redirect(array('action' => 'add',$id));
			}
		}
		$destinations = $this->DestinationImage->Destination->find('list',array(
			'conditions'=>array(
				'Destination.id'=>$id
			)
		));
		$this->set(compact('destinations'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->DestinationImage->exists($id)) {
			throw new NotFoundException(__('Invalid destination image'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->DestinationImage->save($this->request->data)) {
				$this->Session->setFlash(__('The destination image has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The destination image could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('DestinationImage.' . $this->DestinationImage->primaryKey => $id));
			$this->request->data = $this->DestinationImage->find('first', $options);
		}
		$destinations = $this->DestinationImage->Destination->find('list');
		$users = $this->DestinationImage->User->find('list');
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
		$this->DestinationImage->id = $id;
		if (!$this->DestinationImage->exists()) {
			throw new NotFoundException(__('Invalid destination image'));
		}
		
		$this->request->onlyAllow('post', 'delete');
		
		$destination_image=$this->DestinationImage->find('first',array(
			'conditions'=>array(
				'DestinationImage.id'=>$id
			)
		));
		if ($this->DestinationImage->delete()) {
			$this->Session->setFlash(__('Destination image deleted'));
			
			$file_name=$destination_image['DestinationImage']['image_file'];
			if(file_exists("img/destination_images/$file_name")){
				@unlink("img/destination_images/$file_name");
			}
									
			if(file_exists("img/imagecache/destination_images/$file_name")){
				@unlink("img/imagecache/destination_images/$file_name");
			}			
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Destination image was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
