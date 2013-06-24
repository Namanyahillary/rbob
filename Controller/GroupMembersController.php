<?php
App::uses('AppController', 'Controller');
/**
 * GroupMembers Controller
 *
 * @property GroupMember $GroupMember
 */
class GroupMembersController extends AppController {
	public $uses=array('GroupMember','Group','User');
	
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->GroupMember->recursive = 0;
		$this->set('groupMembers', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->GroupMember->exists($id)) {
			throw new NotFoundException(__('Invalid group member'));
		}
		$options = array('conditions' => array('GroupMember.' . $this->GroupMember->primaryKey => $id));
		$this->set('groupMember', $this->GroupMember->find('first', $options));
	}

	
	public function response(){}
	
/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			if(isset($this->request->data['GroupMember']['members']) && count($this->request->data['GroupMember']['members'])){
				foreach($this->request->data['GroupMember']['members'] as $member){
					//save user if doesnt exist for the group
					if($this->GroupMember->find('count',
						array(
							'conditions'=>array(
									'GroupMember.group_id'=>($this->Session->read("RoundBob['Booking']['ViewGroup']")),
									'GroupMember.user_id'=>$member,
									'GroupMember.has_confirmed'=>1
								),
							'limit'=>1
						)
					)){
						continue;
					}
					$this->request->data['GroupMember']['group_id']=($this->Session->read("RoundBob['Booking']['ViewGroup']"));
					$this->request->data['GroupMember']['id']=($this->Session->read("RoundBob['Booking']['ViewGroup']")).'_'.$member;
					$this->request->data['GroupMember']['user_id']=$member;					
					$this->request->data['GroupMember']['date']=date('Y-m-d');					
					$this->GroupMember->create();
					
					if($this->GroupMember->save($this->request->data)){
						$this->User->Notification->msg(
							$member," has added you to a group. Confirm addition if you haven't yet.",
							null,(Configure::read('domainAddress')).'/groups/view/'.($this->Session->read("RoundBob['Booking']['ViewGroup']")),$this->Auth->User('id')
						);
					}
				}
				$this->Session->setFlash(__('Request sent.'));
			}else{
				$this->Session->setFlash(__('Please choose members for your group.'));
			}
			$this->redirect(array('action' => 'response'));			
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
		if (!$this->GroupMember->exists($id)) {
			throw new NotFoundException(__('Invalid group member'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->GroupMember->save($this->request->data)) {
				$this->Session->setFlash(__('The group member has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The group member could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('GroupMember.' . $this->GroupMember->primaryKey => $id));
			$this->request->data = $this->GroupMember->find('first', $options);
		}
		$groups = $this->GroupMember->Group->find('list');
		$users = $this->GroupMember->User->find('list');
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
		$this->GroupMember->id = $id;
		if (!$this->GroupMember->exists()) {
			throw new NotFoundException(__('Invalid group member'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->GroupMember->delete()) {
			$this->Session->setFlash(__('Group member deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Group member was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
