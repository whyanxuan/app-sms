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
namespace YxCloud\Sms;

use YxCloud\Sms\Construct\SmsAliyunConstruct;
use YxCloud\Sms\Construct\SmsHttpConstruct;
use YxCloud\Sms\Factory\AliyunFactory;
use YxCloud\Sms\Factory\HttpFactory;

class ConfigProvider
{

    public function __invoke(): array
    {
        return [
            'dependencies' => [
                SmsAliyunConstruct::class => AliyunFactory::class,
                SmsHttpConstruct::class => HttpFactory::class,
            ],
            'commands' => [
            ],
            'annotations' => [
                'scan' => [
                    'paths' => [
                        __DIR__,
                    ],
                ],
            ],
            'publish' => [
                [
                    'id' => 'sms',
                    'description' => 'sms 组件配置.', // 描述
                    // 建议默认配置放在 publish 文件夹中，文件命名和组件名称相同
                    'source' => __DIR__ . '/../publish/sms.php',  // 对应的配置文件路径
                    'destination' => BASE_PATH . '/config/autoload/sms.php', // 复制为这个路径下的该文件
                ],
            ],
        ];
    }
}
