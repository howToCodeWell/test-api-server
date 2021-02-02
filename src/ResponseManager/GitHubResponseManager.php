<?php
declare(strict_types=1);

namespace App\ResponseManager;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class GitHubResponseManager extends AbstractResponseManager implements ResponseManagerInterface
{
    public function createAuthorizeFromRequest(Request $request)
    {
        $state = $this->getStateFromRequest($request);
        if (empty($state)) {
            throw new AccessDeniedHttpException('State Not Supplied');
        }
        $config = $this->getResponseConfig('authorize', $state);
        return new ResponseConfig($config['body'], $config['status_code']);
    }

    public function create(Request $request, string $endPoint): ResponseConfig
    {
        $token = $this->getAccessTokenFromRequest($request);
        if (empty($token)) {
            throw new AccessDeniedHttpException('Access Token Not Supplied');
        }
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
