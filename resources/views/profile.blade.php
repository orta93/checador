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
    <div class="box box-default color-palette-box">
        <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-home"></i> Inicio</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-xs-12">
                    Mi reporte Diario
                </div>
            </div>
        </div>
    </div>
@endsection
