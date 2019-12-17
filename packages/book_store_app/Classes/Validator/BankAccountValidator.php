<?php
namespace OliverHader\BookStoreApp\Validator;

use OliverHader\BookStoreApp\Domain\Model\BankAccount;
use TYPO3\CMS\Extbase\Validation\Exception;
use TYPO3\CMS\Extbase\Validation\Validator\AbstractValidator;

/**
 * Usage example for controller action:
 * ```
 * @Validate("OliverHader\BookStoreApp\Validator\BankAccountValidator", param="bankAccount", options="{"prefix":"DE"}")
 * ```
 * Test IBAN: DE18684522900077015428
 */
class BankAccountValidator extends AbstractValidator
{
    private const DEFINITIONS = [
        'DE' => [
            'NATIONAL_CODE' => 'DE',
            'LENGTH' => 22,
            'LENGTH_SUBSIDIARY' => 0,
            'LENGTH_BRANCH' => 8,
            'LENGTH_ACCOUNT' => 10,
        ],
    ];

    /**
     * @var array
     */
    protected $supportedOptions = [
        'prefix' => null,
    ];

    /**
     * @param mixed $value
     * @throws Exception
     */
    protected function isValid($value)
    {
        $prefix = $this->options['prefix'] ?? null;
        if (empty($prefix) || empty(self::DEFINITIONS[$prefix])) {
            throw new Exception(
                sprintf('Undefined or empty IBAN prefix "%s"', $prefix),
                1576622920
            );
        }

        if (!$value instanceof BankAccount) {
            return $this->addError('Expected type BankAccount', 1576622921);
        }
        if (!$this->isValidIban($prefix, $value->getIban())) {
            return $this->addError('IBAN could not be verified', 1576622922);
        }
    }

    /**
     * @param string $prefix
     * @param string $iban
     * @return bool
     *
     * @todo Could have been done using value objects and a bank data service, like
     * + https://github.com/TYPO3incubator/bank_account_example/blob/master/Classes/Domain/Model/Iban/Iban.php
     * + https://github.com/TYPO3incubator/bank_account_example/blob/master/Classes/Infrastructure/Service/NationalBank/GermanCoreData.php
     */
    private function isValidIban(string $prefix, string $iban): bool
    {
        if (substr($iban, 0, 2) !== $prefix) {
            return false;
        }
        $definitions = self::DEFINITIONS[$prefix];
        $branch = substr($iban, 4, $definitions['LENGTH_BRANCH']);
        $subsidiary = substr($iban, 4 + $definitions['LENGTH_BRANCH'], $definitions['LENGTH_SUBSIDIARY']);
        $account = substr($iban, 4 + $definitions['LENGTH_BRANCH'] + $definitions['LENGTH_SUBSIDIARY'], $definitions['LENGTH_ACCOUNT']);
        $check = substr($iban, 2, 2);

        return $check === $this->calculateIbanCheckSum($branch . $subsidiary . $account . $prefix . '00');
    }

    private function calculateIbanCheckSum($value): string
    {
        $value = $this->substituteIbanCharacters($value);
        $checkValue = 98 - bcmod($value, 97);
        return str_pad($checkValue, 2, '0', STR_PAD_LEFT);
    }

    /**
     * @param string $value
     * @return string
     */
    private function substituteIbanCharacters(string $value): string
    {
        $substitutions = [];
        foreach (range('A', 'Z') as $character) {
            // character 'A' => 10, 'B' => 11, ...
            $substitutions[$character] = ord($character) - 55;
        }
        return str_replace(
            array_keys($substitutions),
            array_values($substitutions),
            $value
        );
    }
}