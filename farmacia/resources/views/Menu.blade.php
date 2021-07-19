<body oncontextmenu="return false;">
<div class="top">
	<div class="wide">
		<div class="t">
			<div class="t1">{{session('h1')}}</div>
			<div class="t2">{{session('h2')}}</div>
		</div>
		<div class="line"></div>
		<div class="txtup">
			<div class="tx1">Usuario: {{session('usuario')}}</div>
			<div class="tx2">Hoy es: 
				{{date('d')}}
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
				del {{date('Y')}}</div>
		</div>
		<button class="exit" onclick="window.location='{{url('/salir')}}'">Salir</button>
		<div class="menumax">
			@if(session('master')==2)
			<a href="{{url('usuario')}}"><button>Usuario</button></a>
			<a href="{{url('producto')}}"><button>Producto</button></a>
			<a href="{{url('reporte')}}"><button>Reporte</button></a>
			<a href="{{url('recibo')}}"><button>Recibo</button></a>
			@endif
			<a href="{{url('ventas')}}"><button>Ventas</button></a>
		</div>
		<button id="menubutton" onclick="open_menu()">Men&uacute;</button>
		<div id="menumin">
			@if(session('master')==2)
			<a href="{{url('usuario')}}"><button>Usuario</button></a>
			<a href="{{url('producto')}}"><button>Producto</button></a>
			<a href="{{url('reporte')}}"><button>Reporte</button></a>
			<a href="{{url('recibo')}}"><button>Recibo</button></a>
			@endif
			<a href="{{url('ventas')}}"><button>Ventas</button></a>
		</div>
	</div>
</div>
