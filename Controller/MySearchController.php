<?php
/**
 * Dashboard controller.
 */
App::uses('AppController', 'Controller');
class MySearchController extends AppController {
	public $uses = array('User','Group','Destination');
	
	public function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow('get_data');
	}
	
	public function get_data($q=null) {
		$Response=array(
			'User'=>array(),
			'Group'=>array(),
			'Destination'=>array(),
		);
		if($q){
			//Users
			$Response['User']=$this->User->find('all', array(
				'conditions' => array(
					 'OR' => array(
						  'User.name LIKE ' => '%'.h($q).'%'
					  )
				 ),
				 'limit'=>20,
				 'fields'=>array(
					'id','name','profile_image'
				 ),
				 'recursive'=>-1,
				 'order'=>'name desc, date desc'
			));
			
			//Groups
			$Response['Group']=$this->Group->find('all', array(
				'conditions' => array(
					 'OR' => array(
						  'Group.name LIKE ' => '%'.h($q).'%'
					  )
				 ),
				 'limit'=>20,
				 'fields'=>array(
					'id','name','cover_img'
				 ),
				 'recursive'=>-1,
				 'order'=>'name desc, date desc'
			));
			
			//Destinations
			$Response['Destination']=$this->Destination->find('all', array(
				'conditions' => array(
					 'OR' => array(
						  'Destination.name LIKE ' => '%'.h($q).'%',
						  'Destination.location LIKE ' => '%'.h($q).'%'
					  )
				 ),
				 'limit'=>20,
				 'fields'=>array(
					'id','name','image_file'
				 ),
				 'recursive'=>-1,
				 'order'=>'name desc,date desc'
			));
		}
		
		$this->set('data',$Response);
	}
}
