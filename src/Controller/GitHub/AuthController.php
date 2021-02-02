<?php
declare(strict_types=1);

namespace App\Controller\GitHub;

use App\ResponseManager\GitHubResponseManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
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
     * @todo this should be in config
     */
    private array $responseData = [
        'authorize' => [
            [
                'request' => [
                    'state' => 'abcd',
                ],
                'response' => [
                    'state' => 'abcd',
                    'code' => '1234',
                ],
            ],
            [
                'request' => [
                    'state' => 'state-should-not-match',
                ],
                'response' => [
                    'state' => 'state-does-not-match',
                    'code' => '1234x',
                ],
            ],
        ],
    ];

    /**
     * @Route("/login/oauth/authorize", name="authorize")
     * @param Request $request
     * @return JsonResponse
     */
    public function authorize(Request $request): JsonResponse
    {
        $state = $request->get('state', 'abcd');
        $code = 'abcd';

        // Get the response based on the request
        foreach ($this->responseData['authorize'] as $data) {
            if ($data['request']['state'] === $state) {
                $code = $data['response']['code'];
                $state = $data['response']['state'];
            }
        }

        return new JsonResponse(
            [
                'code' => $code,
                'state' => $state,
            ]
        );
    }

    /**
     * @Route("/login/oauth/access_token", name="access_token")
     * @param Request $request
     * @return JsonResponse
     */
    public function accessToken(Request $request): JsonResponse
    {
        $responseData = $this->responseManager->createFromCode($request, 'access_token');

        return new JsonResponse($responseData->getBody(), $responseData->getStatusCode());
    }
}
