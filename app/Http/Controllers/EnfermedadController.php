<?php

namespace App\Http\Controllers;

use App\Models\Disease;
use App\Models\Pet;
use App\Models\DiseaseEntry;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class EnfermedadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $enfermedades = Disease::paginate(10);
        return view('enfermedades.lista', ['enfermedades' => $enfermedades]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('enfermedades.crear');
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
            'tipo.required' => 'diseases.tipo_required',
            'tipo.unique' => 'diseases.tipo_unique',
            'tipo.string' => 'diseases.tipo_string',
            'categoria.required' => 'diseases.categoria_required',
            'categoria.numeric' => 'diseases.categoria_numeric',
            'categoria.between' => 'diseases.categoria_between',
            'nombre.required' => 'diseases.nombre_required',
            'nombre.string' => 'diseases.nombre_string',
        ];


        $validator = Validator::make($request->all(), [
            'tipo' => 'string|required|unique:diseases',
            'categoria' => 'required|numeric|between:0,2',
            'nombre' => 'string|required'
        ], $messages);
        

        if ($validator->fails()) {
            return redirect()->route('disease_create')->withErrors($validator)->withInput();
        } else {
            $enfermedad = new Disease;
            $enfermedad->tipo = $request->tipo;
            $enfermedad->nombre = $request->nombre;
            $enfermedad->categoria = $request->categoria;
            $enfermedad->save();
            return redirect()->route('diseases_list')->with('message', 'diseases.mensaje4');
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
        $enfermedad = Disease::find($id);

        if (!$enfermedad)
        {
            return view('errors.notFound');
        }
        return view('enfermedades.editar', ["enfermedad" => $enfermedad]);
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
        $enfermedad = Disease::find($id);

          $messages = [
            'tipo.required' => 'diseases.tipo_required',
            'tipo.unique' => 'diseases.tipo_unique',
            'tipo.string' => 'diseases.tipo_string',
            'categoria.required' => 'diseases.categoria_required',
            'categoria.numeric' => 'diseases.categoria_numeric',
            'categoria.between' => 'diseases.categoria_between',
            'nombre.required' => 'diseases.nombre_required',
            'nombre.string' => 'diseases.nombre_string',
        ];        

        if ($enfermedad) {

             $validator = Validator::make($request->all(), [
                'tipo' => [
                    'string',
                    'required',
                    Rule::unique('diseases')->ignore($enfermedad->tipo, 'tipo'),
                ],
                'categoria' => 'required|numeric|between:0,2',
                'nombre' => 'string|required'
            ], $messages);


            if ($validator->fails()) {
                return redirect()->route('disease_edit', ['id' => $id])->withErrors($validator)->withInput();
            } else {
                $enfermedad->tipo = $request->tipo;
                $enfermedad->nombre = $request->nombre;
                $enfermedad->categoria = $request->categoria;
                $enfermedad->save();
                return redirect()->route('diseases_list')->with('message', 'diseases.mensaje2'); 
            }

        } else {
            return view('errors.notFound');
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
        $enfermedad = Disease::find($request->enfermedadId);
        
        if ($enfermedad) {
            try{
                 $enfermedad->delete();
            } catch(\Illuminate\Database\QueryException  $e) {
                return response()->json("error");
            }

        }
        return redirect()->route('diseases_list')->with('message', 'diseases.mensaje3');
    }

}
