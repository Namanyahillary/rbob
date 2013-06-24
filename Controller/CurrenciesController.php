<?php
App::uses('AppController', 'Controller');
/**
 * Currencies Controller
 *
 * @property Currency $Currency
 */
class CurrenciesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Currency->recursive = 0;
		$this->set('currencies', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Currency->exists($id)) {
			throw new NotFoundException(__('Invalid currency'));
		}
		$options = array('conditions' => array('Currency.' . $this->Currency->primaryKey => $id));
		$this->set('currency', $this->Currency->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			
			$func = $this->Func;
			$this->request->data['Currency']['id']=$func->getUID1();
			
			$this->Currency->create();
			if ($this->Currency->save($this->request->data)) {
				$this->Session->setFlash(__('The currency has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The currency could not be saved. Please, try again.'));
			}
		}
		$countries = $this->Currency->Country->find('list');
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
		if (!$this->Currency->exists($id)) {
			throw new NotFoundException(__('Invalid currency'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Currency->save($this->request->data)) {
				$this->Session->setFlash(__('The currency has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The currency could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Currency.' . $this->Currency->primaryKey => $id));
			$this->request->data = $this->Currency->find('first', $options);
		}
		$countries = $this->Currency->Country->find('list');
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
		$this->Currency->id = $id;
		if (!$this->Currency->exists()) {
			throw new NotFoundException(__('Invalid currency'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Currency->delete()) {
			$this->Session->setFlash(__('Currency deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Currency was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
