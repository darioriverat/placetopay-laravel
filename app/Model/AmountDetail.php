<?php

namespace App\Model;

/**
 * AmountDetail class
 *
 * Estructura para almacenar información sobre el valor
 */
class AmountDetail extends AbstractModel
{
    /**
     * Valor de clasificación, puede ser [discount, additional, vatDevolutionBase, shipping, handlingFee, insurance, giftWrap, subtotal, fee, tip]
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
}