<?php
namespace Coolcigarets\ApiValidation\Entities\Rules;

use Coolcigarets\ApiValidation\Entities\Exceptions\ValidateException;

interface Rule
{
    /**
     * Validate params in construct method and return bool or validation exception
     * @return bool
     * @throws ValidateException
     */
    function validate(): bool;
}