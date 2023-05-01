@extends('template.master')
@section('contenido_principal')
    
    <!-- Start Header Section -->
    <div class="page-header">
        <div class="overlay">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1>Bienvenido, {{ $user['name'] }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Header Section -->

    <!-- Start About-section 2 -->
    <section id="about-section-2">
        <div class="container">
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10 wow fadeInLeft" data-wow-duration="2s" data-wow-delay="300ms">

                    <!-- Start Accordion Section -->
                    <div class="panel-group" id="accordion">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse-1" class="collapsed">
                                        <i class="fa fa-angle-left control-icon"></i>Mostrar mis datos
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse-1" class="panel-collapse collapse">
                                <div class="panel-body">
                                    Nombre: {{ $user['name'] }} <br>
                                    Email: {{ $user['email'] }} <br>
                                    

                                </div>
                            </div>
                        </div>


                    </div>
                    <!-- End Accordion section -->

                </div>
                <!--/.col-md-6 -->
            </div>
        </div>
    </section>
    <!-- Start About-section 2 -->

    <!-- Start Service Section -->
    <section id="service-section">
        <div class="container">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-3">
                    <div class="services-post">
                        <a href="{{ route('actualizar') }}"><i class="fa fa-lock"></i></a>
                        <h2>CAMBIAR CONTRASEÑA</h2>
                        <p>Aquí podrás cambiar tu contraseña</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="services-post">
                        <a href="{{ route('suscripciones') }}"><i class="fa fa-credit-card"></i></a>
                        <h2>MIS COMPRAS Y SUSCRIPCIONES</h2>
                        <p>Informacion relacionada a tus compras y suscripciones</p>
                    </div>
                </div>
                
            </div>
        </div>
    </section>
    <!-- Start Service Section -->
@endsection()
