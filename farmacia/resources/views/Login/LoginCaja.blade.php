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
    <script src="{{asset('js/nume.js')}}"></script>
    <script>
        @if($errors->any())
            @foreach($errors->all() as $e)
                alert('Falta llenar: '+'{{$e}}');
            @endforeach
        @endif
    </script>
</head>
<body oncontextmenu="return false;">
<div class="container solo">
	<div class="title">inicializar caja</div>
	<div class="frame">
        <form id="add" action="{{url('/caja/agregar')}}" method="post">
            @csrf
            <input name="usuario" type="hidden" value="{{session('usuario')}}">
            <input name="master" type="hidden" value="{{session('master')}}">
            <div class="list5">
                <h1>Hola {{session('usuario')}}</h1>
                <label>Hoy es:</label><p>{{date('d')}}
				@switch(date('m'))
					@case (1) Enero @break
					@case (2) Febrero @break
					@case (3) Marzo @break
					@case (4) Abril @break
					@case (5) Mayo @break
					@case (6) Junio @break
					@case (7) Julio @break
					@case (8) Agosto @break
					@case (9) Setiembre @break
					@case (10) Octubre @break
					@case (11) Noviembre @break
					@case (12) Diciembre @break
				@endswitch
				del {{date('Y')}}</p>
                <label>Caja inicial:</label>
                    <input name="inicial" class="cut" type="text" onkeypress="return float(this)"><em>soles</em>
            </div>
            <div class="section">
                <button class="green" type="submit">Grabar caja</button>
            </div>
        </form>
	</div>
</div>
</body>
</html>
@endif