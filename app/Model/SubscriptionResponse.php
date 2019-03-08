<?php

namespace App\Model;

/**
 * SubscriptionResponse class
 *
 * Estructura que contiene información para el método de pago suscripción
 */
class SubscriptionResponse extends AbstractModel
{
    /**
     * Estado de la suscripción
     *
     * @var Status
     */
    public $status;

    /**
     * Esta cadena dicta el tipo de suscripción que se devuelve, puede ser [token, cuenta]
     *
     * @var string
     */
    public $type;

    /**
     * Acorde con el tipo de suscripción los valore retornados puede cambiar y serán devueltos en la estructura de NameValuePair.
     *
     * token: [token, subtoken, franchise, franchiseName, lastDigits, validUntil]
     * account: [bankCode, bankName, accountType, accountNumber]
     *
     * @var NameValuePairs
     */
    public $instrument;
}