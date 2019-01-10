<div class="user-panel">
    <div class="pull-left image">
        <img src="{{ asset(Auth::user()->img) }}" class="img-circle" alt="User Image">
    </div>
    <div class="pull-left info">
        <p>{{ Auth::user()->nombre }}</p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
    </div>
</div>

<ul class="sidebar-menu" data-widget="tree">
    <li class="header">Menu</li>
    <li class="active"><a href="{{ url('/home') }}"><i class="fa fa-home"></i> <span>Inicio</span></a></li>
    {{--<li><a href="{{ url('/hours') }}"><i class="fa fa-book"></i> <span>Reporte de Horas</span></a></li>--}}
{{--    <li><a href="{{ url('/comments') }}"><i class="fa fa-book"></i> <span>Reporte de Comentarios</span></a></li>--}}
</ul>
