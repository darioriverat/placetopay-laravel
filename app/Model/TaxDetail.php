<?php

namespace App\Model;

/**
 * TaxDetail class
 *
 * Estructura para almacenar información sobre un impuesto
 */
class TaxDetail extends AbstractModel
{
    /**
     * Valor de clasificación, puede ser [valueAddedTax, exciseDuty]
     *
     * @var string
     */
    public $kind;

    /**
     * Valor discriminado
     *
     * @var float
     */
    public $amount;

    /**
     * Valor base
     *
     * @var float
     */
    public $base;
}