<?php

class Mesero extends AppModel 
{
	public $virtualFields = array('nombre_completo' => 'CONCAT(Mesero.nombre, " ", Mesero.apellido)');

	public $validate = array(
		'dni' => array(
				'notEmpty' => array(
					'rule' => 'notEmpty'
					),
				'numeric' => array(
					'rule' => 'numeric', 
					'message'=>'Solo Números'
				),
				'unique' => array(
					'rule' =>'isUnique',
					'message' =>'El DNI ya se encuentra en nuestra base de datos'
				),
			),
		'nombre' => array(
				'rule' => 'notEmpty'
			),
		'apellido' => array(
				'rule' => 'notEmpty'
			),
		'telefono' => array(
					'notEmpty' => array(
						'rule' => 'notEmpty'
					),
					'numeric' => array(
						'rule' => 'numeric', 
						'message'=>'Solo Números'
					)
		),
	);

	public $hasMany = array(
		'Mesa'=>array(
			'classname'=>'mesa',
			'fereignKey'=>'mesero_id',
			'conditions'=>'',
			'order'=>'Mesa.serie DESC',
			'depend'=> false
		)
	);
}
?>
