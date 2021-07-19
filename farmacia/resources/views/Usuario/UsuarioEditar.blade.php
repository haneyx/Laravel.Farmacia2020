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
        @import "{{asset('css/u.css')}}";
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
<div class="container light">
    <div class="title">Editar usuario</div>
	<div class="frame">
        <form id="add" action="{{url('usuario/editar')}}/{{$ed->id}}" method="post">
            @csrf
            <div class="list4">
                <label>N&deg; de DNI:</label>
                    <input name="dni_ruc" type="text" onkeypress="return int(this)" maxlength="8" value="{{$ed->dni_ruc}}">
                <label>Nombres:</label>
                    <input name="nombre_razon" type="text" maxlength="30" value="{{$ed->nombre_razon}}">
                <label>Apellidos:</label>
                    <input name="apellidos" type="text" maxlength="35" value="{{$ed->apellidos}}">
                <label>Tipo:</label>
                    <select name="master" class="master">
                        <option value="2" @if($ed->master==2)selected @endif>Administrador</option>
                        <option value="1" @if($ed->master==1)selected @endif>Vendedor</option>
                    </select>
            </div>
            <div class="dash"></div>
            <div class="list5">
                <label class="l4">Contrase&ntilde;a:</label>
                    <input name="pass" type="text" maxlength="20" value="{{$ed->pass}}">
            </div>
        </form>
        <div class="section">
            <button class="gray" onclick="window.location.assign('{{url('usuario')}}')">Cancelar</button>
            <button class="green" onclick="add.submit()" type="submit">Actualizar</button>
        </div>
	</div>
</div>
@include('fin')
@endif