<?php
declare(strict_types=1);

namespace App\Controller\Stripe;

use App\ResponseManager\StripeResponseManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Swagger\Annotations as SWG;
use Nelmio\ApiDocBundle\Annotation\Security;

/**
 * Class SetupIntentsController
 * @package App\Controller
 * @Route("/stripe", name="stripe_setup_intents_", format="json", requirements={"_format":"json"})
 * @SWG\Tag(name="auth")
 * @SWG\Tag(name="github")
 */
class SetupIntentsController extends AbstractController
{
    private StripeResponseManager $responseManager;

    public function __construct(StripeResponseManager $responseManager)
    {
        $this->responseManager = $responseManager;
    }

    /**
     * @Route("/v1/setup_intents/{intent_id}", name="index", methods={"GET"})
     * @SWG\Response(response=200, description="Get intent")
     * @SWG\Parameter(name="Authorization", in="header", type="string")
     * @Security(name="Bearer")
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        $responseData = $this->responseManager->create($request, 'setup_intents');

        return new JsonResponse($responseData->getBody(), $responseData->getStatusCode());
    }
}
