<?php
namespace OliverHader\BookStoreApp\Domain\Service;

class IbanService
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
     * @param string $prefix
     * @param string $iban
     * @return bool
     *
     * @todo Could have been done using value objects and a bank data service, like
     * + https://github.com/TYPO3incubator/bank_account_example/blob/master/Classes/Domain/Model/Iban/Iban.php
     * + https://github.com/TYPO3incubator/bank_account_example/blob/master/Classes/Infrastructure/Service/NationalBank/GermanCoreData.php
     */
    public function isValid(string $prefix, string $iban): bool
    {
        if (substr($iban, 0, 2) !== $prefix) {
            return false;
        }
        $definitions = self::DEFINITIONS[$prefix];
        $branch = substr($iban, 4, $definitions['LENGTH_BRANCH']);
        $subsidiary = substr($iban, 4 + $definitions['LENGTH_BRANCH'], $definitions['LENGTH_SUBSIDIARY']);
        $account = substr($iban, 4 + $definitions['LENGTH_BRANCH'] + $definitions['LENGTH_SUBSIDIARY'], $definitions['LENGTH_ACCOUNT']);
        $check = substr($iban, 2, 2);

        return $check === $this->calculateCheckSum($branch . $subsidiary . $account . $prefix . '00');
    }

    /**
     * @param string $prefix
     * @return bool
     */
    public function isPrefixDefined(string $prefix): bool
    {
        return !empty(self::DEFINITIONS[$prefix]);
    }

    /**
     * @param string $value
     * @return string
     */
    private function calculateCheckSum(string $value): string
    {
        $value = $this->substituteCharacters($value);
        $checkValue = 98 - bcmod($value, 97);
        return str_pad($checkValue, 2, '0', STR_PAD_LEFT);
    }

    /**
     * @param string $value
     * @return string
     */
    private function substituteCharacters(string $value): string
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