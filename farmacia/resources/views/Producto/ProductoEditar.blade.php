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
	</div>
</div>

<div class="container mini">
	<div class="title">Editar producto</div>
	<div class="frame">
        <form id="add" action="{{url('producto/editar')}}/{{$ed->id}}" method="post">
            @csrf
            <div class="list1">
                <label>C&oacute;digo:</label>
                    <input name="codigo" type="text" maxlength="30" value="{{$ed->codigo}}">
                <label>Descripci&oacute;n:</label>
                    <input name="detalle" type="text" maxlength="70" value="{{$ed->detalle}}">
                <label>Contenido por caja:</label>
                    <input name="contiene" class="cut" type="text" maxlength="3" value="{{$ed->contiene}}" onkeypress="return int(this)"><em>Unidades</em>
            </div>
            <div class="dash"></div>
            <div class="list2">	
                <label>Precio unitario de compra:</label><em>S/.</em>
                    <input name="pcompra" type="text" value="{{$ed->pcompra}}" onkeypress="return float(this)">
                <label>Precio unitario de venta:</label><em>S/.</em>
                    <input name="pventa" type="text" value="{{$ed->pventa}}" onkeypress="return float(this)">
                <label>Precio unitario promocional:</label><em>S/.</em>
                    <input name="ppromo" type="text" value="{{$ed->ppromo}}" onkeypress="return float(this)">
            </div>
            <div class="list3">		
                <label>Stock:</label>
                    <input name="stock" type="text" maxlength="6" value="{{$ed->stock}}" onkeypress="return int(this)"><em>Unidades</em>
                <label>Caducidad:</label>
                    <input name="expmes" type="text" maxlength="2" value="{{$ed->expmes}}" onkeypress="return int(this)">
                    <em>/</em>
                    <input name="expanio" type="text" maxlength="4" value="{{$ed->expanio}}" onkeypress="return int(this)"><em>(Mes/A&ntilde;o)</em>
            </div>
        </form>
		<div class="section">
			<button class="gray" onclick="window.location.assign('{{url('producto')}}')">Cancelar</button>
			<button class="green" onclick="add.submit()" type="submit">Actualizar</button>
		</div>
	</div>
</div>
@include('fin')
@endif