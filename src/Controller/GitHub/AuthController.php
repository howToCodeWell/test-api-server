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
     * @Route("/login/oauth/authorize", name="authorize")
     * @param Request $request
     * @return Response
     */
    public function authorize(Request $request): Response
    {
        $state = $request->get('state');

        return new JsonResponse([
            'code' => "abc",
            'state' => $state
        ]);
    }

    /**
     * @Route("/login/oauth/access_token", name="access_token")
     * @param Request $request
     * @return Response
     */
    public function accessToken(Request $request): Response
    {
        $scope = $request->get('scope', 'user');
        $tokenType = 'bearer';

        return new JsonResponse([
            'access_token' => "abc",
            'scope' => $scope,
            'token_type' => $tokenType
        ]);
    }
}
