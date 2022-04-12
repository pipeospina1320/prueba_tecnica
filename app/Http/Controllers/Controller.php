<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function internalErrorResponse(Exception $e)
    {
        Log::error($e->getMessage());
        return response(['message' => 'Hubo un error al momento de realizar el proceso'], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}

