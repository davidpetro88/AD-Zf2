<?php
return [
    'controllers' => [
        'invokables' => [
            'PropostaServico\Controller\Crud' => 'PropostaServico\Controller\CrudController',
        ],
    ],
    'router' => [
        'routes' => [
            'proposta-servico' => [
                'type' => 'Literal',
                'options' => [
                    'route' => '/proposta-servico',
                    'defaults' => [
                        'controller' => 'PropostaServico\Controller\Crud',
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
                                'controller' => 'PropostaServico\Controller\Crud',
                                'action' => 'list',
                            ],
                        ],
                    ],
                    'add' => [
                        'type' => 'Literal',
                        'options' => [
                            'route' => '/add',
                            'defaults' => [
                                'controller' => 'PropostaServico\Controller\Crud',
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
                                'controller' => 'PropostaServico\Controller\Crud',
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
                                'controller' => 'PropostaServico\Controller\Crud',
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
            'PropostaServico' => __DIR__.'/../view',
        ],
    ],
    'doctrine' => [
        'driver' => [
            'PropostaServico_driver' => [
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => [
                    __DIR__.'/../src/PropostaServico/Entity',
                ],
            ],
            'orm_default' => [
                'drivers' => [
                    'PropostaServico\Entity' => 'PropostaServico_driver',
                ],
            ],
        ],
    ],
    'navigation' => [
        'default' => [
            'Crud' => [
                'pages' => [
                    'proposta-servico' => [
                        'label' => 'PropostaServico',
                        'route' => 'proposta-servico/list',
                        'pages' => [
                            'list' => [
                                'label' => 'List',
                                'route' => 'proposta-servico/list',
                            ],
                            'add' => [
                                'label' => 'Add',
                                'route' => 'proposta-servico/add',
                            ],
                            'edit' => [
                                'label' => 'Edit',
                                'route' => 'proposta-servico/edit',
                            ],
                            'delete' => [
                                'label' => 'Delete',
                                'route' => 'proposta-servico/delete',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ]
];
