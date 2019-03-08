<?php

namespace App\Model;

/**
 * SubscriptionRequest class
 *
 * Estructura que contiene la información relacionada con una solicitud de suscripción para obtener un Token
 */
class SubscriptionRequest extends AbstractModel
{
    /**
     * Referencia única para la solicitud de suscripción
     *
     * @var string
     */
    public $reference;

    /**
     * Descripción de la suscripción
     *
     * @var string
     */
    public $description;

    /**
     * Información adicional relacionada con la suscripción
     *
     * @var NameValuePairs
     */
    public $fields;
}