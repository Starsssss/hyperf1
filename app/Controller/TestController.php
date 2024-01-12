<?php
declare(strict_types=1);

namespace App\Controller;

use App\Service\UserService;
use Hyperf\DbConnection\Db;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\RequestMapping;

#[Controller]
class TestController extends AbstractController
{
    #[Inject]
    private UserService $userService;

    // Hyperf 会自动为此方法生成一个 /index/index 的路由，允许通过 GET 或 POST 方式请求
    #[RequestMapping(path: "aa", methods: "get,post")]
    public function index()
    {
        // $results = Db::select('SELECT item_id from sysitem_item  order by modify_time limit 10000,100');
        $user = $this->request->input('user', 'Hyperf');
        $method = $this->request->getMethod();
        $data= [
            'method' => $method,
            'message' => "Hello {$user}.",
            'time' => \Hyperf\Context\Context::get('time'),
            'time1' => \Hyperf\Context\Context::get('time1'),
        ];
        return $this->success($data);
    }
    #[RequestMapping(path: "testException", methods: "get,post")]
    public function testException()
    {
        // $results = Db::select('SELECT item_id from sysitem_item  order by modify_time limit 10000,100');
        $user = $this->request->input('user', 'Hyperf');
        $method = $this->request->getMethod();
        $this->userService->testException();
        $data= [
            123
        ];
        return $this->success($data);
    }

}
