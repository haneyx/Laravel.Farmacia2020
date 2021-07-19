<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\Usuario;

class UsuarioController extends Controller
{
    public function index(){
        $todoU = Usuario::join('persona','persona.id','=','usuario.persona_id')->orderBy('persona_id')->get();
        return view('Usuario.Usuario',compact('todoU'));
    }

    public function ini_create(){
        return view('Usuario.UsuarioAgregar');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'dni_ruc'=> 'required|max:8',
            'nombre_razon'=> 'required|max:30',
            'apellidos'=> 'required|max:35',
            'pass'=> 'required|max:20'
        ],
        [
            'dni_ruc.required' => 'dni',
            'dni_ruc.max' => 'dni máximo de 8 números',
            'nombre_razon.required' => 'nombres',
            'nombre_razon.max' => 'nombres máximo de 30 letras',
            'apellidos.required' => 'apellidos',
            'apellidos.max' => 'apellidos máximo de 35 letras',
            'pass.required' => 'contraseña',
            'pass.max' => 'contraseña máximo de 20 caracteres'
        ]);

        $q = DB::connection('mysql_procedure')
            ->select('CALL Add_U(?,?,?,?,?)',array(
                $request->get('master'),
                $request->get('dni_ruc'),
                $request->get('pass'),
                $request->get('nombre_razon'),
                $request->get('apellidos')
            ));

        $E=$q[0]->error;
        if($E==1){
            $this->color='red';
            $this->symbol='✘';
            $this->message='No se puede agregar al usuario: '.$request->get('nombre_razon').' con un DNI que ya existe';
        }else{
            $this->color='green';
            $this->symbol='✓';
            $this->message='Se ha agregado el usuario: '.$request->get('nombre_razon').' '.$request->get('apellidos');
        }

        return redirect()->action('UsuarioController@index')
            ->with('color',$this->color)
            ->with('symbol',$this->symbol)
            ->with('message',$this->message);
    }

    public function ini_edit($id){
        $ed=Usuario::join('persona','persona.id','=','usuario.persona_id')
            ->where('persona_id','=',$id)->first();
        return view('Usuario.UsuarioEditar',compact('ed'));
    }

    public function update(Request $request, $id){

        $this->validate($request,[
            'dni_ruc'=> 'required|max:8',
            'nombre_razon'=> 'required|max:30',
            'apellidos'=> 'required|max:35',
            'pass'=> 'required|max:20'
        ],
        [
            'dni_ruc.required' => 'dni',
            'dni_ruc.max' => 'dni máximo de 8 números',
            'nombre_razon.required' => 'nombres',
            'nombre_razon.max' => 'nombres máximo de 30 letras',
            'apellidos.required' => 'apellidos',
            'apellidos.max' => 'apellidos máximo de 35 letras',
            'pass.required' => 'contraseña',
            'pass.max' => 'contraseña máximo de 20 caracteres'
        ]);

        $q = DB::connection('mysql_procedure')
        ->select('CALL Upd_U(?,?,?,?,?,?)',array(
            $id,
            $request->get('master'),
            $request->get('dni_ruc'),
            $request->get('pass'),
            $request->get('nombre_razon'),
            $request->get('apellidos')
        ));
        $E=$q[0]->error;
        if($E==0){
            $this->color='green';
            $this->symbol='✓';
            $this->message='Se han actualizado todos los datos';
        }
        return redirect()->action('UsuarioController@index')
            ->with('color',$this->color)
            ->with('symbol',$this->symbol)
            ->with('message',$this->message); 
    }

    public function destroy($id){
        $ed=Usuario::join('persona','persona.id','=','usuario.persona_id')
            ->where('persona_id','=',$id)->first();
        $y=$ed->nombre_razon.' '.$ed->apellidos;//nombre anterior

        $q = DB::connection('mysql_procedure')
        ->select('CALL Del_U(?)',array($id));
        $E=$q[0]->error;
        if($E==0){
            $this->color='green';
            $this->symbol='✓';
            $this->message='Se ha eliminado el usuario: '.$y;
        }
        return redirect()->action('UsuarioController@index')
            ->with('color',$this->color)
            ->with('symbol',$this->symbol)
            ->with('message',$this->message); 
    }
}
