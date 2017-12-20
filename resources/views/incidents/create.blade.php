@extends('layouts.app')

@section('content')
<div class="panel panel-primary" style="box-shadow: 4px 3px 7px 1px black;">
    <div class="panel-heading">Crear Solicitud</div>

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
        
        <form action="" method="POST">
            {{  csrf_field()  }}

            <div class="form-group">
                <label for="category_id">Categoria</label>
                <select name="category_id" class="form-control" >
                    <option value="0">General</option>
                    @foreach( $categories as $category)
                       <option value="{{ $category->id }}">{{ $category->name }}</option>                       
                    @endforeach
                </select>                        
            </div>

            <div class="form-group">
                <label for="priority">Prioridad</label>
                    <select name="priority" class="form-control" value="{{  old('priority') }}">
                        <option value="B">Baja</option>
                        <option value="M">Media</option>
                        <option value="A">Alta</option>              
                    </select>                        
            </div>

            <div class="form-group">
                 <label for="title">Titulo</label>
                 <input type="text" name="title" placeholder="Coloque el tema" class="form-control" value="{{  old('title') }}">                        
             </div>

            <div class="form-group">
                <label for="description">Descripcion</label>
                <textarea name="description" rows="5" class="form-control" placeholder="Escriba una breve descripcion.." >{{  old('description') }}</textarea>                        
            </div>

            <div class="form-group">
                <button clas="btn btn-primary">Registrar Solcitud</button>
                                                   
            </div>
        </form>
    </div>
</div>
@endsection
