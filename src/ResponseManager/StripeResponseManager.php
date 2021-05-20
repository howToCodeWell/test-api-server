<?php
declare(strict_types=1);

namespace App\ResponseManager;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Yaml\Yaml;

class StripeResponseManager extends AbstractResponseManager implements ResponseManagerInterface
{

    public function updateCustomer(Request $request): ResponseConfig
    {
        $customerID = $request->get('customer_id');
        $config = $this->getResponseConfig('customers', $customerID);
        return new ResponseConfig($config['body'], $config['status_code']);
    }

    public function getCustomer(Request $request): ResponseConfig
    {
        $customerID = $request->get('customer_id');
        $config = $this->getResponseConfig('customers', $customerID);
        return new ResponseConfig($config['body'], $config['status_code']);
    }

    public function create(Request $request, string $endPoint): ResponseConfig
    {
        $id = $request->get('intent_id');
        $config = $this->getResponseConfig($endPoint, $id);
        return new ResponseConfig($config['body'], $config['status_code']);
    }


    public function getResponseConfig(string $endPoint, string $filename): array
    {
        $path = '../config/responses/stripe/' . $endPoint . '/' . $filename . '.yaml';
        try {
            return Yaml::parseFile($path);
        } catch (ParseException $exception) {
            throw new NotFoundHttpException('Not Found '. $path);
        }
    }
}
