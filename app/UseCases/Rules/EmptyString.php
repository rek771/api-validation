<?php
namespace Coolcigarets\ApiValidation\UseCases\Rules;

use Coolcigarets\ApiValidation\Entities\Exceptions\ValidateException;
use Coolcigarets\ApiValidation\Entities\Rules\AbstractRule;

/**
 * Validation of non-empty strings
 */
class EmptyString extends AbstractRule
{
    /**
     * @inheritdoc
     */
    function validate(): bool
    {
        if ($this->txt === '') {
            throw new ValidateException('String is empty');
        }

        return true;
    }
}