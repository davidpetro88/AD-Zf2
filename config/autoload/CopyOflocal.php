<?php
/**
 * No nosso local.php, configuramos a senha do banco de dados e, no caso do desenvolvimento,
 * definimos o cache como array, ou seja, s� usar� o cache apenas naquela p�gina. Isso �
 * importante, pois como o cache armazena estrutura das tabelas e at� as consultas ao banco,
 * vai atrapalhar bastante o desenvolvimento.
 *
 */
return array(
    'doctrine' => array(
        'configuration' => array(
            'orm_default' => array(
                'query_cache' => 'array',
                'result_cache' => 'array',
                'metadata_cache' => 'array'
            ),
            'orm_saas' => array(
                'query_cache' => 'array',
                'result_cache' => 'array',
                'metadata_cache' => 'array'
            )
        ),
        'connection' => array(
            'orm_default' => array(
                'params' => array(
                    'password' => ''
                )
            ),
            'orm_saas' => array(
                'params' => array(
                    'password' => ''
                )
            )
        )

    )
);