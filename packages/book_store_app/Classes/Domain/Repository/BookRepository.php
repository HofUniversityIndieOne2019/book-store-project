<?php
namespace OliverHader\BookStoreApp\Domain\Repository;


use OliverHader\BookStoreApp\Domain\Model\Book;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;

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
 * The repository for Books
 */
class BookRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{
    /**
     * @param string $search
     * @return array|QueryResultInterface|Book[]
     */
    public function findBySearch(string $search)
    {
        $query = $this->createQuery();

        $constraints = [];
        $constraints[] = $query->like('title', '%' . $search . '%');
        $constraints[] = $query->like('blurb', '%' . $search . '%');
        $constraints[] = $query->like('authors.name', '%' . $search . '%');
        $constraints[] = $query->like('topics.name', '%' . $search . '%');
        $constraints[] = $query->like('publisher.country.name', '%' . $search . '%');

        $query->matching(
            $query->logicalOr(
                $constraints
            )
        );

        return $query->execute();
    }
}
