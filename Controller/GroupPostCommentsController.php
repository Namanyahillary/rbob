<?php
App::uses('AppController', 'Controller');
/**
 * GroupPostComments Controller
 *
 * @property GroupPostComment $GroupPostComment
 */
class GroupPostCommentsController extends AppController {
	public $uses=array('GroupPostComment','GroupPost');
/**
 * index method
 *
 * @return void
 */
	public function index($group_post_id) {
		$this->GroupPostComment->recursive = 1;
		$this->paginate=array(
			'conditions'=>array(
				'GroupPostComment.group_post_id'=>$group_post_id
			),
			'order'=>'GroupPostComment.date asc',
			'limit'=>20
		);
		$this->set('groupPostComments', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->GroupPostComment->exists($id)) {
			throw new NotFoundException(__('Invalid group post comment'));
		}
		$options = array('conditions' => array('GroupPostComment.' . $this->GroupPostComment->primaryKey => $id));
		$this->set('groupPostComment', $this->GroupPostComment->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			
			if (!$this->GroupPost->exists($this->request->data['GroupPostComment']['group_post'])) {
				$this->redirect(array('action' => 'index',-1));
			}
			
			$func=$this->Func;
			$this->request->data['GroupPostComment']['id']=$func->getUID1();
			$this->request->data['GroupPostComment']['user_id']=$this->Auth->User('id');
			$this->request->data['GroupPostComment']['date']=date('Y-m-d H:i:s');
			$this->request->data['GroupPostComment']['group_post_id']=$this->request->data['GroupPostComment']['group_post'];
			
			$this->GroupPostComment->create();
			if ($this->GroupPostComment->save($this->request->data)) {
				$this->redirect(array('action' => 'index',$this->request->data['GroupPostComment']['group_post']));
			} else {
				$this->redirect(array('action' => 'index',$this->request->data['GroupPostComment']['group_post']));
			}
		}
		$this->redirect(array('action' => 'index',-1));
		//$groupPosts = $this->GroupPostComment->GroupPost->find('list');
		//$users = $this->GroupPostComment->User->find('list');
		//$this->set(compact('groupPosts', 'users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->GroupPostComment->exists($id)) {
			throw new NotFoundException(__('Invalid group post comment'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->GroupPostComment->save($this->request->data)) {
				$this->Session->setFlash(__('The group post comment has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The group post comment could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('GroupPostComment.' . $this->GroupPostComment->primaryKey => $id));
			$this->request->data = $this->GroupPostComment->find('first', $options);
		}
		$groupPosts = $this->GroupPostComment->GroupPost->find('list');
		$users = $this->GroupPostComment->User->find('list');
		$this->set(compact('groupPosts', 'users'));
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
		$this->GroupPostComment->id = $id;
		if (!$this->GroupPostComment->exists()) {
			throw new NotFoundException(__('Invalid group post comment'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->GroupPostComment->delete()) {
			$this->Session->setFlash(__('Group post comment deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Group post comment was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
