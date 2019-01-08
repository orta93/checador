@extends('auth.auth')

@section('content')

    <div class="register-box">
        <div class="register-logo">
            <a href="/"><b>Registro de Entradas y Salidas</b></a>
        </div>

        <div class="register-box-body">
            <p class="login-box-msg">Registre sus datos</p>

            <form action="{{ route('register') }}" method="post">
                <div class="form-group has-feedback">
                    <input type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name') }}" required autofocus placeholder="Nombre Completo">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>

                    @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group has-feedback">
                    <input type="text" name="matricula" class="form-control{{ $errors->has('matricula') ? ' is-invalid' : '' }}" value="{{ old('matricula') }}" required autofocus placeholder="Matricula">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>

                    @if ($errors->has('matricula'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('matricula') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group has-feedback">
                    <input type="text" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" required autofocus placeholder="Correo Electrónico">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>

                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group has-feedback">
                    <select name="departamento" class="form-control{{ $errors->has('departamento') ? ' is-invalid' : '' }}" required>
                        <option value="">Seleccione</option>
                        @foreach(\App\Department::all() as $department)
                            <option @if(old('departamento') == $department->id){{ 'selected' }}@endif value="{{ $department->id }}">{{ $department->nombre }}</option>
                        @endforeach
                    </select>

                    @if ($errors->has('departamento'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('departamento') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group has-feedback">
                    <select name="tipo" class="form-control{{ $errors->has('tipo') ? ' is-invalid' : '' }}" required>
                        <option value="">Seleccione</option>
                        <option @if(old('tipo') == 1){{ 'selected' }}@endif value="1">Practicante Profesional Académico</option>
                        <option @if(old('tipo') == 2){{ 'selected' }}@endif value="2">Becario Colaborador</option>
                        <option @if(old('tipo') == 3){{ 'selected' }}@endif value="3">Servicio Social</option>
                    </select>

                    @if ($errors->has('tipo'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('tipo') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group has-feedback">
                    <input type="password" name="password{{ $errors->has('password') ? ' is-invalid' : '' }}" class="form-control" required placeholder="Contraseña">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group has-feedback">
                    <input type="password" name="password_confirmation" class="form-control" required placeholder="Repita Contraseña">
                    <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Registrarse</button>
                    </div>
                </div>

                @csrf
            </form>

            <a href="login" class="text-center">Iniciar Sesión</a>
        </div>
    </div>

{{--<div class="container">--}}
    {{--<div class="row justify-content-center">--}}
        {{--<div class="col-md-8">--}}
            {{--<div class="card">--}}
                {{--<div class="card-header">{{ __('Register') }}</div>--}}

                {{--<div class="card-body">--}}
                    {{--<form method="POST" action="{{ route('register') }}">--}}
                        {{--@csrf--}}

                        {{--<div class="form-group row">--}}
                            {{--<label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>--}}

                                {{--@if ($errors->has('name'))--}}
                                    {{--<span class="invalid-feedback" role="alert">--}}
                                        {{--<strong>{{ $errors->first('name') }}</strong>--}}
                                    {{--</span>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group row">--}}
                            {{--<label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>--}}

                                {{--@if ($errors->has('email'))--}}
                                    {{--<span class="invalid-feedback" role="alert">--}}
                                        {{--<strong>{{ $errors->first('email') }}</strong>--}}
                                    {{--</span>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group row">--}}
                            {{--<label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>--}}

                                {{--@if ($errors->has('password'))--}}
                                    {{--<span class="invalid-feedback" role="alert">--}}
                                        {{--<strong>{{ $errors->first('password') }}</strong>--}}
                                    {{--</span>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group row">--}}
                            {{--<label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group row mb-0">--}}
                            {{--<div class="col-md-6 offset-md-4">--}}
                                {{--<button type="submit" class="btn btn-primary">--}}
                                    {{--{{ __('Register') }}--}}
                                {{--</button>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</form>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}
@endsection
