<?php
App::uses('AppController', 'Controller');
/**
 * MessageKinds Controller
 *
 * @property MessageKind $MessageKind
 */
class MessageKindsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->MessageKind->recursive = 0;
		$this->set('messageKinds', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->MessageKind->exists($id)) {
			throw new NotFoundException(__('Invalid message kind'));
		}
		$options = array('conditions' => array('MessageKind.' . $this->MessageKind->primaryKey => $id));
		$this->set('messageKind', $this->MessageKind->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->MessageKind->create();
			if ($this->MessageKind->save($this->request->data)) {
				$this->Session->setFlash(__('The message kind has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The message kind could not be saved. Please, try again.'));
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
		if (!$this->MessageKind->exists($id)) {
			throw new NotFoundException(__('Invalid message kind'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->MessageKind->save($this->request->data)) {
				$this->Session->setFlash(__('The message kind has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The message kind could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('MessageKind.' . $this->MessageKind->primaryKey => $id));
			$this->request->data = $this->MessageKind->find('first', $options);
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
		$this->MessageKind->id = $id;
		if (!$this->MessageKind->exists()) {
			throw new NotFoundException(__('Invalid message kind'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->MessageKind->delete()) {
			$this->Session->setFlash(__('Message kind deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Message kind was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
