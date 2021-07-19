@if(!session('usuario'))
<script>window.location.href="{{url('/')}}";</script>
@else
<!DOCTYPE HTML PUBLIC>
<html>
<head>
    <title>SISTEMA </title>
    <meta name="author" content="Mg. Sc. Harold Coila">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="robots" content="noindex">
    <meta name="googlebot" content="noindex">
    <link rel="shortcut icon" href="{{asset('ico.ico')}}" type="image/x-icon">
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<style type="text/css" media="screen">
        @import "{{asset('css/base.css')}}";
    </style>
    <script src="{{asset('js/menu.js')}}"></script>
	<script src="{{asset('js/nume.js')}}"></script>
</head>
@include('menu')
<div class="subtop">
	<div class="notify">
        @if($errors->any())
		<div id="info" class="alert orange">
            <div class="colo">!</div>
			<div class="desc">Falta llenar:
                <em>
                @foreach($errors->all() as $e)
                    @if($loop->last){{$e}}.
                    @else {{$e}},
                    @endif
                @endforeach
                </em>
            </div>
			<div id="close" onclick="info()">x</div>
		</div>
        @endif
	</div>
</div>

<div class="container mono">
	<div class="title">Editar caja</div>
	<div class="frame">
        <div class="opt2">
        <form id="add" action="{{url('reporte/caja/editar')}}/{{$id}}" method="post">
        @csrf
            <label>Fecha: {{$fecha}}</label>
                <input name="fecha" type="hidden" value="{{$fecha}}">
            <label>Caja inicial:</label>
                <input name="inicial" class="year" type="text" onkeypress="return float(this)" value="{{$ini}}">
                <em>soles</em>
        </form>
        </div>
        <div class="section">
            <button class="gray" onclick="window.location.assign('{{url('reporte')}}')">Cancelar</button>
            <button class="green" onclick="add.submit()" type="submit">Actualizar</button>
        </div>
	</div>
</div>
@include('fin')
@endif