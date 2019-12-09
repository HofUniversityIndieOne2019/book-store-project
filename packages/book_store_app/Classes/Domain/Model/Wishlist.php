<?php
namespace OliverHader\BookStoreApp\Domain\Model;


/***
 *
 * This file is part of the "Book Store App" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2019 Oliver Hader <oliver.hader.2@hof-university.de>
 *
 ***/
/**
 * Wishlist
 */
class Wishlist extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * books
     * 
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\OliverHader\BookStoreApp\Domain\Model\Book>
     */
    protected $books = null;

    /**
     * __construct
     */
    public function __construct()
    {

        //Do not remove the next line: It would break the functionality
        $this->initStorageObjects();
    }

    /**
     * Initializes all ObjectStorage properties
     * Do not modify this method!
     * It will be rewritten on each save in the extension builder
     * You may modify the constructor of this class instead
     * 
     * @return void
     */
    protected function initStorageObjects()
    {
        $this->books = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }

    /**
     * Adds a Book
     * 
     * @param \OliverHader\BookStoreApp\Domain\Model\Book $book
     * @return void
     */
    public function addBook(\OliverHader\BookStoreApp\Domain\Model\Book $book)
    {
        $this->books->attach($book);
    }

    /**
     * Removes a Book
     * 
     * @param \OliverHader\BookStoreApp\Domain\Model\Book $bookToRemove The Book to be removed
     * @return void
     */
    public function removeBook(\OliverHader\BookStoreApp\Domain\Model\Book $bookToRemove)
    {
        $this->books->detach($bookToRemove);
    }

    /**
     * Returns the books
     * 
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\OliverHader\BookStoreApp\Domain\Model\Book> $books
     */
    public function getBooks()
    {
        return $this->books;
    }

    /**
     * Sets the books
     * 
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\OliverHader\BookStoreApp\Domain\Model\Book> $books
     * @return void
     */
    public function setBooks(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $books)
    {
        $this->books = $books;
    }
}
