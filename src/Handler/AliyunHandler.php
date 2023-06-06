<?php

namespace YxCloud\Sms\Handler;

use YxCloud\Sms\AbstructSms;
use YxCloud\Sms\Construct\SmsAliyunConstruct;

class AliyunHandler extends AbstructSms implements SmsAliyunConstruct
{
    public function sendSms(string $mobile, string $message, string $code = null, callable $function = null): bool
    {
        // TODO: Implement sendSms() method.
    }

    public function checkSmsCode(string $mobile, string $code): bool
    {
        // TODO: Implement checkSmsCode() method.
    }

    public function initInstance()
    {
        // TODO: Implement initInstance() method.
    }
}