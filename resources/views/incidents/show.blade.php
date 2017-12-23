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
                    <td id="incident_key"> {{ $incident->id }}  </td> 
                    <td id="incidente_requirement"> {{ $incident->requirement->name}} </td>  {{--  {{ $requirement['name'] }}  --}}
                    <td id="incidente_category"> {{ $incident->category_name}} </td>  
                    <td id="incidente_requirement"> {{ $incident->created_at }} </td> 
                </tr>           
            </tbody>  
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
                    <td id="incidente_responsible">{{ $incident->support_name }} </td>
                    <td >Publico </td>
                    <td id="incidente_state">{{ $incident->state }} </td>
                    <td id="incidente_severity" >{{ $incident->priority_full }} </td>
                </tr>
            </tbody>
    </table>

    <table class="table table-bordered">            
                <tr>
                    <th>Titulo</th>
                    <td id="incident_summary"> {{ $incident->title }}  </td> 
                </tr>
                <tr>
                    <th>Descripcion</th>
                    <td id="incident_description">  {{ $incident->description }}   </td> 
                </tr>
                <tr>
                    <th>Adjuntos</th>
                    <td id="incident_attachament"> No  se han adjuntado archivos  </td> 
                </tr>       
    </table>
    <button class="btn btn-primary btn-sm"  id="incident_btn_apply">
        Atender Solicitud
    
    </button>

    <button class="btn btn-info btn-sm"  id="incident_btn_open">
       Volver a abrir Solicitud
    
    </button>

    <button class="btn btn-info btn-sm"  id="incident_btn_solve">
       Marcar como resuelta
    
    </button>

    <button class="btn btn-success btn-sm"  id="incident_btn_edit">
        Editar Solicitud
    
    </button>

    <button class="btn btn-danger btn-sm"  id="incident_btn_derive">
        Derivar al siguiente nivel
    
    </button>
       
    </div>
</div>
@endsection
