<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
namespace YxCloud\Sms\Exception;

use YxCloud\Sms\Constants\SmsErrorConstants;
use Hyperf\Server\Exception\ServerException;
use Throwable;

class SmsException extends ServerException
{
    public function __construct(int $code = 0, string $message = null, Throwable $previous = null)
    {
        if (is_null($message)) {
            $message = SmsErrorConstants::getMessage($code);
        }

        parent::__construct($message, $code, $previous);
    }
}
