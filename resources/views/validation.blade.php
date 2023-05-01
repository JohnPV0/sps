@extends('template.master')
@section('contenido_principal')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>{{ $title }}</h1>
            @if(isset($success))
                <p>{{ $success }}</p>
                <h2></h2><a href="{{ route('login') }}">Iniciar sesión</a></h2>
            @else
                <p>{{ $error }}</p>
                <h2><a href="{{ asset('/') }}">Regresar</a></h2>
            @endif
        </div>
    </div>
</div>
@endsection()