<?php
namespace Unit;

use Coolcigarets\ApiValidation\UseCases\Rules\EmptyString;
use PHPUnit\Framework\TestCase;

class EmptyStringValidatorTest extends TestCase
{
    /**
     * Needed success on validation of words
     * @throws \Coolcigarets\ApiValidation\Entities\Exceptions\ValidateException
     */
    public function testValidateSuccess(): void
    {
        $result = (new EmptyString('anything words'))->validate();

        $this->assertTrue($result);
    }

    /**
     * Needed fail on validation of words
     */
    public function testValidateFail(): void
    {
        try {
            (new EmptyString(''))->validate();
            $this->fail();
        } catch (\Coolcigarets\ApiValidation\Entities\Exceptions\ValidateException $exception) {
            $this->assertTrue(true);
        }
    }
}