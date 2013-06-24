<?php
App::uses('AppController', 'Controller');
/**
 * DestinationsRegions Controller
 *
 * @property DestinationsRegion $DestinationsRegion
 */
class DestinationsRegionsController extends AppController {
	
	public function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow('index','set_region');
	}
	
	public function set_region(){
		$this->Session->setFlash(__('Which region would you like to go.'));
		$this->redirect(array('action' => 'index','controller'=>'regions'));
	}

/**
 * index method
 *
 * @return void
 */
	public function index() {
		if($this->Session->read("RoundBob['Destination']['Region']")==null){
			$this->set_region();
		}
		
		$region=$this->Session->read("RoundBob['Destination']['Region']");
		
		$this->DestinationsRegion->recursive = 0;
		$this->paginate=array('conditions'=>array('region_id'=>$region),'order'=>'date desc');
		$this->set('destinationsRegions', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->DestinationsRegion->exists($id)) {
			throw new NotFoundException(__('Invalid destinations region'));
		}
		$options = array('conditions' => array('DestinationsRegion.' . $this->DestinationsRegion->primaryKey => $id));
		$this->set('destinationsRegion', $this->DestinationsRegion->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->DestinationsRegion->create();
			if ($this->DestinationsRegion->save($this->request->data)) {
				$this->Session->setFlash(__('The destinations region has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The destinations region could not be saved. Please, try again.'));
			}
		}
		$regions = $this->DestinationsRegion->Region->find('list');
		$destinations = $this->DestinationsRegion->Destination->find('list');
		$this->set(compact('regions', 'destinations'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->DestinationsRegion->exists($id)) {
			throw new NotFoundException(__('Invalid destinations region'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->DestinationsRegion->save($this->request->data)) {
				$this->Session->setFlash(__('The destinations region has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The destinations region could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('DestinationsRegion.' . $this->DestinationsRegion->primaryKey => $id));
			$this->request->data = $this->DestinationsRegion->find('first', $options);
		}
		$regions = $this->DestinationsRegion->Region->find('list');
		$destinations = $this->DestinationsRegion->Destination->find('list');
		$this->set(compact('regions', 'destinations'));
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
		$this->DestinationsRegion->id = $id;
		if (!$this->DestinationsRegion->exists()) {
			throw new NotFoundException(__('Invalid destinations region'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->DestinationsRegion->delete()) {
			$this->Session->setFlash(__('Destinations region deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Destinations region was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
