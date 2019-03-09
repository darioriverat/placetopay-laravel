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
                <th>Estado</th>
                <th>Valor</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($requests as $request)
                <tr>
                    <td>{{ $request->date }}</td>
                    <td>{{ $request->reference }}</td>
                    <td>{{ $request->status }}</td>
                    <td>{{ $request->currency }} {{ number_format($request->total, 2) }}</td>
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