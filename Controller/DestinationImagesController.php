<?php
App::uses('AppController', 'Controller');
/**
 * DestinationImages Controller
 *
 * @property DestinationImage $DestinationImage
 */
class DestinationImagesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->DestinationImage->recursive = 0;
		$this->set('destinationImages', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->DestinationImage->exists($id)) {
			throw new NotFoundException(__('Invalid destination image'));
		}
		$options = array('conditions' => array('DestinationImage.' . $this->DestinationImage->primaryKey => $id));
		$this->set('destinationImage', $this->DestinationImage->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->DestinationImage->create();
			if ($this->DestinationImage->save($this->request->data)) {
				$this->Session->setFlash(__('The destination image has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The destination image could not be saved. Please, try again.'));
			}
		}
		$destinations = $this->DestinationImage->Destination->find('list');
		$users = $this->DestinationImage->User->find('list');
		$this->set(compact('destinations', 'users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->DestinationImage->exists($id)) {
			throw new NotFoundException(__('Invalid destination image'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->DestinationImage->save($this->request->data)) {
				$this->Session->setFlash(__('The destination image has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The destination image could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('DestinationImage.' . $this->DestinationImage->primaryKey => $id));
			$this->request->data = $this->DestinationImage->find('first', $options);
		}
		$destinations = $this->DestinationImage->Destination->find('list');
		$users = $this->DestinationImage->User->find('list');
		$this->set(compact('destinations', 'users'));
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
		$this->DestinationImage->id = $id;
		if (!$this->DestinationImage->exists()) {
			throw new NotFoundException(__('Invalid destination image'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->DestinationImage->delete()) {
			$this->Session->setFlash(__('Destination image deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Destination image was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
