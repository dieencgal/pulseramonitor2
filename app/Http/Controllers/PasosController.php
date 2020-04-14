<?php

namespace App\Http\Controllers;

use App\Paso;
use App\Paciente;
use Auth;
use Illuminate\Http\Request;

class PasosController extends Controller
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
            $pasos = Paso::all();

            return view('pasos.index', ['pasos' => $pasos]);
        } else {

            $pasos = Paso::all()->where('paciente_id', (Auth::user()->id) - 1);

            return view('pasos.index', ['pasos' => $pasos]);
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
            return view('pasos/create', ['pacientes' => $pacientes]);
        }

    else{

        $pacientes = Paciente::all()->where('id',(Auth::user()->id)-1)->pluck('id');


        return view('pasos/create', ['pacientes' => $pacientes[0]]);
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
            'fecha' => 'required|date',
            'num_pasos' => 'required|max:255',
            'distancia' => 'required|max:255',
            'paciente_id' => 'required|exists:pacientes,id'
        ]);
        $pasos = new Paso($request->all());
        $pasos->save();

        // return redirect('especialidades');

        flash('Los pasos se han creado correctamente');

        return redirect()->route('pasos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Medico  $medico
     * @return \Illuminate\Http\Response
     */
    public function show(Paso $pasos)
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
        $pasos = Paso::find($id);

        $paciente = Paciente::all()->pluck('nombre','id');


        return view('pasos/edit',['paso'=> $pasos, 'paciente'=>$paciente ]);
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
            'num_pasos' => 'required|max:255',
            'distancia' => 'required|max:255',
            'paciente_id' => 'required|exists:pacientes,id'
        ]);


        $paso = Paso::find($id);
        $paso->fill($request->all());

        $paso->save();

        flash('Los pasos se han modificado correctamente');

        return redirect()->route('pasos.index');
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
        $paso = Paso::find($id);
        $paso->delete();
        flash('Los pasos se han borrado correctamente');

        return redirect()->route('pasos.index');
        }
        else{
            flash('Sólo los médicos pueden borrar datos');
            return redirect()->route('pasos.index');
        }

    }


}
