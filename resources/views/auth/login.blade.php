@extends('template.master')
@section("contenido_principal")
<br>
<br>
<!-- Start Contact Us Section -->
<section id="contact" class="contact">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title text-center wow fadeInDown" data-wow-duration="2s" data-wow-delay="50ms">
                    <h2>Iniciar sesión</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <form name="sentMessage" id="loginForm" method="POST" action="{{ route('login.submit') }}"
                    novalidate>
                    @csrf
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6 wow fadeInLeft" data-wow-duration="2s" data-wow-delay="600ms">
                            <div class="form-group">
                                <input type="email" class="form-control" placeholder="Correo Electrónico *"
                                    id="email" name="email" value="{{ old('email') }}" required
                                    data-validation-required-message="Please enter your email address.">
                                <p class="help-block text-danger"></p>
                                @if (session('email_error'))
                                    <div class="alert alert-danger">{{ session('email_error') }}</div>
                                @endif
                                @error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" placeholder="Contraseña *" id="password"
                                    name="password" required
                                    >
                                <p class="help-block text-danger"></p>
                                @error('password')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-lg-12 text-center wow zoomIn" data-wow-duration="1s" data-wow-delay="600ms">
                            <div id="success"></div>
                            <button type="submit" class="btn btn-primary">Iniciar sesión</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<br>
<br>
<br>
@endsection()