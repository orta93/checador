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
            @if(Session::has('success'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i> Completado</h4>
                    {{ Session::get('success') }}
                </div>
            @endif
            <div class="row">
                <div class="col-xs-12">
                    Mi reporte Diario
                </div>
            </div>
        </div>
    </div>
@endsection
