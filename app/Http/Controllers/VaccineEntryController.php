<?php

namespace App\Http\Controllers;
use App\Models\Pet;
use App\Models\Vaccine;
use App\Models\VaccineEntry;
use Illuminate\Http\Request;
use App\Models\Client;
use Illuminate\Support\Facades\Validator;
class VaccineEntryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($mascota)
    {
       $pet = Pet::find($mascota);
       return view('RegistroVacunas.vacunasVet', ["pet" => $pet]);
    }

    public function IndexClient(int $id)
    {
        $pet = Pet::find($id);
        return view('RegistroVacunas.vacunasClient', ["pet"=> $pet]);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($mascota)
    {
        $pet = Pet::find($mascota);
        $vacunas = Vaccine::all();
        return view('expedientes.vacunas.add', ["pet" => $pet, "vaccines" => $vacunas]);
      //  return view('RegistroVacunas.agregarRegistro', ["pet" => $pet, "vaccines" => $vacunas]);
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
            'required' =>'vacunas.required',
            'fecha_de_aplicacion.before' => 'vacunas.fechaV', 
        ];

        $validator = Validator::make($request->all(), [
        'fecha_de_aplicacion' => 'required|date|before:tomorrow'
        ], $messages);

        if($validator->fails()){
            return redirect()->route('expediente_vacuna_crear', ['id' => $mascota])->withErrors($validator)->withInput();
        }else{

            $entry = new VaccineEntry;
        $entry->fecha_aplicacion = $request->fecha_de_aplicacion;
        $entry->pet_id = $mascota;
        $entry->vaccine_id = $request->vacuna;
        $entry->save();
          return redirect()->route('expediente_ver', ['id' => $mascota])->with('message', 'La vacuna se ha registrado con éxito.');
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
        $vaccine = VaccineEntry::find($id);

        return view('RegistroVacunas.detalles', ['data' => $vaccine]);
    }
      public function showDetail($id)
    {
        $vaccine = VaccineEntry::find($id);

        return view('RegistroVacunas.detallesClient', ['data' => $vaccine]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $entry = VaccineEntry::find($id);
        $vaccines = Vaccine::all();
        return view('expedientes.vacunas.edit', ['data' => $entry, 'vaccines' => $vaccines]);
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
            'required' =>'vacunas.required',
            'fecha_de_aplicacion.before' => 'vacunas.fechaV', 
        ];

        $validator = Validator::make($request->all(), [
        'fecha_de_aplicacion' => 'required|date|before:tomorrow'
        ], $messages);

        $vaccine = VaccineEntry::find($id);

        if($validator->fails()){
            return redirect()->route('expediente_vacuna_editar', ['id' => $id])->withErrors($validator)->withInput();
        }else{

            $vaccine->fecha_aplicacion = $request->fecha_de_aplicacion;
            $vaccine->vaccine_id = $request->vacuna;
            $vaccine->save();
            return redirect()->route('expediente_ver', ['id' => $vaccine->pet->id])->with('message', 'El registro se ha editado con éxito.');
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
        $vaccine = VaccineEntry::find($id);
        $mascota = $vaccine->pet_id;

        $vaccine->delete();

        return redirect()->route('expediente_ver', ['id' => $mascota])->with('message', 'La vacuna se ha eliminado con éxito.');
    }
}
