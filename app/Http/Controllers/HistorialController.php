<?php

namespace App\Http\Controllers;

use App\Models\Historial;
use App\Models\Tratamiento;
use Illuminate\Http\Request;

class HistorialController extends Controller
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
    public function addhistorial(Request $request)
    {
        $datos=$request->all();

        $formadata=$request->formulariosupd;
        $idtratamiento=$formadata['idtratamiento'];
        $datodontograma_gral=json_encode($request->odontograma_gral,JSON_UNESCAPED_UNICODE);
        $datodontograma_his=json_encode($request->odontograma_his,JSON_UNESCAPED_UNICODE);

        
        $uptra=Tratamiento::find($idtratamiento);
        $uptra->data_odontograma=$datodontograma_gral;
        $uptra->save();


        // $tra=new Tratamiento();
        // $tra->idpaciente=$formadata['idpaciente'];
        // $tra->titulo_tratamiento=$formadata['titulo'];
        // $tra->diagnostico=$formadata['diagnostico'];
        // $tra->costo_total=$formadata['costo'];
        // $tra->adelanto=$formadata['adelanto'];
        // $tra->data_odontograma=$datodontograma;
        // $tra->save();


        $his=new Historial();
        $his->tit_diagnostico=$formadata['titulo'];
        $his->text_diagnostico=$formadata['diagnostico'];
        $his->pago_adelanto=$formadata['adelanto'];
        $his->h_odontograma=$datodontograma_his;
        $his->idtratamiento=$idtratamiento;
        $his->save();

        return $idtratamiento;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Historial  $historial
     * @return \Illuminate\Http\Response
     */
    public function show(Historial $historial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Historial  $historial
     * @return \Illuminate\Http\Response
     */
    public function edit(Historial $historial)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Historial  $historial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Historial $historial)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Historial  $historial
     * @return \Illuminate\Http\Response
     */
    public function destroy(Historial $historial)
    {
        //
    }
}
