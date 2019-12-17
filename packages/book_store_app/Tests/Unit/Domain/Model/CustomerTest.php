<?php
namespace OliverHader\BookStoreApp\Tests\Unit\Domain\Model;

/**
 * Test case.
 *
 * @author Oliver Hader <oliver.hader.2@hof-university.de>
 */
class CustomerTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \OliverHader\BookStoreApp\Domain\Model\Customer
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \OliverHader\BookStoreApp\Domain\Model\Customer();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function getCustomerIdReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getCustomerId()
        );
    }

    /**
     * @test
     */
    public function setCustomerIdForStringSetsCustomerId()
    {
        $this->subject->setCustomerId('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'customerId',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getNameReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getName()
        );
    }

    /**
     * @test
     */
    public function setNameForStringSetsName()
    {
        $this->subject->setName('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'name',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getUserReturnsInitialValueForFrontendUser()
    {
    }

    /**
     * @test
     */
    public function setUserForFrontendUserSetsUser()
    {
    }

    /**
     * @test
     */
    public function getAddressesReturnsInitialValueForAddress()
    {
        $newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        self::assertEquals(
            $newObjectStorage,
            $this->subject->getAddresses()
        );
    }

    /**
     * @test
     */
    public function setAddressesForObjectStorageContainingAddressSetsAddresses()
    {
        $address = new \OliverHader\BookStoreApp\Domain\Model\Address();
        $objectStorageHoldingExactlyOneAddresses = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOneAddresses->attach($address);
        $this->subject->setAddresses($objectStorageHoldingExactlyOneAddresses);

        self::assertAttributeEquals(
            $objectStorageHoldingExactlyOneAddresses,
            'addresses',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function addAddressToObjectStorageHoldingAddresses()
    {
        $address = new \OliverHader\BookStoreApp\Domain\Model\Address();
        $addressesObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['attach'])
            ->disableOriginalConstructor()
            ->getMock();

        $addressesObjectStorageMock->expects(self::once())->method('attach')->with(self::equalTo($address));
        $this->inject($this->subject, 'addresses', $addressesObjectStorageMock);

        $this->subject->addAddress($address);
    }

    /**
     * @test
     */
    public function removeAddressFromObjectStorageHoldingAddresses()
    {
        $address = new \OliverHader\BookStoreApp\Domain\Model\Address();
        $addressesObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['detach'])
            ->disableOriginalConstructor()
            ->getMock();

        $addressesObjectStorageMock->expects(self::once())->method('detach')->with(self::equalTo($address));
        $this->inject($this->subject, 'addresses', $addressesObjectStorageMock);

        $this->subject->removeAddress($address);
    }

    /**
     * @test
     */
    public function getBankAccountsReturnsInitialValueForBankAccount()
    {
        $newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        self::assertEquals(
            $newObjectStorage,
            $this->subject->getBankAccounts()
        );
    }

    /**
     * @test
     */
    public function setBankAccountsForObjectStorageContainingBankAccountSetsBankAccounts()
    {
        $bankAccount = new \OliverHader\BookStoreApp\Domain\Model\BankAccount();
        $objectStorageHoldingExactlyOneBankAccounts = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOneBankAccounts->attach($bankAccount);
        $this->subject->setBankAccounts($objectStorageHoldingExactlyOneBankAccounts);

        self::assertAttributeEquals(
            $objectStorageHoldingExactlyOneBankAccounts,
            'bankAccounts',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function addBankAccountToObjectStorageHoldingBankAccounts()
    {
        $bankAccount = new \OliverHader\BookStoreApp\Domain\Model\BankAccount();
        $bankAccountsObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['attach'])
            ->disableOriginalConstructor()
            ->getMock();

        $bankAccountsObjectStorageMock->expects(self::once())->method('attach')->with(self::equalTo($bankAccount));
        $this->inject($this->subject, 'bankAccounts', $bankAccountsObjectStorageMock);

        $this->subject->addBankAccount($bankAccount);
    }

    /**
     * @test
     */
    public function removeBankAccountFromObjectStorageHoldingBankAccounts()
    {
        $bankAccount = new \OliverHader\BookStoreApp\Domain\Model\BankAccount();
        $bankAccountsObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['detach'])
            ->disableOriginalConstructor()
            ->getMock();

        $bankAccountsObjectStorageMock->expects(self::once())->method('detach')->with(self::equalTo($bankAccount));
        $this->inject($this->subject, 'bankAccounts', $bankAccountsObjectStorageMock);

        $this->subject->removeBankAccount($bankAccount);
    }
}
