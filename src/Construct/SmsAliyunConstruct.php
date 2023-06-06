<?php

declare(strict_types=1);
/**
 * This file is part of qbhy/hyperf-auth.
 *
 * @link     https://github.com/qbhy/hyperf-auth
 * @document https://github.com/qbhy/hyperf-auth/blob/master/README.md
 * @contact  qbhy0715@qq.com
 * @license  https://github.com/qbhy/hyperf-auth/blob/master/LICENSE
 */
namespace YxCloud\Sms\Construct;

interface SmsAliyunConstruct
{
    /**
     * Retrieve a user by the given credentials.
     *
     * @param string $mobile
     */
    public function sendSms(string $mobile, string $message, string $code = null, callable $function = null);

    /**
     * Validate a user against the given credentials.
     *
     * @param string $mobile
     * @param string $code
     */
    public function checkSmsCode(string $mobile, string $code): bool;
}
