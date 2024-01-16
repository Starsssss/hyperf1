<?php


namespace App\Aspect;

use App\Controller\TestController;
use Hyperf\Context\ApplicationContext;
use Hyperf\Di\Annotation\Aspect;
use Hyperf\Di\Aop\AbstractAspect;
use Hyperf\Di\Aop\ProceedingJoinPoint;
use Hyperf\HttpServer\Contract\RequestInterface;

#[Aspect]
class ControllerAspect extends AbstractAspect
{
    // 要切入的类或 Trait，可以多个，亦可通过 :: 标识到具体的某个方法，通过 * 可以模糊匹配
    public array $classes = [
        // TestController::class,
    ];

    // 要切入的注解，具体切入的还是使用了这些注解的类，仅可切入类注解和类方法注解
    public array $annotations = [
//        SomeAnnotation::class,
    ];

    public function process(ProceedingJoinPoint $proceedingJoinPoint)
    {
        $container = ApplicationContext::getContainer();
        $request = $container->get(RequestInterface::class);
//        var_dump($request->all());
        // 获取当前方法反射原型
        /** @var \ReflectionMethod **/
        $reflect = $proceedingJoinPoint->getReflectMethod();
        // 获取调用方法时提交的参数
        $arguments = $proceedingJoinPoint->getArguments(); // array
        var_dump('参数',$arguments);
//        $result = $proceedingJoinPoint->process(12222);
        // 在调用后进行某些处理
        // 获取原类的实例并调用原类的其他方法
        $originalInstance = $proceedingJoinPoint->getInstance();
//        $result = $reflect->invoke($originalInstance,111);
//        var_dump('orig',$originalInstance->);
//         $result = $originalInstance->testParmDi(11113333444);
        return '9999';//json_encode($result);
        return $result;
//        $proceedingJoinPoint->
        // 获取注解元数据
        /** @var \Hyperf\Di\Aop\AnnotationMetadata **/
//        $metadata = $proceedingJoinPoint->getAnnotationMetadata();

        // 调用不受代理类影响的原方法
        $result=$proceedingJoinPoint->processOriginalMethod(123999);
        var_dump('res',$result);
        return '98888' ;

        // 不执行原方法，做其他操作
        $result = date('YmdHis', time() - 86400);
        return $result;

    }
}
