<?php

namespace App\Http\Controllers;


use App\Models\Advance;

use App\Models\Pet;
use App\Models\Client;
use App\Models\DiseaseEntry;
use App\Models\Treatment;
use App\Models\Indicator;
use App\Models\VaccineEntry;
use App\Http\Controllers\ImageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use PDF;

class TreatmentController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $DiseaseEntry = DiseaseEntry::find($id);
        if (!$DiseaseEntry)
        {
            return view('errors.notFound');
        }
        return view('expedientes.enfermedades.tratamientos.add', ['id' => $id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
         $messages = [
            'indicacion.string' => 'treatment.string',
            'indicacion.required' => 'treatment.i_required',
            'periodicidad.required' => 'treatment.p_required',
            'periodicidad.string' => 'treatment.p_string',
            'duracion.numeric' => 'treatment.d_numeric',
            'duracion.required' => 'treatment.d_required',
            'duracion.min' => 'treatment.d_min',
            'duracion.max' => 'treatment.d_max',
        ];


        $validator = Validator::make($request->all(), [
            'indicacion' => 'string|required',
            'periodicidad' => 'required|string',
            'duracion' => 'numeric|required|min:1|max:365',
        ], $messages);
        
       if ($validator->fails()) {
            return redirect()->route('expediente_tratamiento_crear', ['id' => $id])->withErrors($validator)->withInput();
        } else {
            $entry = new Treatment;
            $entry->disease_entry_id = $id;
            $entry->indicacion = $request->indicacion;
            $entry->periodicidad = $request->periodicidad;
            $entry->finalizacion = \Carbon\Carbon::now('America/Costa_Rica')->addDays($request->duracion);
            $entry->active = true;
            $entry->save();
            return redirect()->route('expediente_enfermedad_detalles', ['id' => $id])->with('message', 'El tratamiento ha sido creado satisfactoriamente.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function list($id)
    {
        $tratamiento = Treatment::find($id);
        if($tratamiento){
            return view('expedientes.enfermedades.tratamientos.avance',['id'=> $id,'tratamiento'=>$tratamiento]);
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
        $tratamiento = Treatment::find($id);
        if($tratamiento){
            return view('expedientes.enfermedades.tratamientos.edit',['id'=> $id,'tratamiento'=>$tratamiento]);
        }
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
            'observaciones.string' => 'treatment.obs_chains',
            'observaciones.required' => 'treatment.obs',
            'indicacion.string' => 'treatment.string',
            'indicacion.required' => 'treatment.i_required',
            'periodicidad.required' => 'treatment.p_required',
            'periodicidad.string' => 'treatment.p_string',
            'duracion.numeric' => 'treatment.d_numeric',
            'duracion.required' => 'treatment.d_required',
            'duracion.min' => 'treatment.d_min',
            'duracion.max' => 'treatment.d_max',
        ];


        $validator = Validator::make($request->all(), [
            'indicacion' => 'string|required',
            'observaciones' => 'string|required',
            'periodicidad' => 'required|string',
            'duracion' => 'numeric|required|min:0|max:365',
        ], $messages);
        
       if ($validator->fails()) {
            return redirect()->route('expediente_tratamiento_edit', ['id' => $id])->withErrors($validator)->withInput();
        } else {
            $entry =Treatment::find($id);
            $avance = new Advance;
            $cambioPeridiocidad=false;     //cambio
            if( $entry->periodicidad==$request->periodicidad){
                $cambioPeridiocidad=true;  //se mantiene
            }
            $entry->indicacion = $request->indicacion;
            $entry->periodicidad = $request->periodicidad;
            $entry->finalizacion = \Carbon\Carbon::parse($entry->finalizacion)->addDays($request->duracion);
            $entry->active = true;
            $entry->save();


            $avance->treatment_id = $entry->id;
            $avance->dosis = $request->dosis;
            $avance->indicaciones = $request->indicacion;
            $avance->periodoModif =0;//mantiene
            if(  $cambioPeridiocidad==false){
                $avance->periodoModif =1;//cambio
            }
            $avance->periodicidad = $request->periodicidad;
            $avance->finalizacion =  $entry->finalizacion;
            $avance->observaciones = $request->observaciones;
            $avance->save();
            return redirect()->route('expediente_tratamiento_advance',['id'=> $entry->id,'tratamiento'=>$entry])->with('message', 'Se ha agregado un nuevo avance al tratamiento satisfactoriamente.');
           // return redirect()->route('expediente_enfermedad_detalles', ['id' => $entry->disease_entry_id])->with('message', 'El tratamiento ha sido actualizado satisfactoriamente.');
        }
    }

    public function pdf($id, $start = null, $end = null)
    {
        $pet = Pet::find($id);
        $date_generator = \Carbon\Carbon::now('America/Costa_Rica')->format('d/m/Y');
        $image = ImageController::getImage($pet->foto);
        if(is_null($start) && is_null($end)) {
            $diseases = DiseaseEntry::where('pet_id', $id)->get();
        } else {
            $diseases = DiseaseEntry::where('pet_id', $id)->whereBetween('fecha_diagnostico', [$start, $end])->get();
        }
        $temporal = bin2hex(openssl_random_pseudo_bytes(3));

        $pdf = PDF::loadView('expedientes.enfermedades.tratamientos.pdf', ['pet' => $pet, 'foto' =>  $image, 'diseases' => $diseases, 'start' => $start, 'end' => $end, 'date' => $date_generator]);
        return $pdf->download('tratamientos_'.$pet->nombre.'_'.$temporal.'.pdf');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $treatment = Treatment::find($request->id);
        $diseaseEntry = $treatment->diseaseEntry->pet_id;

        if ($treatment) {
            $treatment->delete();
        }

        return redirect()->route('expediente_ver', ['id' => $diseaseEntry])->with('message', 'El tratamiento ha sido eliminado satisfactoriamente.');
    }
}
