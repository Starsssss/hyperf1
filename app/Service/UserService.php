<?php

declare(strict_types=1);

namespace App\Service;

use Psr\Log\LoggerInterface;
use Hyperf\Logger\LoggerFactory;

class UserService
{

    protected LoggerInterface $logger;

    public function __construct(LoggerFactory $loggerFactory)
    {
        // 第一个参数对应日志的 name, 第二个参数对应 config/autoload/logger.php 内的 key
        $this->logger = $loggerFactory->get('log', 'default');
    }

    /**
     * 测试异常方法
     * @author: crx
     * @time: 2024/1/12 17:44
     * @return mixed
     * @throws \Exception
     */
    public function testException()
    {
        // Do something.
        $this->logger->info("Your log message.");
        $this->logger->info("Your log message2222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222.");
        throw new \Exception('测试异常eee', 1111);
    }

    /**
     * 正常方法调用
     * @author: crx
     * @time: 2024/1/12 17:45
     * @return void
     */
    public function index()
    {
        // Do something.
        $this->logger->info("INDEX log message.");
        $this->logger->info("Your log message2222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222.");
    }
}