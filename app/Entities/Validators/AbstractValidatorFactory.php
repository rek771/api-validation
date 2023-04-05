<?php

namespace Coolcigarets\ApiValidation\Entities\Validators;

abstract class AbstractValidatorFactory
{
    protected string $text;

    public function __construct(string $text)
    {
        $this->text = $text;
    }

    abstract function make(): Validator;
}