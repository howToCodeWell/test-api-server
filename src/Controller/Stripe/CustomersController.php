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

/**
 * Class CustomersController
 * @package App\Controller
 * @Route("/stripe", name="stripe_customers_", format="json", requirements={"_format":"json"})
 */
class CustomersController extends AbstractController
{
    private StripeResponseManager $responseManager;

    public function __construct(StripeResponseManager $responseManager)
    {
        $this->responseManager = $responseManager;
    }



    /**
     * @Route("/v1/customers/{customer_id}", name="index", methods={"GET", "POST"})
     * @SWG\Response(response=200, description="Get intent")
     * @SWG\Parameter(name="Authorization", in="header", type="string")
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        if ($request->isMethod('POST')) {
            $responseData = $this->responseManager->updateCustomer($request);
        } else {
            $responseData = $this->responseManager->getCustomer($request);
        }

        return new JsonResponse($responseData->getBody(), $responseData->getStatusCode());
    }
}
