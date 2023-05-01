@extends('template.master')
@section('contenido_principal')

    <!-- Start About-section 2 -->
    <section id="about-section-2">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title text-center wow fadeInDown" data-wow-duration="2s" data-wow-delay="50ms">
                        <h2>Mis compras y suscripciones</h2>
                    </div>
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-10 wow fadeInLeft" data-wow-duration="2s" data-wow-delay="300ms">

                    <!-- Start Accordion Section -->
                    <div class="panel-group" id="accordion">
                        @if ($suscripciones)
                        @foreach($suscripciones as $suscripcion)
                        <!-- Start Accordion 1 -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse-{{ $suscripcion['id'] }}" class="collapsed">
                                        <i class="fa fa-angle-left control-icon"></i> 
                                        <div style="display: block;">
                                            {{ strftime("%B %d, %Y", strtotime($suscripcion['start_date'])) }}
                                            @if($suscripcion['active'] == 1)
                                                <span class="label label-success">Activa</span>
                                            @else
                                                <span class="label label-danger">Inactiva</span>
                                            @endif
                                        </div>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse-{{ $suscripcion['id'] }}" class="panel-collapse collapse">
                                <div class="panel-body">
                                    Método de pago: {{ $suscripcion['payment_method'] }} <br>
                                    Fecha de inicio: {{ strftime("%B %d, %Y", strtotime($suscripcion['start_date'])) }} <br>
                                    Fecha de finalización: {{ strftime("%B %d, %Y", strtotime($suscripcion['end_date'])) }} <br>
                                    Total: {{ $suscripcion['amount'] }} <br>
                                    Moneda: {{ $suscripcion['currency'] }} <br>

                                </div>
                            </div>
                        </div>
                        <!-- End Accordion 1 -->
                        @endforeach
                        @else
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    No tienes suscripciones activas
                                </h4>
                            </div>
                        </div>
                        @endif

                    </div>
                    <!-- End Accordion section -->

                </div>
                <!--/.col-md-10 -->
            </div>
        </div>
    </section>
    <!-- Start About-section 2 -->
@endsection()
