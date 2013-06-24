<?php
App::uses('AppController', 'Controller');
/**
 * Categories Controller
 *
 * @property Category $Category
 */
class CategoriesController extends AppController {

	public $uses = array('Category','Country','Currency');
	
	public function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow('show','index','view');
	}
	
	public function show($country_id=null){
		
		if((int)$country_id){
			$countries=$this->Country->find('all',array('conditions'=>array('Country.id'=>$country_id),'recursive'=>-1,'limit'=>1));
			if(count($countries)){
				$this->Session->write("RoundBob['Destination']['Region']",$countries[0]['Country']['region_id']);
				$this->Session->write("RoundBob['Destination']['Country']",(int)$country_id);
				$this->Session->write("RoundBob['Destination']['CountryName']",$countries[0]['Country']['name']);
				$this->redirect(array('action' => 'index'));
				
			}else{
				$this->Session->setFlash(__('Invalid request.'));
				$this->redirect(Configure::read('domainAddress'));
			}
		}else{
			$this->redirect(array('action' => 'index'));
		}
	}
/**
 * index method
 *
 * @return void
 */
	public function index() {
		//$rb=$this->Cookie->read('User');
		
		$region=$this->Cookie->read('Region');
		$selected_country=$this->Cookie->read('Country');
		$selected_country_name=$this->Cookie->read('CountryName');
		
		if($region==null || $selected_country==null){
			$region=$this->Session->read("RoundBob['Destination']['Region']");
			$selected_country=$this->Session->read("RoundBob['Destination']['Country']");
			$selected_country_name=$this->Session->read("RoundBob['Destination']['CountryName']");
		}else{
			$this->Session->write("RoundBob['Destination']['Region']",$region);
			$this->Session->write("RoundBob['Destination']['Country']",$selected_country);
			$this->Session->write("RoundBob['Destination']['CountryName']",$selected_country_name);
		}
		
		if($region==null || $selected_country==null){
			if($this->Auth->User('role')!='bank_admin' || $this->Auth->User('role')!='super_admin'){
				$this->Session->setFlash(__('Please select a country.'));
				$this->redirect(Configure::read('domainAddress'));
			}
		}
		
		$currency=$this->Currency->find('first',array(
			'conditions'=>array(
				'Currency.country_id'=>$selected_country
			),
			'recursive'=>-1
		));
		
		if(isset($currency['Currency'])){
			$this->Session->write("RoundBob['Destination']['Currency']",$currency);
		}
		
		$this->Category->recursive = 0;
		$this->set('categories', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Category->exists($id)) {
			throw new NotFoundException(__('Invalid category'));
		}

		$this->Session->write("RoundBob['Destination']['Category']",(int)$id);
		$this->redirect(array('action' => 'index','controller'=>'destinations'));
		
		/*$options = array('conditions' => array('Category.' . $this->Category->primaryKey => $id));
		$this->set('category', $this->Category->find('first', $options));*/
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Category->create();
			if ($this->Category->save($this->request->data)) {
				$this->Session->setFlash(__('The category has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The category could not be saved. Please, try again.'));
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
		if (!$this->Category->exists($id)) {
			throw new NotFoundException(__('Invalid category'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Category->save($this->request->data)) {
				$this->Session->setFlash(__('The category has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The category could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Category.' . $this->Category->primaryKey => $id));
			$this->request->data = $this->Category->find('first', $options);
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
		$this->Category->id = $id;
		if (!$this->Category->exists()) {
			throw new NotFoundException(__('Invalid category'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Category->delete()) {
			$this->Session->setFlash(__('Category deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Category was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
