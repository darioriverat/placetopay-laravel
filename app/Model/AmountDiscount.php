<?php

namespace App\Model;

/**
 * AmountDiscount class
 *
 * ---
 */
class AmountDiscount extends AbstractModel
{
    /**
     * ---
     *
     * @var string
     */
    public $code;

    /**
     * ---
     *
     * @var string
     */
    public $type;

    /**
     * ---
     *
     * @var float
     */
    public $amount;

    /**
     * ---
     *
     * @var float
     */
    public $base;

    /**
     * ---
     *
     * @var float
     */
    public $percent;
}