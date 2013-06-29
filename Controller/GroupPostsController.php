<?php
App::uses('AppController', 'Controller');
/**
 * GroupPosts Controller
 *
 * @property GroupPost $GroupPost
 */
class GroupPostsController extends AppController {
	public $uses=array('GroupPost','Group');
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->GroupPost->recursive = 0;
		$this->set('groupPosts', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->GroupPost->exists($id)) {
			throw new NotFoundException(__('Invalid group post'));
		}
		$options = array('conditions' => array('GroupPost.' . $this->GroupPost->primaryKey => $id));
		$this->set('groupPost', $this->GroupPost->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$func=$this->Func;
			$this->request->data['GroupPost']['id']=$func->getUID1();
			$this->request->data['GroupPost']['date']=date('Y-m-d H:i:s');
			$this->request->data['GroupPost']['user_id']=$this->Auth->User('id');
			
			//check whether the group_id posted actually exists
			if (!$this->Group->exists($this->request->data['GroupPost']['group_id'])) {
				$this->Session->setFlash(__('Invalid Request'));
				$this->redirect(Configure::read('domainAddress'));
			}
			
			//check whether this group belongs to this user
			//<<<CODE MISSING HERE>>>
			
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
					$this->redirect(array('controller'=>'groups','action' => 'view',$this->request->data['GroupPost']['group_id']));					
				}else{
					//create filename if the image type is alowed
					$file_name=($func->getUID1()).'.'.(pathinfo($_FILES['fileField']['name'], PATHINFO_EXTENSION));
					
					//uploading the file
					if(move_uploaded_file($_FILES['fileField']['tmp_name'],"img/group_posts/$file_name")){
						$this->request->data['GroupPost']['image_url']=$file_name;//filename to use for submitted file
						$this->request->data['GroupPost']['has_image']=1;
		
						if (copy("img/group_posts/$file_name","img/imagecache/group_posts/$file_name")) {
							$image ="img/imagecache/group_posts/$file_name"; 
							$width = 500;$height = 240;
							$this->ImageResize->resize($image, $width, $height);
						}
					}
				}
			}
			
			$this->GroupPost->create();
			if ($this->GroupPost->save($this->request->data)) {
				$this->redirect(array('controller'=>'groups','action' => 'view',$this->request->data['GroupPost']['group_id']));
			} else {				
				$this->Session->setFlash(__('Say something about the Post.'));
				if(file_exists("img/group_posts/$file_name")){
					@unlink("img/group_posts/$file_name");
				}
				$this->redirect(array('controller'=>'groups','action' => 'view',$this->request->data['GroupPost']['group_id']));
			}
		}
		$groups = $this->GroupPost->Group->find('list');
		$users = $this->GroupPost->User->find('list');
		$this->set(compact('groups', 'users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->GroupPost->exists($id)) {
			throw new NotFoundException(__('Invalid group post'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->GroupPost->save($this->request->data)) {
				$this->Session->setFlash(__('The group post has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The group post could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('GroupPost.' . $this->GroupPost->primaryKey => $id));
			$this->request->data = $this->GroupPost->find('first', $options);
		}
		$groups = $this->GroupPost->Group->find('list');
		$users = $this->GroupPost->User->find('list');
		$this->set(compact('groups', 'users'));
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
		$this->GroupPost->id = $id;
		if (!$this->GroupPost->exists()) {
			throw new NotFoundException(__('Invalid group post'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->GroupPost->delete()) {
			$this->Session->setFlash(__('Group post deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Group post was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
