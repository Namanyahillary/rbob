<?php
App::uses('AppController', 'Controller');
/**
 * Groups Controller
 *
 * @property Group $Group
 */
class GroupsController extends AppController {
	public $uses=array('Group','GroupMember','User','GroupPost');
	
	public function albums($gid){
		
	}
	
	public function change_cover_img($id=null){
		if (!$this->Group->exists($id)) {
			throw new NotFoundException(__('Invalid group'));
		}
		
		if ($this->request->is('post') || $this->request->is('put')) {
			
			$this->Group->id = $this->request->data['Group']['gid'];
			if (!$this->Group->exists()) {
				throw new NotFoundException(__('Invalid group'));
			}
			
			$func=$this->Func;			
			$file_name='';
			
			if(isset($_FILES['fileField']['name']) and !empty($_FILES['fileField']['name'])){//getting the file extension and testing it
				$covers=$this->Group->find('all',array(
					'limit'=>1,
					'recursive'=>-1,
					'fields'=>array(
						'Group.cover_img'
					),
					'conditions'=>array(
						'Group.id'=>$id
					)
				));
				$previous_profile_image=$covers[0]['Group']['cover_img'];
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
					$this->redirect(array('action' => 'view',$this->request->data['Group']['gid']));					
				}else{
					//create filename if the image type is alowed										
					$file_name=($func->getUID1()).'.'.(pathinfo($_FILES['fileField']['name'], PATHINFO_EXTENSION));	//the new uploaded file but with the same name as before			
					if(file_exists("img/group_covers/$previous_profile_image")){
						if($previous_profile_image!='default.png')
							@unlink("img/group_covers/$previous_profile_image");
					}
					
					if(file_exists("img/imagecache/group_covers/$previous_profile_image")){
							@unlink("img/imagecache/group_covers/$previous_profile_image");
					}
					
					if(move_uploaded_file($_FILES['fileField']['tmp_name'],"img/group_covers/$file_name")){
						$this->request->data['Group']['cover_img']=$file_name;//filename to use for submitted file
						
						$width = 1000;
						$this->ImageResize->resize($file_name, $width, null);
						
						if (copy("img/group_covers/$file_name","img/imagecache/group_covers/$file_name")) {
							$image ="img/imagecache/group_covers/$file_name"; 
							$width = 300; $height = 300; 
							$this->ImageResize->resize($image, $width, $height);
						}
					}		
					
				}
			}
			
			$this->request->data['Group']['id']=$this->request->data['Group']['gid'];
			if ($this->Group->save($this->request->data)) {
				$this->Session->setFlash(__('Saved'));
				$this->redirect(array('action' => 'view',$this->request->data['Group']['gid']));	
			} else {
				$this->Session->setFlash(__('Not saved. Please, try again.'));
				$this->redirect(array('action' => 'view',$this->request->data['Group']['gid']));	
			}
		} 
		/*else {
			$this->Session->setFlash(__('Invalid request. Please, try again.'));
			$this->redirect(array('action' => 'index','controller'=>'categories'));	
		}*/
		
