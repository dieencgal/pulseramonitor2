<?php

namespace App\Http\Controllers;

use App\Medico;
use Illuminate\Http\Request;
use Auth;

class MedicoController extends Controller
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
        $medicos = Medico::all();

        return view('medicos/index')->with('medicos', $medicos);

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('medicos/create');
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
        'nombre' => 'required|max:255',
        'apellidos' => 'required|max:255',


    ]);
    $medico = new Medico($request->all());
    $medico->save();

    // return redirect('especialidades');

    flash('medico creado correctamente');

    return redirect()->route('medicos.index');
}

    /**
     * Display the specified resource.
     *
     * @param  \App\Medico  $medico
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
        $medico = Medico::find($id);




        return view('medicos/edit')->with('medico', $medico);

    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request,$id)
    {
        $this->validate($request, [
            'nombre' => 'required|max:255',
            'apellidos' => 'required|max:255',

        ]);

        $medico = Medico::find($id);
        $medico->fill($request->all());

        $medico->save();

        flash('medico modificado correctamente');

        return redirect()->route('medicos.index');
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

        $medico = Medico::find($id);
        $medico->delete();
        flash('medico borrado correctamente');

        return redirect()->route('medicos.index');
        }
        else{
            flash('Sólo los médicos pueden borrar datos');
            return redirect()->route('medicos.index');
        }
    }
    public function destroyAll()
    {
        Medico::truncate();
        flash('Todas los medicos borrados correctamente');

        return redirect()->route('medicos.index');
    }
}
