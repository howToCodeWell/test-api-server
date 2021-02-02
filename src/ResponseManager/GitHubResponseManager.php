<?php

namespace App\ResponseManager;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class GitHubResponseManager extends AbstractResponseManager implements ResponseManagerInterface
{
    public function create(Request $request, string $endPoint): ResponseConfig
    {
        $token = $this->getAccessTokenFromRequest($request);
        $config = $this->getResponseConfig($endPoint, $token);
        return new ResponseConfig($config['body'], $config['status_code']);
    }

    public function createFromCode(Request $request, string $endPoint): ResponseConfig
    {
        $code = $this->getAccessCodeFromRequest($request);
        if (empty($code)) {
            throw new NotFoundHttpException('Not Found');
        }
        $config = $this->getResponseConfig($endPoint, $code);
        return new ResponseConfig($config['body'], $config['status_code']);
    }
}
