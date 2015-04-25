<?php
return [
    'controllers' => [
        'invokables' => [
            'Servico\Controller\Crud' => 'Servico\Controller\CrudController',
        ],
    ],
    'router' => [
        'routes' => [
            'servico' => [
                'type' => 'Literal',
                'options' => [
                    'route' => '/servico',
                    'defaults' => [
                        'controller' => 'Servico\Controller\Crud',
                        'action' => 'list',
                    ],
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'list' => [
                        'type' => 'Literal',
                        'options' => [
                            'route' => '/list',
                            'defaults' => [
                                'controller' => 'Servico\Controller\Crud',
                                'action' => 'list',
                            ],
                        ],
                    ],
                    'add' => [
                        'type' => 'Literal',
                        'options' => [
                            'route' => '/add',
                            'defaults' => [
                                'controller' => 'Servico\Controller\Crud',
                                'action' => 'add',
                            ],
                        ],
                    ],
                    'edit' => [
                        'type' => 'Segment',
                        'options' => [
                            'route' => '/edit[/:id]',
                            'constraints' => [
                                'id' => '[0-9]+',
                            ],
                            'defaults' => [
                                'controller' => 'Servico\Controller\Crud',
                                'action' => 'edit',
                                'id' => 0,
                            ],
                        ],
                    ],
                    'delete' => [
                        'type' => 'Segment',
                        'options' => [
                            'route' => '/delete[/:id]',
                            'constraints' => [
                                'id' => '[0-9]+',
                            ],
                            'defaults' => [
                                'controller' => 'Servico\Controller\Crud',
                                'action' => 'delete',
                                'id' => 0,
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            'Servico' => __DIR__.'/../view',
        ],
    ],
    'doctrine' => [
        'driver' => [
            'Servico_driver' => [
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => [
                    __DIR__.'/../src/Servico/Entity',
                ],
            ],
            'orm_default' => [
                'drivers' => [
                    'Servico\Entity' => 'Servico_driver',
                ],
            ],
        ],
    ],
    'navigation' => [
        'default' => [
            'Crud' => [
                'pages' => [
                    'servico' => [
                        'label' => 'Servico',
                        'route' => 'servico/list',
                        'pages' => [
                            'list' => [
                                'label' => 'List',
                                'route' => 'servico/list',
                            ],
                            'add' => [
                                'label' => 'Add',
                                'route' => 'servico/add',
                            ],
                            'edit' => [
                                'label' => 'Edit',
                                'route' => 'servico/edit',
                            ],
                            'delete' => [
                                'label' => 'Delete',
                                'route' => 'servico/delete',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ]
];
