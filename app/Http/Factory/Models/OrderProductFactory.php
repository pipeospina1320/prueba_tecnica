<?php

namespace App\Http\Factory\Models;

use App\Helpers\MathHelper;
use App\Http\Factory\SimpleFactory;
use App\Models\OrderProduct;
use Illuminate\Database\Eloquent\Model;

class OrderProductFactory implements SimpleFactory
{

    public static function init(array $data): Model
    {
        $model = new OrderProduct();
        $model->fill($data);
        self::setTotal($model);
        return $model;
    }

    private static function setTotal(OrderProduct &$orderProduct)
    {
        $product = $orderProduct->product;
        $orderProduct->unit_price = $product->price;
        $orderProduct->total = MathHelper::multiplicar($orderProduct->unit_price, $orderProduct->amount);
    }
}
