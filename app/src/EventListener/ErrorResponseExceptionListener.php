<?php

namespace App\EventListener;

use App\HttpResponse\Interface\IBaseResponseException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ErrorResponseExceptionListener
{
    public function onKernelException(
        ExceptionEvent $event,
    ): void
    {
        $exception = $event->getThrowable();

        if (
            $exception instanceof NotFoundHttpException ||
            $exception instanceof AccessDeniedHttpException
        ) {
            $event->setResponse(
                new JsonResponse(
                    [
                        "message" => $exception->getMessage(),
                        "errors" => [],
                    ],
                    $exception->getStatusCode(),
                    ['Content-Type' => 'application/json']
                )
            );
        } else if ($exception instanceof IBaseResponseException) {
            $event->setResponse(
                new JsonResponse(
                    [
                        "message" => $exception->getMessage(),
                        "errors" => $exception->getErrors()
                    ],
                    $exception->getCode(),
                    ['Content-Type' => 'application/json']
                )
            );
        }
    }
}
