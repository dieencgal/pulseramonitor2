<?php

namespace App\Http\Controllers;

use App\Paciente;
use Illuminate\Http\Request;
use App\Medico;

use Auth;

class PacienteController extends Controller
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
       /* $pacientes = Paciente::all();
        if(($pacientes->contains('id',1))==true){

           $pacientes->


        }*/
       /* $pacientes = Paciente::all();

        if(($pacientes->contains('id',1))==true) {
            $color = Paciente::where('id', 1);
            $color->delete();
            return view('pacientes.index', ['pacientes' => $pacientes]);
        }*/

        if ((Auth::user()->hasRole('admin'))){

        $pacientes = Paciente::all();
            return view('pacientes.index', ['pacientes' => $pacientes]);
        }
        else {
            $pacientas = (Paciente::all()->where('id', ((Auth::user()->id))-1))->isEmpty();
            $pacientes = (Paciente::all()->where('id', ((Auth::user()->id))-1));



            if ($pacientas == true) {


                return view('pacientes.index', ['pacientes' => $pacientes]);
            }else {
                $pacientes = (Paciente::all()->where('id', ((Auth::user()->id))-1));


                return view('pacientes.creat', ['pacientes' => $pacientes]);
            }
        }

    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $medicos = Medico::all()->pluck('nombre','id');

        return view('pacientes/create',['medicos'=>$medicos]);
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
            'edad' => 'required|date',
            'peso' => 'required|max:255',
            'altura' => 'required|max:255',
            'sexo' => 'required|max:255',
            'operacion' => 'required|max:255',
            'tipo_paciente' => 'required|max:255',
            'medico_id' => 'required|exists:medicos,id'
    ]);
    $paciente = new Paciente($request->all());
    $paciente->save();

    // return redirect('especialidades');

    flash('paciente creado correctamente');

    return redirect()->route('pacientes.index');
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
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $paciente = Paciente::find($id);

        $medicos = Medico::all()->pluck('nombre','id');


        return view('pacientes/edit',['paciente'=> $paciente, 'medicos'=>$medicos ]);
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
            'nombre' => 'required|max:255',
            'apellidos' => 'required|max:255',
            'edad' => 'required|date',
            'peso' => 'required|max:255',
            'altura' => 'required|max:255',
            'sexo' => 'required|max:255',
            'operacion' => 'required|max:255',
            'tipo_paciente' => 'required|max:255',
            'medico_id' => 'required|exists:medicos,id'
        ]);

        $paciente = Paciente::find($id);
        $paciente->fill($request->all());

        $paciente->save();

        flash('paciente modificado correctamente');

        return redirect()->route('pacientes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Medico  $medico
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   if ((Auth::user()->hasRole('admin'))) {

        $paciente = Paciente::find($id);
        $paciente->delete();
        flash('paciente borrado correctamente');

        return redirect()->route('pacientes.index');}
    else{
            flash('Sólo los médicos pueden borrar datos');
            return redirect()->route('pacientes.index');
        }
    }
}
