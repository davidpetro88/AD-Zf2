<?php
return [
    'controllers' => [
        'invokables' => [
            'Dvd\Controller\Crud' => 'Dvd\Controller\CrudController'
        ]
    ],
    'router' => [
        'routes' => [
            'dvd' => [
                'type' => 'Literal',
                'options' => [
                    'route' => '/dvd',
                    'defaults' => [
                        'controller' => 'Dvd\Controller\Crud',
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
                                'controller' => 'Dvd\Controller\Crud',
                                'action' => 'list'
                            ]
                        ]
                    ],
                    'add' => [
                        'type' => 'Literal',
                        'options' => [
                            'route' => '/add',
                            'defaults' => [
                                'controller' => 'Dvd\Controller\Crud',
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
                                'controller' => 'Dvd\Controller\Crud',
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
                                'controller' => 'Dvd\Controller\Crud',
                                'action' => 'delete',
                                'id' => 0
                            ]
                        ]
                    ]
                ]
            ]
        ]
    ],
    'view_manager' => [
        'template_path_stack' => [
            'Dvd' => __DIR__ . '/../view'
        ]
    ],
    'doctrine' => [
        'driver' => [
            'Dvd_driver' => [
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => [
                    __DIR__ . '/../src/Dvd/Entity'
                ]
            ],
            'orm_default' => [
                'drivers' => [
                    'Dvd\Entity' => 'Dvd_driver'
                ]
            ]
        ]
    ],
    'navigation' => [
        'default' => [
            'Crud' => [
                'pages' => [
                    'dvd' => [
                        'label' => 'Dvd',
                        'route' => 'dvd/list',
                        'pages' => [
                            'list' => [
                                'label' => 'List',
                                'route' => 'dvd/list'
                            ],
                            'add' => [
                                'label' => 'Add',
                                'route' => 'dvd/add'
                            ],
                            'edit' => [
                                'label' => 'Edit',
                                'route' => 'dvd/edit'
                            ],
                            'delete' => [
                                'label' => 'Delete',
                                'route' => 'dvd/delete'
                            ]
                        ]
                    ]
                ]
            ]
        ]
    ]
];