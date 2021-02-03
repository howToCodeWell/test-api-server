<?php
declare(strict_types=1);

namespace App\Controller\GitHub;

use App\ResponseManager\GitHubResponseManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Swagger\Annotations as SWG;
use Nelmio\ApiDocBundle\Annotation\Security;

/**
 * Class UserController
 * @package App\Controller
 * @Route("/github", name="github_user_", format="json", requirements={"_format":"json"})
 * @SWG\Tag(name="auth")
 * @SWG\Tag(name="github")
 */
class UserController extends AbstractController
{
    private GitHubResponseManager $responseManager;

    public function __construct(GitHubResponseManager $responseManager)
    {
        $this->responseManager = $responseManager;
    }

    /**
     * @Route("/api/v3/user", name="index", methods={"GET"})
     * @SWG\Response(response=200, description="Get authenticated user")
     * @SWG\Parameter(name="Authorization", in="header", type="string")
     * @Security(name="Bearer")
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        $responseData = $this->responseManager->create($request, 'user');

        return new JsonResponse($responseData->getBody(), $responseData->getStatusCode());
    }
}
