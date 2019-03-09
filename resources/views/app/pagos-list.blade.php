@extends('layout.bootstrap')

@section('title', 'Lista de Pagos')

@section('content')

<h2><i class="fas fa-clipboard-list"></i> Últimos pagos realizados</h2>

<?php if (count($requests)): ?>

    <table class="table table-striped table-bordered table-sm">
        <thead>
            <tr>
                <th>Fecha y hora</th>
                <th>Referencia</th>
                <th>Autorización/CUS</th>
                <th>Estado</th>
                <th>Valor</th>
                <th>Detalle</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($requests as $request)
                <tr>
                    <td>{{ $request->payment_date }}</td>
                    <td>{{ $request->payment_reference }}</td>
                    <td>{{ $request->payment_authorization }}</td>
                    <td>{{ $request->payment_status }}</td>
                    <td>{{ $request->payment_currency }} {{ number_format($request->payment_total, 2) }}</td>
                    <td>
                        <a href="{{ url('/confirmacion') .'/'. $request->id }}" class="btn btn-primary btn-sm">
                            Ver confirmación
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

<?php else: ?>
    <div class="alert alert-warning alert-light">
        <h4 class="alert-heading"><span class="glyphicon glyphicon-exclamation-sign"></span> Sin transacciones</h4>
        <p>Parece que aún no hay transacciones registradas.</p>
    </div>
<?php endif; ?>

@endsection('content')