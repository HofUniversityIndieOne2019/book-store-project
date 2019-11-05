<?php

/**
 * Extension Manager/Repository config file for ext "book_store_site".
 */
$EM_CONF[$_EXTKEY] = [
    'title' => 'Book Store Site',
    'description' => '',
    'category' => 'templates',
    'constraints' => [
        'depends' => [
            'typo3' => '8.7.0-9.5.99',
            'rte_ckeditor' => '8.7.0-9.5.99',
            'bootstrap_package' => '10.0.0-10.0.99'
        ],
        'conflicts' => [
        ],
    ],
    'autoload' => [
        'psr-4' => [
            'OliverHader\\BookStoreSite\\' => 'Classes'
        ],
    ],
    'state' => 'stable',
    'uploadfolder' => 0,
    'createDirs' => '',
    'clearCacheOnLoad' => 1,
    'author' => 'Oliver Hader',
    'author_email' => 'oliver.hader.2@hof-university.de',
    'author_company' => 'Oliver Hader',
    'version' => '1.0.0',
];
