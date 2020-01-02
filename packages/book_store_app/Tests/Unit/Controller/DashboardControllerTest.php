<?php
namespace OliverHader\BookStoreApp\Tests\Unit\Controller;

use OliverHader\BookStoreApp\Controller\DashboardController;
use OliverHader\BookStoreApp\Domain\Dto\AuthorPublication;
use OliverHader\BookStoreApp\Domain\Repository\BookRepository;
use OliverHader\BookStoreApp\Domain\Repository\TopicRepository;
use PHPUnit\Framework\MockObject\MockObject;
use TYPO3\CMS\Extbase\Mvc\View\ViewInterface;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

/**
 * Test case.
 *
 * @author Oliver Hader <oliver.hader.2@hof-university.de>
 */
class DashboardControllerTest extends UnitTestCase
{
    /**
     * @var DashboardController|MockObject
     */
    protected $subject;

    /**
     * @var ViewInterface|MockObject
     */
    protected $view;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder(DashboardController::class)
            ->setMethods(['redirect', 'forward', 'addFlashMessage', 'findRecentAuthorPublications'])
            ->disableOriginalConstructor()
            ->getMock();
        $this->view = $this->getMockBuilder(ViewInterface::class)
            ->getMock();
        $this->inject($this->subject, 'view', $this->view);
    }

    protected function tearDown()
    {
        parent::tearDown();
        unset($this->subject, $this->view);
    }

    /**
     * @test
     */
    public function overviewActionAssignsEntitiesToView()
    {
        $testItems = [sha1(uniqid())];

        $bookRepository = $this->getMockBuilder(BookRepository::class)
            ->setMethods(['findRecent'])
            ->disableOriginalConstructor()
            ->getMock();
        $topicRepository = $this->getMockBuilder(TopicRepository::class)
            ->setMethods(['findSorted'])
            ->disableOriginalConstructor()
            ->getMock();

        $bookRepository->expects(self::once())
            ->method('findRecent')->with(self::greaterThan(0))
            ->will(self::returnValue($testItems));
        $topicRepository->expects(self::once())
            ->method('findSorted')->with(self::greaterThan(0))
            ->will(self::returnValue($testItems));

        $this->inject($this->subject, 'bookRepository', $bookRepository);
        $this->inject($this->subject, 'topicRepository', $topicRepository);

        $this->subject->expects(self::once())
            ->method('findRecentAuthorPublications')->with(self::greaterThan(0))
            ->will(self::returnValue($testItems));

        $this->view->expects(self::at(0))
            ->method('assign')->with('books', $testItems);
        $this->view->expects(self::at(1))
            ->method('assign')->with('topics', $testItems);
        $this->view->expects(self::at(2))
            ->method('assign')->with('authorPublications', $testItems);

        $this->subject->overviewAction();
    }

    /**
     * @test
     */
    public function findRecentAuthorPublicationsResolvedUniqueAuthors()
    {
        $subject = $this->getAccessibleMock(
            DashboardController::class, // class name to be mocked
            ['dummy'], // methods to be mocked (cannot be empty, thus we use `dummy` method)
            [], // arguments to be used for calling constructor of class (none here)
            '', // alternative class name for this mock
            false // avoid calling constructor
        );

        $firstAuthor = new \OliverHader\BookStoreApp\Domain\Model\Author();
            $firstAuthor->setName('Author 1');
        $secondAuthor = new \OliverHader\BookStoreApp\Domain\Model\Author();
            $secondAuthor->setName('Author 2');
        $thirdAuthor = new \OliverHader\BookStoreApp\Domain\Model\Author();
            $thirdAuthor->setName('Author 3');

        $firstBook = new \OliverHader\BookStoreApp\Domain\Model\Book();
            $firstBook->setTitle('Book 1');
            $firstBook->addAuthor($firstAuthor);
            $firstBook->addAuthor($secondAuthor);
        $secondBook = new \OliverHader\BookStoreApp\Domain\Model\Book();
            $secondBook->setTitle('Book 2');
            $secondBook->addAuthor($secondAuthor);
            $secondBook->addAuthor($thirdAuthor);

        $books = [$firstBook, $secondBook];

        $bookRepository = $this->getMockBuilder(BookRepository::class)
            ->setMethods(['findRecent'])
            ->disableOriginalConstructor()
            ->getMock();
        $bookRepository->expects(self::once())
            ->method('findRecent')->with(null)
            ->will(self::returnValue($books));
        $this->inject($subject, 'bookRepository', $bookRepository);

        // calling protected method `findRecentAuthorPublications` using `_call` helper method
        /** @var AuthorPublication[] $result */
        $result = $subject->_call('findRecentAuthorPublications');

        // extracting authors from `AuthorPublication` objects
        // (this reveals bad design, since it contains superfluous information)
        $actualAuthors = [];
        foreach ($result as $item) {
            $actualAuthors[] = $item->getAuthor();
        }

        self::assertCount(3, $result);
        self::assertSame([$firstAuthor, $secondAuthor, $thirdAuthor], $actualAuthors);
    }
}
