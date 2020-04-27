<?php

namespace App\Controller;

use App\Entity\Order;
use App\Entity\Pizza;
use App\Entity\Topping;
use App\Service\ApiManager;
use App\Service\ResponseModel;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiController extends AbstractFOSRestController
{

    /**
     * @Rest\Get("/orders")
     *
     * @param ResponseModel $responseModel
     *
     * @return Response
     */
    public function getOrders(ResponseModel $responseModel)
    {
        $response = $responseModel->createFromClassName(Order::class);
        $view = $this->view($response->getData(), $response->getStatusCode());

        return $this->handleView($view);
    }

    /**
     * @Rest\Get("/orders/{id}")
     *
     * @param int $id
     *
     * @return Response
     */
    public function getOrder($id)
    {
        /** @var ResponseModel $response */
        $response = $this->getDoctrine()
            ->getRepository(Order::class)
            ->getSingleResultAsResponseModel($id);
        $view = $this->view($response->getData(), $response->getStatusCode());

        return $this->handleView($view);
    }

    /**
     * @Rest\Post("/orders")
     *
     * @param Request $request
     * @param ApiManager $apiManager
     *
     * @return Response
     */
    public function postOrder(Request $request, ApiManager $apiManager)
    {
        $createdOrder = $apiManager
            ->storeOrder(
                $request->get('customer'),
                $request->get('pizzas'),
                $request->get('phone')
            );

        $view = $this->view($createdOrder, 201);

        return $this->handleView($view);
    }

    /**
     * @Rest\Put("/orders")
     *
     * @param Request $request
     * @param ApiManager $apiManager
     *
     * @return Response
     */
    public function updateOrder(Request $request, ApiManager $apiManager)
    {
        $updatedOrder = $apiManager
            ->storeOrder(
                $request->get('customer'),
                $request->get('pizzas'),
                $request->get('phone'),
                $request->get('id')
            );

        $view = $this->view($updatedOrder, 200);

        return $this->handleView($view);
    }

    /**
     * @Rest\Get("/toppings")
     *
     * @param ResponseModel $responseModel
     *
     * @return Response
     */
    public function getToppings(ResponseModel $responseModel)
    {
        $response = $responseModel->createFromClassName(Topping::class);
        $view = $this->view($response->getData(), $response->getStatusCode());

        return $this->handleView($view);
    }

    /**
     * @Rest\Post("/toppings")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function postToppings(Request $request, ApiManager $apiManager)
    {
        $createdTopping = $apiManager
            ->storeTopping($request->get('name'));

        $view = $this->view($createdTopping, 201);

        return $this->handleView($view);
    }

    /**
     * @Rest\Get("/pizzas")
     *
     * @param ResponseModel $responseModel
     *
     * @return Response
     */
    public function getPizzas(ResponseModel $responseModel)
    {
        $response = $responseModel->createFromClassName(Pizza::class);
        $view = $this->view($response->getData(), $response->getStatusCode());

        return $this->handleView($view);
    }

    /**
     * @Rest\Post("/pizzas")
     *
     * @param Request $request
     * @param ApiManager $apiManager
     *
     * @return Response
     */
    public function postPizzas(Request $request, ApiManager $apiManager)
    {
        $createdTopping = $apiManager
            ->storePizza($request->get('name'), $request->get('toppings'));

        $view = $this->view($createdTopping, 201);

        return $this->handleView($view);
    }

}