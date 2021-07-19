<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\Login;

class LoginController extends Controller
{
    public function boot(){
        view()->composer('*',function($view)
        {
            $view->with('master',session('master'))->with('usuario',session('usuario'))
            ->with('h1',session('h1'))->with('h2',session('h2'));
        });
    }

    public function index(){
        $k = DB::connection('mysql_procedure')
            ->select('CALL Chk_K()');
        $kr=$k[0]->error;
        if($kr==1) return view('Activar.Activar');
        else return view('Login.Login');
    }

    public function start(Request $request){
        $this->validate($request,[
            'user'=> 'required',
            'pass'=> 'required'
        ]);

        $a = DB::connection('mysql_procedure')
        ->select('CALL Login(?,?)',array(
            $request->get('user'),
            $request->get('pass')
        ));
        $M=$a[0]->link;

        if($M>0){
            $b = DB::connection('mysql_procedure')
            ->select('CALL Get_N(?)',array(
                $request->get('user')
            ));
            $nameu=$b[0]->us;

            session(['master' => $M]);
            session(['usuario' => $nameu]);

            session(['h1' => 'BOTICA']);
            session(['h2' => 'DON MIGUEL']);

            $c = DB::connection('mysql_procedure')
            ->select('CALL Rev_C');
            $I=$c[0]->ini;

            if($I==0){
                return redirect()->action('LoginController@ini_caja');
            }else{
                return redirect()->action('VentaController@index');
            }

        }else{ return redirect()->action('LoginController@index'); }
    }

    public function exit(){
        session()->forget('master');
        session()->forget('usuario');
        return redirect()->action('LoginController@index');
    }
    public function ini_caja(){
        return view('Login.LoginCaja');
    }

    public function store(Request $request){
        $this->validate($request,[
            'inicial'=> 'required'
        ],
        [
            'inicial.required' => 'EL VALOR DE LA CAJA INICIAL'
        ]);

        $d = DB::connection('mysql_procedure')
        ->select('CALL Set_C(?)',array($request->get('inicial')));
        $Z=$d[0]->error;
        if($Z==0){
            return redirect()->action('VentaController@index');
        }
    }

    public function store_key(Request $request){
        $ki = DB::connection('mysql_procedure')
        ->select('CALL Ins_K(?)',array($request->get('codigo')));
        if($ki[0]->error==0){
            return redirect()->action('LoginController@index');
        }
    }
}
