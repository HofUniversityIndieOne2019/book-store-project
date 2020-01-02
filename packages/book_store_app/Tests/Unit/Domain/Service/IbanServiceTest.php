<?php
namespace OliverHader\BookStoreApp\Tests\Unit\Domain\Service;

use OliverHader\BookStoreApp\Domain\Service\IbanService;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

/**
 * Test case.
 *
 * @author Oliver Hader <oliver.hader.2@hof-university.de>
 */
class IbanServiceTest extends UnitTestCase
{
    /**
     * @var IbanService
     */
    protected $subject;

    public function setUp()
    {
        parent::setUp();
        $this->subject = new IbanService();
    }

    public function tearDown()
    {
        parent::tearDown();
        unset($this->subject);
    }

    public function isPrefixDefinedIsTrueDataProvider(): array
    {
        foreach (range('AA', 'ZZ') as $prefix) {
            $dataSets[$prefix] = [
                $prefix, // 1st argument for isPrefixDefinedIsTrue()
                $prefix === 'DE', // 2nd argument for isPrefixDefinedIsTrue()
            ];
        }
        return $dataSets;
    }

    /**
     * @param string $prefix
     * @param bool $expectation
     *
     * @test
     * @dataProvider isPrefixDefinedIsTrueDataProvider
     */
    public function isPrefixDefinedIsTrue(string $prefix, bool $expectation)
    {
        self::assertSame($expectation, $this->subject->isPrefixDefined($prefix));
    }

    public function isValidDeterminesCorrectItemsDataProvider(): array
    {
        return [
            'prefix mismatch' => [
                'NL00000000000000000000',
                false,
            ],
            'invalid IBAN' => [
                'DE00000000000000000000',
                false
            ],
            'valid IBAN #1' => [
                'DE18684522900077015428',
                true
            ],
            'valid IBAN #2' => [
                // @todo even this works, the IBAN is obviously wrong
                'DE36000000000000000000',
                true
            ],
        ];
    }

    /**
     * @param string $iban
     * @param bool $expectation
     *
     * @test
     * @dataProvider isValidDeterminesCorrectItemsDataProvider
     */
    public function isValidDeterminesCorrectGermanIban(string $iban, bool $expectation)
    {
        self::assertSame($expectation, $this->subject->isValid('DE', $iban));
    }
}
