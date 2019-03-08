<?php

namespace App\Model;

class Address extends AbstractModel
{
    /**
     * @var string
     */
    public $street;

    /**
     * @var string
     */
    public $city;

    /**
     * @var string
     */
    public $state;

    /**
     * @var string
     */
    public $postalCode;

    /**
     * @var string
     */
    public $country;

    /**
     * @var string
     */
    public $phone;
}