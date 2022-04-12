<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderTraked extends Model
{
    use HasFactory;

    protected $table = 'orders_traked';

    protected $fillable = [
        'date',
        'order_id',
        'code_transaction',
        'order_id',
        'status',
    ];
}
