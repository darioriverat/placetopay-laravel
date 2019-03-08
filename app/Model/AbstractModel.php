<?php

namespace App\Model;

/**
 * AbstractModel class
 *
 * Clase abstracta para las estructuras del web checkout
 */
class AbstractModel
{
    /**
     * Constructor
     *
     * @param array $attributes
     */
    public function __construct(Array $attributes)
    {
        # asignación dinámica de atributos
        foreach ($attributes as $attribute => $value)
        {
            if (property_exists(get_class($this), $attribute))
                $this->{$attribute} = $value;
        }
    }
}