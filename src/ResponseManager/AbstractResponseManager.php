<?php
declare(strict_types=1);

namespace App\ResponseManager;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Yaml\Yaml;

class AbstractResponseManager
{
    public function getStateFromRequest(Request $request)
    {
        if ($request->isMethod('GET')) {
            $code = $request->query->get('state');
        } else {
            $code = $request->request->get('state');
        }
        return $code;
    }

    public function getAccessTokenFromRequest(Request $request): ?string
    {
        $headerValue = $request->headers->get('Authorization');
        if (empty($headerValue)) {
            return null;
        }
        $parts = explode(' ', $headerValue);
        return $parts[1];
    }

    public function getAccessCodeFromRequest(Request $request): ?string
    {
        if ($request->isMethod('GET')) {
            $code = $request->query->get('code');
        } else {
            $code = $request->request->get('code');
        }
        return $code;
    }


    public function getResponseConfig(string $endPoint, string $filename): array
    {
        $path = '../config/responses/github/' . $endPoint . '/' . $filename . '.yaml';
        return Yaml::parseFile($path);
    }
}
