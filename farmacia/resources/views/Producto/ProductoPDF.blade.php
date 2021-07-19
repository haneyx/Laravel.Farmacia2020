<body style="font-size:12px;">
<h1 style="font-size:15px;text-align:center;">INVENTARIO DE PRODUCTOS</h1>
<h2 style="font-size:12px;text-align:left;">GENERADO: El
@php
echo date('d').' de ';
switch(date('m')){
    case 1: echo 'Enero';break;
    case 2: echo 'Febrero';break;
    case 3: echo 'Marzo';break;
    case 4: echo 'Abril';break;
    case 5: echo 'Mayo';break;
    case 6: echo 'Junio';break;
    case 7: echo 'Julio';break;
    case 8: echo 'Agosto';break;
    case 9: echo 'Setiembre';break;
    case 10: echo 'Octubre';break;
    case 11: echo 'Noviembre';break;
    case 12: echo 'Diciembre';break;
}
echo ' del '.date('Y');
@endphp
</h2>
<table style="width:100%;text-align:center;border-collapse:collapse;border-spacing:0;">
<tr>
    <th style="width:3%;border:1px solid black;">N&deg;</th>
    <th style="width:12%;border:1px solid black;">C&Oacute;DIGO</th>
    <th style="width:47%;border:1px solid black;">DESCRIPCI&Oacute;N</th>
    <th style="width:7%;border:1px solid black;">CONTIENE POR CAJA</th>
    <th style="width:6%;border:1px solid black;">P. UNIT. COMPRA</th>
    <th style="width:6%;border:1px solid black;">P. UNIT. VENTA</th>
    <th style="width:6%;border:1px solid black;">P. UNIT. PROMO</th>
    <th style="width:5%;border:1px solid black;">STOCK</th>
    <th style="width:6%;border:1px solid black;">CADUCIDAD</th>
</tr>
@foreach ($items as $key => $item)
<tr>
<td style="width:3%;border:1px solid gray;">{{$loop->iteration}}</td>
<td style="width:12%;border:1px solid gray;">{{ $item->codigo }}</td>
<td style="width:47%;border:1px solid gray;text-align:left;">{{ $item->detalle }}</td>
<td style="width:7%;border:1px solid gray;">{{ $item->contiene }}</td>
<td style="width:6%;border:1px solid gray;">{{ $item->pcompra }}</td>
<td style="width:6%;border:1px solid gray;">{{ $item->pventa }}</td>
<td style="width:6%;border:1px solid gray;">{{ $item->ppromo }}</td>
<td style="width:5%;border:1px solid gray;">{{ $item->stock }}</td>
<td style="width:6%;border:1px solid gray;">{{$item->expmes}}/{{$item->expanio}}</td>
</tr>
@endforeach
</table>
<h2 style="font-size:12px;text-align:left;">TOTAL: {{count($items)}}</h2>
</body>