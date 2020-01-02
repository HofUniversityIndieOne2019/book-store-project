<?php
namespace OliverHader\BookStoreApp\Validator;

use OliverHader\BookStoreApp\Domain\Model\BankAccount;
use OliverHader\BookStoreApp\Domain\Service\IbanService;
use TYPO3\CMS\Extbase\Validation\Exception;
use TYPO3\CMS\Extbase\Validation\Validator\AbstractValidator;

/**
 * Usage example for controller action:
 * ```
 * @TYPO3\CMS\Extbase\Annotation\Validate("OliverHader\BookStoreApp\Validator\BankAccountValidator", param="bankAccount", options={"prefix":"DE"})
 * ```
 * Test IBAN: DE18684522900077015428
 */
class BankAccountValidator extends AbstractValidator
{
    /**
     * Must be disabled, otherwise `null` will not lead to validation errors.
     *
     * @var bool
     */
    protected $acceptsEmptyValues = false;

    /**
     * Options are defined when using `@Validate` annotation.
     *
     * @var array
     */
    protected $supportedOptions = [
        'prefix' => [
            null, // default value
            'IBAN prefix (e.g. DE)', // description
            'string', // value type
            true, // mandatory option
        ]
    ];

    /**
     * @var IbanService
     */
    protected $ibanService;

    /**
     * @param IbanService $ibanService
     */
    public function injectIbanService(IbanService $ibanService)
    {
        $this->ibanService = $ibanService;
    }

    /**
     * @param mixed $value
     * @throws Exception
     */
    protected function isValid($value)
    {
        $prefix = $this->options['prefix'] ?? null;
        if (empty($prefix) || !$this->ibanService->isPrefixDefined($prefix)) {
            throw new Exception(
                sprintf('Undefined or empty IBAN prefix "%s"', $prefix),
                1576622920
            );
        }

        if (!$value instanceof BankAccount) {
            return $this->addError('Expected type BankAccount', 1576622921);
        }
        if (!$this->ibanService->isValid($prefix, $value->getIban())) {
            return $this->addError('IBAN could not be verified', 1576622922);
        }
    }
}