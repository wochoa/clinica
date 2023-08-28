<?php

namespace App\Http\Controllers;

use App\Models\Tratamiento;
use App\Models\Historial;
use Illuminate\Http\Request;


class TratamientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos=Tratamiento::join('users','tratamientos.idpaciente','=','users.id')->get();
        return $datos;
    }
    public function tratamientoxid($id)
    {
        $datos=Tratamiento::join('users','tratamientos.idpaciente','=','users.id')->where('idtratamientos',$id)->limit(1)->get();
        $odontogeneral=json_decode($datos[0]->data_odontograma);
        // $odontogeneral=$datos[0]->data_odontograma;
        $detalletratamiento=Historial::where('idtratamiento',$id)->get();
        $adelantos=Historial::where('idtratamiento',$id)->sum('pago_adelanto');
        return response()->json(['tratamiento'=>$datos,'odontogeneral'=>$odontogeneral,'historial'=>$detalletratamiento,'sumaadelanto'=>$adelantos], 200);
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
    public function nuevotratamiento(Request $request)
    {
        $datos=$request->all();
        $formadata=$request->formularios;
        $datodontograma=json_encode($request->odontograma,JSON_UNESCAPED_UNICODE);

        
        // foreach($datodontograma as $indexexp=>$valorexp)
        //     {
        //         $arrayexpe[$indexexp] = array($valorexp);
        //     }
        //     $jsonexperiencia=json_encode($arrayexpe,JSON_UNESCAPED_UNICODE);

        $tra=new Tratamiento();
        $tra->idpaciente=$formadata['idpaciente'];
        $tra->titulo_tratamiento=$formadata['titulo'];
        $tra->diagnostico=$formadata['diagnostico'];
        $tra->costo_total=$formadata['costo'];
        $tra->adelanto=$formadata['adelanto'];
        $tra->data_odontograma=$datodontograma;
        $tra->save();


        $his=new Historial();
        $his->tit_diagnostico=$formadata['titulo'];
        $his->text_diagnostico=$formadata['diagnostico'];
        $his->pago_adelanto=$formadata['adelanto'];
        $his->h_odontograma=$datodontograma;
        $his->idtratamiento=$tra->idtratamientos;
        $his->save();

        return $datodontograma;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tratamiento  $tratamiento
     * @return \Illuminate\Http\Response
     */
    public function show(Tratamiento $tratamiento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tratamiento  $tratamiento
     * @return \Illuminate\Http\Response
     */
    public function edit(Tratamiento $tratamiento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tratamiento  $tratamiento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tratamiento $tratamiento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tratamiento  $tratamiento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tratamiento $tratamiento)
    {
        //
    }
}