		$this->set(compact('id'));
	}
	
	public function join_group($id){
		$this->Group->id = $id;
		if (!$this->Group->exists()) {
			throw new NotFoundException(__('Invalid group'));
		}
		
		$this->request->data['GroupMember']['group_id']=$id;
		$this->request->data['GroupMember']['id']=($id).'_'.($this->Auth->User('id'));
		$this->request->data['GroupMember']['user_id']=($this->Auth->User('id'));					
		$this->request->data['GroupMember']['date']=date('Y-m-d');	
		$this->request->data['GroupMember']['has_confirmed']=1;	
		
		$this->GroupMember->create();				
		$this->GroupMember->save($this->request->data);
		
		$this->redirect(array('action' => 'view',$id));
		
		//notify all group members for the new member
		
	}
	
	public function leave_group($id){
		$this->Group->id = $id;
		if (!$this->Group->exists()) {
			throw new NotFoundException(__('Invalid group'));
		}		
		$this->Group->query("delete from group_members where user_id='".($this->Auth->User('id'))."' and group_id='".($id)."'");
		$this->redirect(array('action' => 'view',$id));
	}
	
	public function approve_request($id){
		$this->Group->id = $id;
		if (!$this->Group->exists()) {
			throw new NotFoundException(__('Invalid group'));
		}
		$this->Group->query("update group_members set has_confirmed=1 where user_id='".($this->Auth->User('id'))."' and group_id='".($id)."'");
		$this->redirect(array('action' => 'view',$id));
	}
	
	public function disapprove_request($id){
		$this->Group->id = $id;
		if (!$this->Group->exists()) {
			throw new NotFoundException(__('Invalid group'));
		}		
		$this->Group->query("delete from group_members where user_id='".($this->Auth->User('id'))."' and group_id='".($id)."'");
		$this->redirect(array('action' => 'view',$id));
	}

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Group->recursive = 0;
		$this->set('groups', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Group->exists($id)) {
			throw new NotFoundException(__('Invalid group'));
		}
		
		$this->Session->write("RoundBob['Booking']['ViewGroup']",$id);
		
		$options = array('conditions' => array('Group.' . $this->Group->primaryKey => $id));
		$group=$this->Group->find('first', $options);
		$group_posts=$this->GroupPost->find('all',array(
			'conditions'=>array(
				'GroupPost.group_id'=>$id
			),
			'order'=>'GroupPost.date desc',
			'limit'=>20
		));
		$members['GroupMember']=array();
		$is_member=0;
		$has_confirmed=0;
		if(isset($group['GroupMember'])){
			if(count($group['GroupMember'])){
				foreach($group['GroupMember'] as $member){
					if($this->Auth->User('id')==$member['user_id']){
						$is_member=1;
						$has_confirmed=$member['has_confirmed'];
					}
					
					if(!$member['has_confirmed']) continue;
					
					$user=$this->User->find('all',array(
							'conditions'=>array(
								'User.id'=>$member['user_id']
							),
							'fields'=>array(
								'id','name','profile_image'
							),
							'recursive'=>-1,
							'limit'=>1
						)
					);
					
					if(isset($user[0]))
						array_push($members['GroupMember'],$user[0]);
				}
			}
		}
		$this->set(compact('group','members','is_member','has_confirmed','group_posts'));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			
			$func=$this->Func;
			$gid=$func->getUID1();
			$this->request->data['Group']['id']=$gid;
			$this->request->data['Group']['date']=date('Y-m-d');
			$this->request->data['Group']['user_id']=$this->Auth->User('id');
			
			$this->Group->create();
			if ($this->Group->save($this->request->data)) {
				$this->Session->setFlash(__('The group has been saved'));
				
				$this->request->data['GroupMember']['group_id']=$gid;
				$this->request->data['GroupMember']['id']=($gid).'_'.($this->Auth->User('id'));
				$this->request->data['GroupMember']['user_id']=($this->Auth->User('id'));					
				$this->request->data['GroupMember']['date']=date('Y-m-d H:i:s');	
				$this->request->data['GroupMember']['has_confirmed']=1;	
				
				$this->GroupMember->create();				
				if($this->GroupMember->save($this->request->data)){
					$this->redirect(array('action' => 'view',$this->Group->getInsertID()));
				}else{
					$this->Session->setFlash(__('You are not a member.'));
				}
				
			} else {
				$this->Session->setFlash(__('The group could not be saved. Please, try again.'));
			}
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
		if (!$this->Group->exists($id)) {
			throw new NotFoundException(__('Invalid group'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Group->save($this->request->data)) {
				$this->Session->setFlash(__('The group has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The group could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Group.' . $this->Group->primaryKey => $id));
			$this->request->data = $this->Group->find('first', $options);
		}
		$users = $this->Group->User->find('list');
		$this->set(compact('users'));
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
		$this->Group->id = $id;
		if (!$this->Group->exists()) {
			throw new NotFoundException(__('Invalid group'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Group->delete()) {
			$this->Session->setFlash(__('Group deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Group was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}