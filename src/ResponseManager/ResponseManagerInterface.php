<?php
declare(strict_types=1);

namespace App\ResponseManager;

use Symfony\Component\HttpFoundation\Request;

interface ResponseManagerInterface
{
    public function create(Request $request, string $endPoint): ResponseConfig;
}
