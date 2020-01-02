<?php
namespace OliverHader\BookStoreApp\Tests\Functional\Validator;

use OliverHader\BookStoreApp\Domain\Model\BankAccount;
use OliverHader\BookStoreApp\Validator\BankAccountValidator;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Error\Result;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Extbase\Reflection\ObjectAccess;
use TYPO3\CMS\Extbase\Validation\Exception;
use TYPO3\CMS\Extbase\Validation\Exception\InvalidValidationOptionsException;
use TYPO3\TestingFramework\Core\Functional\FunctionalTestCase;

class BankAccountValidatorTest extends FunctionalTestCase
{
    /**
     * TYPO3 core extension to activate in function test.
     * At least `extbase` is required to have classes/annotations available
     *
     * @var array
     */
    protected $coreExtensionsToLoad = [
        'extbase',
    ];

    /**
     * @var ObjectManager
     */
    protected $objectManager;

    protected function setUp()
    {
        parent::setUp();
        $this->objectManager = GeneralUtility::makeInstance(ObjectManager::class);
    }

    protected function tearDown()
    {
        parent::tearDown();
        unset($this->objectManager);
    }

    /**
     * @test
     */
    public function instantiationFailsWhenInvokedWithoutPrefix()
    {
        $this->expectException(InvalidValidationOptionsException::class);
        $this->expectExceptionCode(1379981891);

        $this->objectManager->get(BankAccountValidator::class);
    }

    /**
     * @test
     */
    public function instantiationFailsWhenInvokedWithInvalidOption()
    {
        $this->expectException(InvalidValidationOptionsException::class);
        $this->expectExceptionCode(1379981890);

        $this->objectManager->get(
            BankAccountValidator::class,
            ['invalid' => 'nonsense']
        );
    }

    public function validateFailsOnInvalidPrefixDataProvider(): array
    {
        return [
            'null' => [null],
            'true' => [true],
            'empty' => [''],
            'value' => ['XX'],
        ];
    }

    /**
     * @param mixed $value
     *
     * @test
     * @dataProvider validateFailsOnInvalidPrefixDataProvider
     */
    public function validateFailsOnInvalidPrefix($value)
    {
        $this->expectException(Exception::class);
        $this->expectExceptionCode(1576622920);

        $validator = $this->objectManager->get(
            BankAccountValidator::class,
            ['prefix' => 'XX']
        );
        $validator->validate($value);
    }

    public function validateGeneratedErrorMessagesDataProvider(): array
    {
        return [
            'null' => [
                null,
                ['[1576622921] Expected type BankAccount'],
            ],
            'true' => [
                true,
                ['[1576622921] Expected type BankAccount'],
            ],
            'empty' => [
                '',
                ['[1576622921] Expected type BankAccount'],
            ],
            'value' => [
                'XX',
                ['[1576622921] Expected type BankAccount'],
            ],
            'invalid IBAN' => [
                self::createBankAccount(['iban' => 'DE00000000000000000000']),
                ['[1576622922] IBAN could not be verified'],
            ],
            'valid IBAN #1' => [
                self::createBankAccount(['iban' => 'DE18684522900077015428']),
                [],
            ],
            'valid IBAN #2' => [
                // @todo even this works, the IBAN is obviously wrong
                self::createBankAccount(['iban' => 'DE36000000000000000000']),
                [],
            ],
        ];
    }

    /**
     * @param $value
     * @param array $expectations
     *
     * @test
     * @dataProvider validateGeneratedErrorMessagesDataProvider
     */
    public function validateGeneratedErrorMessages($value, array $expectations)
    {
        $validator = $this->objectManager->get(
            BankAccountValidator::class,
            ['prefix' => 'DE']
        );
        $result = $validator->validate($value);

        sort($expectations);
        self::assertSame($expectations, $this->flattenErrors(($result)));
    }

    /**
     * @param Result $result
     * @return string[]
     */
    private function flattenErrors(Result $result): array
    {
        $errors = array_map(
            function (\TYPO3\CMS\Extbase\Error\Error $error) {
                return sprintf(
                    '[%s] %s',
                    $error->getCode(),
                    $error->getMessage()
                );
            },
            $result->getErrors()
        );
        sort($errors);
        return $errors;
    }

    private static function createBankAccount(array $properties = []): BankAccount
    {
        $bankAccount = new BankAccount();
        foreach ($properties as $name => $value) {
            ObjectAccess::setProperty($bankAccount, $name, $value);
        }
        return $bankAccount;
    }
}