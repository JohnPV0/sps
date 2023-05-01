@extends('template.master')
@section("contenido_principal")
<!-- Start Header Section -->
<div class="banner">
    <div class="overlay">
        <div class="container">
            <div class="intro-text">
                <h1>Sistema de Prácticas <span>de subneteo</span></h1>
                <p>Es una herramienta que te permitirá tener multiples ejercicios prácticos, también podrás aprender sobre el tema</p>
                <a href="{{ asset('/descargar') }}" class="page-scroll btn btn-primary">Descargar</a>
            </div>
        </div>
    </div>
</div>
<!-- End Header Section -->
@endsection()