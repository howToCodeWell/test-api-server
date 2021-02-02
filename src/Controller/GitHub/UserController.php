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
 * @Route("/github", name="github_user_")
 */
class UserController extends AbstractController
{
    private GitHubResponseManager $responseManager;

    public function __construct(GitHubResponseManager $responseManager)
    {
        $this->responseManager = $responseManager;
    }

    /**
     * @Route("/api/v3/user", name="index")
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        $responseData = $this->responseManager->create($request, 'user');

        return new JsonResponse($responseData->getBody(), $responseData->getStatusCode());
    }

}
