@extends('layout.bootstrap')

@section('title', 'Confirmación del pago')

@section('content')

<h2><i class="far fa-credit-card"></i> Confirmación del pago</h2>

<table class="table table-striped table-bordered table-sm">
    <thead>
        <tr>
            <th>Label</th>
            <th>Información</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th>Razón social</th>
            <td><strong>RAZON SOCIAL COMERCIO</strong></td>
        </tr>
        <tr>
            <th>NIT</th>
            <td><strong>NIT COMERCIO</strong></td>
        </tr>
        <tr>
            <th>Fecha y hora</th>
            <td><?= $information->payment[0]->status->date ?></td>
        </tr>
        <tr>
            <th>Estado</th>
            <td><?= $information->payment[0]->status->status ?></td>
        </tr>
        <tr>
            <th>Motivo</th>
            <td><?= $information->payment[0]->status->reason ?> - <?= $information->payment[0]->status->message ?></td>
        </tr>
        <tr>
            <th>Valor</th>
            <td>
                <?= $information->payment[0]->amount->from->currency ?>
                <?= number_format($information->payment[0]->amount->to->total, 2) ?>
            </td>
        </tr>
        <tr>
            <th>IVA</th>
            <td>-</td>
        </tr>
        <tr>
            <th>Franquicia</th>
            <td><?= $information->payment[0]->franchise ?></td>
        </tr>
        <tr>
            <th>Banco</th>
            <td><?= $information->payment[0]->issuerName ?></td>
        </tr>
        <tr>
            <th>Autorización / CUS</th>
            <td><?= $information->payment[0]->authorization ?></td>
        </tr>
        <tr>
            <th>Recibo</th>
            <td><?= $information->payment[0]->internalReference ?></td>
        </tr>
        <tr>
            <th>Referencia</th>
            <td><?= $information->payment[0]->reference ?></td>
        </tr>
        <tr>
            <th>Descripción</th>
            <td><?= $information->request->payment->description ?></td>
        </tr>
        <tr>
            <th>Dirección IP</th>
            <td><?= $information->request->ipAddress ?></td>
        </tr>
        <tr>
            <th>Cliente</th>
            <td><?= $information->request->payer->name ?> <?= $information->request->payer->surname ?></td>
        </tr>
        <tr>
            <th>Email</th>
            <td><?= $information->request->payer->email ?></td>
        </tr>
    </tbody>
</table>

<?php if ($information->payment[0]->status->status == 'APPROVED'): ?>

    <a href="<?= url('/') ?>" class="btn btn-success">
        <i class="fas fa-undo-alt"></i> Voler al inicio
    </a>

<?php elseif ($information->payment[0]->status->status == 'PENDING'): ?>

    En este momento su orden de compra #<?= $information->payment[0]->reference ?> presenta
    un proceso de pago cuya transacción se encuentra PENDIENTE de recibir
    confirmación por parte de su entidad financiera, por favor espere unos minutos y vuelva
    a consultar más tarde para verificar si su pago fue confirmado de forma exitosa. Si
    desea mayor información sobre el estado actual de su operación puede comunicarse a
    nuestras líneas de atención al cliente <strong>TELEFONO CONTACTO</strong> o enviar un correo
    electrónico a <strong>EMAIL</strong> y preguntar por el estado de la transacción:
    #<?= $information->payment[0]->authorization ?>***.

<?php endif; ?>

@endsection('content')