<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static CREATE()
 * @method static static EDIT()
 */
final class FormType extends Enum
{
    const CREATE = 0;
    const EDIT = 1;
}
