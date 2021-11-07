<?php

namespace App\Http\Controllers;
use App\Models\Pet;
use App\Models\Disease;
use App\Models\DiseaseEntry;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

class DiseaseEntryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($mascota)
    {
       $pet = Pet::find($mascota);
       return view('registroEnfermedad.index', ["pet" => $pet]);
    }
        public function IndexClient(int $id)
    {
        $pet = Pet::find($id);
        return view('registroEnfermedad.enfermedadClient', ["pet"=> $pet]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($mascota)
    {
        $pet = Pet::find($mascota);

        if (!$pet) {
            return response("error");
        }

        $diseases = Disease::all();
        return view('expedientes.enfermedades.add', ["pet" => $pet, "diseases" => $diseases]);
        //return view('registroEnfermedad.crear', ["pet" => $pet, "diseases" => $diseases]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $mascota)
    {
       $messages = [
            'fecha_diagnostico.date' => 'diseases.fecha_diagnostico_date',
            'fecha_diagnostico.required' => 'diseases.fecha_diagnostico_required',
            'estado_avance.required' => 'diseases.estado_avance_required',
            'estado_avance.numeric' => 'diseases.estado_avance_numeric',
            'estado_avance.between' => 'diseases.estado_avance_between',
            'disease_id.required' => 'diseases.disease_id_required',
            'disease_id.numeric' => 'diseases.disease_id_numeric',
            'disease_id.exists' => 'diseases.disease_id_exists',
        ];


        $validator = Validator::make($request->all(), [
            'fecha_diagnostico' => 'date|required',
            'estado_avance' => 'required|numeric|between:0,2',
            'disease_id' => 'numeric|required|exists:App\Models\Disease,id',
        ], $messages);
        

        if ($validator->fails()) {
            return redirect()->route('expediente_enfermedad_crear', ['id' => $mascota])->withErrors($validator)->withInput();
        } else {
            $entry = new DiseaseEntry;
            $entry->fecha_diagnostico = $request->fecha_diagnostico;
            $entry->estado_avance = $request->estado_avance;
            $entry->pet_id = $mascota;
            $entry->disease_id = $request->disease_id;
            $entry->save();
            return redirect()->route('expediente_ver', ['id' => $mascota])->with('message', 'diseases.mensaje4');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function show($id)
    {
        $disease = DiseaseEntry::find($id);
        if (!$disease) {
            return view('errors.notFound');
        }
        return view('expedientes.enfermedades.consultar', ['data' => $disease]);
    }
    public function showDetail($id)
    {
        $disease = DiseaseEntry::find($id);

        return view('expedientes.enfermedades.consultar', ['data' => $disease]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $entry = DiseaseEntry::find($id);
        $diseases = Disease::all();

        if (!$entry)
        {
            return view('errors.notFound');
        }
        return view('expedientes.enfermedades.edit', ['data' => $entry, 'diseases' => $diseases]);
        //return view('registroEnfermedad.editar', ['data' => $entry, 'diseases' => $diseases]);
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
        $disease = DiseaseEntry::find($id);

        $messages = [
            'fecha_diagnostico.date' => 'diseases.fecha_diagnostico_date',
            'fecha_diagnostico.required' => 'diseases.fecha_diagnostico_required',
            'estado_avance.required' => 'diseases.estado_avance_required',
            'estado_avance.numeric' => 'diseases.estado_avance_numeric',
            'estado_avance.between' => 'diseases.estado_avance_between',
            'disease_id.required' => 'diseases.disease_id_required',
            'disease_id.numeric' => 'diseases.disease_id_numeric',
            'disease_id.exists' => 'diseases.disease_id_exists',
        ];


        $validator = Validator::make($request->all(), [
            'fecha_diagnostico' => 'date|required',
            'estado_avance' => 'required|numeric|between:0,2',
            'disease_id' => 'numeric|required|exists:App\Models\Disease,id',
        ], $messages);
        

        if ($validator->fails()) {
            return redirect()->route('expediente_enfermedad_editar', ['id' => $id])->withErrors($validator)->withInput();
        } else {
            $disease->fecha_diagnostico = $request->fecha_diagnostico;
            $disease->estado_avance = $request->estado_avance;
            $disease->disease_id = $request->disease_id;
            $disease->save();
            return redirect()->route('expediente_ver', ['id' => $disease->pet->id])->with('message', 'diseases.mensaje2');
        }

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $disease = DiseaseEntry::find($id);
        $pet = $disease->pet_id;
        if($disease){
            $disease->delete();
        }
        return redirect()->route('expediente_ver', ['id' => $pet])->with('message', 'diseases.mensaje3');
    }
}
