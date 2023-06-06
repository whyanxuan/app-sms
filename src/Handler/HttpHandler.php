<?php

namespace YxCloud\Sms\Handler;

use Hyperf\Guzzle\ClientFactory;
use Hyperf\Redis\Pool\RedisPool;
use Hyperf\Redis\Redis;
use YxCloud\Sms\AbstructSms;
use YxCloud\Sms\Construct\SmsHttpConstruct;
use YxCloud\Sms\Exception\SmsException;

class HttpHandler extends AbstructSms implements SmsHttpConstruct
{

    /**
     * @param string $mobile
     * @throws SmsException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function sendSms(string $mobile, string $message, string $code = null, callable $function = null)
    {
        try {
            if (is_null($function)) {
                return null;
            }
            $url = $this->config['path'];
            $url .= '?' . http_build_query(['content' => $message, 'mobile' => $mobile]);
            $responseContent = $this->clientFactory->request('post', $url);
            if ($responseContent->getStatusCode() == 200) {
                $result = $responseContent->getBody()->getContents();
                $result = json_decode($result, true);
                // 发送成功
                if (isset($result['status']) && $result['status'] == 0) {
                    $this->codeManage($code, $mobile, 'Set');
                }
            } else {
                $result = [];
            }
            return $function($result);
        } catch (\Exception $exception) {
            return $function(['code' => $exception->getCode(), 'message' => $exception->getMessage()]);
        }
    }

    /**
     * 检查是否正确
     * @param string $mobile
     * @param string $code
     * @return bool
     */
    public function checkSmsCode(string $mobile, string $code) : bool
    {
        return $this->codeManage($code, $mobile, 'Get');
    }

    public function initInstance() : void
    {
        $host = $this->config['host'] ?? [];
        $headers = $this->config['headers'] ?? [];
        $clientFactory = $this->container->get(ClientFactory::class);
        $this->clientFactory = $clientFactory->create(['headers' => $headers, 'base_uri' => $host, 'debug' => true]);
    }

    private function codeManage(string $code, string $mobile, string $actionType = 'Set') : bool
    {
        // 初始化redis实例
        $cacheHandler = is_callable($this->config['cache']) ? call_user_func_array($this->config['cache'], []) : make(Redis::class);
        // 过期时间
        $cacheTtl = $this->config['ttl'];
        // 获取
        $cachePrefix = $this->config['prefix'];
        // 检查
        if ($actionType == 'Set') {
            return (bool) $cacheHandler->set($cachePrefix . $mobile, $code, $cacheTtl);
        } else {
            $cacheCode = $cacheHandler->get($cachePrefix . $mobile);
            if ($cacheCode === $code) {
                return true;
            }
            return false;
        }
    }
}