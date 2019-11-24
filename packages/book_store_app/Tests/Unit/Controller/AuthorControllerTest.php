<?php
namespace OliverHader\BookStoreApp\Tests\Unit\Controller;

/**
 * Test case.
 *
 * @author Oliver Hader <oliver.hader.2@hof-university.de>
 */
class AuthorControllerTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \OliverHader\BookStoreApp\Controller\AuthorController
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder(\OliverHader\BookStoreApp\Controller\AuthorController::class)
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
    public function listActionFetchesAllAuthorsFromRepositoryAndAssignsThemToView()
    {

        $allAuthors = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $authorRepository = $this->getMockBuilder(\OliverHader\BookStoreApp\Domain\Repository\AuthorRepository::class)
            ->setMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $authorRepository->expects(self::once())->method('findAll')->will(self::returnValue($allAuthors));
        $this->inject($this->subject, 'authorRepository', $authorRepository);

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('authors', $allAuthors);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenAuthorToView()
    {
        $author = new \OliverHader\BookStoreApp\Domain\Model\Author();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('author', $author);

        $this->subject->showAction($author);
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenAuthorToAuthorRepository()
    {
        $author = new \OliverHader\BookStoreApp\Domain\Model\Author();

        $authorRepository = $this->getMockBuilder(\OliverHader\BookStoreApp\Domain\Repository\AuthorRepository::class)
            ->setMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $authorRepository->expects(self::once())->method('add')->with($author);
        $this->inject($this->subject, 'authorRepository', $authorRepository);

        $this->subject->createAction($author);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenAuthorToView()
    {
        $author = new \OliverHader\BookStoreApp\Domain\Model\Author();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('author', $author);

        $this->subject->editAction($author);
    }

    /**
     * @test
     */
    public function updateActionUpdatesTheGivenAuthorInAuthorRepository()
    {
        $author = new \OliverHader\BookStoreApp\Domain\Model\Author();

        $authorRepository = $this->getMockBuilder(\OliverHader\BookStoreApp\Domain\Repository\AuthorRepository::class)
            ->setMethods(['update'])
            ->disableOriginalConstructor()
            ->getMock();

        $authorRepository->expects(self::once())->method('update')->with($author);
        $this->inject($this->subject, 'authorRepository', $authorRepository);

        $this->subject->updateAction($author);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenAuthorFromAuthorRepository()
    {
        $author = new \OliverHader\BookStoreApp\Domain\Model\Author();

        $authorRepository = $this->getMockBuilder(\OliverHader\BookStoreApp\Domain\Repository\AuthorRepository::class)
            ->setMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $authorRepository->expects(self::once())->method('remove')->with($author);
        $this->inject($this->subject, 'authorRepository', $authorRepository);

        $this->subject->deleteAction($author);
    }
}
