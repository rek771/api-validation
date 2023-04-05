<?php

namespace Coolcigarets\ApiValidation\Entities\Rules;

abstract class AbstractRule implements Rule
{
    /** @var string Checked text */
    protected string $txt;

    public function __construct(string $txt)
    {
        $this->txt = $txt;
    }

    /**
     * @inheritDoc
     */
    abstract function validate(): bool;
}