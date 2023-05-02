@extends('template.master')
@section("contenido_principal")

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="error-template text-center">
                <h1>Oops!</h1>
                <div class="error-details">
                    Ha ocurrido un error, por nuestra parte, por favor intentelo más tarde
                </div>
                <div class="error-actions">
                    <a href="{{ asset('/') }}" class="btn btn-primary btn-lg"><span
                            class="glyphicon glyphicon-home"></span>
                        Ir a la página principal </a>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<br><br>
@endsection()