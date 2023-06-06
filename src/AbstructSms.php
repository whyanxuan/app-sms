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

namespace YxCloud\Sms;

use GuzzleHttp\Client;
use Hyperf\Di\Annotation\Inject;
use Hyperf\Redis\Redis;
use Psr\Container\ContainerInterface;

abstract class AbstructSms
{
    protected string $key;
    protected string $secret;

    protected array $config = [];

    protected Client $clientFactory;

    #[Inject]
    protected ContainerInterface $container;

    public function __construct(array $config)
    {
        $this->config = $config;

        $this->key = $config['key'];

        $this->secret = $config['secret'];

        // 初始化
        $this->initInstance();
    }

    abstract public function initInstance();

    protected function getCode(): int
    {
        return rand(100000, 200000);
    }
}
