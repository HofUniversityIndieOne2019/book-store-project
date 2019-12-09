<?php
namespace OliverHader\BookStoreApp\Tests\Unit\Domain\Model;

/**
 * Test case.
 *
 * @author Oliver Hader <oliver.hader.2@hof-university.de>
 */
class WishlistTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \OliverHader\BookStoreApp\Domain\Model\Wishlist
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \OliverHader\BookStoreApp\Domain\Model\Wishlist();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function getBooksReturnsInitialValueForBook()
    {
        $newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        self::assertEquals(
            $newObjectStorage,
            $this->subject->getBooks()
        );
    }

    /**
     * @test
     */
    public function setBooksForObjectStorageContainingBookSetsBooks()
    {
        $book = new \OliverHader\BookStoreApp\Domain\Model\Book();
        $objectStorageHoldingExactlyOneBooks = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOneBooks->attach($book);
        $this->subject->setBooks($objectStorageHoldingExactlyOneBooks);

        self::assertAttributeEquals(
            $objectStorageHoldingExactlyOneBooks,
            'books',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function addBookToObjectStorageHoldingBooks()
    {
        $book = new \OliverHader\BookStoreApp\Domain\Model\Book();
        $booksObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['attach'])
            ->disableOriginalConstructor()
            ->getMock();

        $booksObjectStorageMock->expects(self::once())->method('attach')->with(self::equalTo($book));
        $this->inject($this->subject, 'books', $booksObjectStorageMock);

        $this->subject->addBook($book);
    }

    /**
     * @test
     */
    public function removeBookFromObjectStorageHoldingBooks()
    {
        $book = new \OliverHader\BookStoreApp\Domain\Model\Book();
        $booksObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['detach'])
            ->disableOriginalConstructor()
            ->getMock();

        $booksObjectStorageMock->expects(self::once())->method('detach')->with(self::equalTo($book));
        $this->inject($this->subject, 'books', $booksObjectStorageMock);

        $this->subject->removeBook($book);
    }
}
