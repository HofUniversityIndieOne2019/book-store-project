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
 * BankAccount
 */
class BankAccount extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * iban
     * 
     * @var string
     * @TYPO3\CMS\Extbase\Annotation\Validate("NotEmpty")
     */
    protected $iban = '';

    /**
     * bankName
     * 
     * @var string
     * @TYPO3\CMS\Extbase\Annotation\Validate("NotEmpty")
     */
    protected $bankName = '';

    /**
     * Returns the iban
     * 
     * @return string $iban
     */
    public function getIban()
    {
        return $this->iban;
    }

    /**
     * Sets the iban
     * 
     * @param string $iban
     * @return void
     */
    public function setIban($iban)
    {
        $this->iban = $iban;
    }

    /**
     * Returns the bankName
     * 
     * @return string $bankName
     */
    public function getBankName()
    {
        return $this->bankName;
    }

    /**
     * Sets the bankName
     * 
     * @param string $bankName
     * @return void
     */
    public function setBankName($bankName)
    {
        $this->bankName = $bankName;
    }
}
