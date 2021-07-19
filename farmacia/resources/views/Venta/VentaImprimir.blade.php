<body style="font-family:Tahoma;">
<h2 style="font-size:10px;text-align:center;margin:0;">{{session('h1')}}</h2>
<h1 style="font-size:17px;text-align:center;margin:0;">{{session('h2')}}</h1>
<h2 style="font-size:9px;text-align:center;margin:5px 0 2px 0;">JR. CENTENARIO N&deg; 124</h2>
<h2 style="font-size:9px;text-align:center;margin:2px 0 2px 0;">LINCE - LIMA - LIMA</h2>
<h2 style="font-size:10px;text-align:center;margin:2px 0 8px 0;">RUC: 10414751143</h2>
<h2 style="font-size:12px;font-weight:700;text-align:center;margin:2px 0;">@if($fo==3)BOLETA @else FACTURA @endif DE VENTA ELECTR&Oacute;NICA</h2>
<h2 style="font-size:14px;font-weight:700;text-align:center;margin:2px 0;">{{$se}} - {{$nu}}</h2>
<h2 style="font-size:11px;font-weight:400;text-align:center;margin:2px 0 8px 0;">FECHA DE EMISI&Oacute;N {{$fe}}</h2>
<h2 style="font-size:11px;font-weight:700;text-align:left;width:96%;margin:2px auto;">DATOS DEL CLIENTE</h2>
<h2 style="font-size:11px;font-weight:400;text-align:left;width:96%;margin:2px auto;">N&deg; @if($cl3==1)DNI @else RUC @endif : {{$cl0}}</h2>
<h2 style="font-size:11px;font-weight:400;text-align:left;width:96%;margin:2px auto;">NOMBRES : {{$cl1}}</h2>
<h2 style="font-size:11px;font-weight:400;text-align:left;width:96%;margin:2px auto 8px auto;">DIRECCI&Oacute;N: {{$cl2}}</h2>
<table style="width:96%;margin:0 auto;text-align:center;border-collapse:collapse;border-spacing:0;">
<tr style="border-top:1px dashed black;border-bottom:1px dashed black;">
    <th style="padding:2px;font-size:10px;width:20%;">C&Oacute;DIGO</th>
    <th style="padding:2px;font-size:10px;width:50%;padding-left:6px;text-align:left;">DESCRIPCI&Oacute;N</th>
    <th style="padding:2px;font-size:10px;width:10%;">CANT.</th>
    <th style="padding:2px;font-size:10px;width:10%;">P.U.</th>
    <th style="padding:2px;font-size:10px;width:10%;">IMPORTE</th>
</tr>
@foreach ($todoV as $v)
<tr>
    <td style="padding:2px;font-size:11px;width:20%;">{{$v->codigo}}</td>
    <td style="padding:2px;font-size:11px;width:50%;padding-left:6px;text-align:left;">{{$v->detalle}}</td>
    <td style="padding:2px;font-size:11px;width:10%;">{{$v->cantidad}}</td>
    <td style="padding:2px;font-size:11px;width:10%;">{{$v->precio}}</td>
    <td style="padding:2px;font-size:11px;width:10%;">{{$v->cantidad*$v->precio}}</td>
</tr>
@endforeach
</table>
<table style="width:96%;margin:0 auto;text-align:center;border-collapse:collapse;border-spacing:0;">
<tr style="border-top:1px dashed black;">
    <th style="padding:2px;text-align:right;font-size:10px;width:90%;">OP. GRAVADA</th>
    <td style="padding:2px;font-size:10px;width:10%;">{{number_format($v->total/1.18,1)}}</td>
</tr>
<tr>
    <th style="padding:2px;text-align:right;font-size:10px;width:90%;">OP. EXONERADA</th>
    <td style="padding:2px;font-size:10px;width:10%;">0.00</td>
</tr>
<tr>
    <th style="padding:2px;text-align:right;font-size:10px;width:90%;">IGV 18%</th>
    <td style="padding:2px;font-size:10px;width:10%;">{{number_format($v->total-$v->total/1.18,1)}}</td>
</tr>
<tr>
    <th style="padding:2px;text-align:right;font-size:10px;width:90%;">IMPORTE TOTAL</th>
    <td style="padding:2px;font-size:10px;width:10%;">{{$v->total}}</td>
</tr>
<tr style="border-bottom:1px dashed black;">
    <th style="padding:2px;text-align:right;font-size:10px;width:90%;">TOTAL A PAGAR</th>
    <td style="padding:2px;font-size:10px;width:10%;">{{$v->total}}</td>
</tr>
</table>
<h2 style="font-size:11px;font-weight:400;text-align:left;width:96%;margin:4px auto 2px auto;">SON: {{$lt}}</h2>
<h2 style="font-size:11px;font-weight:400;text-align:left;width:96%;margin:2px auto;">EFECTIVO: {{$v->total}}</h2>
<h2 style="font-size:11px;font-weight:400;text-align:left;width:96%;margin:2px auto 4px auto;">CAJERO: {{$v->atiende}}</h2>
@php
$qr = $cl0.'|'.$fo.'|'.$se.'|'.$nu.'|'.number_format($v->total-$v->total/1.18,1).'|'.$v->total.'|'.$fe.'|0|0';
@endphp
<h2 style="display: flex;justify-content: center;">{!! QrCode::size(100)->generate($qr); !!}</h2>
<h1 style="font-size:12px;font-weight:400;text-align:center;margin:0;">Representaci&oacute;n impresa<BR>de la @if($fo==3)boleta @else factura @endif electr&oacute;nica.</h1>
</body>