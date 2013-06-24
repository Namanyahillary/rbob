<?php
/**
 * Dashboard controller.
 */
App::uses('AppController', 'Controller');
class DashboardsController extends AppController {
	public $uses = array('Country','Currency');
	public $name = 'Dashboards';
	
	public function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow('set_country','change_currency','get_african_countries','get_international_countries');
	}
	
	public function index() {
	}
	
	public function get_african_countries() {
		$countries=$this->Country->find('all',array('conditions'=>array('Country.region_id'=>10),'recursive'=>-1));
		
		$this->set(compact('countries'));
	}
	
	public function get_international_countries() {
		$countries=$this->Country->find('all',array('conditions'=>array('Country.region_id'=>11),'recursive'=>-1));
		
		$this->set(compact('countries'));
	}
	
	
	//set the country selected aswell as the conversion rate to be used
	public function set_country($country_id=null,$other_country=null){
		$resp['data']=array();
		
		$countries=$this->Country->find('all',array('conditions'=>array('Country.id'=>$country_id),'recursive'=>-1,'limit'=>1));
		if(count($countries)){
			$resp['data']=array('status'=>'1');
			$this->Session->write("RoundBob['Destination']['Region']",$countries[0]['Country']['region_id']);
			$this->Session->write("RoundBob['Destination']['Country']",(int)$country_id);
			$this->Session->write("RoundBob['Destination']['CountryName']",$countries[0]['Country']['name']);
			
			//set cookie
			$expires=3600*24*1; //1day
			$this->Cookie->httpOnly = true;
			$this->Cookie->write('Region', $countries[0]['Country']['region_id'], $encrypt = true, $expires);
			$this->Cookie->write('Country', (int)$country_id, $encrypt = true, $expires);
			$this->Cookie->write('CountryName', $countries[0]['Country']['name'], $encrypt = true, $expires);
			
			
			$currency=$this->Currency->find('first',array(
				'conditions'=>array(
					'Currency.country_id'=>$countries[0]['Country']['id']
				),
				'recursive'=>-1
			));
			
			if(isset($currency['Currency'])){
				$this->Session->write("RoundBob['Destination']['Currency']",$currency);
			}
			if($other_country){
				$this->redirect(array('action'=>'show',$country_id,'controller'=>'categories'));
			}
		}else{
			$resp['data']=array('status'=>'0');
			if($other_country){
				$this->redirect(array('action'=>'home','controller'=>'pages'));
			}
		}
		
		$this->set(compact('resp'));
	}
	
	public function change_currency($currency_id){
		$currency=$this->Currency->find('first',array(
			'conditions'=>array(
				'Currency.id'=>$currency_id
			),
			'recursive'=>-1
		));
		
		if(isset($currency['Currency'])){
			$this->Session->write("RoundBob['Destination']['Currency']",$currency);
		}
		
		$this->redirect(array('action'=>'index','controller'=>'categories'));
	}

}
