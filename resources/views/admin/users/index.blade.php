@extends('layouts.app')

@section('content')
<div class="panel panel-primary" style="box-shadow: 4px 3px 7px 1px black;">
    <div class="panel-heading">Usuarios</div>

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
                 <label for="email">Email</label>
                 <input type="email" name="email" placeholder="Introduzca su correo electronico" class="form-control" value="">                        
             </div>

            <div class="form-group">
                 <label for="name">Nombre</label>
                 <input type="text" name="name" placeholder="Introduzca su nombre" class="form-control" value="{{  old('name') }}">                        
             </div>                 

             {{--  <div class="form-group">
                 <label for="password">Contraseña</label>
                 <input type="text" name="password" placeholder="Introduzca su Contraseña" class="form-control" value="{{  old('password', str_random(6)) }}">                        
             </div>  --}}

             {{--  nuevo formulario de validacion de contrasena   --}}
            
            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" class="col-md-6 control-label">Contraseña</label>
                <input type="password" name="password" placeholder="Introduzca su Contraseña" class="form-control" value="" required>

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif                
            </div>

            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                <label for="password_confirmation" class="col-md-6 control-label">Confirmar Contraseña</label>
                <input type="password" class="form-control" placeholder="Confirme su Contraseña" name="password_confirmation" value="" required>
                 
            </div>
           {{--  termina el forumulario de confirmacion de contrasena  --}}
          
            <div class="form-group">
                <button class="btn btn-primary">Guardar Usuario</button>
                                               
            </div>
        </form>

        <table class ="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>E-mail</th>
                    <th>Nombre</th>
                    <th>Opciones</th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->name}}</td>    
                    <td>
                        <a href="/usuario/{{ $user->id }}" class="btn btn-sm btn-primary" title="Editar">
                            <span class="glyphicon glyphicon-pencil"></span>
                        </a>
                        <a href="/usuario/{{ $user->id }}/eliminar" onclick="return confirm('Seguro que quiere eliminar este usuario?')" class="btn btn-sm btn-danger" title="Eliminar" >
                            <span class="glyphicon glyphicon-remove" ></span>
                        </a>               
                    </td>
                </tr>
                @endforeach
            </tbody>



        </table>
    </div>
</div>
@endsection
