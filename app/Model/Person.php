<?php

namespace App\Model;

class Person extends AbstractModel
{
    /**
     * CC, CE, TI, SSN, NIT, PPN
     *
     * @var string
     */
    public $documentType;

    /**
     * @var string
     */
    public $document;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $surname;

    /**
     * @var string
     */
    public $company;

    /**
     * @var string
     */
    public $email;

    /**
     * @var Address
     */
    public $address;

    /**
     * @var string
     */
    public $mobile;
}