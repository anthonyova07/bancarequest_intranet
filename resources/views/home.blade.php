@extends('layouts.app')

@section('content')
<div class="panel panel-primary" style="box-shadow: 4px 3px 7px 1px black;">
    <div class="panel-heading">Dashboard</div>

    <div class="panel-body">
        @if (auth()->user()->is_admin  ||  auth()->user()->is_support)

        {{--  @if (auth()->user()->is_support)  --}}
        <div class="panel panel-info">          
            <div class="panel-heading">               
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
                            <th>Titulo</th>
                        </tr>                    
                    </thead>
                    <tbody id="dashboard_my_incidents">
                        @foreach ($my_incidents as $incident)
                            <tr>
                                <td>
                                    <a href="/ver/{{ $incident->id }}">
                                        {{$incident->id}}
                                    </a>
                                </td>
                                <td>{{$incident->category->name}}</td>
                                <td>{{$incident->priority_full}}</td>
                                @if ($incident->state == 0 )
                                    <td id="incidente_state">Asignado</td>
                                    @elseif ($incident->state == 1)
                                        <td id="incidente_state">Resuelto</td>
                                    @else
                                        <td id="incidente_state">Pendiente</td>
                                @endif

                                <td>{{$incident->created_at}}</td>
                                <td>{{$incident->title_short}}</td>
                            </tr>
                        @endforeach                    
                    </tbody>                
                </table>
            </div> 
        </div> 
        @endif
        {{--  @endif  --}}
        @if (auth()->user()->is_admin  ||  auth()->user()->is_support)
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
                                <td>
                                    <a href="/ver/{{ $incident->id }}">
                                        {{$incident->id}}
                                    </a>
                                </td>
                                <td>{{$incident->category_name}}</td>
                                <td>{{$incident->priority_full}}</td>
                                @if ($incident->state == 0 )
                                    <td id="incidente_state">Asignado</td>
                                    @elseif ($incident->state == 1)
                                        <td id="incidente_state">Resuelto</td>
                                    @else
                                        <td id="incidente_state">Pendiente</td>
                                @endif
                                <td>{{$incident->created_at}}</td>
                                <td>{{$incident->title_short}}</td>
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
        @endif

     
        <div class="panel panel-info">
            <div class="panel-heading">
                <h4>Solicitudes reportadas por mi<span class="label label-default"></span></h4>
                
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
                    <tbody id="dashboard_by_me"></tbody>
                          @foreach ($incidents_by_me as $incident)
                            <tr>
                                <td>
                                    <a href="/ver/{{ $incident->id }}">
                                        {{$incident->id}}
                                    </a>
                                </td>
                                <td>{{$incident->category_name}}</td>
                                <td>{{$incident->priority_full}}</td>
                                @if ($incident->support_id )
                                    <td id="incidente_state">Asignado</td>
                                    @elseif ($incident->state == 0)
                                        <td id="incidente_state">Resuelto</td>
                                    @else
                                        <td id="incidente_state">Pendiente</td>
                                @endif
                                <td>{{$incident->created_at}}</td>
                                <td>{{$incident->title_short}}</td>
                                <td>
                                    {{$incident->support_name ?: 'Sin asignar'}}  
                                </td>
                            </tr>
                        @endforeach                    
                </table>
            </div> 
        </div> 
        
    </div>
</div>
      
@endsection
