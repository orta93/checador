@extends('layouts.master')

@section('title')
    Mi Perfil
@endsection
@section('small_title')
    Modifique los datos necesarios
@endsection

@section('breadcrumb')
    <li class="active"><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
    {{--<li><a href="#">UI</a></li>--}}
    {{--<li class="active">Icons</li>--}}
@endsection

@section('content')
    <div class="box box-default color-palette-box">
        <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-user"></i> {{ Auth::user()->nombre }}</h3>
        </div>

        <form method="post" role="form" enctype="multipart/form-data">
            <div class="box-body">

                @if(count($errors->all()))
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-ban"></i> Error!</h4>
                        <ul>
                            @foreach ($errors->all() as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if(Session::has('error'))
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-ban"></i> Error!</h4>
                            {{ Session::get('error') }}
                        </div>
                @endif

                <div class="form-group">
                    <label for="name">Nombre Completo</label>
                    <input type="text" id="name" name="name" class="form-control" placeholder="Nombre" value="{{ old('name',Auth::user()->nombre) }}" required>
                </div>

                <div class="form-group">
                    <label for="email">email</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="email" value="{{ old('email',Auth::user()->email) }}" required>
                </div>

                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                </div>
                <p>Si desea cambiar de contraseña, escribala en los dos recuadros. De lo contrario, deje los espacios vacíos.</p>
                <div class="form-group">
                    <label for="password_confirmation">Repita contraseña </label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Password">
                </div>

                <div class="form-group">
                    <label for="picture">Foto de perfil</label>
                    <input type="file" id="picture" name="picture">
                    <p class="help-block">Puede subir una fotografía de perfil.</p>
                </div>
            </div>
            @csrf
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            </div>
        </form>
    </div>
@endsection
