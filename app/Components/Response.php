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
}