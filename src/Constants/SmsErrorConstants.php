<?php

namespace YxCloud\Sms\Constants;

use Hyperf\Constants\AbstractConstants;
use Hyperf\Constants\Annotation\Constants;

#[Constants]
class SmsErrorConstants extends AbstractConstants
{
    /**
     * @Message("短信发送失败")
     */
    public const SMS_SEND_FAIL = 600;

    /**
     * @Message("发送短信手机号格式错误")
     */
    public const SMS_SEND_MOBILE_ERROR = 601;

    /**
     * @Message("发送短信频繁")
     */
    public const SMS_SEND_MOBILE_FREQUENTLY = 602;
}