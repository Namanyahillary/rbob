<?php
App::uses('AppController', 'Controller');
/**
 * PaymentMethods Controller
 *
 * @property PaymentMethod $PaymentMethod
 */
class PaymentMethodsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->PaymentMethod->recursive = 0;
		$this->set('paymentMethods', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->PaymentMethod->exists($id)) {
			throw new NotFoundException(__('Invalid payment method'));
		}
		$options = array('conditions' => array('PaymentMethod.' . $this->PaymentMethod->primaryKey => $id));
		$this->set('paymentMethod', $this->PaymentMethod->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->PaymentMethod->create();
			if ($this->PaymentMethod->save($this->request->data)) {
				$this->Session->setFlash(__('The payment method has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The payment method could not be saved. Please, try again.'));
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
		if (!$this->PaymentMethod->exists($id)) {
			throw new NotFoundException(__('Invalid payment method'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->PaymentMethod->save($this->request->data)) {
				$this->Session->setFlash(__('The payment method has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The payment method could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('PaymentMethod.' . $this->PaymentMethod->primaryKey => $id));
			$this->request->data = $this->PaymentMethod->find('first', $options);
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
		$this->PaymentMethod->id = $id;
		if (!$this->PaymentMethod->exists()) {
			throw new NotFoundException(__('Invalid payment method'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->PaymentMethod->delete()) {
			$this->Session->setFlash(__('Payment method deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Payment method was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
