<?php
namespace OliverHader\BookStoreApp\Domain\Model;


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
 * Customer
 */
class Customer extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * customerId
     * 
     * @var string
     */
    protected $customerId = '';

    /**
     * name
     * 
     * @var string
     */
    protected $name = '';

    /**
     * user
     * 
     * @var \TYPO3\CMS\Extbase\Domain\Model\FrontendUser
     */
    protected $user = null;

    /**
     * Returns the customerId
     * 
     * @return string $customerId
     */
    public function getCustomerId()
    {
        return $this->customerId;
    }

    /**
     * Sets the customerId
     * 
     * @param string $customerId
     * @return void
     */
    public function setCustomerId($customerId)
    {
        $this->customerId = $customerId;
    }

    /**
     * Returns the name
     * 
     * @return string $name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets the name
     * 
     * @param string $name
     * @return void
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Returns the user
     * 
     * @return \TYPO3\CMS\Extbase\Domain\Model\FrontendUser $user
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Sets the user
     * 
     * @param \TYPO3\CMS\Extbase\Domain\Model\FrontendUser $user
     * @return void
     */
    public function setUser(\TYPO3\CMS\Extbase\Domain\Model\FrontendUser $user)
    {
        $this->user = $user;
    }
}
