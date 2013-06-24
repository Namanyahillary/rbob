<?php
App::uses('AppController', 'Controller');
/**
 * WishLists Controller
 *
 * @property WishList $WishList
 */
class WishListsController extends AppController {
	public $uses=array('WishList','Destination','User');
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->WishList->recursive = 0;
		$this->paginate=array('conditions'=>array('WishList.user_id'=>$this->Auth->User('id')));
		$this->set('wishLists', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->WishList->exists($id)) {
			throw new NotFoundException(__('Invalid wish list'));
		}
		$options = array('conditions' => array('WishList.' . $this->WishList->primaryKey => $id));
		$this->set('wishList', $this->WishList->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add($destinationID=null,$_resp=null) {
		$resp='';
		if($_resp){
			$resp=$_resp;
		}
		if ($destinationID && $destinationID!=-1) {
			//check whether destinationID passed exists
			if (!$this->Destination->exists($destinationID)) {
				throw new NotFoundException(__('Invalid destination'));
			}
			
			//check whether destinationID exists in WishList for the user
			$options=array('conditions'=>array('WishList.destination_id'=>$destinationID,'WishList.user_id'=>$this->Auth->User('id')),'limit'=>1);
			if($this->WishList->find('count',$options)){
				$resp='Destination is already on your wish list.';
				$this->redirect(array('action' => 'add',-1,$resp));
			}
			
			$this->request->data['WishList']['destination_id']=$destinationID;
			$this->request->data['WishList']['user_id']=$this->Auth->User('id');			
			$this->request->data['WishList']['date']=date('Y-m-d H:i:s');			
			
			$this->WishList->create();
			if ($this->WishList->save($this->request->data)) {
				$resp='Destination has beed added to your wish list.';
			} else {
				$resp='Destination could not be added to your with list.';
			}
		}
		$this->set(compact('resp'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->WishList->exists($id)) {
			throw new NotFoundException(__('Invalid wish list'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->WishList->save($this->request->data)) {
				$this->Session->setFlash(__('The wish list has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The wish list could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('WishList.' . $this->WishList->primaryKey => $id));
			$this->request->data = $this->WishList->find('first', $options);
		}
		$users = $this->WishList->User->find('list');
		$destinations = $this->WishList->Destination->find('list');
		$this->set(compact('users', 'destinations'));
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
		$this->WishList->id = $id;
		if (!$this->WishList->exists()) {
			throw new NotFoundException(__('Invalid wish list'));
		}
		
		if (!($this->WishList->find('count',array('conditions'=>array('WishList.user_id'=>$this->Auth->User('id')))))) {
			throw new NotFoundException(__('Invalid wish list'));
		}
		
		if ($this->WishList->delete()) {
			$this->Session->setFlash(__('Deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
