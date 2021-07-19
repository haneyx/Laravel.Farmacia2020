<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Luecano\NumeroALetras\NumeroALetras;
use App\Venta;
use App\Reporte;

class VentaController extends Controller
{
    public function index(){
        return view('Venta.Venta');
    }
    
    public function searchC(Request $request){
        $todoP = Venta::where('codigo','=',$request->code)
            ->orderBy('detalle')
            ->get();
        return view('Venta.VentaTabla',compact('todoP'));
    }

    public function searchN(Request $request){
        $todoP = Venta::where('detalle','LIKE','%'.$request->name."%")
            ->orderBy('detalle')
            ->get();
        return view('Venta.VentaTabla',compact('todoP'));
    }

    public function store(Request $request)
    {
        $this->recibo=-1;
        $this->ultimo=-1;
        if($request->get('lot')==0){$this->alerta='Nada que vender';}
        else{
            $x = DB::connection('mysql_procedure')
                ->select('CALL Venta_P(?,?,?,?,?,?,?,?)',array(
                    $request->get('formato'),
                    $request->get('tipo'),
                    $request->get('dni_ruc'),
                    $request->get('nombre_razon'),
                    $request->get('direccion'),
                    $request->get('atiende'),
                    $request->get('lot'),
                    $request->get('array'),
                ));
            $E=$x[0]->error;

            if($E==0){
                $this->alerta='Venta realizada correctamente';
                $this->recibo=$request->get('formato');
            }

            $y = DB::connection('mysql_procedure')
                ->select('CALL Ult_V()');
            $U=$y[0]->ult;
            $this->ultimo=$U;
        }

        return redirect()->action('VentaController@index')
            ->with('alerta',$this->alerta)
            ->with('recibo',$this->recibo)
            ->with('ultimo',$this->ultimo);
    }

    public function print($id){
        $todoV = Reporte::select('codigo','cantidad','detalle','precio','total','atiende','fecha','formato','serie','numero','tipo','dni_ruc','nombre_razon','direccion')
            ->join('linea','venta.id','=','linea.venta_id')
            ->join('producto','producto.id','=','linea.producto_id')
            ->join('persona','persona.id','=','venta.persona_id')
            ->where('venta_id',$id)
            ->orderBy('linea.id')
            ->get();
        $this->cl0=$todoV[0]->dni_ruc;
        $this->cl1=$todoV[0]->nombre_razon;
        $this->cl2=$todoV[0]->direccion;
        $this->cl3=$todoV[0]->tipo;

        $this->fo=$todoV[0]->formato;
        $this->se=$todoV[0]->serie;
        $cn=8-strlen($todoV[0]->numero); $ceros='';
        for($i=0;$i<$cn;$ceros.='0',$i++){}
        $this->nu=$ceros.$todoV[0]->numero;
        $this->fe=str_replace('-','/',$todoV[0]->fecha);
        $this->lt=(new NumeroALetras())->toMoney($todoV[0]->total, 2, 'SOLES', 'CÉNTIMOS');
        $this->cajero=$todoV[0]->atiende;
        return view('Venta.VentaImprimir',compact('todoV'))
            ->with('fo',$this->fo)
            ->with('se',$this->se)
            ->with('nu',$this->nu)
            ->with('fe',$this->fe)
            ->with('cl0',$this->cl0)
            ->with('cl1',$this->cl1)
            ->with('cl2',$this->cl2)
            ->with('cl3',$this->cl3)
            ->with('lt',$this->lt)
            ->with('cajero',$this->cajero);
    }
}