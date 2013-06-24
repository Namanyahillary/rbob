<?php
App::uses('AppController', 'Controller');
/**
 * MyFolders Controller
 *
 * @property MyFolder $MyFolder
 */
class MyFoldersController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->MyFolder->recursive = 0;
		$this->paginate=array(
			'conditions'=>array(
				'MyFolder.user_id'=>$this->Auth->User('id')
			),
			'order'=>'MyFolder.name'
		);
		$this->set('myFolders', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->MyFolder->exists($id)) {
			throw new NotFoundException(__('Invalid my folder'));
		}
		$options = array('conditions' => array('MyFolder.' . $this->MyFolder->primaryKey => $id));
		$this->set('myFolder', $this->MyFolder->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
		
			$func=$this->Func;
			$this->request->data['MyFolder']['id']=$func->getUID1();
			$this->request->data['MyFolder']['user_id']=$this->Auth->User('id');
			date_default_timezone_set ( 'Africa/Nairobi' );
			$this->request->data['MyFolder']['date']=date('Y-m-d H:i:s');
			$this->request->data['MyFolder']['last_modified']=date('Y-m-d H:i:s');
			
			$this->MyFolder->create();
			if ($this->MyFolder->save($this->request->data)) {
				$this->Session->setFlash(__('The my folder has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The my folder could not be saved. Please, try again.'));
			}
		}
		$users = $this->MyFolder->User->find('list');
		$this->set(compact('users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->MyFolder->exists($id)) {
			throw new NotFoundException(__('Invalid my folder'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			
			date_default_timezone_set ( 'Africa/Nairobi' );
			$this->request->data['MyFolder']['last_modified']=date('Y-m-d H:i:s');
			
			if ($this->MyFolder->save($this->request->data)) {
				$this->Session->setFlash(__('The my folder has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The my folder could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('MyFolder.' . $this->MyFolder->primaryKey => $id));
			$this->request->data = $this->MyFolder->find('first', $options);
		}
		$users = $this->MyFolder->User->find('list');
		$this->set(compact('users'));
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
		$this->MyFolder->id = $id;
		if (!$this->MyFolder->exists()) {
			throw new NotFoundException(__('Invalid my folder'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->MyFolder->delete()) {
			$this->Session->setFlash(__('My folder deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('My folder was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
