<?php

declare(strict_types=1);

namespace App\Components;

use Hyperf\Contract\Jsonable;

class ResponseContent implements Jsonable
{
    protected $code;

    protected $data;

    protected $message;

    /**
     * @param $code
     * @param $data
     * @param $message
     */
    public function __construct($code, $data, $message)
    {
        $this->code = $code;
        $this->data = $data;
        $this->message = $message;
    }

    public function __toString(): string
    {
        return  json_encode(['code' => $this->code, 'data' => $this->data, 'message' => $this->message], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
    }
}