<?php

namespace App\Http\Controllers;
use App\Models\Pet;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Auth;
class PetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('pets.add');
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
            'nombre.required' =>'pet.nombre_required',
            'tipo.required' =>'pet.tipo_required',
            'raza.required' =>'pet.raza_required',
            'fecha_de_nacimiento.required' =>'pet.fecha_de_nacimiento_required',
            'fecha_de_nacimiento.before' => 'pet.fecha_de_nacimimento_before',  
        ];

        $validator = Validator::make($request->all(), [
        'nombre' => 'required',
        'tipo' => 'required',
        'raza' => 'required',
        'fecha_de_nacimiento' => 'required|date|before:tomorrow',
        'foto' => 'nullable'
        ], $messages);

        if($validator->fails()){
            return redirect()->route('pet_create',['id' => $id])->withErrors($validator)->withInput();
        }else{

            $pet = new Pet;
            $pet->nombre = $request->nombre;
            $pet->tipoDeAnimal = $request->tipo;
            $pet->raza = $request->raza;
            $pet->fechaNacimiento = $request->fecha_de_nacimiento;
            $pet->client_id = $id;

            $pet->save();

            if (!is_null($request->file('foto')) || strlen($request->file('foto'))>0) {
                $path = $request->file('foto')->store('mascotas/'.$pet->id, 'minio');
                $pet->foto = $path;
            }
            
            $pet->save();


            return redirect()->route('clients_show', ['id' => $id])->with('message', 'La mascota se ha registrado con éxito.');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pet = Pet::find($id);
        if(!$pet) {
            return view('errors.notFound');
        }
        return view('pets.edit', ['pet' => $pet]);
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
            'nombre.required' =>'pet.nombre_required',
            'tipo.required' =>'pet.tipo_required',
            'raza.required' =>'pet.raza_required',
            'fecha_de_nacimiento.required' =>'pet.fecha_de_nacimiento_required',
            'fecha_de_nacimiento.before' => 'pet.fecha_de_nacimimento_before', 
        ];

        $validator = Validator::make($request->all(), [
        'nombre' => 'required',
        'raza' => 'required',
        'fecha_de_nacimiento' => 'required|date|before:tomorrow',
        'foto' => 'nullable'
        ], $messages);

        if($validator->fails()){
            return redirect()->route('pet_edit',['id' => $id])->withErrors($validator)->withInput();
        }else{

            $pet = Pet::find($id);
            if ($pet) {
                $pet->nombre = $request->nombre;
                $pet->raza = $request->raza;
                $pet->fechaNacimiento = $request->fecha_de_nacimiento;

                if($request->foto){
                    $path = $request->file('foto')->store('mascotas/'.$pet->id, 'minio');
                    $pet->foto = $path;
                    
                }
                $pet->save();
            } else {
                return view('errors.notFound');
            }

            return redirect()->route('clients_show', ['id' => $pet->client_id])->with('message', 'La mascota se ha modificado con éxito.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pet = Pet::find($id);
        $cliente = $pet->client_id;
        if ($pet) {
            $pet->delete();
        } else {
            return view('errors.notFound');
        }

        return redirect()->route('clients_show', ['id' => $cliente])->with('message', 'La mascota se ha eliminado con éxito.');     
    }
}
