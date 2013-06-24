<?php
App::uses('AppController', 'Controller');
/**
 * Banks Controller
 *
 * @property Bank $Bank
 */
class BanksController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Bank->recursive = 0;
		$this->set('banks', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Bank->exists($id)) {
			throw new NotFoundException(__('Invalid bank'));
		}
		$options = array('conditions' => array('Bank.' . $this->Bank->primaryKey => $id));
		$this->set('bank', $this->Bank->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Bank->create();
			if ($this->Bank->save($this->request->data)) {
				$this->Session->setFlash(__('The bank has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The bank could not be saved. Please, try again.'));
			}
		}
		$countries = $this->Bank->Country->find('list');
		$this->set(compact('countries'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Bank->exists($id)) {
			throw new NotFoundException(__('Invalid bank'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Bank->save($this->request->data)) {
				$this->Session->setFlash(__('The bank has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The bank could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Bank.' . $this->Bank->primaryKey => $id));
			$this->request->data = $this->Bank->find('first', $options);
		}
		$countries = $this->Bank->Country->find('list');
		$this->set(compact('countries'));
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
		$this->Bank->id = $id;
		if (!$this->Bank->exists()) {
			throw new NotFoundException(__('Invalid bank'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Bank->delete()) {
			$this->Session->setFlash(__('Bank deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Bank was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
