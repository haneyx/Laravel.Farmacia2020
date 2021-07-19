<?php
namespace App\Http\Controllers;
use App\Http\Requests;
use Illuminate\Http\Request;
use DB;
use PDF;

class BestInterviewQuestionController extends Controller
{
    public function producto(Request $request){
        $items = DB::table("producto")->orderBy('detalle')->get();
        view()->share('items',$items);

        if($request->has('download')){
            $pdf = PDF::loadView('Producto.ProductoPDF');
            $pdf->setPaper('A4', 'landscape');
            return $pdf->download('Inventario.pdf');
        }
        return view('producto');
    }
}