<?php

namespace App\Model;

/**
 * AmountConversion class
 *
 * Estructura para definir el factor de conversión y los valores
 */
class AmountConversion extends AbstractModel
{
    /**
     * Monto solicitado
     *
     * @var AmountBase
     */
    public $from;

    /**
     * Monto procesado por la entidad
     *
     * @var AmountBase
     */
    public $to;

    /**
     * Factor de conversión
     *
     * @var float
     */
    public $factor;
}