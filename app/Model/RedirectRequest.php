<?php

namespace App\Model;

/**
 * RedirectRequest class
 *
 * Estructura que contiene toda la información acerca de la transacción para ser procesada
 */
class RedirectRequest extends AbstractModel
{
    /**
     * Objeto de autenticación del la petición REST
     *
     * @var Auth
     */
    public $auth;

    /**
     * Definido con los códigos ISO 639 (language) y ISO 3166-1 alpha-2 (2-letras del país). ej. en_US, es_CO
     *
     * @var string
     */
    public $locale;

    /**
     * Información del ordenante, si establece este objeto, los datos del pagador utilizarán esta información
     *
     * @var Person
     */
    public $payer;

    /**
     * Información del comprador en la transacción
     *
     * @var Person
     */
    public $buyer;

    /**
     * Objeto de pago cuando necesite solicitar un cobro
     *
     * @var PaymentRequest
     */
    public $payment;

    /**
     * Objeto de suscripción utilizado cuando se necesita un tóken
     *
     * @var SubscriptionRequest
     */
    public $subscription;

    /**
     * Información adicional relacionada con la solicitud que el comercio requiere para guardar con la transacción
     *
     * @var NameValuePairs
     */
    public $fields;

    /**
     * Forzar el medio de pago en la interfaz de redirección, los códigos aceptados son los de la lista. Si necesita más de uno separarlos con coma. I.e. _ATH_,_PSE_,CR_VS
     *
     * @var string
     */
    public $paymentMethod;

    /**
     * Expiración de esta solicitud, el cliente debe terminar el proceso antes de esta fecha (i.e. 2016-07-22T15:43:25-05:00)
     *
     * @var dateTime
     */
    public $expiration;

    /**
     * URL para retornar cuando el cliente termine la operación
     *
     * @var string
     */
    public $returnUrl;

    /**
     * URL para retornar cuando el cliente aborte la operación
     *
     * @var string
     */
    public $cancelUrl;

    /**
     * Dirección IP del cliente
     *
     * @var string
     */
    public $ipAddress;

    /**
     * Agente de usuario informado por el cliente
     *
     * @var string
     */
    public $userAgent;
}