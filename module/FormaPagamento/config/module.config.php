<?php
return [
    'controllers' => [
        'invokables' => [
            'FormaPagamento\Controller\Crud' => 'FormaPagamento\Controller\CrudController',
        ],
    ],
    'router' => [
        'routes' => [
            'forma-pagamento' => [
                'type' => 'Literal',
                'options' => [
                    'route' => '/forma-pagamento',
                    'defaults' => [
                        'controller' => 'FormaPagamento\Controller\Crud',
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
                                'controller' => 'FormaPagamento\Controller\Crud',
                                'action' => 'list',
                            ],
                        ],
                    ],
                    'add' => [
                        'type' => 'Literal',
                        'options' => [
                            'route' => '/add',
                            'defaults' => [
                                'controller' => 'FormaPagamento\Controller\Crud',
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
                                'controller' => 'FormaPagamento\Controller\Crud',
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
                                'controller' => 'FormaPagamento\Controller\Crud',
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
            'FormaPagamento' => __DIR__.'/../view',
        ],
    ],
    'doctrine' => [
        'driver' => [
            'FormaPagamento_driver' => [
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => [
                    __DIR__.'/../src/FormaPagamento/Entity',
                ],
            ],
            'orm_default' => [
                'drivers' => [
                    'FormaPagamento\Entity' => 'FormaPagamento_driver',
                ],
            ],
        ],
    ],
    'navigation' => [
        'default' => [
            'Crud' => [
                'pages' => [
                    'forma-pagamento' => [
                        'label' => 'FormaPagamento',
                        'route' => 'forma-pagamento/list',
                        'pages' => [
                            'list' => [
                                'label' => 'List',
                                'route' => 'forma-pagamento/list',
                            ],
                            'add' => [
                                'label' => 'Add',
                                'route' => 'forma-pagamento/add',
                            ],
                            'edit' => [
                                'label' => 'Edit',
                                'route' => 'forma-pagamento/edit',
                            ],
                            'delete' => [
                                'label' => 'Delete',
                                'route' => 'forma-pagamento/delete',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ]
];
