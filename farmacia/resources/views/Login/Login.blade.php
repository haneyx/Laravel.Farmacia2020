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
	<script src="{{asset('js/nume.js')}}"></script>
</head>
<body oncontextmenu="return false;">
<div class="container solo">
	<div class="title">Acceso al sistema</div>
	<div class="frame">
        <form action="{{url('/ingreso')}}" method="post">
        @csrf
            <div class="list5">
                <label>Usuario:</label>
                    <input name="user" type="text" onkeypress="return int(this)">
                <label>Contrase&ntilde;a:</label>
                    <input name="pass" type="password">
            </div>
            <div class="section">
                <button class="green">Ingresar</button>
            </div>
        </form>
	</div>
</div>
</body>
</html>