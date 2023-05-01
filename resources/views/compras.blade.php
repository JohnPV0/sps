@extends('template.master')
@section('contenido_principal')
    <!-- Start Pricing Section -->
    <section id="pricing-section" class="pricing-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title text-center wow fadeInDown" data-wow-duration="2s" data-wow-delay="50ms">
                        <h2>Precio SPS</h2>
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-md-4">

                </div>
                <div class="col-md-4">
                    <div class="pricing">
                        <div class="pricing-header">
                            <i class="fa fa-bars"></i>
                        </div>
                        <div class="pricing-body">
                            <h3 class="pricing-title">Suscripción</h3>
                            <p>Es una suscripción semestral en la que podrá practicar y tene acceso a multiples ejercicios
                                de subneteo</p>
                            @if ($suscription == false)
                                <form action="{{ route('payment') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">$6.99USD / 6MESES pagar con PayPal</button>
                                </form>
                            @else 
                                <div class="alert alert-success">Usted ya tiene una suscripción activa, finaliza {{ $end_date }}</div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-4">

                </div>
            </div>
        </div>
    </section>
    <!-- End Pricing Section -->
@endsection()
