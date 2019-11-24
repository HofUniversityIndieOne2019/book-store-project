<?php
namespace OliverHader\BookStoreApp\Tests\Unit\Controller;

/**
 * Test case.
 *
 * @author Oliver Hader <oliver.hader.2@hof-university.de>
 */
class TopicControllerTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \OliverHader\BookStoreApp\Controller\TopicController
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder(\OliverHader\BookStoreApp\Controller\TopicController::class)
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
    public function listActionFetchesAllTopicsFromRepositoryAndAssignsThemToView()
    {

        $allTopics = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $topicRepository = $this->getMockBuilder(\OliverHader\BookStoreApp\Domain\Repository\TopicRepository::class)
            ->setMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $topicRepository->expects(self::once())->method('findAll')->will(self::returnValue($allTopics));
        $this->inject($this->subject, 'topicRepository', $topicRepository);

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('topics', $allTopics);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenTopicToView()
    {
        $topic = new \OliverHader\BookStoreApp\Domain\Model\Topic();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('topic', $topic);

        $this->subject->showAction($topic);
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenTopicToTopicRepository()
    {
        $topic = new \OliverHader\BookStoreApp\Domain\Model\Topic();

        $topicRepository = $this->getMockBuilder(\OliverHader\BookStoreApp\Domain\Repository\TopicRepository::class)
            ->setMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $topicRepository->expects(self::once())->method('add')->with($topic);
        $this->inject($this->subject, 'topicRepository', $topicRepository);

        $this->subject->createAction($topic);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenTopicToView()
    {
        $topic = new \OliverHader\BookStoreApp\Domain\Model\Topic();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('topic', $topic);

        $this->subject->editAction($topic);
    }

    /**
     * @test
     */
    public function updateActionUpdatesTheGivenTopicInTopicRepository()
    {
        $topic = new \OliverHader\BookStoreApp\Domain\Model\Topic();

        $topicRepository = $this->getMockBuilder(\OliverHader\BookStoreApp\Domain\Repository\TopicRepository::class)
            ->setMethods(['update'])
            ->disableOriginalConstructor()
            ->getMock();

        $topicRepository->expects(self::once())->method('update')->with($topic);
        $this->inject($this->subject, 'topicRepository', $topicRepository);

        $this->subject->updateAction($topic);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenTopicFromTopicRepository()
    {
        $topic = new \OliverHader\BookStoreApp\Domain\Model\Topic();

        $topicRepository = $this->getMockBuilder(\OliverHader\BookStoreApp\Domain\Repository\TopicRepository::class)
            ->setMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $topicRepository->expects(self::once())->method('remove')->with($topic);
        $this->inject($this->subject, 'topicRepository', $topicRepository);

        $this->subject->deleteAction($topic);
    }
}
