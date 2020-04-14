<?php

namespace App\Http\Controllers;

use App\Frecuencia_cardiaca;
use App\Paciente;
use Auth;

use Illuminate\Http\Request;

class Frecuencia_cardiacaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $userId = Auth::user()->id;

        if ((Auth::user()->hasRole('admin'))){
            $frecuencia_cardiacas = Frecuencia_cardiaca::all();

            return view('frecuencia_cardiacas.index',['frecuencia_cardiacas'=>$frecuencia_cardiacas]);
        }else{
            $frecuencia_cardiacas = Frecuencia_cardiaca::all()->where('paciente_id',($userId)-1);

            return view('frecuencia_cardiacas.index', ['frecuencia_cardiacas' => $frecuencia_cardiacas]);
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){

        if ((Auth::user()->hasRole('admin'))){
            $pacientes = Paciente::all()->pluck('nombre','id');
            return view('frecuencia_cardiacas/create', ['pacientes' => $pacientes]);
        }

        else{

            $pacientes = Paciente::all()->where('id',(Auth::user()->id)-1)->pluck('id');

            return view('frecuencia_cardiacas/create', ['pacientes' => $pacientes[0]]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    //
    public function store(Request $request)
    { //'frec_cardiaca', 'tiempo_inicio','tiempo_fin','paciente_id'
        $this->validate($request, [
            'fecha' => 'required|date',
            'frec_cardiaca_media' => 'required|max:255',
            'frec_cardiaca_max' => 'required|max:255',
            'frec_cardiaca_min' => 'required|max:255',
            'paciente_id' => 'required|exists:pacientes,id'
        ]);
        $frecuencia_cardiaca = new Frecuencia_cardiaca($request->all());
        $frecuencia_cardiaca->save();

        // return redirect('especialidades');

        flash('La frecuencia cardiaca se ha creado correctamente');

        return redirect()->route('frecuencia_cardiacas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Medico  $medico
     * @return \Illuminate\Http\Response
     */
    public function show(Frecuencia_cardiaca $frec_cardiaca)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Medico  $medico
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $frecuencia_cardiaca = Frecuencia_cardiaca::find($id);

        $pacientes = Paciente::all()->pluck('nombre','id');


        return view('frecuencia_cardiacas/edit',['frecuencia_cardiaca'=> $frecuencia_cardiaca, 'pacientes'=>$pacientes ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Medico  $medico
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'fecha' => 'required|date',
            'frec_cardiaca_media' => 'required|max:255',
            'frec_cardiaca_max' => 'required|max:255',
            'frec_cardiaca_min' => 'required|max:255',
            'paciente_id' => 'required|exists:pacientes,id'
        ]);


        $frecuencia_cardiaca = Frecuencia_cardiaca::find($id);
        $frecuencia_cardiaca->fill($request->all());

        $frecuencia_cardiaca->save();

        flash('La frecuencia cardiaca modificado correctamente');

        return redirect()->route('frecuencia_cardiacas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Medico  $medico
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ((Auth::user()->hasRole('admin'))) {
            $frecuencia_cardiaca = Frecuencia_cardiaca::find($id);
            $frecuencia_cardiaca->delete();
            flash('La frecuencia cardiaca se ha borrado correctamente');

            return redirect()->route('frecuencia_cardiacas.index');

        }
        else{
            flash('Sólo los médicos pueden borrar datos');
            return redirect()->route('frecuencia_cardiacas.index');
        }
    }
}
