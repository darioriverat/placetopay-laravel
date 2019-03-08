<?php

namespace App\Model;

/**
 * Recurring class
 *
 * Estructura que contiene la información requerida para una solicitud de pago recurrente
 */
class Recurring extends AbstractModel
{
    /**
     * Periodicidad de la factura [D, M, Y]
     *
     * @var string
     */
    public $periodicity;

    /**
     * Intervalo asociado a la periodicidad
     *
     * @var integer
     */
    public $interval;

    /**
     * Fecha del próximo pago
     *
     * @var date
     */
    public $nextPayment;

    /**
     * Número máximo de periodo (-1en caso de que no haya  restricción)
     *
     * @var integer
     */
    public $maxPeriods;

    /**
     * Fecha para finalizar el pago
     *
     * @var date
     */
    public $dueDate;

    /**
     * URL en el que el servicio notificará cada vez que se haga un pago recurrente
     *
     * @var string
     */
    public $notificationUrl;
}