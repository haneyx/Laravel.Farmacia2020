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
        @import "{{asset('css/r.css')}}";
    </style>
    <script src="{{asset('js/menu.js')}}"></script>
	<script src="{{asset('js/nume.js')}}"></script>
</head>
@include('menu')

<div class="container">
	<div class="title">Reporte de ventas del d&iacute;a: {{$fecha}}</div>
	<div class="frame">
        <div class="rtable">
        <table>
            <thead>
                <tr>
                    <th class="i0">N&deg;</th>
                    <th class="i1">Descripci&oacute;n</th>
                    <th class="i2">Cantidad</th>
                    <th class="i3">Precio</th>
                    <th class="i4">Recibo</th>
                    <th class="i5">Cajero</th>
                </tr>
            </thead>
            <tbody>
                @foreach($todoR as $r)
                <tr>
                    <td class="i0">{{$loop->iteration}}</td>
                    <td class="i1">{{$r->detalle}}</td>
                    <td class="i2">{{$r->cantidad}}</td>
                    <td class="i3">{{$r->precio}}</td>
                    <td class="i4">
                        @if($r->formato==3)Boleta
                        @elseif($r->formato==1)Factura
                        @else No
                        @endif
                    </td>
                    <td class="i5">{{$r->atiende}}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
					<th class="ix">{{count($todoR)}}</th>
					<th class="iy">
                        @if(count($todoR)==0)Ning&uacute;n resultado
                        @elseif(count($todoR)==1)Venta realizada
                        @else Ventas realizadas
                        @endif
                    </th>
				</tr>
            </tfoot>
            </table>
        </div>
        <div class="section">
            <em class="blue">Caja inicial s/.</em>
                <input disabled name="inicial" type="text" value="{{$ini}}">
            <em class="green">Ventas del d&iacute;a s/.</em>
                <input disabled type="text" value="{{$dia}}">
            <em class="red">Total final s/.</em>
                <input disabled type="text" value="{{$sum}}">
            <button class="gray set" onclick="window.location.assign('{{url('reporte/caja')}}/{{$date}}')">Actualizar CAJA INICIAL</button>
        </div>
        <div class="section">
            <button class="blue" onclick="window.location.assign('{{url('reporte')}}')">Nueva b&uacute;squeda</button>
        </div>
	</div>
</div>
@include('fin')
@endif