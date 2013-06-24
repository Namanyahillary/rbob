<?php
App::uses('AppController', 'Controller');
/**
 * Messages Controller
 *
 * @property Message $Message
 */
class MessagesController extends AppController {
/**
 * getMessageCount method
 *
 * @return void
 */	
	function get_message_count() {
        $this->set('msg_count', $this->Message->find('count', array('conditions' => array('to' => $this->Auth->user('id'),'message_status_id'=>1))));
    }

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Message->recursive = 0;
		$this->paginate = array('order' => 'message_date desc', 'conditions' => array('to' => $this->Auth->user('id')));
		$this->set('messages', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Message->exists($id)) {
			throw new NotFoundException(__('Invalid message'));
		}
		
		$this->request->data['Message']['id'] = $id;
        $this->request->data['Message']['message_status_id'] = 2;
        $this->Message->create();
        $this->Message->save($this->request->data);
		
		$options = array('conditions' => array('Message.' . $this->Message->primaryKey => $id));
		$this->set('message', $this->Message->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			
			$this->request->data['Message']['id']=$this->Func->getUID1();
            $this->request->data['Message']['to'] = $this->request->data['Message']['user_id'];
            $this->request->data['Message']['user_id'] = $this->Auth->user('id');
            $this->request->data['Message']['message_status_id'] = 1;
            $this->request->data['Message']['message_kind_id'] = 1;
            $this->request->data['Message']['message_date'] = date("Y:m:d H:i:s");
			$this->Message->create();
			if ($this->Message->save($this->request->data)) {
				$this->Session->setFlash(__('The message has been sent'));
				$this->redirect(array('action' => 'add'));
			} else {
				$this->Session->setFlash(__('The message could not be sent. Please, try again.'));
			}
		}
		$users = $this->Message->User->find('list');
		$messageStatuses = $this->Message->MessageStatus->find('list');
		$messageKinds = $this->Message->MessageKind->find('list');
		$this->set(compact('users', 'messageStatuses', 'messageKinds'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Message->exists($id)) {
			throw new NotFoundException(__('Invalid message'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Message->save($this->request->data)) {
				$this->Session->setFlash(__('The message has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The message could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Message.' . $this->Message->primaryKey => $id));
			$this->request->data = $this->Message->find('first', $options);
		}
		$users = $this->Message->User->find('list');
		$messageStatuses = $this->Message->MessageStatus->find('list');
		$messageKinds = $this->Message->MessageKind->find('list');
		$this->set(compact('users', 'messageStatuses', 'messageKinds'));
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
		$this->Message->id = $id;
		if (!$this->Message->exists()) {
			throw new NotFoundException(__('Invalid message'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Message->delete()) {
			$this->Session->setFlash(__('Message deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Message was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
