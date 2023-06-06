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
namespace YxCloud\Sms\Factory;

use Hyperf\Contract\ConfigInterface;
use Psr\Container\ContainerInterface;
use YxCloud\Sms\Handler\HttpHandler;

class HttpFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $config = $container->get(ConfigInterface::class);
        $option = $config->get('sms.guards.http', []);

        return \Hyperf\Support\make(HttpHandler::class, [$option]);
    }
}
