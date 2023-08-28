<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $datos=User::orderBy('id','asc')->paginate(10);
        $datos=DB::table('model_has_roles')->join('roles','model_has_roles.role_id','=','roles.id')->join('users','model_has_roles.model_id','=','users.id')->orderBy('users.id','asc')->paginate(10);

        // return [
        //     'paginacion'=>[
        //         'total'=>$datos->total(),
        //         'current_page'=>$datos->currentPage(),// pagina actual
        //         'per_page'=>$datos->perPage(),// por pagina
        //         'last_page'=>$datos->lastPage(),//ultima pagina
        //         'from'=>$datos->firstItem(),// desde
        //         'to'=>$datos->total(),// hasta
        //     ],
        //     'listauser'=>$datos
        // ];
       
        return response()->json($datos, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function buscar($id)
    {
        $datos=User::where('id',$id)->get();
            //return response()->json($datos);
            return $datos;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function newuser(Request $request)
    {
        // aqui se tiene que guardar para user del sistema, paciente, cirujano
        $todo=$request->all();
        // $datubigeo=explode(" ", $request->ubigeo);

        $user=new User();
        $user->tipo_doc='DNI';
        $user->ap_paterno=$request->apellido_pat;
        $user->ap_materno=$request->apellido_mat;
        $user->email=$request->correo;
        $user->direccion=$request->direccion;
        $user->num_doc=$request->dni;
        $user->estadocivil=$request->estadocivil;
        $user->fecha_nac=$request->fecha_nac;
        $user->foto=$request->foto;
        $user->nombre=$request->nombres;
        $user->sexo=$request->sexo;
        $user->celular=$request->telefono;
        $user->telefono=$request->telefono;        
        $user->ubigeo=$request->ubigeo;
        $user->password=Hash::make($request->dni);
        $user->save();

        DB::insert('insert into model_has_roles (role_id, model_type,model_id) values (?, ?,?)', [$request->rol, 'App\Models\User',$user->id]);
        
        // $user->password =  Hash::make($request->new_password);
        return $this->index();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function reniec($id)
    {
        $url=env('RENIEC').$id;
        $retorno = file_get_contents($url);
        return $retorno;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function rolesuser()
    {
        $roles=DB::table('roles')->get();
        return $roles;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function borraruser($id)
    {
        $eliminar = User::where('id', $id)->delete();

        return response()->json($eliminar, 202); 
    }
}
