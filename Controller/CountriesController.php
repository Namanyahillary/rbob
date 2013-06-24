<?php
App::uses('AppController', 'Controller');
/**
 * Countries Controller
 *
 * @property Country $Country
 */
class CountriesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Country->recursive = 0;
		$this->set('countries', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Country->exists($id)) {
			throw new NotFoundException(__('Invalid country'));
		}
		$options = array('conditions' => array('Country.' . $this->Country->primaryKey => $id));
		$this->set('country', $this->Country->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$func=$this->Func;
			$_id=$func->getUID1();	
			$this->request->data['Country']['id']=$_id;			
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
					$this->redirect(array('action' => 'add'));					
				}else{
					//create filename if the image type is alowed
					$file_name=($_id).'.'.(pathinfo($_FILES['fileField']['name'], PATHINFO_EXTENSION));
				}
			}else{
				$file_name='default.png';
			}
			
			//uploading the file
			if(move_uploaded_file($_FILES['fileField']['tmp_name'],"img/countries/$file_name")){
				$this->request->data['Country']['image_file']=$file_name;//filename to use for submitted file
				
				if (copy("img/countries/$file_name","img/imagecache/countries/$file_name")) {
					$image ="img/imagecache/countries/$file_name"; 
					$width = 300; $height = 300; 
					$this->ImageResize->resize($image, $width, $height);
					
					$this->request->data['Country']['date']=date('Y:m:d');
					$this->Country->create();
				
					if ($this->Country->save($this->request->data)) {
						$this->Session->setFlash(__('The Country has been saved', true));
						$this->redirect(array('action' => 'index'));
					} else {
						$this->Session->setFlash(__('The Country could not be saved. Please, try again.', true));
						
												
						if(file_exists("img/countries/$file_name")){
							@unlink("img/countries/$file_name");
						}
												
						if(file_exists($image)){
							@unlink($image);
						}
						$this->redirect(array('action' => 'add'));
					}
				}else{
					@unlink("img/countries/$file_name");
					$this->Session->setFlash(__('Picture could not be saved', true));
					$this->redirect(array('action' => 'add'));
					
				}	
									
			}else{
				$this->Session->setFlash(__('Picture could not be saved', true));
				$this->redirect(array('action' => 'add'));
			}			
		}
		$regions = $this->Country->Region->find('list');
		$this->set(compact('regions'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Country->exists($id)) {
			throw new NotFoundException(__('Invalid country'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
		
			$func=$this->Func;			
			$file_name='';
			
			if(isset($_FILES['fileField']['name']) and !empty($_FILES['fileField']['name'])){//getting the file extension and testing it
				$previous_profile_image=$this->request->data['Country']['image_file'];
				$file=explode('.',$previous_profile_image);
				
				$fileExtension=pathinfo($_FILES['fileField']['name'], PATHINFO_EXTENSION);
				$FileExtensionAllowed=false;
				switch(strtolower($fileExtension)){
					case 'png':
						$FileExtensionAllowed=true;
						break;
					default:
						$FileExtensionAllowed=false;
				}
				
				//redirect the user if the file is not accepted to be uploaded
				if(!$FileExtensionAllowed){
					$this->Session->setFlash(__('File type not allowed...try png or jpeg images.Thanks', true));
					$this->redirect(array('action' => 'add'));					
				}else{
					//create filename if the image type is alowed										
					$file_name=($this->request->data['Country']['id']).'.'.(pathinfo($_FILES['fileField']['name'], PATHINFO_EXTENSION));	//the new uploaded file but with the same name as before			
					if(file_exists("img/countries/$previous_profile_image")){
						if($this->request->data['Country']['image_file']!='default.png')
							@unlink("img/countries/$previous_profile_image");
					}
					
					if(file_exists("img/imagecache/countries/$previous_profile_image")){
							@unlink("img/imagecache/countries/$previous_profile_image");
					}
					
					if(move_uploaded_file($_FILES['fileField']['tmp_name'],"img/countries/$file_name")){
						$this->request->data['Country']['image_file']=$file_name;//filename to use for submitted file
						
						if (copy("img/countries/$file_name","img/imagecache/countries/$file_name")) {
							$image ="img/imagecache/countries/$file_name"; 
							$width = 500; $height = 500; 
							$this->ImageResize->resize($image, $width, $height);
						}
					}		
					
				}
			}
			
			if ($this->Country->save($this->request->data)) {
				$this->Session->setFlash(__('The country has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The country could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Country.' . $this->Country->primaryKey => $id));
			$this->request->data = $this->Country->find('first', $options);
		}
		$regions = $this->Country->Region->find('list');
		$this->set(compact('regions'));
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
		$this->Country->id = $id;
		if (!$this->Country->exists()) {
			throw new NotFoundException(__('Invalid country'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Country->delete()) {
			$this->Session->setFlash(__('Country deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Country was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
