<?php
declare(strict_types=1);

namespace App\Util;

use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

trait ApiTrait
{

    protected function getActionSuccess(int $code, $entity) : JsonResponse
    {
        return $this->json(['data' => $entity], $code);
    }


    protected function getActionFailure(int $code, string $message) : JsonResponse
    {
        $RET = [];
        $RET['code'] = $code;
        $RET['message'] = $message;
        return $this->json(['error' => $RET], $code);
    }


    protected function postActionSuccess(int $code, $entity, string $route_name, array $params = []) : JsonResponse
    {
        if ( ! $params ) {
            $params['id'] = $entity->getId();
        }
        $url = $this->generateUrl($route_name, $params);
        return $this->json(['data' => $entity], $code, ['location' => $url]);
    }


    protected function convertFormErrors(int $code, string $message, FormInterface $form) : JsonResponse
    {
        $RET = [];
        $RET['code'] = $code;
        $RET['message'] = $message;

        $ERR = [];
        foreach ($form->getErrors(true) as $error) {
            $ERR[] = ['domain' => $error->getOrigin()->getName(), 'message' => $error->getMessage()];
        }
        $RET['errors'] = $ERR;
        return $this->json(['error' => $RET], $code);
    }


    protected function putActionSuccess(int $code) : JsonResponse
    {
        return $this->json(null, $code);
    }


    protected function putActionFailure(int $code, string $message) : JsonResponse
    {
        return $this->getActionFailure($code, $message);
    }


    protected function deleteActionSuccess(int $code) : JsonResponse
    {
        return $this->json(null, $code);
    }


    protected function deleteActionFailure(int $code, string $message) : JsonResponse
    {
        return $this->getActionFailure($code, $message);
    }

}