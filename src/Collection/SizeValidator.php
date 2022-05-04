<?php
declare(strict_types=1);

namespace LessValidator\Collection;

use LessValidator\ValidateResult\ErrorValidateResult;
use LessValidator\ValidateResult\ValidateResult;
use LessValidator\ValidateResult\ValidValidateResult;
use LessValidator\Validator;

/**
 * @psalm-immutable
 */
final class SizeValidator implements Validator
{
    public function __construct(public readonly int $minSize, public readonly int $maxSize)
    {}

    public function validate(mixed $input): ValidateResult
    {
        assert(is_array($input));

        $size = count($input);

        if ($size < $this->minSize) {
            return new ErrorValidateResult('collection.size.tooSmall', ['counted' => $size, 'min' => $this->minSize]);
        }

        if ($size > $this->maxSize) {
            return new ErrorValidateResult('collection.size.tooLarge', ['counted' => $size, 'max' => $this->maxSize]);
        }

        return new ValidValidateResult();
    }
}
