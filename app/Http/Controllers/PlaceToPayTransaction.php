<?php

namespace App\Http\Controllers;

use App\Repositories\OrderRepository;
use App\Repositories\OrderTrakedRepository;
use App\Services\ClientTransactionOrigins\ClientRequest\PlaceToPay\CreateSessionRequest;
use App\Services\ClientTransactionOrigins\ClientRequest\PlaceToPay\GetInformationSessionRequest;
use App\Services\ClientTransactionOrigins\ClientResponse\PlaceToPay\PlaceToPayResponse;
use App\Services\OrderTraked\OrderTrakedService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class PlaceToPayTransaction extends Controller
{
    public function createSession(Request $request)
    {
        $uuidOrder = $request->get('order');
        $order = OrderRepository::getByUuid($uuidOrder);
        if (!$order) {
            return response(['message' => 'Registro no encontrado'], Response::HTTP_NOT_FOUND);
        }
        DB::beginTransaction();
        try {
            $client = new CreateSessionRequest();
            $resp = $client->createSession($order);
            OrderTrakedService::store($order, new PlaceToPayResponse($resp));
            DB::commit();
            return response($resp, Response::HTTP_CREATED);
        } catch (\Exception $exception) {
            DB::rollBack();
            return $this->internalErrorResponse($exception);
        }
    }

    public function transactionStatus(Request $request)
    {
        $uuidOrder = $request->get('order');
        $order = OrderRepository::getByUuid($uuidOrder);
        if (!$order) {
            return response(['message' => 'Registro no encontrado'], Response::HTTP_NOT_FOUND);
        }

        $lastOrderTransaction = OrderTrakedRepository::getLastTransaction($order->id, $order->code_transaction);
        if (!$lastOrderTransaction) {
            return response(['message' => 'Transaccion no encontrada  no encontrado'], Response::HTTP_NOT_FOUND);
        }
        try {
            $client = new GetInformationSessionRequest();
            $resp = $client->getRequestInformation($lastOrderTransaction->code_transaction);
            $status = new PlaceToPayResponse($resp);
            OrderTrakedService::update($order, new PlaceToPayResponse($resp));
            return response([
                'message' => $status->getTransactionStatusMessage()
            ], Response::HTTP_OK);
        } catch (\Exception $exception) {
            return $this->internalErrorResponse($exception);
        }
    }
}
