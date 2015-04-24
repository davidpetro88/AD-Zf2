<?php
$database = '';

if (isset($_SESSION)) {
    $database = $_SESSION['nome'];
}

return array(
    'service_manager' => array(
        'invokables' => array(
            'Zend\Session\SessionManager' => 'Zend\Session\SessionManager'
        ),
        'aliases' => []
    )
    // 'Zend\Authentication\AuthenticationService' => 'zfcuser_auth_service'

    ,
    'doctrine' => array(
        'connection' => array(
            'orm_default' => array(
                'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
                'params' => array(
                    'host' => 'localhost',
                    'port' => '3306',
                    'user' => 'root',
                    'dbname' => 'zf2los',
                    'charset' => 'UTF8',
                    'driverOptions' => array(
                        'charset' => 'UTF8'
                    )
                )
            ),

            'orm_saas' => array(
                'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
                'params' => array(
                    'host' => 'localhost',
                    'port' => '3306',
                    'user' => 'root',
                    'dbname' => $database,
                    'charset' => 'UTF8',
                    'driverOptions' => array(
                        'charset' => 'UTF8'
                    )
                )
            )
        ),
        'entitymanager' => array(
            'orm_default' => array(
                'connection' => 'orm_default',
                'configuration' => 'orm_default'
            ),
            'orm_saas' => array(
                'connection' => 'orm_default',
                'configuration' => 'orm_default'
            )
        ),
        'configuration' => array(
            'orm_default' => array(
                'query_cache' => 'apc',
                'result_cache' => 'apc',
                'metadata_cache' => 'apc'
            ),
            'orm_saas' => array(
                'query_cache' => 'apc',
                'result_cache' => 'apc',
                'metadata_cache' => 'apc'
            )
        )
    ),
    'view_manager' => array(
        'template_map' => array(
            'error/403' => __DIR__ . '/../../module/Application/view/error/403.phtml'
        )
    ),
    'static_salt' => 'aFGQ475SDsdfsaf2342'
); // was moved from module.config.php here to allow all modules to use it
