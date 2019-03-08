<?php

namespace App\Model;

/**
 * Amount class
 *
 * Describe el contenido de la cantidad completa, incluyendo impuestos y detalles
 */
class Amount extends AbstractModel
{
    /**
     * {@inheritDoc}
     *
     * @var string
     */
    public $currency;

    /**
     * {@inheritDoc}
     *
     * @var float
     */
    public $total;

    /**
     * Descripción de los impuestos
     *
     * @var TaxDetail[]
     */
    public $taxes;

    /**
     * Descripción del importe total
     *
     * @var AmountDetail[]
     */
    public $details;
}