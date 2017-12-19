<div class="panel panel-primary" style="box-shadow: 4px 3px 7px 1px black;">
    <div class="panel-heading">Menu</div>

    <div class="panel-body">
        <ul class="nav nav-pills nav-stacked">
            @if (auth()->check())
                <li @if(request()->is('home')) class="active" @endif>
                    <a href="/home">Dashboard</a>
                </li>
                
                <li @if(request()->is('reportar')) class="active" @endif>
                    <a href="/reportar">Crear Solicitud</a>
                </li>
                
                @if(! auth()->user()->is_client)
                <li  @if(request()->is('ver_reportes')) class="active" @endif>
                    <a href="/ver_reportes">Ver Solicitudes</a>
                </li>
                @endif
                
                
                @if(auth()->user()->is_admin)
                <li role="presentation" class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    Administracion <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li @if(request()->is('usuarios')) class="active" @endif><a href="/usuarios">Usuarios</a></li>
                        {{--  <li @if(request()->is('categorias')) class="active" @endif><a href="/categorias">Categorias</a></li>  --}}
                        <li @if(request()->is('requerimientos')) class="active" @endif><a href="/requerimientos">Requerimientos</a></li>
                        <li @if(request()->is('config')) class="active" @endif><a href="/config">Configuracion</a></li>
                    </ul>
                </li>
                @endif
            @else
                <li><a href="/">Bienvenido</a></li>
                <li><a href="/instrucciones">Instrucciones</a></li>               
            @endif
        </ul>
    </div>
</div>

