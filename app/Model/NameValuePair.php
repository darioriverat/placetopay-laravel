<?php

namespace App\Model;

/**
 * NameValuePair class
 *
 * Se utiliza para definir un tipo de par clave-valor
 */
class NameValuePair extends AbstractModel
{
    /**
     * Clave para el par de valores del dato
     *
     * @var string
     */
    public $keyword;

    /**
     * Valor para el par de datos
     *
     * @var string
     */
    public $value;

    /**
     * Bajo qué circunstancias el campo debe ser mostrado en la interfaz de redirección [none, payment, receipt, both]
     *
     * @var string
     */
    public $displayOn;
}