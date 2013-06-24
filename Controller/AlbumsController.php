<?php
App::uses('AppController', 'Controller');
/**
 * Albums Controller
 *
 * @property Album $Album
 */
class AlbumsController extends AppController {

	public $uses=array('Album','User','Group');

/**
 * index method
 *
 * @return void
 */
	public function index($group_id=null) {		
		$this->Album->recursive = 0;
		if($group_id!=null){
			if (!$this->Group->exists($group_id)) {
				$this->Session->setFlash(__('Group not found.'));
				$this->redirect(array('controller' => 'categories'));
			}
			$this->paginate=array(
				'conditions'=>array(
					'Album.group_id'=>$group_id
				)
			);
		}
		$this->set('albums', $this->paginate());		
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Album->exists($id)) {
			throw new NotFoundException(__('Invalid album'));
		}
		$options = array('conditions' => array('Album.' . $this->Album->primaryKey => $id));
		$this->set('album', $this->Album->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->request->data['Album']['date']=date('Y-m-d H:i:s');
			$this->Album->create();
			if ($this->Album->save($this->request->data)) {
				$this->Session->setFlash(__('The album has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The album could not be saved. Please, try again.'));
			}
		}
		$users = $this->Album->User->find('list');
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
		if (!$this->Album->exists($id)) {
			throw new NotFoundException(__('Invalid album'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Album->save($this->request->data)) {
				$this->Session->setFlash(__('The album has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The album could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Album.' . $this->Album->primaryKey => $id));
			$this->request->data = $this->Album->find('first', $options);
		}
		$users = $this->Album->User->find('list');
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
		$this->Album->id = $id;
		if (!$this->Album->exists()) {
			throw new NotFoundException(__('Invalid album'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Album->delete()) {
			$this->Session->setFlash(__('Album deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Album was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
