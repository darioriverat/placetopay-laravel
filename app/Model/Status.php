<?php

namespace App\Model;

/**
 * Status class
 *
 * Estructura que contiene la información sobre una solicitud o pago, informa al estado actual de la misma
 */
class Status extends AbstractModel
{
    /**
     * Estado proporcionado, podría ser uno de esos:
     * [OK, FAILED, APPROVED, APPROVED_PARTIAL, REJECTED, PENDING, PENDING_VALIDATION, REFUNDED]
     *
     * @var string
     */
    public $status;

    /**
     * Código de motivo proporcionado
     *
     * @var string
     */
    public $reason;

    /**
     * Descripción del código de razón
     *
     * @var string
     */
    public $message;

    /**
     * Fecha y hora de este estado
     *
     * @var dateTime
     */
    public $date;
}