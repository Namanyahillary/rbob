<?php
App::uses('AppController', 'Controller');
/**
 * MyFiles Controller
 *
 * @property MyFile $MyFile
 */
class MyFilesController extends AppController {
	
	public $uses=array('MyFile','MyFolder');

/**
 * index method
 *
 * @return void
 */
	public function index($my_folder_id) {
		if (!$this->MyFolder->exists($my_folder_id)) {
			$this->Session->setFlash(__('Folder does not exist!!'));
			$this->redirect(array('action' => 'index','controller'=>'my_folders'));
		}
		$this->paginate=array(
			'conditions'=>array(
				'MyFile.my_folder_id'=>$my_folder_id
			),
			'order'=>'MyFile.name'
		);
		$this->MyFile->recursive = 0;
		$this->set('myFiles', $this->paginate());
		$this->set('my_folder_id', $my_folder_id);
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->MyFile->exists($id)) {
			throw new NotFoundException(__('Invalid my file'));
		}
		$options = array('conditions' => array('MyFile.' . $this->MyFile->primaryKey => $id));
		$this->set('myFile', $this->MyFile->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add($my_folder_id) {
		if (!$this->MyFolder->exists($my_folder_id)) {
			$this->Session->setFlash(__('Folder does not exist!!'));
			$this->redirect(array('action' => 'index','controller'=>'my_folders'));
		}
		
		if ($this->request->is('post')) {
			$func=$this->Func;
			$file_name='';
			if(isset($_FILES['fileField']['name']) and !empty($_FILES['fileField']['name'])){//getting the file extension and testing it
				$fileExtension=pathinfo($_FILES['fileField']['name'], PATHINFO_EXTENSION);
				
				//redirect the user if the file is not accepted to be uploaded
				$file_name=($func->getUID1()).'.'.(pathinfo($_FILES['fileField']['name'], PATHINFO_EXTENSION));
				
			}else{
				$file_name='default.png';
			}
			
			//uploading the file
			if(move_uploaded_file($_FILES['fileField']['tmp_name'],"files/my_files_library/$file_name")){
				$this->request->data['MyFile']['id']=$func->getUID1();
				$this->request->data['MyFile']['filename']=$file_name;//filename to use for submitted file
				$this->request->data['MyFile']['file_extension']=pathinfo($_FILES['fileField']['name'], PATHINFO_EXTENSION);
				date_default_timezone_set ( 'Africa/Nairobi' );
				$this->request->data['MyFile']['date']=date('Y-m-d H:i:s');
				
				$this->MyFile->create();			
				if ($this->MyFile->save($this->request->data)) {
					$this->Session->setFlash(__('The File has been saved', true));
					$this->redirect(array('action' => 'index',$my_folder_id));
				} else {
					$this->Session->setFlash(__('The File could not be saved. Please, try again.', true));
											
					if(file_exists("files/my_files_library/$file_name")){
						@unlink("files/my_files_library/$file_name");
					}
					$this->redirect(array('action' => 'index',$my_folder_id));
				}
									
			}else{
				$this->Session->setFlash(__('The File could not be saved. Please try again.', true));
				$this->redirect(array('action' => 'index',$my_folder_id));
			}			
		}
		$this->set(compact('my_folder_id'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->MyFile->exists($id)) {
			throw new NotFoundException(__('Invalid my file'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->MyFile->save($this->request->data)) {
				$this->Session->setFlash(__('The my file has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The my file could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('MyFile.' . $this->MyFile->primaryKey => $id));
			$this->request->data = $this->MyFile->find('first', $options);
		}
		$myFolders = $this->MyFile->MyFolder->find('list');
		$this->set(compact('myFolders'));
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
		$this->MyFile->id = $id;
		if (!$this->MyFile->exists()) {
			throw new NotFoundException(__('Invalid file'));
		}
		$my_file=$this->MyFile->find('first',array(
			'conditions'=>array(
				'MyFile.id'=>$id
			)
		));
		if ($this->MyFile->delete()) {
			$this->Session->setFlash(__('File deleted'));
			@unlink('files/my_files_library/'.$my_file['MyFile']['filename']);
			$this->redirect(array('action' => 'index',$my_file['MyFile']['my_folder_id']));
		}
		$this->Session->setFlash(__('File was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
