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
        @import "{{asset('css/i.css')}}";
    </style>
    <script src="{{asset('js/menu.js')}}"></script>
	<script src="{{asset('js/nume.js')}}"></script>
	<script src="{{asset('js/prin.js')}}"></script>
</head>
@include('menu')
<div class="subtop">
	<div class="notify">
        <button class="blue" style="float:left;" onclick="window.location='{{url('producto/agregar')}}'">Agregar producto</button>
        @if(session('message'))
		<div id="info" class="alert {{session('color')}}">
			<div class="colo">{{session('symbol')}}</div>
			<div class="desc">{{session('message')}}</div>
			<div id="close" onclick="info()">x</div>
		</div>
        @endif
	</div>
</div>

<div class="container">
	<div class="title">Productos</div>
	<div class="frame">
		<div class="rtable">
		<table>
			<thead>
				<tr>
					<th class="i0">N&deg;</th>
					<th class="i1">C&oacute;digo</th>
					<th class="i2">Descripci&oacute;n</th>
					<th class="i3">Contiene por caja</th>
					<th class="i4">p. unit. compra</th>
					<th class="i5">p. unit. venta</th>
					<th class="i6">p. unit. promo</th>
					<th class="i7">stock</th>
					<th class="i8">caducidad</th>
					<th class="i9">Acciones</th>
				</tr>
			</thead>
			<tbody>
                @foreach($todoP as $p)
				<tr>
					<td class="i0">{{$loop->iteration}}</td>
					<td class="i1">{{$p->codigo}}</td>
					<td class="i2">{{$p->detalle}}</td>
					<td class="i3">{{$p->contiene}}</td>
					<td class="i4">{{$p->pcompra}}</td>
					<td class="i5">{{$p->pventa}}</td>
					<td class="i6">{{$p->ppromo}}</td>
					<td class="i7">{{$p->stock}}</td>
					<td class="i8">{{$p->expmes}}/{{$p->expanio}}</td>
					<td class="i9">
						<button class="green" onclick="window.location='{{url('producto/editar')}}/{{$p->id}}'">Editar</button>
						<button class="gray"  onclick="if(confirm('¿Seguro de eliminar el producto: {{$p->detalle}}?')){window.location='{{url('producto/eliminar')}}/{{$p->id}}'}">Eliminar</button>
					</td>
				</tr>
                @endforeach 
			</tbody>
			<tfoot>
				<tr>
					<th class="ix">{{count($todoP)}}</th>
					<th class="iy">
                        @if(count($todoP)==0)Ning&uacute;n resultado
                        @elseif(count($todoP)==1)Producto registrado
                        @else Productos registrados
                        @endif
                    </th>
				</tr>
			</tfoot>
			</table>
		</div>
		<div class="section">
			<button class="blue" onclick="print()">Imprimir</button>
			<button class="red" onclick="window.location='{{ route('pdf',['download'=>'pdf']) }}'">Descargar</button>
		</div>
	</div>
</div>
<script>
function print(){
	var W = window.open('{{ url("producto/imprimir")}}','','width=1000,height=500,resizable=no,toolbar=no');
	W.window.print();
}
</script>
@include('fin')
@endif