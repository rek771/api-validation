<?php

namespace Coolcigarets\ApiValidation\UseCases\ValidatorFactories;

use Coolcigarets\ApiValidation\Entities\Rules\RulesStack;
use Coolcigarets\ApiValidation\Entities\Validators\AbstractValidatorFactory;
use Coolcigarets\ApiValidation\Entities\Validators\Validator;
use Coolcigarets\ApiValidation\UseCases\Rules\EmailMX;
use Coolcigarets\ApiValidation\UseCases\Rules\EmailTemplate;
use Coolcigarets\ApiValidation\UseCases\Rules\EmptyString;

class CheckEmailsFactory extends AbstractValidatorFactory
{
    function make(): Validator
    {
        $rulesStack = new RulesStack();
        $rulesStack->push(new EmailMX($this->text));
        $rulesStack->push(new EmailTemplate($this->text));
        $rulesStack->push(new EmptyString($this->text));

        return new Validator($rulesStack);
    }
}