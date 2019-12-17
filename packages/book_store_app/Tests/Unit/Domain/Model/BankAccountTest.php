<?php
namespace OliverHader\BookStoreApp\Tests\Unit\Domain\Model;

/**
 * Test case.
 *
 * @author Oliver Hader <oliver.hader.2@hof-university.de>
 */
class BankAccountTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \OliverHader\BookStoreApp\Domain\Model\BankAccount
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \OliverHader\BookStoreApp\Domain\Model\BankAccount();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function getIbanReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getIban()
        );
    }

    /**
     * @test
     */
    public function setIbanForStringSetsIban()
    {
        $this->subject->setIban('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'iban',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getBankNameReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getBankName()
        );
    }

    /**
     * @test
     */
    public function setBankNameForStringSetsBankName()
    {
        $this->subject->setBankName('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'bankName',
            $this->subject
        );
    }
}
