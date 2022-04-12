<?php

namespace App\Repositories;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class OrderProductRepository
{
    public static function list(): Collection
    {
        return DB::table('orders_products as op')
            ->select(['op.*'])
            ->get();
    }
}
