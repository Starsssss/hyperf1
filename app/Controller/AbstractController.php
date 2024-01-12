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

namespace App\Controller;

use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
use Psr\Container\ContainerInterface;

abstract class AbstractController
{
    #[Inject]
    protected ContainerInterface $container;

    #[Inject]
    protected RequestInterface $request;

    #[Inject]
    protected ResponseInterface $response;

    /**
     * 成功统一返回格式
     * @author: crx
     * @time: 2024/1/12 17:57
     * @param $data
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function success($data = [])
    {
        return $this->response->json([
            'code' => 0,
            'data' => $data,
        ]);
    }

    /**
     * 失败统一返回格式
     * @author: crx
     * @time: 2024/1/12 17:57
     * @param $code
     * @param $message
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function fail($code, $message = '')
    {
        return $this->response->json([
            'code' => $code,
            'message' => $message,
        ]);
    }
}
