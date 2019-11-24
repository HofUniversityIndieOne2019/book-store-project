<?php
namespace OliverHader\BookStoreApp\Controller;


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
 * AuthorController
 */
class AuthorController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * authorRepository
     * 
     * @var \OliverHader\BookStoreApp\Domain\Repository\AuthorRepository
     */
    protected $authorRepository = null;

    /**
     * @param \OliverHader\BookStoreApp\Domain\Repository\AuthorRepository $authorRepository
     */
    public function injectAuthorRepository(\OliverHader\BookStoreApp\Domain\Repository\AuthorRepository $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }

    /**
     * action list
     * 
     * @return void
     */
    public function listAction()
    {
        $authors = $this->authorRepository->findAll();
        $this->view->assign('authors', $authors);
    }

    /**
     * action show
     * 
     * @param \OliverHader\BookStoreApp\Domain\Model\Author $author
     * @return void
     */
    public function showAction(\OliverHader\BookStoreApp\Domain\Model\Author $author)
    {
        $this->view->assign('author', $author);
    }

    /**
     * action new
     * 
     * @return void
     */
    public function newAction()
    {
    }

    /**
     * action create
     * 
     * @param \OliverHader\BookStoreApp\Domain\Model\Author $newAuthor
     * @return void
     */
    public function createAction(\OliverHader\BookStoreApp\Domain\Model\Author $newAuthor)
    {
        $this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->authorRepository->add($newAuthor);
        $this->redirect('list');
    }

    /**
     * action edit
     * 
     * @param \OliverHader\BookStoreApp\Domain\Model\Author $author
     * @ignorevalidation $author
     * @return void
     */
    public function editAction(\OliverHader\BookStoreApp\Domain\Model\Author $author)
    {
        $this->view->assign('author', $author);
    }

    /**
     * action update
     * 
     * @param \OliverHader\BookStoreApp\Domain\Model\Author $author
     * @return void
     */
    public function updateAction(\OliverHader\BookStoreApp\Domain\Model\Author $author)
    {
        $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->authorRepository->update($author);
        $this->redirect('list');
    }

    /**
     * action delete
     * 
     * @param \OliverHader\BookStoreApp\Domain\Model\Author $author
     * @return void
     */
    public function deleteAction(\OliverHader\BookStoreApp\Domain\Model\Author $author)
    {
        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->authorRepository->remove($author);
        $this->redirect('list');
    }
}
