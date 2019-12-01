<?php
namespace OliverHader\BookStoreApp\Domain\Repository;


use TYPO3\CMS\Extbase\Persistence\QueryInterface;

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
 * The repository for Topics
 */
class TopicRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{

    /**
     * @var array
     */
    protected $defaultOrderings = ['sorting' => QueryInterface::ORDER_ASCENDING];

    public function findSorted(int $limit = 5)
    {
        $query = $this->createQuery();
        $query->setOrderings([
            'sorting' => QueryInterface::ORDER_ASCENDING
        ]);
        $query->setLimit($limit);

        return $query->execute();
    }
}
