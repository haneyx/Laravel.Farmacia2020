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

        @if(session('message'))
		<div id="info" class="alert {{session('color')}}">
			<div class="colo">{{session('symbol')}}</div>
			<div class="desc">{{session('message')}}</div>
			<div id="close" onclick="info()">x</div>
		</div>
        @endif
	</div>
</div>

<form action="{{url('recibo/editar')}}" method="post">
@csrf
<div class="container light">
	<div class="title">Numeraci&oacute;n del Recibo</div>
	<div class="frame">
        <div class="subtitle1">&#10148; Boleta electr&oacute;nica</div>
        <div class="opt3">
            <label>Serie:</label>
                <input name="sb" class="d4" type="text" maxlength="4" value="{{$todoR[1]->serie}}">
            <label>N&uacute;mero:</label>
                <input name="nb" class="d4" type="text" maxlength="8" onkeypress="return int(this)" value="{{$todoR[1]->numero}}">
        </div>
        <div class="subtitle1">&#10148; Factura electr&oacute;nica</div>
        <div class="opt3">
            <label>Serie:</label>
                <input name="sf" class="d4" type="text" maxlength="4" value="{{$todoR[0]->serie}}">
            <label>N&uacute;mero:</label>
                <input name="nf" class="d4" type="text" maxlength="8" onkeypress="return int(this)" value="{{$todoR[0]->numero}}">
        </div>
        <div class="section">
            <button class="green" type="submit">Actualizar</button>
        </div>
	</div>
</div>
</form>
@include('fin')
@endif