<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" 
            data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">NetwarMonitor</a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                @guest
                    <li class=""><a class="nav-link" href="{{ route('login') }}">Iniciar sesión</a></li>
                    <li><a class="nav-link" href="{{ route('register') }}">Registrate</a></li>
                @else
                    <li class="">
                        <a href="/contacts">Contactos</a>
                    </li>
                    <li class="">
                        <a href="/appointments">Citas</a>
                    </li>
                    <li class="">
                        <a href="/about-me">Acerca de</a>
                    </li>
                    <ul class="nav navbar-nav pull-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                            aria-haspopup="true" aria-expanded="false"> {{ Auth::user()->name }}  <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="/profile"><i class="fa fa-user"></i> Mi Perfil </a></li>
                                <li role="separator" class="divider"></li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="fa fa-power-off"></i> Salir
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                        
                    </ul>
                    
                @endguest
            </ul>
            
        </div>

    </div>

</nav>