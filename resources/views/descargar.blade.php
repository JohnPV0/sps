@extends('template.master')
@section("contenido_principal")

     <!-- Start About Us Section -->
     <section id="about-section" class="about-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title text-center wow fadeInDown" data-wow-duration="2s" data-wow-delay="50ms">
                        <h2>Descargar</h2>
                    </div>                        
                </div>
            </div>
            <div class="row">
               <div class="col-md-12">
                   <div class="about-text">
                       <p>Primera versión de SPS</p>
                       <p>Puedes descaragar lo aqui    <a href="https://mega.nz/file/IKAjkQCA#zfsG_WYGrPNz2S9Tc3t861Q60AMgPwkqNR8c-gbEqqk">Descargar SPS</a></p>
                        <p>Tal vez tabién necesites descargar <a href="https://java-runtime-environment.softonic.com/descargar">Java Runtime 1.8.0</a></p>
                    </div>
                   
                   <div class="about-list">
                       <h4>Características</h4>
                       <ul>
                           <li><i class="fa fa-check-square"></i>Podrás aprender a subnetear de manera gratuita</li>
                           <li><i class="fa fa-check-square"></i>Si quieres practicar con ejercicios necesitarás adquirir una licencia en <a href="{{ asset('compras') }}">Comprar</a></li>
                           <li><i class="fa fa-check-square"></i>Necesitas crear una cuenta de manera gratuita para cualquiera de ambos casos</li>
                            <li><i class="fa fa-check-square"></i>No guardamos tus datos de compra, y es seguro mediante Paypal</li>
                        </ul>
                       
                   </div>
                   
               </div>
                
                
                
            </div>
        </div>
    </section>

@endsection()