<?php

namespace App\ResponseManager;

use Symfony\Component\HttpFoundation\Request;

interface ResponseManagerInterface
{
    public function create(Request $request, string $endPoint): ResponseConfig;
}
