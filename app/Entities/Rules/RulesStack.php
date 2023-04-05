<?php

namespace Coolcigarets\ApiValidation\Entities\Rules;

class RulesStack
{
    private array $objects;

    public function __construct()
    {
        $this->objects = [];
    }

    public function push(Rule $obj): void
    {
        $this->objects[] = $obj;
    }

    public function pop(): Rule
    {
        return array_pop($this->objects);
    }

    public function hasMore(): bool
    {
        return count($this->objects) > 0;
    }
}