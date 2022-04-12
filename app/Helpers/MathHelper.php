<?php

namespace App\Helpers;

class MathHelper
{

    public static function multiplicar($operadorIzquierda = 0, $operadorDerecha = 0): string
    {
        return bcmul($operadorIzquierda, $operadorDerecha, 6);
    }
}
