<?php

namespace App\Repositories;

use App\Models\Order;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class OrderRepository
{
    public static function list(): Collection
    {
        return DB::table('orders as o')
            ->select(['o.*'])
            ->get();
    }

    public static function getByUuid($uuid): ?Order
    {
        return Order::where('uuid', $uuid)->first();
    }
}
