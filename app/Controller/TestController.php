<?php

declare(strict_types=1);

namespace App\Controller;

use App\Aspect\BAnnotation;
use App\Service\UserService;
use Hyperf\Context\ApplicationContext;
use Hyperf\Contract\TranslatorInterface;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\RequestMapping;

#[Controller]
#[BAnnotation]
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
        $this->userService->index();
        $cid = \Swoole\Coroutine::getCid();
        \Swoole\Coroutine::defer(function () {

            var_dump(122222222222222222222222);
        });
        var_dump(33333333333333);
        $data = [
            'method' => $method,
            'message' => "Hello {$user}.",
            'time' => \Hyperf\Context\Context::get('time'),
            'time1' => \Hyperf\Context\Context::get('time1'),
            'cid' => $cid,
        ];
        return $this->success($data);
    }
    #[RequestMapping(path: "bb", methods: "get,post")]
    public function testParmDi(...$integer)
    {
        var_dump('被代理的〒_〒类', $integer);
        $data = [
            'method' => $integer,
            'message' => "Hello {123}.",
            'time' => \Hyperf\Context\Context::get('time'),
            'time1' => \Hyperf\Context\Context::get('time1'),
        ];
        var_dump($cid);
        return $this->success($data);
    }
    #[RequestMapping(path: "testException", methods: "get,post")]
    public function testException()
    {
        // $results = Db::select('SELECT item_id from sysitem_item  order by modify_time limit 10000,100');
        $user = $this->request->input('user', 'Hyperf');
        $method = $this->request->getMethod();
        $this->userService->testException();
        $data = [
            123
        ];
        return $this->success($data);
    }
    #[RequestMapping(path: "testMultiLang", methods: "get,post")]
    public function testMultiLang()
    {
        $translator = ApplicationContext::getContainer()->get(TranslatorInterface::class);
        $data = [
            'message' => [
                'en' => 'Hello .' . $translator->trans('params.id_invalid'),
                'zh' => '你好 {user}.',
            ],
        ];
        return $this->success($data);
    }
}
