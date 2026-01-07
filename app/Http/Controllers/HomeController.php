<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Citas;
use App\Models\Tratamiento;
use App\Models\Historial;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('inicio');//->except('inicio');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function inicio()
    {
        return view('welcome');
    }
    public function reportes()
    {

        $pacientes = User::role('Paciente')->get();
        $dentitas = User::role('Cirujano')->get();
        $citas = Citas::all();
        $tratamientos = Tratamiento::all();

        return response()->json([
            'pacientes' => $pacientes->count(),
            'dentistas' => $dentitas->count(),
            'citas' => $citas->count(),
            'tratamientos' => $tratamientos->count(),
        ]);

    }
}
