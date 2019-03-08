<?php

namespace App\Model;

/**
 * AmountBase class
 *
 * Estructura que representa una cantidad que define la moneda y el total
 */
class AmountBase extends AbstractModel
{
    /**
     * Moneda acorde al ISO 4217
     *
     * @var string
     */
    public $currency;

    /**
     * Valor total
     *
     * @var float
     */
    public $total;
}