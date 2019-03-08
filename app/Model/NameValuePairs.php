<?php

namespace App\Model;

/**
 * NameValuePairs class
 *
 * Posee una matriz de NameValuePair con información
 */
class NameValuePairs extends AbstractModel
{
    /**
     * Referencia única para la solicitud de pago
     *
     * @var NameValuePair[]
     */
    public $item;
}