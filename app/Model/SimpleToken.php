<?php

namespace App\Model;

/**
 * SimpleToken class
 *
 * Estructura que contiene los detalles de un token previamente obtenido mediante un proceso de suscripción,
 * se debe enviar el token o el subtoken en los casos que se habilite, no es necesario enviar ambos
 */
class SimpleToken extends AbstractModel
{
    /**
     * Token completo para tarjeta de crédito, debe ser usada para solicitar cualquier transacción a Place to Pay
     *
     * @var string
     */
    public $token;

    /**
     * Representación numérica del Token para casos donde es requerido un número adicional que parece como una tarjeta de crédito, 
     * los últimos 4 dígitos son iguales a los últimos 4 dígitos de la tarjeta de crédito
     *
     * @var string
     */
    public $subtoken;

    /**
     * Número de cuotas en las cuales se solicita el cobro (opcional)
     *
     * @var integer
     */
    public $installments;

    /**
     * Dígitos del código de seguridad de la tarjeta a usar en los casos en los que sea necesario, generalmente se deja en blanco si se tiene una terminal sin validación de CVV
     *
     * @var string
     */
    public $cvv;
}