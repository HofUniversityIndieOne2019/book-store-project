<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function()
    {
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'OliverHader.BookStoreApp',
            'Wishlist',
            [
                'Wishlist' => 'show, add, remove, purge',
            ],
            // non-cacheable actions
            [
                'Wishlist' => 'show, add, remove, purge',
            ]
        );
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'OliverHader.BookStoreApp',
            'Customer',
            [
                'Customer' => 'index, newAddress, createAddress, editAddress, updateAddress, deleteAddress, '
                    . 'newBankAccount, createBankAccount, editBankAccount, updateBankAccount, deleteBankAccount',
            ],
            // non-cacheable actions
            [
                'Customer' => 'index, newAddress, createAddress, editAddress, updateAddress, deleteAddress, '
                    . 'newBankAccount, createBankAccount, editBankAccount, updateBankAccount, deleteBankAccount',
            ]
        );
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'OliverHader.BookStoreApp',
            'Overview',
            [
                'Dashboard' => 'overview',
            ],
            // non-cacheable actions
            [
            ]
        );
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'OliverHader.BookStoreApp',
            'Book',
            [
                'Book' => 'list, show',
            ],
            // non-cacheable actions
            [
                'Book' => 'list, show',
            ]
        );
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'OliverHader.BookStoreApp',
            'Author',
            [
                'Author' => 'list, show',
                'Publisher' => 'list, show',
                'Country' => 'list, show'
            ],
            // non-cacheable actions
            [
                'Author' => 'list, show',
                'Publisher' => 'list, show',
                'Country' => 'list, show'
            ]
        );
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'OliverHader.BookStoreApp',
            'Topic',
            [
                'Topic' => 'list, show',
            ],
            // non-cacheable actions
            [
                'Topic' => 'list, show',
            ]
        );

        // wizards
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
            'mod {
                wizards.newContentElement.wizardItems.plugins {
                    elements {
                        overview {
                            iconIdentifier = book_store_app-plugin-overview
                            title = Books overview
                            description = Books overview
                            tt_content_defValues {
                                CType = list
                                list_type = bookstoreapp_overview
                            }
                        }
                        book {
                            iconIdentifier = book_store_app-plugin-book
                            title = LLL:EXT:book_store_app/Resources/Private/Language/locallang_db.xlf:tx_book_store_app_book.name
                            description = LLL:EXT:book_store_app/Resources/Private/Language/locallang_db.xlf:tx_book_store_app_book.description
                            tt_content_defValues {
                                CType = list
                                list_type = bookstoreapp_book
                            }
                        }
                        author {
                            iconIdentifier = book_store_app-plugin-author
                            title = Author
                            description = Renders all authors
                            tt_content_defValues {
                                CType = list
                                list_type = bookstoreapp_author
                            }
                        }
                        topic {
                            iconIdentifier = book_store_app-plugin-topic
                            title = Topic
                            description = Renders all topics
                            tt_content_defValues {
                                CType = list
                                list_type = bookstoreapp_topic
                            }
                        }
                    }
                    show = *
                }
           }'
        );
		$iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);

			$iconRegistry->registerIcon(
				'book_store_app-plugin-book',
				\TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
				['source' => 'EXT:book_store_app/Resources/Public/Icons/user_plugin_book.svg']
			);
			$iconRegistry->registerIcon(
				'book_store_app-plugin-author',
				\TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
				['source' => 'EXT:book_store_app/Resources/Public/Icons/user_plugin_book.svg']
			);

    }
);
