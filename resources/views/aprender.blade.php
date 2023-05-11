@extends('template.master')
@section('contenido_principal')

<!-- Start Header Section -->
<div class="page-header">
    <div class="overlay">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Aprender</h1>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Header Section -->

<!-- Start Blog Page Section -->
<div class="container">
    <div class="row">

        <!-- Start Blog Body Section -->
        <div class="col-md-8 blog-body">

            <!-- Start Blog post -->
            <div class="blog-post">
                <div class="post-img">
                <iframe width="560" height="315" src="https://www.youtube.com/embed/rvvyU7Wdv64" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                </div>
                <h1 class="post-title">Aprende a subnetear</h1>

                <p class="post-content">El subneteo es una técnica utilizada en redes de computadoras para dividir una red en subredes más pequeñas. Básicamente, implica tomar una red IP más grande y dividirla en segmentos más pequeños llamados subredes.

El objetivo principal del subneteo es mejorar la eficiencia en el uso de direcciones IP y facilitar la administración de la red. Al dividir una red en subredes más pequeñas, se pueden asignar rangos de direcciones IP específicos a cada subred, lo que permite un control más preciso de las direcciones disponibles y reduce la probabilidad de agotar las direcciones en una red grande.

Cada subred creada mediante el subneteo tiene su propia identificación de red y límite de direcciones IP únicas. Además, el subneteo también permite la segmentación lógica de la red, lo que puede mejorar el rendimiento y la seguridad al aislar diferentes partes de la red entre sí.</p>
            </div>
            <!-- End Blog Post -->
        </div>   
    </div>
</div>
<!-- End Blog Page Section -->


@endsection()