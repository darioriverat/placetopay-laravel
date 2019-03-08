<?php

namespace App\Model;

/**
 * RedirectResponse class
 *
 * Estructura que contiene la respuesta inicial desde el método createRequest
 */
class RedirectResponse extends AbstractModel
{
    /**
     * Estado de esta solicitud
     *
     * @var Status
     */
    public $status;

    /**
     * Referencia única de esta sesión
     *
     * @var integer
     */
    public $requestId;

    /**
     * URL para redireccionar el cliente para completar el proceso
     *
     * @var string
     */
    public $processUrl;
}