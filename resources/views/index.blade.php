<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Registro de Entradas y Salidas</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="css/index.css">
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition lockscreen">
<div class="lockscreen-wrapper">
    <div class="lockscreen-logo">
        <p><b>{{ \Carbon\Carbon::now()->format('h:i') }}</b></p>
    </div>
    <div class="lockscreen-name">{{ \Carbon\Carbon::now()->format('d-m-Y') }}</div>
    <div class="lockscreen-item">
        <div class="lockscreen-image">
            <img src="dist/img/avatar5.png" alt="User Image">
        </div>
        <form class="lockscreen-credentials">
            <div class="input-group">
                <input type="password" id="matricula" class="form-control" autofocus placeholder="Matrícula">
                <input type="hidden" id="token" value="{{ csrf_token() }}">

                <div class="input-group-btn">
                    <button type="button" class="btn" onclick="check()"><i class="fa fa-arrow-right text-muted"></i></button>
                </div>
            </div>
        </form>
    </div>

    <div id="info" class="box box-widget widget-user-2">
        <div class="widget-user-header bg-yellow">
            <div class="widget-user-image">
                <img id="profile-picture" class="img-circle" src="{{ asset('/storage/images/default.png') }}" alt="User Avatar">
            </div>
            <h3 class="widget-user-username"></h3>
            <h5 class="widget-user-desc"></h5>
        </div>

    </div>
    <div id="success" class="alert alert-success" role="alert"></div>
    <div id="fail" class="alert alert-danger" role="alert"></div>

    <div class="help-block text-center login_help">
        Ingrese su matrícula para guardar su registro.
    </div>
    <div class="text-center">
        <a href="login">Iniciar sesión</a>
    </div>
    <div class="lockscreen-footer text-center">
        Copyright &copy; {{ date('Y') }} <b>Jonathan Orta</b><br>
        Code Solutions Systems
    </div>
</div>

<script src="bower_components/jquery/dist/jquery.min.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="js/index.js"></script>
</body>
</html>
