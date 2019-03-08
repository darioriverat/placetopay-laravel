<?php

namespace App\Model;

/**
 * Auth class
 *
 * Estructura que contiene toda la información acerca de la transacción para ser procesada
 */
class Auth extends AbstractModel
{
    /**
     * @var string
     */
    public $login;

    /**
     * @var string
     */
    public $seed;

    /**
     * @var string
     */
    public $nonce;

    /**
     * @var string
     */
    public $tranKey;
}