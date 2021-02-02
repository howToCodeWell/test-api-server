<?php

namespace App\Controller\GitHub;

use App\ResponseManager\GitHubResponseManager;
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
    private GitHubResponseManager $responseManager;

    public function __construct(GitHubResponseManager $responseManager)
    {
        $this->responseManager = $responseManager;
    }

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

        $responseData = $this->responseManager->createFromCode($request, 'access_token');

        return new JsonResponse($responseData->getBody(), $responseData->getStatusCode());
    }
}
