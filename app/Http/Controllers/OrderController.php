<?php

namespace App\Http\Controllers;

use App\Http\Factory\Models\OrderFactory;
use App\Http\Requests\StoreOrderRequest;
use App\Repositories\OrderRepository;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Symfony\Component\HttpFoundation\Response;

class OrderController extends Controller
{
    /**
     * @return Application|ResponseFactory|\Illuminate\Http\Response
     */
    public function index()
    {
        $data = OrderRepository::list();
        return response($data, Response::HTTP_OK);
    }

    public function store(StoreOrderRequest $request)
    {
        try {
            $order = OrderFactory::init($request->validated());
            $order->save();
            return response($order, Response::HTTP_CREATED);
        } catch (Exception $exception) {
            return $this->internalErrorResponse($exception);
        }
    }
}
