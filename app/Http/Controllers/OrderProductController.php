<?php

namespace App\Http\Controllers;

use App\Http\Factory\Models\OrderProductFactory;
use App\Http\Requests\StoreOrderProductRequest;
use App\Repositories\OrderRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Symfony\Component\HttpFoundation\Response;
use Exception;

class OrderProductController extends Controller
{
    /**
     * @return Application|ResponseFactory|\Illuminate\Http\Response
     */
    public function index()
    {
        $data = OrderRepository::list();
        return response($data, Response::HTTP_OK);
    }

    public function store(StoreOrderProductRequest $request)
    {
        try {
            $orderProduct = OrderProductFactory::init($request->validated());
            $orderProduct->save();
            return response($orderProduct, Response::HTTP_CREATED);
        } catch (Exception $exception) {
            return $this->internalErrorResponse($exception);
        }
    }
}
