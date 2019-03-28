@extends('layouts.master')

@section('title')
    Inicio
@endsection
@section('small_title')
    {{--Ha iniciado sesión correctamente--}}
@endsection

@section('breadcrumb')
    <li class="active"><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
    {{--<li><a href="#">UI</a></li>--}}
    {{--<li class="active">Icons</li>--}}
@endsection

@section('content')
    @if(Session::has('success'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Completado</h4>
            {{ Session::get('success') }}
        </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default color-palette-box">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-home"></i> Reporte Mensual {{ $current_month  }}</h3>
                </div>
                <div class="box-body no-padding">
                    <table class="table table-striped" width="100%">
                        <tbody>
                        <tr>
                            <th width="40%">Nombre</th>
                            <th width="10%">Horas Mensuales</th>
                            <th width="10%">Horas Semestrales</th>
                            <th width="40%"></th>
                        </tr>
                        @foreach($employees as $employee)
                            <tr>
                                <td>{{ $employee->nombre }}</td>
                                <td>{{ $employee->movements['total'] }}</td>
                                <td>{{ $employee->hours }}</td>
                                <td>
                                    <div class="progress progress-xs progress-striped active">
                                        <div class="progress-bar progress-bar-success" style="width: {{ $employee->barWidth }}%"></div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
