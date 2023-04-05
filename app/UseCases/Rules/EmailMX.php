<?php

namespace Coolcigarets\ApiValidation\UseCases\Rules;

use Coolcigarets\ApiValidation\Entities\Exceptions\ValidateException;
use Coolcigarets\ApiValidation\Entities\Rules\AbstractRule;

/**
 * Validation of email mx string
 */
class EmailMX extends AbstractRule
{
    /**
     * @inheritdoc
     */
    function validate(): bool
    {
        list($user, $domain) = explode('@', $this->txt);
        $result = checkdnsrr($domain, 'MX');

        if (!$result) {
            throw new ValidateException('No MX record exists;  Invalid email.');
        }

        return true;
    }
}