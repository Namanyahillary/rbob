<?php
App::uses('AppController', 'Controller');
/**
 * AlbumPhotos Controller
 *
 * @property AlbumPhoto $AlbumPhoto
 */
class AlbumPhotosController extends AppController {
	public $uses=array('AlbumPhoto','Album','User');
/**
 * index method
 *
 * @return void
 */
	public function index($album_id) {
		$this->AlbumPhoto->recursive = 0;
		if (!$this->Album->exists($album_id)) {
			$this->Session->setFlash(__('Album not found.'));
			$this->redirect(array('controller' => 'categories'));
		}
		$this->paginate=array(
			'conditions'=>array(
				'AlbumPhoto.album_id'=>$album_id
			)
		);
		$this->set('albumPhotos', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->AlbumPhoto->exists($id)) {
			throw new NotFoundException(__('Invalid album photo'));
		}
		$options = array('conditions' => array('AlbumPhoto.' . $this->AlbumPhoto->primaryKey => $id));
		$this->set('albumPhoto', $this->AlbumPhoto->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->AlbumPhoto->create();
			if ($this->AlbumPhoto->save($this->request->data)) {
				$this->Session->setFlash(__('The album photo has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The album photo could not be saved. Please, try again.'));
			}
		}
		$albums = $this->AlbumPhoto->Album->find('list');
		$users = $this->AlbumPhoto->User->find('list');
		$this->set(compact('albums', 'users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->AlbumPhoto->exists($id)) {
			throw new NotFoundException(__('Invalid album photo'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->AlbumPhoto->save($this->request->data)) {
				$this->Session->setFlash(__('The album photo has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The album photo could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('AlbumPhoto.' . $this->AlbumPhoto->primaryKey => $id));
			$this->request->data = $this->AlbumPhoto->find('first', $options);
		}
		$albums = $this->AlbumPhoto->Album->find('list');
		$users = $this->AlbumPhoto->User->find('list');
		$this->set(compact('albums', 'users'));
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
		$this->AlbumPhoto->id = $id;
		if (!$this->AlbumPhoto->exists()) {
			throw new NotFoundException(__('Invalid album photo'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->AlbumPhoto->delete()) {
			$this->Session->setFlash(__('Album photo deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Album photo was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
