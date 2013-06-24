<?php
App::uses('AppModel', 'Model');
/**
 * Destination Model
 *
 * @property Booking $Booking
 * @property Region $Region
 */
class Destination extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
			),
		),
		'location' => array(
			'notempty' => array(
				'rule' => array('notempty'),
			),
		),
		'cost' => array(
			'numeric' => array(
				'rule' => array('numeric'),
			),
		),
		'country_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
			),
		),
		'category_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Booking' => array(
			'className' => 'Booking',
			'foreignKey' => 'destination_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Activity' => array(
			'className' => 'Activity',
			'foreignKey' => 'destination_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);
	
	
/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Country' => array(
			'className' => 'Country',
			'foreignKey' => 'country_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Category' => array(
			'className' => 'Category',
			'foreignKey' => 'category_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);


/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Region' => array(
			'className' => 'Region',
			'joinTable' => 'destinations_regions',
			'foreignKey' => 'destination_id',
			'associationForeignKey' => 'region_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		)
	);

}
