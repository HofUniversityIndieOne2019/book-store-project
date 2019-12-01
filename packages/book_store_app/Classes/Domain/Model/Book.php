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
 * Book
 */
class Book extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * isbn
     * 
     * @var string
     * @TYPO3\CMS\Extbase\Annotation\Validate("NotEmpty")
     */
    protected $isbn = '';

    /**
     * title
     * 
     * @var string
     * @TYPO3\CMS\Extbase\Annotation\Validate("NotEmpty")
     */
    protected $title = '';

    /**
     * blurb
     * 
     * @var string
     */
    protected $blurb = '';

    /**
     * description
     * 
     * @var string
     */
    protected $description = '';

    /**
     * price
     * 
     * @var float
     * @TYPO3\CMS\Extbase\Annotation\Validate("NotEmpty")
     */
    protected $price = 0.0;

    /**
     * pages
     * 
     * @var int
     */
    protected $pages = 0;

    /**
     * images
     * 
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $images = null;

    /**
     * topics
     * 
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\OliverHader\BookStoreApp\Domain\Model\Topic>
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $topics = null;

    /**
     * authors
     * 
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\OliverHader\BookStoreApp\Domain\Model\Author>
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $authors = null;

    /**
     * publisher
     * 
     * @var \OliverHader\BookStoreApp\Domain\Model\Publisher
     */
    protected $publisher = null;

    /**
     * publicationDate
     * 
     * @var \DateTime
     * @TYPO3\CMS\Extbase\Annotation\Validate("NotEmpty")
     */
    protected $publicationDate = null;

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
        $this->images = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->topics = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->authors = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }

    /**
     * Returns the isbn
     * 
     * @return string $isbn
     */
    public function getIsbn()
    {
        return $this->isbn;
    }

    /**
     * Sets the isbn
     * 
     * @param string $isbn
     * @return void
     */
    public function setIsbn($isbn)
    {
        $this->isbn = $isbn;
    }

    /**
     * Returns the title
     * 
     * @return string $title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Sets the title
     * 
     * @param string $title
     * @return void
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Returns the blurb
     * 
     * @return string $blurb
     */
    public function getBlurb()
    {
        return $this->blurb;
    }

    /**
     * Sets the blurb
     * 
     * @param string $blurb
     * @return void
     */
    public function setBlurb($blurb)
    {
        $this->blurb = $blurb;
    }

    /**
     * Returns the description
     * 
     * @return string $description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Sets the description
     * 
     * @param string $description
     * @return void
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Returns the price
     * 
     * @return float $price
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Sets the price
     * 
     * @param float $price
     * @return void
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * Returns the pages
     * 
     * @return int $pages
     */
    public function getPages()
    {
        return $this->pages;
    }

    /**
     * Sets the pages
     * 
     * @param int $pages
     * @return void
     */
    public function setPages($pages)
    {
        $this->pages = $pages;
    }

    /**
     * Adds a FileReference
     * 
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $image
     * @return void
     */
    public function addImage(\TYPO3\CMS\Extbase\Domain\Model\FileReference $image)
    {
        $this->images->attach($image);
    }

    /**
     * Removes a FileReference
     * 
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $imageToRemove The FileReference to be removed
     * @return void
     */
    public function removeImage(\TYPO3\CMS\Extbase\Domain\Model\FileReference $imageToRemove)
    {
        $this->images->detach($imageToRemove);
    }

    /**
     * Returns the images
     * 
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $images
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * Sets the images
     * 
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $images
     * @return void
     */
    public function setImages(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $images)
    {
        $this->images = $images;
    }

    /**
     * Adds a Topic
     * 
     * @param \OliverHader\BookStoreApp\Domain\Model\Topic $topic
     * @return void
     */
    public function addTopic(\OliverHader\BookStoreApp\Domain\Model\Topic $topic)
    {
        $this->topics->attach($topic);
    }

    /**
     * Removes a Topic
     * 
     * @param \OliverHader\BookStoreApp\Domain\Model\Topic $topicToRemove The Topic to be removed
     * @return void
     */
    public function removeTopic(\OliverHader\BookStoreApp\Domain\Model\Topic $topicToRemove)
    {
        $this->topics->detach($topicToRemove);
    }

    /**
     * Returns the topics
     * 
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\OliverHader\BookStoreApp\Domain\Model\Topic> $topics
     */
    public function getTopics()
    {
        return $this->topics;
    }

    /**
     * Sets the topics
     * 
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\OliverHader\BookStoreApp\Domain\Model\Topic> $topics
     * @return void
     */
    public function setTopics(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $topics)
    {
        $this->topics = $topics;
    }

    /**
     * Adds a Author
     * 
     * @param \OliverHader\BookStoreApp\Domain\Model\Author $author
     * @return void
     */
    public function addAuthor(\OliverHader\BookStoreApp\Domain\Model\Author $author)
    {
        $this->authors->attach($author);
    }

    /**
     * Removes a Author
     * 
     * @param \OliverHader\BookStoreApp\Domain\Model\Author $authorToRemove The Author to be removed
     * @return void
     */
    public function removeAuthor(\OliverHader\BookStoreApp\Domain\Model\Author $authorToRemove)
    {
        $this->authors->detach($authorToRemove);
    }

    /**
     * Returns the authors
     * 
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\OliverHader\BookStoreApp\Domain\Model\Author> $authors
     */
    public function getAuthors()
    {
        return $this->authors;
    }

    /**
     * Sets the authors
     * 
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\OliverHader\BookStoreApp\Domain\Model\Author> $authors
     * @return void
     */
    public function setAuthors(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $authors)
    {
        $this->authors = $authors;
    }

    /**
     * Returns the publisher
     * 
     * @return \OliverHader\BookStoreApp\Domain\Model\Publisher $publisher
     */
    public function getPublisher()
    {
        return $this->publisher;
    }

    /**
     * Sets the publisher
     * 
     * @param \OliverHader\BookStoreApp\Domain\Model\Publisher $publisher
     * @return void
     */
    public function setPublisher(\OliverHader\BookStoreApp\Domain\Model\Publisher $publisher)
    {
        $this->publisher = $publisher;
    }

    /**
     * Returns the publicationDate
     * 
     * @return \DateTime $publicationDate
     */
    public function getPublicationDate()
    {
        return $this->publicationDate;
    }

    /**
     * Sets the publicationDate
     * 
     * @param \DateTime $publicationDate
     * @return void
     */
    public function setPublicationDate(\DateTime $publicationDate)
    {
        $this->publicationDate = $publicationDate;
    }
}
