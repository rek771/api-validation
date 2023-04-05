<?php
namespace Unit;

use Coolcigarets\ApiValidation\Entities\Exceptions\ValidateException;
use Coolcigarets\ApiValidation\UseCases\Rules\ClosedParentheses;
use PHPUnit\Framework\TestCase;

class ClosedParenthesesValidatorTest extends TestCase
{
    /**
     * Needed success on validation of words
     * @throws \Coolcigarets\ApiValidation\Entities\Exceptions\ValidateException
     */
    public function testValidateSuccess(): void
    {
        $result = (new ClosedParentheses('(word(word))'))->validate();

        $this->assertTrue($result);
    }

    /**
     * Needed fail on validation of words
     */
    public function testValidateFail(): void
    {
        $failWords = [
            '(word(word))(',
            '(word(word)))'
        ];

        foreach ($failWords as $failWord) {
            try {
                (new ClosedParentheses($failWord))->validate();
                $this->fail();
            } catch (ValidateException $exception) {
                $this->assertTrue(true);
            }
        }
    }
}