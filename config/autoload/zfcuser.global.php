<?php
$settings = array(
    // 'zend_db_adapter' => 'Zend\Db\Adapter\Adapter',
    'user_entity_class' => 'Usuario\Entity\Usuario',
    'enable_default_entities' => false,
    'enable_registration' => false,
    'enable_username' => true,
    'auth_adapters' => array(
        100 => 'ZfcUser\Authentication\Adapter\Db'
    ),
    'enable_display_name' => true,
    'auth_identity_fields' => array(
        // 'email'
        'nome' => 'nome'
    ),
    'login_form_timeout' => 300,
    'user_form_timeout' => 300,
    'use_redirect_parameter_if_present' => true,
    'user_login_widget_view_template' => 'zfc-user/user/login.phtml',
    // 'login_redirect_route' => 'dashboard',
    // 'logout_redirect_route' => 'home',
    'login_redirect_route' => 'index',
    'logout_redirect_route' => 'registration',
    // 'password_cost' => 14,
    'enable_user_state' => false,
    // 'table_name' => 'Usu'
    'table_name' => 'usuario'
);
return array(
    'zfcuser' => $settings,
    'service_manager' => array(
        'aliases' => array(
            'zfcuser_zend_db_adapter' => (isset($settings['zend_db_adapter'])) ? $settings['zend_db_adapter'] : 'Zend\Db\Adapter\Adapter'
        )
    )
);