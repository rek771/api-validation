<?php
namespace Coolcigarets\ApiValidation\UseCases\Rules;

use Coolcigarets\ApiValidation\Entities\Exceptions\ValidateException;
use Coolcigarets\ApiValidation\Entities\Rules\AbstractRule;

/**
 * Validation of non-empty strings
 */
class EmailTemplate extends AbstractRule
{
    /**
     * @inheritdoc
     */
    function validate(): bool
    {
        if (!filter_var($this->txt, FILTER_VALIDATE_EMAIL)) {
            throw new ValidateException("Invalid email format");
        }

        return true;
    }
}