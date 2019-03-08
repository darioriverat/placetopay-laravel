<?php

namespace App\Model;

/**
 * Item class
 *
 * Estructura que contiene los detalles del elemento
 */
class Item extends AbstractModel
{
    /**
     * Unidad en stock correspondiente (SKU) al artículo
     *
     * @var string
     */
    public $sku;

    /**
     * Nombre del artículo
     *
     * @var string
     */
    public $name;

    /**
     * Puede ser [digital, físical]
     *
     * @var string
     */
    public $category;

    /**
     * Número de un artículo en particular
     *
     * @var string
     */
    public $qty;

    /**
     * Costo del articulo
     *
     * @var float
     */
    public $price;

    /**
     * Impuesto del artículo
     *
     * @var float
     */
    public $tax;
}