<?php

namespace Coolcigarets\ApiValidation\Entities\Validators;

use Coolcigarets\ApiValidation\Entities\Exceptions\ValidateException;
use Coolcigarets\ApiValidation\Entities\Rules\RulesStack;

class Validator
{
    private RulesStack $rulesStack;

    public function __construct(RulesStack $rulesStack)
    {
        $this->rulesStack = $rulesStack;
    }

    /**
     * @throws ValidateException
     */
    public function validate(){
        while($this->rulesStack->hasMore()){
            $rule = $this->rulesStack->pop();
            $rule->validate();
        }
    }
}