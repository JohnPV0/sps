@extends('template.master')
@section('contenido_principal')
    <!-- Start Contact Us Section -->
    <section id="contact" class="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title text-center wow fadeInDown" data-wow-duration="2s" data-wow-delay="50ms">
                        <h2>Cambiar contraseña</h2>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <form name="sentMessage" id="updateForm" method="POST" action="{{ route('actualizar.submit') }}"
                        novalidate>
                        @csrf
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-6 wow fadeInLeft" data-wow-duration="2s" data-wow-delay="600ms">
                                <div class="form-group">
                                    <input type="password" class="form-control" placeholder="Nueva contraseña *"
                                        id="password" name="password" value="{{ old('password') }}" required>
                                    <p class="help-block text-danger"></p>
                                    @error('password')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" placeholder="Verifica tu contraseña *"
                                        id="passwordV" name="passwordV" required>
                                    <p class="help-block text-danger"></p>
                                    @error('passwordV')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-lg-12 text-center wow zoomIn" data-wow-duration="1s" data-wow-delay="600ms">
                                <div id="success"></div>
                                <button type="submit" class="btn btn-primary">Cambiar contraseña</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            @if (isset($success))
                <div class="alert alert-success" role="alert" style="margin-top: 25px">
                    {{ $success }}
                </div>
            @endif
        </div>
    </section>
@endsection()
