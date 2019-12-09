<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function()
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'OliverHader.BookStoreApp',
            'Wishlist',
            'Wishlist'
        );
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'OliverHader.BookStoreApp',
            'Overview',
            'Books overview'
        );
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'OliverHader.BookStoreApp',
            'Book',
            'Book'
        );
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'OliverHader.BookStoreApp',
            'Author',
            'Author handling'
        );
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'OliverHader.BookStoreApp',
            'Topic',
            'Topic handling'
        );

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('book_store_app', 'Configuration/TypoScript', 'Book Store App');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_bookstoreapp_domain_model_book', 'EXT:book_store_app/Resources/Private/Language/locallang_csh_tx_bookstoreapp_domain_model_book.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_bookstoreapp_domain_model_book');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_bookstoreapp_domain_model_topic', 'EXT:book_store_app/Resources/Private/Language/locallang_csh_tx_bookstoreapp_domain_model_topic.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_bookstoreapp_domain_model_topic');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_bookstoreapp_domain_model_author', 'EXT:book_store_app/Resources/Private/Language/locallang_csh_tx_bookstoreapp_domain_model_author.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_bookstoreapp_domain_model_author');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_bookstoreapp_domain_model_publisher', 'EXT:book_store_app/Resources/Private/Language/locallang_csh_tx_bookstoreapp_domain_model_publisher.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_bookstoreapp_domain_model_publisher');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_bookstoreapp_domain_model_country', 'EXT:book_store_app/Resources/Private/Language/locallang_csh_tx_bookstoreapp_domain_model_country.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_bookstoreapp_domain_model_country');

    }
);
