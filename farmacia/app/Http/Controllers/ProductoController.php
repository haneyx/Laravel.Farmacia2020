<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Producto;

class ProductoController extends Controller
{
    public function index(){
        $todoP = Producto::orderBy('detalle')->get();
        return view('Producto.Producto',compact('todoP'));
    }

    public function ini_create(){
        return view('Producto.ProductoAgregar');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'codigo'=> 'required|max:30',
            'detalle'=> 'required|max:70',
            'pcompra'=> 'required',
            'pventa'=> 'required',
            'stock'=> 'required|max:6',
            'expmes'=> 'required|max:2',
            'expanio'=> 'required|max:4'
        ],
        [
            'codigo.required' => 'código',
            'codigo.max' => 'código máximo de 30 caracteres',
            'detalle.required' => 'descripción',
            'detalle.max' => 'descripción máximo de 70 caracteres',
            'pcompra.required' => 'precio unit. de compra',
            'pventa.required' => 'precio unit. de venta',
            'stock.required' => 'stock',
            'stock.max' => 'stock máximo de 6 números',
            'expmes.required' => 'mes',
            'expmes.max' => 'mes máximo de 2 números',
            'expanio.required' => 'año',
            'expanio.max' => 'año máximo de 4 números'
        ]);

        Producto::create([
            'codigo'=> $request->get('codigo'),
            'detalle'=> $request->get('detalle'),
            'contiene'=> $request->get('contiene'),
            'pcompra'=> $request->get('pcompra'),
            'pventa'=> $request->get('pventa'),
            'ppromo'=> $request->get('ppromo'),
            'stock'=> $request->get('stock'),
            'expmes'=> $request->get('expmes'),
            'expanio'=> $request->get('expanio')
        ]);

        $this->color='green';
        $this->symbol='✓';
        $this->message='Se ha agregado el producto: '.$request->get('detalle');
        return redirect()->action('ProductoController@index')
            ->with('color',$this->color)
            ->with('symbol',$this->symbol)
            ->with('message',$this->message);
    }

    public function ini_edit($id){
        $ed=Producto::find($id);
        return view('Producto.ProductoEditar',compact('ed'));
    }

    public function update(Request $request, $id){
        $tmp=Producto::find($id);
        $x=$tmp->detalle;//obtener anterior valor

        $this->validate($request,[
            'codigo'=> 'required|max:30',
            'detalle'=> 'required|max:70',
            'pcompra'=> 'required',
            'pventa'=> 'required',
            'stock'=> 'required|max:6',
            'expmes'=> 'required|max:2',
            'expanio'=> 'required|max:4'
        ],
        [
            'codigo.required' => 'código',
            'codigo.max' => 'código máximo de 30 caracteres',
            'detalle.required' => 'descripción',
            'detalle.max' => 'descripción máximo de 70 caracteres',
            'pcompra.required' => 'precio unit. de compra',
            'pventa.required' => 'precio unit. de venta',
            'stock.required' => 'stock',
            'stock.max' => 'stock máximo de 6 números',
            'expmes.required' => 'mes',
            'expmes.max' => 'mes máximo de 2 números',
            'expanio.required' => 'año',
            'expanio.max' => 'año máximo de 4 números'
        ]);

        $upd = Producto::find($id);
        $upd->codigo = $request->get('codigo');
        $upd->detalle = $request->get('detalle');
        $upd->contiene = $request->get('contiene');
        $upd->pcompra = $request->get('pcompra');
        $upd->pventa = $request->get('pventa');
        $upd->ppromo = $request->get('ppromo');
        $upd->stock = $request->get('stock');
        $upd->expmes = $request->get('expmes');
        $upd->expanio = $request->get('expanio');
        $upd->save();

        $this->color='green';
        $this->symbol='✓';
        $this->message='Se han actualizado todos los datos';
        return redirect()->action('ProductoController@index')
            ->with('color',$this->color)
            ->with('symbol',$this->symbol)
            ->with('message',$this->message);
    }

    public function destroy($id){
        $tmp=Producto::find($id);
        $y=$tmp->detalle;//obtener anterior valor
        Producto::destroy($id);
        $this->color='green';
        $this->symbol='✓';
        $this->message='Se ha eliminado el producto: '.$y;
        return redirect()->action('ProductoController@index')
            ->with('color',$this->color)
            ->with('symbol',$this->symbol)
            ->with('message',$this->message);
    }

    public function print(){
        $todoP = Producto::orderBy('detalle')->get();
        return view('Producto.ProductoImprimir',compact('todoP'));
    }
}
