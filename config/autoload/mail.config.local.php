<?php
return array(
	'mail' => array(
		'transport' => array(
			'options' => array(
				'host'              => 'smtp.gmail.com',
			    'port'=> 587,
				'connection_class'  => 'plain',
				'connection_config' => array(
					'username' => 'email@gmail.com',
					'password' => '123456',
					'ssl' => 'tls'
				),
			),
		),
	),
);
