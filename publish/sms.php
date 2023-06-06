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

return [
    'default' => [
        'guard' => 'http',
    ],
    'guards' => [
        'aliyun' => [
            // 自定义 redis key，必须包含 {mobile}，{mobile} 会被替换成用户手机号
            'redis_key' => 'sms:code:{mobile}',
            // 驱动
            'driver' => YxCloud\Sms\Factory\AliyunFactory::class,
            /*
             * aliyun app key
             */
            'key' => \Hyperf\Support\env('SMS_ALIYUN_APP_KEY'),
            /**
             * aliyun app secret
             */
            'secret' => \Hyperf\Support\env('SMS_ALIYUN_SECRET_KEY'),
            /*
             * 可选配置
             * 短信code 生命周期，单位秒，默认一天
             */
            'ttl' => (int)\Hyperf\Support\env('SMS_ALIYUN_CODE_TTL', 60 * 60 * 24),
            /*
             * 可选配置
             * 缓存类
             */
            'cache' => function () {
                return \Hyperf\Support\make(\Hyperf\Redis\Redis::class);
            },
            /*
             * 可选配置
             * 缓存前缀
             */
            'prefix' => \Hyperf\Support\env('SMS_ALIYUN_CODE_PREFIX', 'yx_sms_'),
        ],
        'http' => [
            // 请求地址
            'host' => \Hyperf\Support\env('SMS_HTTP_HOST', ''),
            // 驱动
            'driver' => YxCloud\Sms\Factory\HttpFactory::class,
            // 自定义 redis key，必须包含 {mobile}，{mobile} 会被替换成用户手机号
            'redis_key' => 'sms:code:{mobile}',
            /*
             * aliyun app key
             */
            'key' => \Hyperf\Support\env('SMS_HTTP_APP_KEY'),
            /**
             * aliyun app secret
             */
            'secret' => \Hyperf\Support\env('SMS_HTTP_SECRET_KEY'),

            /**
             * 可选配置
             */
            'headers' => [
                'Authorization' => 'APPCODE' . \Hyperf\Support\env('SMS_HTTP_CODE', '')
            ],
            /*
             * 可选配置
             * 短信code 生命周期，单位秒，默认一天
             */
            'ttl' => (int)\Hyperf\Support\env('SMS_HTTP_CODE_TTL', 60 * 60 * 24),
            /*
             * 可选配置
             * 缓存类
             */
            'cache' => function () {
                return \Hyperf\Support\make(\Hyperf\Redis\Redis::class);
            },
            /*
             * 可选配置
             * 缓存前缀
             */
            'prefix' => \Hyperf\Support\env('SMS_HTTP_CODE_PREFIX', 'yx_sms_')
        ]
    ]
];
