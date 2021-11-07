<?php

namespace App\Http\Controllers;

use App\Models\Vaccine;
use App\Models\Pet;
use App\Models\VaccineEntry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VacunaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vacunas = Vaccine::paginate(10);
        return view('vacunas.listaVacunas', ['vacunas' => $vacunas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vacunas.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            'tipo_de_vacuna.required' =>'vacunas.tipo_required', 
            'nombre_de_la_vacuna.required' =>'vacunas.nombre_required', 
            'categoria_de_la_vacuna.required' =>'vacunas.categoria_required', 
        ];

        $validator = Validator::make($request->all(), [
        'tipo_de_vacuna' => 'required',
        'nombre_de_la_vacuna' => 'required',
        'categoria_de_la_vacuna' => 'required'
        ], $messages);

        if($validator->fails()){
            return redirect()->route('vaccines_create')->withErrors($validator)->withInput();
        }else{

            $vacuna = new Vaccine;
            $vacuna->tipo = $request->tipo_de_vacuna;
            $vacuna->nombre = $request->nombre_de_la_vacuna;
            $vacuna->categoria = $request->categoria_de_la_vacuna;
            $vacuna->save();
            return redirect()->route('vaccines_list')->with('message', 'La vacuna se ha registrado con éxito.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vacuna = Vaccine::find($id);

        return view('vacunas.editar', ["vacuna" => $vacuna]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $messages = [
            'tipo_de_vacuna.required' =>'vacunas.tipo_required', 
            'nombre_de_la_vacuna.required' =>'vacunas.nombre_required', 
            'categoria_de_la_vacuna.required' =>'vacunas.categoria_required',
        ];

        $validator = Validator::make($request->all(), [
        'tipo_de_vacuna' => 'required',
        'nombre_de_la_vacuna' => 'required',
        'categoria_de_la_vacuna' => 'required'
        ], $messages);

        $vacuna = Vaccine::find($id);

        if($validator->fails()){
            return redirect()->route('vaccines_edit', ['id' => $vacuna])->withErrors($validator)->withInput();
        }else{

            if ($vacuna) {
                $vacuna->tipo = $request->tipo_de_vacuna;
                $vacuna->nombre = $request->nombre_de_la_vacuna;
                $vacuna->categoria = $request->categoria_de_la_vacuna;
                $vacuna->save();
            }
            return redirect()->route('vaccines_list')->with('message', 'La vacuna se ha actualizado con éxito.'); 
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $vacuna = Vaccine::find($request->vacunaId);
        
        if ($vacuna) {
            $vacuna->delete();
        }

        return redirect()->route('vaccines_list')->with('message', 'La vacuna se ha eliminado con éxito.');
    }

}
