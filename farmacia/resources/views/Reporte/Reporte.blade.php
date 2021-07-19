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
                <em>El
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

        @if(session('message'))
		<div id="info" class="alert {{session('color')}}">
			<div class="colo">{{session('symbol')}}</div>
			<div class="desc">{{session('message')}}</div>
			<div id="close" onclick="info()">x</div>
		</div>
        @endif
	</div>
</div>

<form action="{{url('reporte/buscar')}}" method="post">
@csrf
<div class="container light">
	<div class="title">Reporte de ventas</div>
	<div class="frame">
        <div class="opt2">
            <label>&#10148; Definir fecha:</label>
                <input name="dia" type="text" maxlength="2" onkeypress="return int(this)">
            <select name="mes">
                <option value="1">Enero</option>
                <option value="2">Febrero</option>
                <option value="3">Marzo</option>
                <option value="4">Abril</option>
                <option value="5">Mayo</option>
                <option value="6">Junio</option>
                <option value="7">Julio</option>
                <option value="8">Agosto</option>
                <option value="9">Setiembre</option>
                <option value="10">Octubre</option>
                <option value="11">Noviembre</option>
                <option value="12">Diciembre</option>
            </select>
                <input name="anio" class="year" type="text" maxlength="4" onkeypress="return int(this)" value="{{date('Y')}}">
        </div>
        <div class="section">
            <button class="blue" type="submit">Buscar</button>
        </div>
	</div>
</div>
</form>
@include('fin')
@endif