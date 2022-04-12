<?php

namespace App\Http\Factory\Models;

use App\Http\Factory\SimpleFactory;
use App\Models\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class OrderFactory implements SimpleFactory
{
    const CREATED = "CREATED";
    const PAYED = "PAYED";
    const REJECTED = "REJECTED";

    public static function init(array $data): Model
    {
        $model = new Order();
        $model->fill($data);
        $model->uuid = Str::uuid()->toString();
        $model->status = self::CREATED;
        return $model;
    }
}
