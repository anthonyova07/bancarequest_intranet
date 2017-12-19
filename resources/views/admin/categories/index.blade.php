@extends('layouts.app')

@section('content')
<div class="panel panel-primary">
    <div class="panel-heading">Categorias</div>

    <div class="panel-body">
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
                 <label for="name">Nombre</label>
                 <input type="text" name="name" placeholder="Introduzca el nombre" class="form-control" value="{{  old('name') }}">                        
             </div>

             <div class="form-group">
                 <label for="description">Descripcion</label>
                 <input type="text" name="description" placeholder="Escriba una breve descripcion.." class="form-control" value="{{  old('description') }}">                        
             </div>

          
            <div class="form-group">
                <button clas="btn btn-primary">Registrar Categoria</button>
                                               
            </div>
        </form>

        <table class ="table table-bordered">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Categoria 1</td>
                    <td>Brindar soporte a los usuarios internos</td>
                    <td>
                        <a href="/categorias/{{$category->id}}" class="btn btn-sm btn-primary" title="Editar">
                            <span class="glyphicon glyphicon-pencil"></span>
                        </a>
                        <a href="" class="btn btn-sm btn-danger" title="Eliminar">
                            <span class="glyphicon glyphicon-remove"></span>
                        </a>               
                    </td>
                </tr>
            </tbody>



        </table>
    </div>
</div>
@endsection
