<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}">
                CNEA
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                @if(Auth::check())
                    <li @if(Route::is('usuarios.*')) class="active" @endif><a href="{{ route('usuarios.index') }}"><i class="fa fa-users"> Usuarios</i></a></li>
                    <li @if(Route::is('tags.*')) class="active" @endif><a href="{{ route('tags.index') }}"><i class="fa fa-tags"> Tags</i></a></li>
                    <li @if(Route::is('instrumentos.*')) class="active" @endif><a href="{{ route('instrumentos.index') }}"><i class="fa fa-compass"> Instrumentos</i></a></li>
                    <li @if(Route::is('cursos.*')) class="active" @endif><a href="{{ route('cursos.index') }}"><i class="fa fa-graduation-cap"> Cursos</i></a></li>
                    <li @if(Route::is('laboratorios.*')) class="active" @endif><a href="{{ route('laboratorios.index') }}"><i class="fa fa-flask"> Laboratorios</i></a></li>
                    <li @if(Route::is('prestamos.*')) class="active" @endif><a href="{{ route('prestamos.index') }}"><i class="fa fa-share-alt"> Prestamos</i></a></li>
                @endif
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (!Auth::check())
                    <li><a href="{{ url('/login') }}">Iniciar Sesión</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ route('perfil.edit',Auth::user()->id) }}"><i class="fa fa-edit"> Modificar mis datos</i></a></li>
                            <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>