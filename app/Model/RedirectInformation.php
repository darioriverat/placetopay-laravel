<?php

namespace App\Model;

/**
 * RedirectInformation class
 *
 * Información de estado de la operación
 */
class RedirectInformation extends AbstractModel
{
    /**
     * Estado de esta solicitud, debe observar el estado interno de cada objeto
     *
     * @var Status
     */
    public $status;

    /**
     * Información con la solicitud original
     *
     * @var RedirectRequest
     */
    public $request;

    /**
     * Información relacionada con el pago si este fue solicitado
     *
     * @var Transaction[]
     */
    public $payment;

    /**
     * Información relacionado con la suscripción si esta fue solicitada
     *
     * @var SubscriptionResponse
     */
    public $subscription;
}