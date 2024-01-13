<?php

declare(strict_types=1);

namespace App\Components;

use Hyperf\HttpServer\Contract\ResponseInterface;
use Psr\Container\ContainerInterface;

class Response
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var ResponseInterface
     */
    protected $response;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->response = $container->get(ResponseInterface::class);
    }

    public function success($data = [])
    {
        return $this->response->json([
            'code' => 0,
            'data' => $data,
        ]);
    }

    public function fail($code, $message = '')
    {

        return $this->response->json([
            'code' => $code,
            'message' => $message,
        ]);
    }

    /**
     * Notes : 返回json格式
     * @author: crx
     * @time: 2024/1/13 11:41
     * @param $code
     * @param $message
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function failContent(ResponseContent $responseContent)
    {
        var_dump(json_encode($responseContent, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES));
        return $this->response->json($responseContent);
    }
}