<?php
App::uses('AppController', 'Controller');
/**
 * MessageStatuses Controller
 *
 * @property MessageStatus $MessageStatus
 */
class MessageStatusesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->MessageStatus->recursive = 0;
		$this->set('messageStatuses', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->MessageStatus->exists($id)) {
			throw new NotFoundException(__('Invalid message status'));
		}
		$options = array('conditions' => array('MessageStatus.' . $this->MessageStatus->primaryKey => $id));
		$this->set('messageStatus', $this->MessageStatus->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->MessageStatus->create();
			if ($this->MessageStatus->save($this->request->data)) {
				$this->Session->setFlash(__('The message status has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The message status could not be saved. Please, try again.'));
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
		if (!$this->MessageStatus->exists($id)) {
			throw new NotFoundException(__('Invalid message status'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->MessageStatus->save($this->request->data)) {
				$this->Session->setFlash(__('The message status has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The message status could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('MessageStatus.' . $this->MessageStatus->primaryKey => $id));
			$this->request->data = $this->MessageStatus->find('first', $options);
		}
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
		$this->MessageStatus->id = $id;
		if (!$this->MessageStatus->exists()) {
			throw new NotFoundException(__('Invalid message status'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->MessageStatus->delete()) {
			$this->Session->setFlash(__('Message status deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Message status was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
