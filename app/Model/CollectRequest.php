<?php

namespace App\Model;

/**
 * CollectRequest class
 *
 * Estructura que representa la información para realizar el cobro en base a un medio de pago suscrito
 */
class CollectRequest extends AbstractModel
{
    /**
     * Datos del titular del medio de pago almacenado
     *
     * @var Person
     */
    public $payer;

    /**
     * Objeto de pago cuando necesite solicitar un cobro
     *
     * @var PaymentRequest
     */
    public $payment;

    /**
     * Datos asociados al medio de pago suscrito
     *
     * @var Instrument
     */
    public $instrument;
}