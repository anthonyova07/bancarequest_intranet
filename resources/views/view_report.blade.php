@extends('layouts.app')

@section('content')
<div class="panel panel-primary" style="box-shadow: 4px 3px 7px 1px black;">
    <div class="panel-heading">Ver Solicitudes  </div>

    <div class="panel-body">
     <!--Con esta sentencia if se valida si existe la variable de sesion llamada notification -->
        @if (session('notification'))
            <div class="alert alert-success fade in">
            <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
               <strong> {{ session('notification') }}</strong>
            </div>           
        @endif 

        @if (count($errors) > 0)
            <div class="alert alert-danger fade in">
            <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <ul>
                    @foreach ($errors->all() as $error)
                        <strong><li>{{  $error  }}</li></strong>
                    @endforeach
                </ul>
            </div>           
        @endif

        <table class ="table table-bordered">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                {{--  @foreach($categories as $category)  --}}
                <tr>
                    <td>Solicitud 1</td>
                    <td>Descripcion 1</td>                    
                    <td>
                        
                        {{--  @if ($category->trashed())  --}}
                        <a href="" onclick="return confirm('Seguro que quieres restarurar este requerimiento?')" class="btn btn-sm btn-success" title="Restaurar">
                            <span class="glyphicon glyphicon-repeat"></span>
                        </a>  

                        {{--  @else  --}}
                        <a href="" class="btn btn-sm btn-primary" title="Editar">
                            <span class="glyphicon glyphicon-pencil"></span>
                        </a>

                        <a href="" onclick="return confirm('Seguro que quieres eliminar este requerimiento?')" class="btn btn-sm btn-danger" title="Eliminar">
                            <span class="glyphicon glyphicon-remove"></span>
                        </a>                        
                        {{--  @endif     --}}

                    </td>
                </tr>
                {{--  @endforeach  --}}
            </tbody>



        </table>
    </div>
</div>



@endsection
