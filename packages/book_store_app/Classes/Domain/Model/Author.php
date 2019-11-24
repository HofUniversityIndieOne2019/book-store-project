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
 * Author
 */
class Author extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * name
     * 
     * @var string
     * @TYPO3\CMS\Extbase\Annotation\Validate("NotEmpty")
     */
    protected $name = '';

    /**
     * dateOfBirth
     * 
     * @var \DateTime
     */
    protected $dateOfBirth = null;

    /**
     * biography
     * 
     * @var string
     */
    protected $biography = '';

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
     * Returns the dateOfBirth
     * 
     * @return \DateTime $dateOfBirth
     */
    public function getDateOfBirth()
    {
        return $this->dateOfBirth;
    }

    /**
     * Sets the dateOfBirth
     * 
     * @param \DateTime $dateOfBirth
     * @return void
     */
    public function setDateOfBirth(\DateTime $dateOfBirth)
    {
        $this->dateOfBirth = $dateOfBirth;
    }

    /**
     * Returns the biography
     * 
     * @return string $biography
     */
    public function getBiography()
    {
        return $this->biography;
    }

    /**
     * Sets the biography
     * 
     * @param string $biography
     * @return void
     */
    public function setBiography($biography)
    {
        $this->biography = $biography;
    }
}
