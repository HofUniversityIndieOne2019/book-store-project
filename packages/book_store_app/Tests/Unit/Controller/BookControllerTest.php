<?php
namespace OliverHader\BookStoreApp\Tests\Unit\Controller;

/**
 * Test case.
 *
 * @author Oliver Hader <oliver.hader.2@hof-university.de>
 */
class BookControllerTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \OliverHader\BookStoreApp\Controller\BookController
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder(\OliverHader\BookStoreApp\Controller\BookController::class)
            ->setMethods(['redirect', 'forward', 'addFlashMessage'])
            ->disableOriginalConstructor()
            ->getMock();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function listActionFetchesAllBooksFromRepositoryAndAssignsThemToView()
    {

        $allBooks = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $bookRepository = $this->getMockBuilder(\OliverHader\BookStoreApp\Domain\Repository\BookRepository::class)
            ->setMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $bookRepository->expects(self::once())->method('findAll')->will(self::returnValue($allBooks));
        $this->inject($this->subject, 'bookRepository', $bookRepository);

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        // define sequences when `$view->assign` is called, starting at zero-index `0`
        $view->expects(self::at(0))->method('assign')->with('search', null);
        $view->expects(self::at(1))->method('assign')->with('books', $allBooks);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenBookToView()
    {
        $book = new \OliverHader\BookStoreApp\Domain\Model\Book();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        // define sequences when `$view->assign` is called, starting at zero-index `0`
        $view->expects(self::at(0))->method('assign')->with('book', $book);
        $view->expects(self::at(1))->method('assign')->with('back', null);

        $this->subject->showAction($book);
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenBookToBookRepository()
    {
        $book = new \OliverHader\BookStoreApp\Domain\Model\Book();

        $bookRepository = $this->getMockBuilder(\OliverHader\BookStoreApp\Domain\Repository\BookRepository::class)
            ->setMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $bookRepository->expects(self::once())->method('add')->with($book);
        $this->inject($this->subject, 'bookRepository', $bookRepository);

        $this->subject->createAction($book);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenBookToView()
    {
        $book = new \OliverHader\BookStoreApp\Domain\Model\Book();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('book', $book);

        $this->subject->editAction($book);
    }

    /**
     * @test
     */
    public function updateActionUpdatesTheGivenBookInBookRepository()
    {
        $book = new \OliverHader\BookStoreApp\Domain\Model\Book();

        $bookRepository = $this->getMockBuilder(\OliverHader\BookStoreApp\Domain\Repository\BookRepository::class)
            ->setMethods(['update'])
            ->disableOriginalConstructor()
            ->getMock();

        $bookRepository->expects(self::once())->method('update')->with($book);
        $this->inject($this->subject, 'bookRepository', $bookRepository);

        $this->subject->updateAction($book);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenBookFromBookRepository()
    {
        $book = new \OliverHader\BookStoreApp\Domain\Model\Book();

        $bookRepository = $this->getMockBuilder(\OliverHader\BookStoreApp\Domain\Repository\BookRepository::class)
            ->setMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $bookRepository->expects(self::once())->method('remove')->with($book);
        $this->inject($this->subject, 'bookRepository', $bookRepository);

        $this->subject->deleteAction($book);
    }
}
