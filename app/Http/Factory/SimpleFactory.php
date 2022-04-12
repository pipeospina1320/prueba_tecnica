<?php

namespace App\Http\Factory;

use Illuminate\Database\Eloquent\Model;

interface SimpleFactory
{
    public static function init(array $data): Model;
}
