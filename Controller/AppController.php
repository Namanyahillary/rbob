<?php
App::uses('Controller', 'Controller');
class AppController extends Controller {
	public $components = array('RequestHandler','Session','Auth','Func','ImageResize','Cookie');
	public $uses=array('GroupMember','Country','Category','Currency');
	
	function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->authError = 'Please login to continue.';
        $this->Auth->loginError = 'Incorrect username/password combination';
        $this->Auth->loginRedirect = array('controller' => 'categories');
        $this->Auth->logoutRedirect = array('controller' => 'categories');
		
        //Set roles for views
		$this->set('super_admin', $this->_is('super_admin'));
		$this->set('collector1', $this->_is('collector1'));
		$this->set('admin', $this->_is('admin'));
		$this->set('bank_admin', $this->_is('bank_admin'));
		$this->set('regular', $this->_is('regular'));
		
        $this->set('logged_in', $this->_loggedIn());
        $this->set('users_username', $this->setField('username'));
		$this->set('country_id', $this->setField('country_id'));
        $this->set('users_Id', $this->setField('id'));
        $this->set('approval_position', $this->setField('approval_position'));
        $this->set('name_of_user', $this->setField('name'));
        $this->set('role_of_user', $this->setField('role'));
        $this->set('other_role_of_user', $this->setField('other_role'));
        $this->set('email_of_user', $this->setField('email'));
        $this->set('profile_image', $this->setField('profile_image')); 
		$this->set('my_groups',$this->getGroups());
		$this->set('available_countries',$this->getCountries());
		$this->set('available_categories',$this->getCategories());
		$this->set('available_currencies',$this->getCurrencies());
		
	}

    function getGroups() {
		if ($this->Auth->user()) {
			$groups=$this->GroupMember->find('all',array(
				'recursive'=>0,
				'conditions'=>array(
					'GroupMember.user_id'=>$this->Auth->User('id'),
					'GroupMember.has_confirmed'=>1
				)
			));
            return $groups;
        }else{
			return array();
		}
        
    }
	
	function getCountries() {		
		return $this->Country->find('all',array(
			'recursive'=>-1,
			'conditions'=>array(
				'NOT'=>array(
					'Country.id'=>array(100001,100002)
				)
			)
		));        
    }
	
	function getCategories() {		
		return $this->Category->find('all',array(
			'recursive'=>-1
		));        
    }

	function getCurrencies() {		
		return $this->Currency->find('all',array(
			'recursive'=>-1
		));        
    }
	
	
	function setField($field) {
        return $this->Auth->User($field);
    }
	
	/*
	 *Returns true or false depending whether the user fits the role passed as argument
	 *@param Srting $role
	 *@return Boolean
	 */
    function _is($role) {
        $fits_role = FALSE;
        if ($this->Auth->user('role') == $role) {
            $fits_role = TRUE;
        }
        return $fits_role;
    }

    function _loggedIn() {
        $logged_in = FALSE;
        if ($this->Auth->user()) {
            $logged_in = TRUE;
        }
        return $logged_in;
    }
}


//User descriptions
/**
 *
 *[collector1]  adds destination data to the database that has to be approve by the super admininstrator before its showed to the public
 *
 */