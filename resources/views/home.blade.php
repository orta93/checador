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
        <div class="col-md-6">
            <div class="box box-default color-palette-box">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-home"></i> Reporte Mensual</h3>
                </div>
                <div class="box-body no-padding">
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <th>Fecha</th>
                                <th>Entrada</th>
                                <th>Salida</th>
                                <th>Horas</th>
                            </tr>
                            @foreach($movements as $move)
                                <tr>
                                    <td>{{ $move->date }}</td>
                                    <td>{{ $move->checkin }}</td>
                                    <td>{{ $move->checkout }}</td>
                                    <td>{{ $move->hours }}</td>
                                </tr>
                            @endforeach
                            <tr><th colspan="3" class="text-right">Total de horas</th><th>{{ $total }}</th></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="box box-default color-palette-box">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-home"></i> Reporte Mensual</h3>
                </div>
                <div class="box-body no-padding">
                    <table class="table table-striped">
                        <tbody>
                        <tr>
                            <th colspan="2">Mes</th>
                            <th>Horas</th>
                        </tr>
                        @foreach($semester->months as $month)
                            <tr>
                                <td colspan="2">{{ $month->month }}</td>
                                <td>{{ $month->total }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td width="40%">
                                <div class="progress progress-xs progress-striped active">
                                    <div class="progress-bar progress-bar-success" style="width: {{ $semester->barWidth }}%"></div>
                                </div>
                            </td>
                            <th width="30%" class="text-right">Total de horas</th>
                            <th width="30%"><span class="badge bg-green">{{ $semester->hours }}</span></th>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
