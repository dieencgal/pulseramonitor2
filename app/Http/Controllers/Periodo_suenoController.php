<?php

namespace App\Http\Controllers;

use App\Periodo_sueno;
use App\Registro_sueno;
use Illuminate\Http\Request;
use Auth;

class Periodo_suenoController extends Controller
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

            $periodo_suenos = Periodo_sueno::all();


            return view('periodo_suenos.index', ['periodo_suenos' => $periodo_suenos]);

        } else {
            if (Periodo_sueno::all()->isEmpty()){
                $periodo_suenos = Periodo_sueno::all();
                return view('periodo_suenos.index', ['periodo_suenos' => $periodo_suenos]);

            }else {
                $registros = Registro_sueno::all()->where('paciente_id', (Auth::user()->id) - 1);
                foreach ($registros as $registro) {
                    $periodo_suenos = Periodo_sueno::all()->where( 'registro_id',$registro->paciente_id);
                    // Code Here
                }

                /* $periodo_suenos = Periodo_sueno::all()->where('registro_id', Auth::user()->id);*/

                return view('periodo_suenos.index', ['periodo_suenos' => $periodo_suenos]);
            }
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */



        public function create(){

        if ((Auth::user()->hasRole('admin'))){
            $registro_suenos = Registro_sueno::all()->pluck('paciente_id','id');

            return view('pasos/create', ['registro_suenos' => $registro_suenos]);
        }

        else{
            $registro_suenos = Registro_sueno::all()->where('paciente_id',(Auth::user()->id)-1)->pluck('fecha','id');
            $pacientes = Registro_sueno::all()->where('id',(Auth::user()->id)-1)->pluck('nombre','id');

            return view('periodo_suenos/create',['registro_suenos'=>$registro_suenos]);
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
            'fases_sueno' => 'required|max:255',
            'tiempo_inicio' => 'required|date',
            'tiempo_fin' => 'required|date',
            'registro_id' => 'required|exists:registro_suenos,id'
        ]);
        $periodo_sueno = new Periodo_sueno($request->all());
        $periodo_sueno->save();

        // return redirect('especialidades');

        flash('El periodo del sueño se ha creado correctamente');

        return redirect()->route('periodo_suenos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Medico  $medico
     * @return \Illuminate\Http\Response
     */
    public function show(Periodo_sueno $periodo_sueno)
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
        $periodo_sueno = Periodo_sueno::find($id);

        $registro_suenos = Registro_sueno::all()->pluck('paciente_id','id');


        return view('periodo_suenos/edit',['periodo_sueno'=> $periodo_sueno, 'registro_suenos'=>$registro_suenos ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Medico  $medico
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $this->validate($request, [

            'fases_sueno' => 'required|max:255',
            'tiempo_inicio' => 'required|date',
            'tiempo_fin' => 'required|date',
            'registro_id' => 'required|exists:registro_suenos,id'
        ]);


        $periodo_sueno = Periodo_sueno::find($id);
        $periodo_sueno->fill($request->all());

        $periodo_sueno->save();

        flash('El periodo del sueño se ha modificado correctamente');

        return redirect()->route('periodo_suenos.index');
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
        $periodo_sueno = Periodo_sueno::find($id);
        $periodo_sueno->delete();
        flash('El periodo del sueño se ha modificado correctamente');

        return redirect()->route('periodo_suenos.index');}
        else{
            flash('Sólo los médicos pueden borrar datos');
            return redirect()->route('periodo_suenos.index');
        }
    }
}
