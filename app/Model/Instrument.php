<?php

namespace App\Model;

/**
 * Instrument class
 *
 * Estructura que contiene los detalles de un medio de pago suscrito
 */
class Instrument extends AbstractModel
{
    /**
     * Datos asociados a una tarjeta de crédito tokenizada
     *
     * @var SimpleToken
     */
    public $token;
}