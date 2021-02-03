<?php
declare(strict_types=1);

namespace App\Controller\GitHub;

use App\ResponseManager\GitHubResponseManager;
use Swagger\Annotations as SWG;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class GitHubController
 * @package App\Controller
 * @Route("/github", name="github_auth_", format="json", requirements={"_format":"json"})
 * @SWG\Tag(name="auth")
 * @SWG\Tag(name="github")
 */
class AuthController extends AbstractController
{
    private GitHubResponseManager $responseManager;

    public function __construct(GitHubResponseManager $responseManager)
    {
        $this->responseManager = $responseManager;
    }

    /**
     * @Route("/login/oauth/authorize", name="authorize", methods={"GET","POST"})
     * @SWG\Response(response=200, description="authorize")
     * @SWG\Parameter(name="client_id", in="query", type="string")
     * @SWG\Parameter(name="redirect_uri", in="query", type="string")
     * @SWG\Parameter(name="scope", in="query", type="string")
     * @SWG\Parameter(name="state", in="query", type="string")
     * @SWG\Parameter(name="allow_signup", in="query", type="string")
     * @param Request $request
     * @return JsonResponse
     */
    public function authorize(Request $request): JsonResponse
    {
        $responseData = $this->responseManager->createAuthorizeFromRequest($request);

        return new JsonResponse($responseData->getBody(), $responseData->getStatusCode());
    }

    /**
     * @Route("/login/oauth/access_token", name="access_token", methods={"POST"})
     * @SWG\Response(response=200, description="access token")
     * @SWG\Parameter(name="client_id", in="formData", type="string")
     * @SWG\Parameter(name="client_secret", in="formData", type="string")
     * @SWG\Parameter(name="code", in="formData", type="string")
     * @SWG\Parameter(name="redirect_uri", in="formData", type="string")
     * @SWG\Parameter(name="state", in="formData", type="string")
     * @param Request $request
     * @return JsonResponse
     */
    public function accessToken(Request $request): JsonResponse
    {
        $responseData = $this->responseManager->createFromCode($request, 'access_token');

        return new JsonResponse($responseData->getBody(), $responseData->getStatusCode());
    }
}
