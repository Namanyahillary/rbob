<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 */
class UsersController extends AppController {
	
	public $uses=array('User','Bank','WishList');
	
	function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('reset_password','my_actions','register');
		
		if($this->Auth->user()){
			$this->Auth->allow('edit');
		}
        
		if ($this->action == 'add') {
			if($this->Auth->user('role')!='super_admin'){
				$this->Session->setFlash(__('Access Denied!!'));
				$this->redirect($this->Auth->logout());
			}
        }
    } 
	
	public function get_users($q=null,$selected_ids=-2){
		$this->User->recursive = 0;
		$this->paginate=array(
			'conditions'=>array(
				'User.id NOT' => $this->Auth->User('id'),
				'User.name LIKE' =>  '%' . addslashes(strip_tags($q)) . '%',
				'NOT'=>array(
					'User.id'=>array(
						addslashes(strip_tags($selected_ids))
					)
				),
			)
		);
		$this->set('users', $this->paginate());
	}
	
	public function get_non_members($q=null,$group_id=null){
		$this->User->recursive = 1;
		$this->User->unBindModel(array('hasMany' => array('WishList', 'Notification')));
		$this->paginate=array(
			'conditions'=>array(
				'User.name LIKE' =>  '%' . addslashes(strip_tags($q)) . '%'
			),
			/*'fields'=>array(
				'User.id','User.name'
			)*/
		);
		$this->set('users', $this->paginate());
		$this->set('group_id', $group_id);
	}
	
	public function login() {
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				//$this->User->Notification->msg(AuthComponent::user('id'), "You logged in!");
				if($this->Auth->User('role')=='super_admin' || $this->Auth->User('role')=='bank_admin'){
					$this->redirect(array('controller'=>'dashboards'));
				}
				$this->redirect($this->Auth->redirect());
			} else {
				$this->Session->setFlash(__('Invalid username or password, try again'));
			}
		}
	}
	
	public function logout() {
		$this->Session->destroy();
		$this->redirect($this->Auth->logout());
	}
	
	public function reset_password(){
		if(!empty($this->data)){
            $user=$this->User->find('all',array('recursive'=>-1,'limit'=>1,'fields'=>array('id','email'),'conditions'=>array('OR'=>array('username'=>$this->data->User->username,'email'=>$this->data->User->username))));
            if(!empty($user)){
                if(isset($user[0]['User']['email'])){
                    if(!empty($user[0]['User']['email'])){
                        $func = $this->Func;
                        $new_pwd = $func->getMD5TimeStampId();//generate hashed password
                        
                        //send the password first to the email
                        $this->Email->from = 'Round Bob';
                        $this->Email->to = $user[0]['User']['email'];
                        $this->Email->subject = "Password reset.";
                        $this->Email->template = 'default';
                        $this->Email->sendAs = 'html';
                        $this->set(compact('new_pwd'));
                        if ($this->Email->send()){//if the message gets sent.
                            if($this->User->query("update users set password='".Security::hash($new_pwd,NULL,TRUE)."', email_confirmed=1 where id='".($user[0]['User']['id'])."' limit 1")){
                                $this->Session->setFlash(__('Email sent.Details updated. Check your email.', true));
                                return;
                            }else{
                                $this->Session->setFlash(__('Email sent. But your details failed to get updated. Try again.', true));
                                return;
                            }
                        }else{
                            $this->Session->setFlash(__('Email not sent. Try again, check also your internet connection.', true));
                            return;
                        }                        
                        
                    }else{
                        $this->Session->setFlash(__('You email address is empty.', true));
                        return;
                    }                    
                }else{
                    $this->Session->setFlash(__('You dont have an email address set.', true));
                    return;
                }
                                
            }else{
                $this->Session->setFlash(__('Username provided does not exist. Try again', true));
                return;
            }
            
        }
	}
	
	public function register(){
		if ($this->request->is('post')) {
			$this->request->data['User']['date']=date('Y-m-d H:i:s');
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('Account Created. You can now login.'));
				$this->redirect(array('action' => 'login','controller'=>'users'));
			} else {
				$this->Session->setFlash(__('Account could not be created. Please, try again.'));
			}
		}
	}
	
	public function settings($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		
		if($id!=$this->Auth->User('id') and $this->Auth->User('role')!='super_admin'){
        	$this->Session->setFlash(__('Invalid request', true));
            $this->redirect(array('action' => 'view',$this->Auth->User('id')));
        }
		
		$this->set('user', $this->User->read(null, $id));
		
		if (empty($this->data)) {
            	$this->data = $this->User->read(null, $id);
        }
		
		$banks=$this->Bank->find('list');
		$this->set(compact('banks'));
	}
	
	/**
 * index method
 *
 * @return void
 */
	public function search() {
		$this->User->recursive = 0;
		if($this->Auth->User('role')=='super_admin' || $this->Auth->User('role')=='bank_admin'){
			if(isset($_REQUEST['search_query_string']) && !empty($_REQUEST['search_query_string'])){					
				$this->paginate = array(
					'conditions' => array(
						'OR' => array(
							'User.name LIKE' => '%' . $_REQUEST['search_query_string'] . '%'
						)
					)
				);
				
			}else{
				$this->paginate=array('conditions'=>array('User.role'=>'bank_admin'));
			}
		}else{
			$this->Session->setFlash(__('Access Denied!', true));
			$this->redirect(array('action' => 'view',$this->Auth->User('id')));
		}
		$this->set('users', $this->paginate());
	}
	


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->User->recursive = 0;
		if($this->Auth->User('role')=='super_admin'){
			$this->paginate=array('conditions'=>array('role'=>'bank_admin'));
		}else{
			$this->Session->setFlash(__('Access Denied!', true));
			$this->redirect(array('action' => 'view',$this->Auth->User('id')));
		}
		$this->set('users', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		
		//$_user=$this->User->read(null, $id);
		$_user=$this->User->find('first',array(
			'conditions'=>array(
				'User.id'=>$id,
			),
			'recursive'=>2,
			'fields'=>array(
				'User.id','User.name','User.email','User.cover_img',
				'User.profile_image','User.facebook_profile','User.phone'
			)
		));
		
		if($this->Auth->User('role')=='bank_admin' || $this->Auth->User('role')=='super_admin'){			
				$this->Session->write("RoundBob['Booking']['admin_client_id']",$_user['User']['id']);
				$this->Session->write("RoundBob['Booking']['admin_client_name']",$_user['User']['name']);
		}
		$this->set('user',$_user);
		
		if (empty($this->data)) {
            	$this->data = $this->User->read(null, $id);
        }
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->request->data['User']['date']=date('Y-m-d H:i:s');
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		}
		$banks=$this->Bank->find('list');
		$this->set(compact('banks'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
		
			if(isset($this->request->data['User']['password']) and isset($this->request->data['User']['password_confirmation'])){
				if($this->request->data['User']['password'] != $this->request->data['User']['password_confirmation']){
					$this->Session->setFlash(__('Passwords don\'t match.', true));
					$this->redirect(array('action' => 'settings',$this->Auth->user('id')));
				}
				if(strlen($this->request->data['User']['password']) < 5){
					$this->Session->setFlash(__('Passwords too short. It should be more than 5 characters.', true));
					$this->redirect(array('action' => 'settings',$this->Auth->user('id')));
				}
				if(strlen($this->request->data['User']['password']) > 15){
					$this->Session->setFlash(__('Passwords too long. It should be more less than 15 characters.', true));
					$this->redirect(array('action' => 'settings',$this->Auth->user('id')));
				}
			}
			
			$this->request->data['User']['date']=date('Y-m-d');
			$func=$this->Func;			
			$file_name='';
			
			if(isset($_FILES['fileField']['name']) and !empty($_FILES['fileField']['name'])){//getting the file extension and testing it
				$previous_profile_image=$this->request->data['User']['profile_image'];
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
					$this->redirect(array('action' => 'view',$this->Auth->User('id')));					
				}else{
					//create filename if the image type is alowed										
					$file_name=($func->getUID1()).'.'.(pathinfo($_FILES['fileField']['name'], PATHINFO_EXTENSION));	//the new uploaded file but with the same name as before			
					if(file_exists("img/pic/$previous_profile_image")){
						if($this->request->data['User']['profile_image']!='default.png')
							@unlink("img/pic/$previous_profile_image");
					}
					
					if(move_uploaded_file($_FILES['fileField']['tmp_name'],"img/pic/$file_name")){
						$this->request->data['User']['profile_image']=$file_name;//filename to use for submitted file
						@$this->ImageResize->resize("img/pic/$file_name", 300, 300);						
					}
					
				}
			}	
			
            if ($this->User->save($this->request->data)) {
                $this->Session->write('Auth',$this->User->read(null,$this->Auth->User('id')));
				
				$this->Session->setFlash(__('Credentials saved.', true));
				$this->redirect(array('action' => 'view',$this->Auth->user('id')));
				
                if($this->Auth->user('role')=='admin')
					$this->redirect(array('action' => 'index'));
				else
					$this->redirect(array('action' => 'view',$this->Auth->user('id')));
            } else {
				if(file_exists("img/pic/$file_name")){
					@unlink("img/pic/$file_name");
				}
                $this->Session->setFlash(__('Credentials not be saved. Please, try again.', true));
            }		
			
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}
		
		$this->redirect(array('action' => 'view',$this->Auth->user('id')));
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
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		
		if($this->Auth->user('role')!='admin'){
			$this->request->onlyAllow('post', 'delete');
		}
		
		if ($this->User->delete()) {
			$this->Session->setFlash(__('User deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('User was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
