@extends('layouts.app')

@section('content')
<div class="panel panel-primary" style="box-shadow: 4px 3px 7px 1px black;">
    <div class="panel-heading">Dashboard</div>

    <div class="panel-body">
        <div class="panel panel-info">
            <div class="panel-heading">
                {{--  <h3 class="panel-title">Incidencias asignadas a mi</h3>  --}}
                <h4>Solicitudes asignadas a mi <span class="label label-default"></span></h4>
            </div>
            <div class="panel-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Codigo</th>
                            <th>Categoria</th>
                            <th>Prioridad</th>
                            <th>Estado</th>
                            <th>Fecha de creacion</th>
                            <th>Resumen</th>
                        </tr>                    
                    </thead>
                    <tbody id="dashboard_my_incidents">
                        @foreach ($my_incidents as $incident)
                            <tr>
                                <td>{{$incident->id}}</td>
                                <td>{{$incident->category->name}}</td>
                                <td>{{$incident->priority}}</td>
                                <td>{{$incident->id}}</td>
                                <td>{{$incident->created_at}}</td>
                                <td>{{$incident->description}}</td>
                            </tr>
                        @endforeach                    
                    </tbody>                
                </table>
            </div> 
        </div> 

        <div class="panel panel-info">
            <div class="panel-heading">
                <h4>Solicitudes sin asignar <span class="label label-default"></span></h4>
            </div>
            <div class="panel-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Codigo</th>
                            <th>Categoria</th>
                            <th>Prioridad</th>
                            <th>Estado</th>
                            <th>Fecha de creacion</th>
                            <th>Titulo</th>
                            <th>Opcion</th>
                        </tr>                    
                    </thead>
                    <tbody id="dashboard_pending_incidents"></tbody>                
                         @foreach ($pending_incidents as $incident)
                            <tr>
                                <td>{{$incident->id}}</td>
                                <td>{{$incident->category->name}}</td>
                                <td>{{$incident->priority}}</td>
                                <td>{{$incident->id}}</td>
                                <td>{{$incident->created_at}}</td>
                                <td>{{$incident->description}}</td>
                                <td>
                                    <a href="" class="btn btn-primary btn-sm">
                                        Atender                                   
                                    
                                    </a>                                
                                </td>
                            </tr>
                        @endforeach                    
                </table>
            </div> 
        </div> 

        <div class="panel panel-info">
            <div class="panel-heading">
                <h4>Solicitudes asignadas a otros<span class="label label-default"></span></h4>
                
            </div>
            <div class="panel-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Codigo</th>
                            <th>Categoria</th>
                            <th>Prioridad</th>
                            <th>Estado</th>
                            <th>Fecha de creacion</th>
                            <th>Titulo</th>
                            <th>Responsable</th>
                        </tr>                    
                    </thead>
                    <tbody id="dashboard_to_others"></tbody>
                          @foreach ($incidents_by_me as $incident)
                            <tr>
                                <td>{{$incident->id}}</td>
                                <td>{{$incident->category->name}}</td>
                                <td>{{$incident->priority}}</td>
                                <td>{{$incident->id}}</td>
                                <td>{{$incident->created_at}}</td>
                                <td>{{$incident->description}}</td>
                                <td>
                                    {{$incident->support_id}}  
                                </td>
                            </tr>
                        @endforeach                    
                </table>
            </div> 
        </div> 

    </div>
</div>
      
@endsection
