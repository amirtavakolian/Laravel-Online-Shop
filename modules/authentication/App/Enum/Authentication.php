<?php

namespace Authentication\App\Enum;

enum Authentication: string
{
    case WRONG_PASSWORD_COUNTER = 'wrong_pass_counter';
    case FORGET_PASS = 'forget_pass';
    case FORGET_PASS_WRONG_CODE_COUNTER = 'forget_pass_wrong_code_counter';
    case TWO_AUTH = 'twoauth';
    case SEND_TWO_AUTH_BY_SMS = 'sms';
    case SEND_TWO_AUTH_BY_EMAIL = 'email';
    case SEND_TWO_AUTH_BY_CALL = 'call';

    public static function getForgetPassKey(string $email): string
    {
        return $email . '.' . self::FORGET_PASS->value;
    }

    public static function getTwoAuthMethods()
    {
        $twoAuthMethods = [
            self::SEND_TWO_AUTH_BY_SMS->value,
            self::SEND_TWO_AUTH_BY_EMAIL->value,
            self::SEND_TWO_AUTH_BY_CALL->value,
        ];
        return implode(',', $twoAuthMethods);
    }

    public static function getTwoAuthKey($currentUserId)
    {
        return $currentUserId . '.' . Authentication::TWO_AUTH->value . '.' . 'code';
    }
}
