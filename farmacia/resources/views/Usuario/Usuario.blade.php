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
        <button class="blue" style="float:left;" onclick="window.location='{{url('usuario/agregar')}}'">Agregar usuario</button>
        @if(session('message'))
		<div id="info" class="alert {{session('color')}}">
			<div class="colo">{{session('symbol')}}</div>
			<div class="desc">{{session('message')}}</div>
			<div id="close" onclick="info()">x</div>
		</div>
        @endif
	</div>
</div>
<div class="container mid">
	<div class="title">Usuarios</div>
	<div class="frame">
		<div class="rtable">
		<table>
			<thead>
				<tr>
					<th class="i0">N&deg;</th>
					<th class="i1">DNI</th>
					<th class="i2">Nombres y apellidos</th>
					<th class="i3">Tipo</th>
					<th class="i4">Usuario</th>
					<th class="i5">Contrase&ntilde;a</th>
					<th class="i6">Acciones</th>
				</tr>
			</thead>
			<tbody>
                @foreach($todoU as $u)
				<tr>
					<td class="i0">{{$loop->iteration}}</td>
					<td class="i1">{{$u->dni_ruc}}</td>
					<td class="i2">{{$u->nombre_razon}} {{$u->apellidos}}</td>
					<td class="i3">
                        @if($u->master==2)Administrador
                        @else Vendedor
                        @endif
                    </td>
					<td class="i4">{{$u->dni_ruc}}</td>
					<td class="i5">{{$u->pass}}</td>
					<td class="i6">
                        <button class="green" onclick="window.location='{{url('usuario/editar')}}/{{$u->id}}'">Editar</button>
						<button class="gray"  onclick="if(confirm('¿Seguro de eliminar el usuario: {{$u->nombre_razon}} {{$u->apellidos}}?')){window.location='{{url('usuario/eliminar')}}/{{$u->id}}'}">Eliminar</button>
					</td>
				</tr>
				@endforeach
			</tbody>
			<tfoot>
				<tr>
					<th class="ix">{{count($todoU)}}</th>
					<th class="iy">
                        @if(count($todoU)==0)Ning&uacute;n resultado
                        @elseif(count($todoU)==1)Usuario registrado
                        @else Usuarios registrados
                        @endif
                    </th>
				</tr>
			</tfoot>
			</table>
		</div>
	</div>
</div>
@include('fin')
@endif