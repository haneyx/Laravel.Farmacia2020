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
<tbody>
    @foreach($todoP as $p)
    <tr>
        <td class="i0">{{$loop->iteration}}</td>
        <td class="i1">{{$p->detalle}}</td>
        <td class="i2"><input id="in.{{$loop->iteration}}" type="text" maxlength="3" onkeypress="return int(this)"></td>
        <td class="i3">{{$p->ppromo ?? $p->pventa}}</td>
        <td class="i4" id="st.{{$loop->iteration}}">{{$p->stock}}</td>
        <td class="i5">
            <button onclick="add({{$p->id}},'{{$p->detalle}}',{{$loop->iteration}},{{$p->ppromo ?? $p->pventa}})" class="green">Agregar</button>
        </td>
    </tr>
    @endforeach 
</tbody>
<tfoot>
    <tr>
        <th class="ix">{{count($todoP)}}</th>
        <th class="iy">
            @if(count($todoP)==0)Ning&uacute;n resultado
            @elseif(count($todoP)==1)Producto encontrado
            @else Productos encontrados
            @endif
        </th>
    </tr>
</tfoot>