<?php

namespace App\Http\Controllers;

use App\Registro_sueno;
use App\Paciente;
use Illuminate\Http\Request;
use Auth;

class Registro_suenoController extends Controller
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
        if ((Auth::user()->hasRole('admin'))) {
            $registro_suenos = Registro_sueno::all();

            return view('registro_suenos/index')->with('registro_suenos', $registro_suenos);
        }else{
            $registro_suenos = Registro_sueno::all()->where('paciente_id',(Auth::user()->id)-1);
            return view('registro_suenos.index', ['registro_suenos' => $registro_suenos]);
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
            return view('registro_suenos/create', ['pacientes' => $pacientes]);
        }

        else{

            $pacientes = Paciente::all()->where('id',(Auth::user()->id)-1)->pluck('id');

            return view('registro_suenos/create', ['pacientes' => $pacientes[0]]);
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
    {
        $this->validate($request, [

            'tiempo_inicio' => 'required|date',
            'tiempo_fin' => 'required|date',
            'paciente_id' => 'required|exists:pacientes,id'
        ]);
        $registro_suenos = new Registro_sueno($request->all());
        $registro_suenos->save();

        // return redirect('especialidades');

        flash('El registro del sueño se ha creado correctamente');

        return redirect()->route('registro_suenos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Medico  $medico
     * @return \Illuminate\Http\Response
     */
    public function show(Registro_sueno $registro_sueno)
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
        $registro_suenos = Registro_sueno::find($id);

        $pacientes = Paciente::all()->pluck('nombre','id');


        return view('registro_suenos/edit',['registro_sueno'=> $registro_suenos, 'paciente'=>$pacientes ]);
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

            'tiempo_inicio' => 'required|date',
            'tiempo_fin' => 'required|date',
            'paciente_id' => 'required|exists:pacientes,id'
        ]);


        $registro_sueno = Registro_sueno::find($id);
        $registro_sueno->fill($request->all());

        $registro_sueno->save();

        flash('El registro del sueño se ha modificado correctamente');

        return redirect()->route('registro_suenos.index');
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
            $registro_sueno = Registro_sueno::find($id);
            $registro_sueno->delete();
            flash('El registro del sueño se ha modificado correctamente');

            return redirect()->route('registro_suenos.index');
        }
        else{
            flash('Sólo los médicos pueden borrar datos');
            return redirect()->route('registro_suenos.index');
        }
    }
}
