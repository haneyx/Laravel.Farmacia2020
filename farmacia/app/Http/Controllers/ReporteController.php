<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\Reporte;

class ReporteController extends Controller
{
    public function index()
    {
        return view('Reporte.Reporte');
    }

    public function search(Request $request){
        $this->validate($request,[
            'dia'=> 'required|max:2',
            'anio'=> 'required|max:4'
        ],
        [
            'dia.required' => 'día',
            'dia.max' => 'día máximo de 2 números',
            'anio.required' => 'año',
            'anio.max' => 'año máximo de 4 números'
        ]);

        $D = $request->get('anio').'-'.$request->get('mes').'-'.$request->get('dia');
        $this->date = $D;
        $txt=$request->get('dia').' de ';
        switch($request->get('mes')){
            case 1: $txt.='Enero';break;
            case 2: $txt.='Febrero';break;
            case 3: $txt.='Marzo';break;
            case 4: $txt.='Abril';break;
            case 5: $txt.='Mayo';break;
            case 6: $txt.='Junio';break;
            case 7: $txt.='Julio';break;
            case 8: $txt.='Agosto';break;
            case 9: $txt.='Setiembre';break;
            case 10: $txt.='Octubre';break;
            case 11: $txt.='Noviembre';break;
            case 12: $txt.='Diciembre';break;
        }
        $this->fecha=$txt.' del '.$request->get('anio');

        $todoR = Reporte::select('detalle','cantidad','precio','formato','atiende')
            ->join('linea','venta.id','=','linea.venta_id')
            ->join('producto','producto.id','=','linea.producto_id')
            ->where('fecha',$D)
            ->orderBy('linea.id')
            ->get();

        $a = DB::connection('mysql_procedure')->select('CALL Ini_C(?)',array($D));
        $this->ini = $a[0]->ini;
        $b = DB::connection('mysql_procedure')->select('CALL Dia_C(?)',array($D));
        $this->dia = $b[0]->dia;
        $c = DB::connection('mysql_procedure')->select('CALL Sum_C(?)',array($D));
        $this->sum = $c[0]->sum;
        

        return view('Reporte.ReporteBuscar',compact('todoR'))
            ->with('fecha',$this->fecha)
            ->with('ini',$this->ini)
            ->with('dia',$this->dia)
            ->with('sum',$this->sum)
            ->with('date',$this->date);
    }

    public function ini_caja($id)
    {
        $txt='';
        $F = explode('-',$id);
        switch($F[1]){
            case 1: $txt='ENERO';break;
            case 2: $txt='FEBRERO';break;
            case 3: $txt='MARZO';break;
            case 4: $txt='ABRIL';break;
            case 5: $txt='MAYO';break;
            case 6: $txt='JUNIO';break;
            case 7: $txt='JULIO';break;
            case 8: $txt='AGOSTO';break;
            case 9: $txt='SETIEMBRE';break;
            case 10: $txt='OCTUBRE';break;
            case 11: $txt='NOVIEMBRE';break;
            case 12: $txt='DICIEMBRE';break;
        }
        $this->fecha = $F[2].' DE '.$txt.' DEL '.$F[0];

        $a = DB::connection('mysql_procedure')->select('CALL Ini_C(?)',array($id));
        $this->ini = $a[0]->ini;

        return view('Reporte.ReporteCaja')
            ->with('id',$id)
            ->with('fecha',$this->fecha)
            ->with('ini',$this->ini);
    }

    public function upd_caja(Request $request,$id)
    {
        $this->validate($request,[
            'inicial'=> 'required'
        ],
        [
            'inicial.required' => 'la caja inicial'
        ]);

        $q = DB::connection('mysql_procedure')->select('CALL Upd_C(?,?)',array($id,$request->get('inicial')));
        $E=$q[0]->error;
        if($E==0){
            $this->color='green';
            $this->symbol='✓';
            $this->message='La caja inicial del día: '.$request->get('fecha').' AHORA ES '.$request->get('inicial');
        }

        return redirect()->action('ReporteController@index')
            ->with('color',$this->color)
            ->with('symbol',$this->symbol)
            ->with('message',$this->message);
    }
}