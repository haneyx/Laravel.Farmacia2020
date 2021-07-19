<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Recibo;

class ReciboController extends Controller
{
    public function index(){
        $todoR = Recibo::orderBy('id')->get();
        return view('Recibo.Recibo',compact('todoR'));
    }
    public function update(Request $request){
        $this->validate($request,[
            'sb'=> 'required|max:4',
            'nb'=> 'required|max:8',
            'sf'=> 'required|max:4',
            'nf'=> 'required|max:8'
        ],
        [
            'sb.required' => 'serie de la boleta',
            'sb.max' => 'serie de la boleta máximo de 4 caracteres',
            'nb.required' => 'número de la boleta',
            'nb.max' => 'número de la boleta máximo de 8 digitos',
            'sf.required' => 'serie de la factura',
            'sf.max' => 'serie de la factura máximo de 4 caracteres',
            'nf.required' => 'número de la factura',
            'nf.max' => 'número de la factura máximo de 8 digitos',
        ]);

        $updB = Recibo::find(3);
        $updB->serie = $request->get('sb');
        $updB->numero = $request->get('nb');
        $updB->save();

        $updF = Recibo::find(1);
        $updF->serie = $request->get('sf');
        $updF->numero = $request->get('nf');
        $updF->save();

        $this->color='green';
        $this->symbol='✓';
        $this->message='Se han actualizado todos los datos';
        return redirect()->action('ReciboController@index')
            ->with('color',$this->color)
            ->with('symbol',$this->symbol)
            ->with('message',$this->message);
    }
}
