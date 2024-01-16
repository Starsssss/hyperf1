<?php

declare(strict_types=1);

namespace App\Middleware;

use Hyperf\Contract\TranslatorInterface;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class MultiLanguage implements MiddlewareInterface
{
    /**
     * @var TranslatorInterface
     */
    protected $translator;

    public function __construct(ContainerInterface $container, TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        if ($lang = $request->getHeaderLine('lang')) {
            $this->translator->setLocale($lang);
        }

        return $handler->handle($request);
    }
}
