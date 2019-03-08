<?php

namespace App\Model;

/**
 * PaymentRequest class
 *
 * Estructura que contiene la información acerca del pago de la transacción requerida al servicio web
 */
class PaymentRequest extends AbstractModel
{
    /**
     * Única referencia para la solicitud de pago
     *
     * @var string
     */
    public $reference;

    /**
     * Descripción de la cuenta
     *
     * @var string
     */
    public $description;

    /**
     * Monto a ser cobrado
     *
     * @var Amount
     */
    public $amount;

    /**
     * Define si el monto a ser cobrado puede ser parcial.
     *
     * @var bool
     */
    public $allowPartial;

    /**
     * Información de la persona quien recibe el producto o servicio en la transacción.
     *
     * @var Person
     */
    public $shipping;

    /**
     * Productos relacionados con esta solicitud de pago
     *
     * @var Items
     */
    public $items;

    /**
     * Información adicional relacionada con la solicitud de pago que el comercio requiere guardar con la transacción
     *
     * @var NameValuePairs
     */
    public $fields;

    /**
     * Información recurrente cuando Place to Pay procesa un pago recurrente
     *
     * @var Recurring
     */
    public $recurring;
}