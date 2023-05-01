@extends('template.master')
@section('contenido_principal')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Hubo un error al procesar el pago</h1>
                <p>Por favor, intente de nuevo.</p>
                <h2><a href="{{ route('compras') }}"> Regresar </a></h2>
            </div>
        </div>
    </div>
@endsection()