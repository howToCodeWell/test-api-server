<?php

namespace App\ResponseManager;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Yaml\Yaml;

class AbstractResponseManager
{
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
