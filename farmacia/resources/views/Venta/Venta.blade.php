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
        @import "{{asset('css/v.css')}}";
    </style>
    <script src="{{asset('js/menu.js')}}"></script>
	<script src="{{asset('js/nume.js')}}"></script>
    <script src="{{asset('js/vent.js')}}"></script>
    <script src="{{asset('js/jquery.js')}}"></script>

</head>
@include('menu')
<div class="container">
	<div class="title">VENTA DE PRODUCTOS</div>
	<div class="frame">
		<div class="subtitle1">&#10148; B&uacute;squeda</div>
		<div class="opt">
            <button>Escanear</button><input id="codigo" type="text" onkeyup="search(1)" onkeydown="search(1)" >
			<button>Buscar</button><input id="nombre" type="text" onkeyup="search(2)">
		</div>
		<div class="rtable">
		<table id="TA">
			<thead>
				<tr>
					<th class="i0">N&deg;</th>
					<th class="i1">Descripci&oacute;n</th>
					<th class="i2">Cantidad</th>
					<th class="i3">Precio</th>
					<th class="i4">Stock</th>
					<th class="i5">Acci&oacute;n</td>
				</tr>
			</thead>
			<tbody></tbody>
			<tfoot>
				<tr>
					<th class="ix">0</th>
					<th class="iy">Ning&uacute;n resultado</th>
				</tr>
			</tfoot>
			</table>
		</div>

		<div class="subtitle2">&#10148; Venta</div>
		<div id="T" class="rtable">
			<table>
				<thead>
					<tr>
						<th class="i10">N&deg;</th>
						<th class="i11">Descripci&oacute;n</th>
						<th class="i12">Cantidad</th>
						<th class="i13">Precio</th>
						<th class="i14">Subtotal</th>
					</tr>
				</thead>
				<tbody id="TB"></tbody>
				<tfoot>
					<tr>
						<th id="L" class="ia">0</th>
						<th class="ib">Productos a vender</th>
						<th class="ic"></th>
						<th class="id">TOTAL</th>
						<th id="S" class="ie">0.0</th>
					</tr>
				</tfoot>
				</table>
		</div>
		<form action="{{url('ventas/agregar')}}" method="post">
		@csrf
		<div class="subtitle1">&#10148; DATOS DEL CLIENTE</div>
		<div class="opt3">
			<button class="tipo">Tipo</button>
				<select id="c0" onchange="ti()" name="tipo">
					<option value="1" selected>DNI</option>
					<option value="6">RUC</option>
				</select>
            <button id="c1" class="doc">N&deg; DNI</button>
				<input class="d1" name="dni_ruc" type="text" maxlength="11" onkeypress="return int(this)">
			<button id="c2">Nombres</button>
				<input class="d2" name="nombre_razon" type="text" maxlength="30">
			<button>Direcci&oacute;n</button>
				<input class="d3" name="direccion" type="text" maxlength="50">
		</div>
		<input name="lot" id="lot" type="hidden" value="0">
		<input name="array" id="array" type="hidden" value=''>
		<input name="formato" id="formato" type="hidden" value="0">
		<input name="atiende" type="hidden" value="{{session('usuario')}}">
		<div class="section">
			<button class="blue" onclick="window.location.assign('{{url('ventas')}}')">Nueva venta</button>
			<button class="red" onclick="fo(0)" type="submit">Venta sin recibo</button>
			<button class="green" onclick="fo(3)" type="submit">Boleta</button>
			<button class="orange" onclick="fo(1)" type="submit">Factura</button>
		</div>
		</form>
	</div>
		
	</div>
</div>

<script type="text/javascript">
@if(session('recibo')>0)
var W = window.open('{{url("ventas/imprimir")}}/{{session("ultimo")}}','','width=800,height=600,resizable=no,toolbar=no');
W.window.print();
@endif

@if(session('alerta'))
	alert("{{session('alerta')}}");
@endif

$.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
function search(t){
    switch(t){
        case 1:
        var code=document.getElementById("codigo").value;
        if(code){
            $.ajax({
                type : 'GET',
                url : '{{URL::to("ventas/searchC")}}',
                data: {'code':code},
                success:function(data){
                    $('#TA').html(data);
                }
            });
        }
        break;

        case 2:
        var name=document.getElementById("nombre").value;
        if(name){
            $.ajax({
                type : 'GET',
                url : '{{URL::to("ventas/searchN")}}',
                data: {'name':name},
                success:function(data){
                    $('#TA').html(data);
                }
            });
        }
        break;
    }
}

function print(){
	var W = window.open('{{ url("ventas/imprimir")}}','','width=600,height=900,resizable=no,toolbar=no');
	W.window.print();
}
</script>
@include('fin')
@endif