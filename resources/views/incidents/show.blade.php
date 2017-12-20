@extends('layouts.app')

@section('content')
<div class="panel panel-primary" style="box-shadow: 4px 3px 7px 1px black;">
    <div class="panel-heading">Ver Solicitud</div>

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
    
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Codigo</th>
                    <th>Requerimiento</th>
                    <th>Categoria</th>
                    <th>Fecha de envio</th> 
                </tr> 
            </thead>            
            <tbody>
                <tr>
                    <td >WEWDW-232321esas22</td>
                    <td >WEWDADX-erw224242</td>
                    <td >General</td>
                    <td >hace 3 meses</td>
                </tr>
            </tbody>
        </table>
    
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Asignada a</th>
                    <th>Visibilidad</th>
                    <th>Estado</th>
                    <th>Prioridad</th> 
                </tr> 
            </thead>
            
            <tbody>
                <tr>
                    <td id="incident-responsible">Juan Carlos</td>
                    <td >Publico</td>
                    <td id="incident-state">En progreso</td>
                    <td id="incident-priority">Alta</td>
                </tr>
            </tbody>
        </table>
       
    </div>
</div>
@endsection
