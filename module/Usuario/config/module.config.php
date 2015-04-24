<?php
return [
    'controllers' => [
        'invokables' => [
            'Usuario\Controller\Crud' => 'Usuario\Controller\CrudController',
            'Usuario\Controller\Index' => 'Usuario\Controller\IndexController',
            'Usuario\Controller\Registration' => 'Usuario\Controller\RegistrationController',
            'Usuario\Controller\Admin' => 'Usuario\Controller\AdminController'
        ]
    ],
    'router' => [
        'routes' => [
            'usuario' => [
                'type' => 'Literal',
                'options' => [
                    'route' => '/usuario',
                    'defaults' => [
                        'controller' => 'Usuario\Controller\Crud',
                        'action' => 'list'
                    ]
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'list' => [
                        'type' => 'Literal',
                        'options' => [
                            'route' => '/list',
                            'defaults' => [
                                'controller' => 'Usuario\Controller\Crud',
                                'action' => 'list'
                            ]
                        ]
                    ],
                    'add' => [
                        'type' => 'Literal',
                        'options' => [
                            'route' => '/add',
                            'defaults' => [
                                'controller' => 'Usuario\Controller\Crud',
                                'action' => 'add'
                            ]
                        ]
                    ],
                    'edit' => [
                        'type' => 'Segment',
                        'options' => [
                            'route' => '/edit[/:id]',
                            'constraints' => [
                                'id' => '[0-9]+'
                            ],
                            'defaults' => [
                                'controller' => 'Usuario\Controller\Crud',
                                'action' => 'edit',
                                'id' => 0
                            ]
                        ]
                    ],
                    'delete' => [
                        'type' => 'Segment',
                        'options' => [
                            'route' => '/delete[/:id]',
                            'constraints' => [
                                'id' => '[0-9]+'
                            ],
                            'defaults' => [
                                'controller' => 'Usuario\Controller\Crud',
                                'action' => 'delete',
                                'id' => 0
                            ]
                        ]
                    ]
                ]
            ],
            'index' => [
                'type' => 'Literal',
                'options' => [
                    'route' => '/login',
                    'defaults' => [
                        'controller' => 'Usuario\Controller\Index',
                        'action' => 'index'
                    ]
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'logar' => [
                        'type' => 'Literal',
                        'options' => [
                            'route' => '/auth',
                            'defaults' => [
                                'controller' => 'Usuario\Controller\Index',
                                'action' => 'login'
                            ]
                        ]
                    ],
                    'logout' => [
                        'type' => 'Literal',
                        'options' => [
                            'route' => '/logout',
                            'defaults' => [
                                'controller' => 'Usuario\Controller\Index',
                                'action' => 'logout'
                            ]
                        ]
                    ],
                    'auth' => [
                        'type' => 'Literal',
                        'options' => [
                            'route' => '/auth-user',
                            'defaults' => [
                                'controller' => 'Usuario\Controller\Index',
                                'action' => 'login'
                            ]
                        ]
                    ]
                ]
            ],
            'registration' => [
                'type' => 'segment',
                'options' => [
                    'route' => '/registration[/:action]',
                    'constraints' => array(
                        'action' => '[a-zA-Z0-9_-]+',
                    ),
                    'defaults' => [
                        'controller' => 'Usuario\Controller\Registration',
                        'action' => 'index'
                    ]
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'list' => [
                        'type' => 'Literal',
                        'options' => [
                            'route' => '/',
                            'defaults' => [
                                'controller' => 'Usuario\Controller\Registration',
                                'action' => 'index'
                            ]
                        ]
                    ],
                    'index' => [
                        'type' => 'Literal',
                        'options' => [
                            'route' => '/index',
                            'defaults' => [
                                'controller' => 'Usuario\Controller\Registration',
                                'action' => 'index'
                            ]
                        ]
                    ],
                    'registration-success' => [
                        'type' => 'Literal',
                        'options' => [
                            'route' => '/registration-success',
                            'defaults' => [
                                'controller' => 'Usuario\Controller\Registration',
                                'action' => 'registration-success'
                            ]
                        ]
                    ],
                    'password-change-success' => [
                        'type' => 'Literal',
                        'options' => [
                            'route' => '/password-change-success',
                            'defaults' => [
                                'controller' => 'Usuario\Controller\Registration',
                                'action' => 'password-change-success'
                            ]
                        ]
                    ],
                    'forgotten-password' => [
                        'type' => 'Literal',
                        'options' => [
                            'route' => '/forgotten-password',
                            'defaults' => [
                                'controller' => 'Usuario\Controller\Registration',
                                'action' => 'forgotten-password'
                            ]
                        ]
                    ],
                    'confirm-email' => [
                        'type' => 'Segment',
                        'options' => [
                            'route' => '/confirm-email[/:id]',
                            'constraints' => [
                                // 'id' => '[a-zA-Z][a-zA-Z0-9_-]*'
                                'id' => '[a-zA-Z0-9_-]+'
                            ],
                            'defaults' => [
                                'controller' => 'Usuario\Controller\Registration',
                                'action' => 'confirm-email',
                                'id' => 0
                            ]
                        ]
                    ],
                    'confirm-email-error' => [
                        'type' => 'Segment',
                        'options' => [
                            'route' => '/confirm-email-error[/:id]',
                            'constraints' => [
                                // 'id' => '[a-zA-Z][a-zA-Z0-9_-]*'
                                'id' => '[a-zA-Z0-9_-]+'
                            ],
                            'defaults' => [
                                'controller' => 'Usuario\Controller\Registration',
                                'action' => 'confirm-email-error',
                                'id' => 0
                            ]
                        ]
                    ]
                ]
            ]

        ]
    ]
    ,
    'view_manager' => [
        'template_path_stack' => [
            'Usuario' => __DIR__ . '/../view',
            'Index' => __DIR__ . '/../view',
            'Registration' => __DIR__ . '/../view'
        ]
    ],
    'doctrine' => [
        'authentication' => [ // this part is for the Auth adapter from DoctrineModule/Authentication
            'orm_default' => [
                'object_manager' => 'Doctrine\ORM\EntityManager',
                // object_repository can be used instead of the object_manager key
                'identity_class' => 'Usuario\Entity\Usuario', // 'Application\Entity\User',
                'identity_property' => 'nome', // 'username', // 'email',
                'credential_property' => 'password'
            ] // 'password',
                                                 // 'credential_callable' => function (Entity\Usuario $user, $passwordGiven) { // not only User
                                                 // // return my_awesome_check_test($user->getPassword(), $passwordGiven);
                                                 // // echo '<h1>callback user->getPassword = ' .$user->getPassword() . ' passwordGiven = ' . $passwordGiven . '</h1>';
                                                 // // - if ($user->getPassword() == md5($passwordGiven)) { // original
                                                 // // ToDo find a way to access the Service Manager and get the static salt from config array
                                                 // if ($user->getPassword() == md5('aFGQ475SDsdfsaf2342' . $passwordGiven . $user->getUsrPasswordSalt()) && $user->getUsrActive() == 1) {
                                                 // return true;
                                                 // } else {
                                                 // return false;
                                                 // }
                                                 // }

        ],

        'driver' => [
            'Usuario_driver' => [
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => [
                    __DIR__ . '/../src/Usuario/Entity'
                ]
            ],
            'orm_default' => [
                'drivers' => [
                    'Usuario\Entity' => 'Usuario_driver'
                ]
            ]
        ]
    ],
    'navigation' => [
        'default' => [
            'Crud' => [
                'pages' => [
                    'usuario' => [
                        'label' => 'Usuario',
                        'route' => 'usuario/list',
                        'pages' => [
                            'list' => [
                                'label' => 'List',
                                'route' => 'usuario/list'
                            ],
                            'add' => [
                                'label' => 'Add',
                                'route' => 'usuario/add'
                            ],
                            'edit' => [
                                'label' => 'Edit',
                                'route' => 'usuario/edit'
                            ],
                            'delete' => [
                                'label' => 'Delete',
                                'route' => 'usuario/delete'
                            ]
                        ]
                    ]
                ]
            ]
        ]
    ]
];