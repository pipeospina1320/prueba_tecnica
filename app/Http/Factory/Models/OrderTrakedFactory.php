<?php

namespace App\Http\Factory\Models;

use App\Http\Factory\SimpleFactory;
use App\Models\OrderTraked;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class OrderTrakedFactory implements SimpleFactory
{
    const PENDING = "PENDING";
    const PAYED = "PAYED";
    const REJECTED = "REJECTED";

    public static function init(array $data): Model
    {
        $model = new OrderTraked();
        $model->fill($data);
        $model->date = Carbon::now();
        $model->status = self::PENDING;
        return $model;
    }
}
