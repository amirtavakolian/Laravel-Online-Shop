<?php

namespace App\Enum;

enum Authentication: string
{
    case WRONG_PASSWORD_COUNTER = 'wrong_pass_counter';
    case FORGET_PASS = 'forget_pass';
    case FORGET_PASS_WRONG_CODE_COUNTER = 'forget_pass_wrong_code_counter';

    public static function getForgetPassKey(string $email): string
    {
        return $email . '.' . self::FORGET_PASS->value;
    }
}
