<?php

namespace App\Controller\GitHub;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class GitHubController
 * @package App\Controller
 * @Route("/github", name="github_auth_")
 */
class AuthController extends AbstractController
{
    /**
     * @Route("/login/oauth/authorize", name="auth")
     * @param Request $request
     * @return Response
     */
    public function auth(Request $request): Response
    {
        return new JsonResponse([

        ]);
    }
}
