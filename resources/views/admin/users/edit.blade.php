@extends('layouts.app')

@section('content')
<div class="panel panel-primary">
    <div class="panel-heading">Editar Usuario</div>

    <div class="panel-body">
        <!--Con esta sentencia if se valida si existe la variable de sesion llamada notification -->
        @if (session('notification'))
            <div class="alert alert-success fade in">
                <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
               <strong> {{ session('notification') }}</strong>
            </div>           
        @endif 
        <!--Con esta sentencia if se valida si el conteo de errores es mayor a 0 para luego mostrarlos en detalle en la pantalla -->
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{  $error  }}</li>
                    @endforeach
                </ul>
            </div>           
        @endif
        
        <form action="" method="POST">
            {{  csrf_field()  }}

            <div class="form-group">
                 <label for="email">E-mail</label>
                 <input type="email" name="email" placeholder="Introduzca su correo" class="form-control" readonly value="{{  old('email', $user->email) }}">                        
             </div>

             <div class="form-group">
                 <label for="name">Nombre</label>
                 <input type="text" name="name" placeholder="Introduzca su nombre" class="form-control" value="{{  old('name', $user->name) }}">                        
             </div>

            {{--  nuevo formulario de validacion de contrasena   --}}
            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" class="col-md-6 control-label">Contraseña<em> "Ingresar solo si desea modificar" </em></label>
                <input id="password" type="password" name="password" placeholder="Introduzca su Contraseña" class="form-control" value="{{  old('password') }}" required>

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif                
            </div>

            <div class="form-group">
                <label for="password-confirm" class="col-md-6 control-label">Confirmar Contraseña</label>
                <input id="password-confirm" type="password" class="form-control" placeholder="Confirme su Contraseña" name="password_confirmation" value="{{  old('password') }}" required>
                 
            </div>
           {{--  termina el forumulario de confirmacion de contrasena  --}}
            <div class="form-group">
                <button class="btn btn-primary">Actualizar Usuario</button>
                                               
            </div>
        </form>
        <form action="/requerimiento-usuario" method="POST">
            {{ csrf_field() }}
            <input type="hidden" name="user_id" value="{{ $user->id  }}">
            <div class="row">
                <div class="col-md-4">
                    <select name="requirement_id" class="form-control" id="select-requirement">
                        <option value="">Seleccione Requerimiento</option>
                        @foreach ($requirements as $requirement)
                            <option value="{{ $requirement->id }}">{{  $requirement->name  }}</option>
                        @endforeach
                    </select>                
                </div>
                <div class="col-md-4">
                    <select name="level_id" class="form-control" id="select-level">
                        <option value="">Seleccione Nivel</option>
                    </select>                
                </div>
                <div class="col-md-4">
                    <button class="btn btn-primary btn-block">Asignar Requerimiento</button>               
                </div>
            </div>
        </form>
        <p></p>       

        <table class ="table table-bordered">
            <thead>
                <tr>
                    <th>Proyecto</th>
                    <th>Nivel</th>                    
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($requirements_user as $requirement_user)
                <tr>
                    <td>{{ $requirement_user->requirement->name}}</td>
                    <td>{{ $requirement_user->level->name}}</td>
                    <td>                        
                        <a href="/requerimiento-usuario/{{ $requirement_user->id}}/eliminar" class="btn btn-sm btn-danger" title="Eliminar">
                            <span class="glyphicon glyphicon-remove"></span>
                        </a>               
                    </td>
                </tr>
                @endforeach
            </tbody>



        </table>
    </div>
</div>
@endsection

@section('scripts')
    <script src="/js/admin/users/edit.js"></script>
@endsection
