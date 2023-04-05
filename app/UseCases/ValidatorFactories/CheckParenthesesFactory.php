<?php

namespace Coolcigarets\ApiValidation\UseCases\ValidatorFactories;

use Coolcigarets\ApiValidation\Entities\Rules\RulesStack;
use Coolcigarets\ApiValidation\Entities\Validators\AbstractValidatorFactory;
use Coolcigarets\ApiValidation\Entities\Validators\Validator;
use Coolcigarets\ApiValidation\UseCases\Rules\ClosedParentheses;
use Coolcigarets\ApiValidation\UseCases\Rules\EmptyString;

class CheckParenthesesFactory extends AbstractValidatorFactory
{
    function make(): Validator
    {
        $rulesStack = new RulesStack();
        $rulesStack->push(new ClosedParentheses($this->text));
        $rulesStack->push(new EmptyString($this->text));

        return new Validator($rulesStack);
    }
}