<?php
namespace OliverHader\BookStoreApp\Controller;

use OliverHader\BookStoreApp\Domain\Model\Book;
use OliverHader\BookStoreApp\Domain\Model\Customer;
use OliverHader\BookStoreApp\Domain\Model\Wishlist;
use OliverHader\BookStoreApp\Domain\Repository\WishlistRepository;
use OliverHader\SessionService\InvalidSessionException;
use OliverHader\SessionService\SubjectCollection;
use OliverHader\SessionService\SubjectResolver;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/***
 *
 * This file is part of the "Book Store App" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 ***/

/**
 * WishlistController
 */
class WishlistController extends ActionController
{
    /**
     * @var WishlistRepository
     */
    protected $wishlistRepository;

    /**
     * @param WishlistRepository $wishlistRepository
     */
    public function injectWishlistRepository(WishlistRepository $wishlistRepository)
    {
        $this->wishlistRepository = $wishlistRepository;
    }

    public function showAction()
    {
        try {
            $customer = SubjectResolver::get()
                ->forClassName(Customer::class)
                ->forPropertyName('user')
                ->resolve();
        } catch (InvalidSessionException $exception) {
            $customer = null;
        }

        $wishlist = $this->provideWishlist();

        $this->view->assign('customer', $customer);
        $this->view->assign('wishlist', $wishlist);
    }

    /**
     * @param Book $book
     */
    public function addAction(Book $book)
    {
        $wishlist = $this->provideWishlist();
        $wishlist->addBook($book);
        $this->wishlistRepository->update($wishlist);
        $this->redirect('show');
    }

    /**
     * @param Book $book
     */
    public function removeAction(Book $book)
    {
        $wishlist = $this->provideWishlist();
        $wishlist->removeBook($book);
        $this->wishlistRepository->update($wishlist);
        $this->redirect('show');
    }

    public function purgeAction()
    {
        $wishlist = $this->provideWishlist();
        $this->redirect('show');
    }

    private function provideWishlist(): Wishlist
    {
        $collection = SubjectCollection::get('book_store_app/wishlist');
        if (!isset($collection['wishlist'])) {
            $collection['wishlist'] = $this->objectManager->get(Wishlist::class);
            $collection->persist();
        }
        return $collection['wishlist'];
    }
}