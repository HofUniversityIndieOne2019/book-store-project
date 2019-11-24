<?php
namespace OliverHader\BookStoreApp\Tests\Unit\Domain\Model;

/**
 * Test case.
 *
 * @author Oliver Hader <oliver.hader.2@hof-university.de>
 */
class BookTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \OliverHader\BookStoreApp\Domain\Model\Book
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \OliverHader\BookStoreApp\Domain\Model\Book();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function getIsbnReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getIsbn()
        );
    }

    /**
     * @test
     */
    public function setIsbnForStringSetsIsbn()
    {
        $this->subject->setIsbn('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'isbn',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getTitleReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getTitle()
        );
    }

    /**
     * @test
     */
    public function setTitleForStringSetsTitle()
    {
        $this->subject->setTitle('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'title',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getBlurbReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getBlurb()
        );
    }

    /**
     * @test
     */
    public function setBlurbForStringSetsBlurb()
    {
        $this->subject->setBlurb('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'blurb',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getDescriptionReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getDescription()
        );
    }

    /**
     * @test
     */
    public function setDescriptionForStringSetsDescription()
    {
        $this->subject->setDescription('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'description',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getPriceReturnsInitialValueForFloat()
    {
        self::assertSame(
            0.0,
            $this->subject->getPrice()
        );
    }

    /**
     * @test
     */
    public function setPriceForFloatSetsPrice()
    {
        $this->subject->setPrice(3.14159265);

        self::assertAttributeEquals(
            3.14159265,
            'price',
            $this->subject,
            '',
            0.000000001
        );
    }

    /**
     * @test
     */
    public function getPagesReturnsInitialValueForInt()
    {
        self::assertSame(
            0,
            $this->subject->getPages()
        );
    }

    /**
     * @test
     */
    public function setPagesForIntSetsPages()
    {
        $this->subject->setPages(12);

        self::assertAttributeEquals(
            12,
            'pages',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getImagesReturnsInitialValueForFileReference()
    {
        $newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        self::assertEquals(
            $newObjectStorage,
            $this->subject->getImages()
        );
    }

    /**
     * @test
     */
    public function setImagesForFileReferenceSetsImages()
    {
        $image = new \TYPO3\CMS\Extbase\Domain\Model\FileReference();
        $objectStorageHoldingExactlyOneImages = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOneImages->attach($image);
        $this->subject->setImages($objectStorageHoldingExactlyOneImages);

        self::assertAttributeEquals(
            $objectStorageHoldingExactlyOneImages,
            'images',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function addImageToObjectStorageHoldingImages()
    {
        $image = new \TYPO3\CMS\Extbase\Domain\Model\FileReference();
        $imagesObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['attach'])
            ->disableOriginalConstructor()
            ->getMock();

        $imagesObjectStorageMock->expects(self::once())->method('attach')->with(self::equalTo($image));
        $this->inject($this->subject, 'images', $imagesObjectStorageMock);

        $this->subject->addImage($image);
    }

    /**
     * @test
     */
    public function removeImageFromObjectStorageHoldingImages()
    {
        $image = new \TYPO3\CMS\Extbase\Domain\Model\FileReference();
        $imagesObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['detach'])
            ->disableOriginalConstructor()
            ->getMock();

        $imagesObjectStorageMock->expects(self::once())->method('detach')->with(self::equalTo($image));
        $this->inject($this->subject, 'images', $imagesObjectStorageMock);

        $this->subject->removeImage($image);
    }

    /**
     * @test
     */
    public function getTopicsReturnsInitialValueForTopic()
    {
        $newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        self::assertEquals(
            $newObjectStorage,
            $this->subject->getTopics()
        );
    }

    /**
     * @test
     */
    public function setTopicsForObjectStorageContainingTopicSetsTopics()
    {
        $topic = new \OliverHader\BookStoreApp\Domain\Model\Topic();
        $objectStorageHoldingExactlyOneTopics = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOneTopics->attach($topic);
        $this->subject->setTopics($objectStorageHoldingExactlyOneTopics);

        self::assertAttributeEquals(
            $objectStorageHoldingExactlyOneTopics,
            'topics',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function addTopicToObjectStorageHoldingTopics()
    {
        $topic = new \OliverHader\BookStoreApp\Domain\Model\Topic();
        $topicsObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['attach'])
            ->disableOriginalConstructor()
            ->getMock();

        $topicsObjectStorageMock->expects(self::once())->method('attach')->with(self::equalTo($topic));
        $this->inject($this->subject, 'topics', $topicsObjectStorageMock);

        $this->subject->addTopic($topic);
    }

    /**
     * @test
     */
    public function removeTopicFromObjectStorageHoldingTopics()
    {
        $topic = new \OliverHader\BookStoreApp\Domain\Model\Topic();
        $topicsObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['detach'])
            ->disableOriginalConstructor()
            ->getMock();

        $topicsObjectStorageMock->expects(self::once())->method('detach')->with(self::equalTo($topic));
        $this->inject($this->subject, 'topics', $topicsObjectStorageMock);

        $this->subject->removeTopic($topic);
    }

    /**
     * @test
     */
    public function getAuthorsReturnsInitialValueForAuthor()
    {
        $newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        self::assertEquals(
            $newObjectStorage,
            $this->subject->getAuthors()
        );
    }

    /**
     * @test
     */
    public function setAuthorsForObjectStorageContainingAuthorSetsAuthors()
    {
        $author = new \OliverHader\BookStoreApp\Domain\Model\Author();
        $objectStorageHoldingExactlyOneAuthors = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOneAuthors->attach($author);
        $this->subject->setAuthors($objectStorageHoldingExactlyOneAuthors);

        self::assertAttributeEquals(
            $objectStorageHoldingExactlyOneAuthors,
            'authors',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function addAuthorToObjectStorageHoldingAuthors()
    {
        $author = new \OliverHader\BookStoreApp\Domain\Model\Author();
        $authorsObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['attach'])
            ->disableOriginalConstructor()
            ->getMock();

        $authorsObjectStorageMock->expects(self::once())->method('attach')->with(self::equalTo($author));
        $this->inject($this->subject, 'authors', $authorsObjectStorageMock);

        $this->subject->addAuthor($author);
    }

    /**
     * @test
     */
    public function removeAuthorFromObjectStorageHoldingAuthors()
    {
        $author = new \OliverHader\BookStoreApp\Domain\Model\Author();
        $authorsObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['detach'])
            ->disableOriginalConstructor()
            ->getMock();

        $authorsObjectStorageMock->expects(self::once())->method('detach')->with(self::equalTo($author));
        $this->inject($this->subject, 'authors', $authorsObjectStorageMock);

        $this->subject->removeAuthor($author);
    }

    /**
     * @test
     */
    public function getPublisherReturnsInitialValueForPublisher()
    {
        self::assertEquals(
            null,
            $this->subject->getPublisher()
        );
    }

    /**
     * @test
     */
    public function setPublisherForPublisherSetsPublisher()
    {
        $publisherFixture = new \OliverHader\BookStoreApp\Domain\Model\Publisher();
        $this->subject->setPublisher($publisherFixture);

        self::assertAttributeEquals(
            $publisherFixture,
            'publisher',
            $this->subject
        );
    }
}
