<?php
declare(strict_types=1);

namespace LessValidator\Collection;

use LessValidator\Exception\UnexpectedType;
use LessValidator\ValidateResult\Collection\ItemsValidateResult;
use LessValidator\ValidateResult\ValidateResult;
use LessValidator\Validator;

/**
 * @psalm-immutable
 */
final class ItemsValidator implements Validator
{
    public function __construct(public Validator $itemValidator)
    {
    }

    public function validate(mixed $input): ValidateResult
    {
        assert(is_array($input), new UnexpectedType('array', get_debug_type($input)));
        /** @var array<int, mixed> $input */

        $itemValidator = $this->itemValidator;

        return new ItemsValidateResult(
            array_map(
                /** @psalm-pure  */
                fn (mixed $item): ValidateResult => $itemValidator->validate($item),
                $input,
            ),
        );
    }
}
