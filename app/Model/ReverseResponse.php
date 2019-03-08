<?php

namespace App\Model;

/**
 * ReverseResponse class
 *
 * Estructura de respuesta a una solicitud de pago reversado
 */
class ReverseResponse extends AbstractModel
{
    /**
     * Estado de la solicitud será APROBADO si se ha realizado el reverso de lo contrario puede ser RECHAZADA
     *
     * @var Status
     */
    public $status;

    /**
     * Si el reverso fue exitoso, se almacena como una nueva transacción
     *
     * @var Transaction
     */
    public $payment;
}