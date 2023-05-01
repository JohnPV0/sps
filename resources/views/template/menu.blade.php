

<body>
    
    <header class="clearfix">
        <!-- Start  Logo & Naviagtion  -->
        <div class="navbar navbar-default navbar-top">
            <div class="container">
                <div class="navbar-header">
                    <!-- Stat Toggle Nav Link For Mobiles -->
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <i class="fa fa-bars"></i>
                    </button>
                    <!-- End Toggle Nav Link For Mobiles -->
                    <a class="navbar-brand" href="{{asset('/')}}">SPS</a>
                </div>
                <div class="navbar-collapse collapse">
                    
                    <!-- Start Navigation List -->
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            @if(request()->is('/'))
                                <a class="active" href="{{asset('/')}}">Inicio</a>
                            @else 
                                <a href="{{asset('/')}}">Inicio</a>
                            @endif
                        </li>
                        @if(Auth::check())
                        <li>
                            @if(request()->is('dashboard'))
                                <a class="active" href="{{route('dashboard')}}">Perfil</a>
                            @else 
                                <a href="{{route('dashboard')}}">Perfil</a>
                            @endif
                        </li>
                        @endif
                        <li>
                            @if(request()->is('descargar'))
                                <a class="active" href="{{asset('/descargar')}}">Descargar</a>
                            @else
                                <a href="{{asset('/descargar')}}">Descargar</a>
                            @endif
                        </li>
                        <li>
                            @if(request()->is('compras'))
                                <a class="active" href="{{ route('compras') }}">Comprar</a>
                            @else
                                <a href="{{ route('compras') }}">Comprar</a>
                            @endif
                        </li>
                        <li>
                            @if(!Auth::check())
                                
                                @if(request()->is('registrarse') || request()->is('registrarse/send'))
                                    <a class="active" href="{{ route('register') }}">Registrarse</a>
                                @else
                                    <a href="{{ route('register') }}">Registrarse</a>
                                @endif
                            @endif
                        </li>
                        @if(!Auth::check())
                            <li>
                                @if(request()->is('login'))
                                    <a class="active" href="{{ asset('/login') }}">Iniciar sesión</a>
                                @else
                                    <a href="{{ asset('/login') }}">Iniciar sesión</a>
                                @endif
                            </li>
                        @else
                        <li>
                            <a type="submit" href="{{ asset('/logout') }}"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar sesión</a>
                        </li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;" >
                            @csrf
                        </form>
                        @endif
                    </ul>
                    <!-- End Navigation List -->
                </div>
            </div>
        </div>
        <!-- End Header Logo & Naviagtion -->
        
    </header>