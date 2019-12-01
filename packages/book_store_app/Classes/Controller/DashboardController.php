<?php
namespace OliverHader\BookStoreApp\Controller;

use OliverHader\BookStoreApp\Domain\Dto\AuthorPublication;
use OliverHader\BookStoreApp\Domain\Repository\AuthorRepository;
use OliverHader\BookStoreApp\Domain\Repository\BookRepository;
use OliverHader\BookStoreApp\Domain\Repository\TopicRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/***
 *
 * This file is part of the "Book Store App" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 ***/

/**
 * DashboardController
 */
class DashboardController extends ActionController
{
    /**
     * @var BookRepository
     */
    protected $bookRepository;

    /**
     * @var AuthorRepository
     */
    protected $authorRepository;

    /**
     * @var TopicRepository
     */
    protected $topicRepository;

    /**
     * @param BookRepository $bookRepository
     */
    public function injectBookRepository(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    /**
     * @param AuthorRepository $authorRepository
     */
    public function injectAuthorRepository(AuthorRepository $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }

    /**
     * @param TopicRepository $topicRepository
     */
    public function injectTopicRepository(TopicRepository $topicRepository)
    {
        $this->topicRepository = $topicRepository;
    }

    public function overviewAction()
    {
        $books = $this->bookRepository->findRecent(3);
        $authors = $this->findRecentAuthorPublications(3);
        $topics = $this->topicRepository->findSorted(3);

        $this->view->assign('books', $books);
        $this->view->assign('authors', $authors);
        $this->view->assign('topics', $topics);
    }

    /**
     * @param int $limit
     * @return AuthorPublication[]
     */
    protected function findRecentAuthorPublications(int $limit = 5): array
    {
        $processedAuthors = [];
        $authorPublications = [];
        $books = $this->bookRepository->findRecent(null);

        foreach ($books as $book) {
            foreach ($book->getAuthors() as $author) {
                if (in_array($author, $processedAuthors, true)) {
                    continue;
                }
                $processedAuthors[] = $author;
                $authorPublications[] = new AuthorPublication(
                    $author,
                    $book
                );
                if (count($authorPublications) === $limit) {
                    break 2;
                }
            }
        }

        return $authorPublications;
    }
}