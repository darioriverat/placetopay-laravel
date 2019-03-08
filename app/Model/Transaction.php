<?php

namespace App\Model;

/**
 * Transaction class
 *
 * Estructura que contiene información sobre el proceso de pago de la transacción en Place to Pay
 */
class Transaction extends AbstractModel
{
    /**
     * Estado de la transacción
     *
     * @var Status
     */
    public $status;

    /**
     * Referencia interna en Place to Pay
     *
     * @var integer
     */
    public $internalReference;

    /**
     * Código del método de pago utilizado
     *
     * @var string
     */
    public $paymentMethod;

    /**
     * Nombre del método de pago utilizado
     *
     * @var string
     */
    public $paymentMethodName;

    /**
     * Nombre del emisor o del procesador
     *
     * @var string
     */
    public $issuerName;

    /**
     * Valor procesado
     *
     * @var AmountConversion
     */
    public $amount;

    /**
     * Código de autorización
     *
     * @var string
     */
    public $authorization;

    /**
     * ---
     *
     * @var string
     */
    public $reference;

    /**
     * ---
     *
     * @var string
     */
    public $description;

    /**
     * ---
     *
     * @var string
     */
    public $receipt;

    /**
     * ---
     *
     * @var string
     */
    public $franchise;

    /**
     * ---
     *
     * @var string
     */
    public $refunded;

    /**
     * ---
     *
     * @var AmountDiscount
     */
    public $discount;

    /**
     * Campos adicionales del procesador
     *
     * @var NameValuePairs
     */
    public $processorFields;
}