<?php

namespace App\Model;

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