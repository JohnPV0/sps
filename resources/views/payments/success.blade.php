@extends('template.master')
@section("contenido_principal")

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Pago realizado con exito, tu número de transaccion es: {{ $payment_id }}</h1>
            <h2><a href="{{ route('compras') }}"> Regresar </a></h2>
        </div>
    </div>
</div>

@endsection()