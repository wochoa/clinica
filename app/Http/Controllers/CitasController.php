<?php

namespace App\Http\Controllers;

use App\Models\Citas;
use App\Models\User;
use App\Models\Servicios;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DateTime;
use DateInterval;

class CitasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function nuevacita(Request $request)
    {
        // $datcita=$request->all();
        // if($request->tipo<>'OTROS'){
        //     $hora2='2:00:00';
        //     list($h, $m, $s) = explode(':', $hora2); //Separo los elementos de la segunda hora
        //     $a = new DateTime($request->hora_ini.':00'); //Creo un DateTime
        //     $b = new DateInterval(sprintf('PT%sH%sM%sS', $h, $m, $s)); //Creo un DateInterval
        //     $a->add($b); //SUMO las horas
        //     $horafinal=$a->format('H:i:s');
        //     // return $a->format('H:i:s'); //Retorno la Suma
        // }
        // else{
        //     $horafinal=$request->hora_fin;
        // }
        $horafinal=$request->hora_fin;
        $userreg=Auth::id();
        $datcita=new Citas();
        $datcita->idpaciente=$request->idpaciente;
        $datcita->idservicio=$request->idservicios;        ;
        $datcita->iduser=$userreg;
        $datcita->tipo_cita=$request->tipo;
        $datcita->fecha_inicial=$request->fechaini;
        $datcita->fecha_fin=$request->fechafin;
        $datcita->hora_inicial=$request->hora_ini;
        $datcita->hora_fin=$horafinal;
        $datcita->color=$request->color;
        $datcita->titulo_evento=$request->titulo;
        $datcita->save();
        return $datcita;
    }
    public function nuevacitapaciente(Request $request)
    {
            if($request->idpaciente){
            $hora2='1:00:00';
            list($h, $m, $s) = explode(':', $hora2); //Separo los elementos de la segunda hora
            $a = new DateTime($request->hora_ini.':00'); //Creo un DateTime
            $b = new DateInterval(sprintf('PT%sH%sM%sS', $h, $m, $s)); //Creo un DateInterval
            $a->add($b); //SUMO las horas
            $horafinal=$a->format('H:i:s');
            // return $a->format('H:i:s'); //Retorno la Suma
        }
        else{
            $horafinal=$request->hora_fin;
        }

        // $horafinal=$request->hora_fin;
        $userreg=Auth::id();
        $datcita=new Citas();

        $datcita->idpaciente=$request->idpaciente;
        $datcita->idservicio=$request->idservicios;        ;
        $datcita->iduser=$userreg;
        $datcita->tipo_cita=$request->tipo;
        $datcita->fecha_inicial=$request->fechaini;
        $datcita->fecha_fin=$request->fechafin;
        $datcita->hora_inicial=$request->hora_ini;
        $datcita->hora_fin=$horafinal;
        $datcita->color=$request->color;

        $datcita->save();
        return $datcita;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Citas  $citas
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $datos=Citas::all();
        if(count($datos))
        {
            foreach($datos as $itm)
        {
            $fechainicialhora=$itm->fecha_inicial.' '.$itm->hora_inicial;
            $fechafinhora=$itm->fecha_fin.' '.$itm->hora_fin;
            if($itm->idpaciente)
            {
                $user=User::find($itm->idpaciente);
                $servi=Servicios::find($itm->idservicio);
                $titulo=$user->nombre.' '.$user->ap_paterno.' '.$user->pa_materno.'->'.$servi->nom_servicio;
                $todfoeldia=false;
            }
            else{
                $titulo=$itm->titulo_evento;
                $todfoeldia=true;  
            }
            

            $array[]=[
                'title'=>$titulo,
                'start'=>$fechainicialhora,
                'end'=>$fechafinhora,
                'allDay'=>$todfoeldia,
                'backgroundColor'=>$itm->color,
                'borderColor'=>$itm->color,
            ];
        }
        return $array;
        }
    }
    public function citapendiente()
    {
        $datos=Citas::join('users','citas.idpaciente','=','users.id')->where('atendido',0)->get();
        return $datos;
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Citas  $citas
     * @return \Illuminate\Http\Response
     */
    public function edit(Citas $citas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Citas  $citas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Citas $citas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Citas  $citas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Citas $citas)
    {
        //
    }
}
