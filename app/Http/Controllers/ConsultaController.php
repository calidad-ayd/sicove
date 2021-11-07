<?php

namespace App\Http\Controllers;
use App\Models\Client;
use App\Models\User;
use App\Models\Pet;
use App\Models\Event;
use App\Models\Query;
use Illuminate\Support\Facades\Hash;
use App\Jobs\SendUserLoginDetails;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ConsultaController extends Controller
{

    public function create($mascota)
    {
        $pet = Pet::find($mascota);
        $date_generator = \Carbon\Carbon::now('America/Costa_Rica')->format('Y-m-d');
        $events = Event::where('pet_id', $pet->id)->where('fechaCita', $date_generator)->where('estado', 0)->orderBy('horaCita')->limit(1)->get()->toArray() ;
        
        if (!$pet) {
            return response("error");
        }

        return view('expedientes.consultas.add', ["pet" => $pet, "events" => $events]);
    }

    public function store(Request $request, int $id)
    {
        $messages = [
            'required' =>'query.required', 
        ];

        $validator = Validator::make($request->all(), [
            'observaciones' => 'required',
        ], $messages);

        if($validator->fails()){
            return redirect()->route('expediente_consulta_crear',['id' => $id])->withErrors($validator)->withInput();
        }else{

            $query = new Query;
            $query->observaciones = $request->observaciones;
            $query->event_id = $request->idEvento;
            $query->pet_id = $id;
            $event = Event::find($request->idEvento);
            $event->estado=1;
            $event->save();
            $query->save();

            return redirect()->route('expediente_ver', ['id' => $id])->with('message', 'query.add_redirect');
        }
    }

    public function edit($id)
    {
        $consulta = Query::find($id);

        if (!$consulta)
        {
            return view('errors.notFound');
        }
        return view('expedientes.consultas.edit', ["consulta" => $consulta]);
    }

    public function update(Request $request, $id)
    {
        $consulta = Query::find($id);

          $messages = [
            'required' =>'query.required', 
        ];        

        if ($consulta) {

             $validator = Validator::make($request->all(), [
                'observaciones' => 'required',
            ], $messages);


            if ($validator->fails()) {
                return redirect()->route('expediente_consulta_editar', ['id' => $id])->withErrors($validator)->withInput();
            } else {
                $consulta->observaciones = $request->observaciones;
                $consulta->save();
                return redirect()->route('expediente_ver', ['id' => $consulta->pet_id])->with('message', 'query.edit_redirect');
            }

        } else {
            return view('errors.notFound');
        }
    }

    public function show($id)
    {
        $query = Query::find($id);
        if (!$query) {
            return view('errors.notFound');
        }
        return view('expedientes.consultas.detalles', ['data' => $query]);
    }

    public function destroy(Request $request, $id)
    {
        $consulta = Query::find($request->registroId);
        $pet = $consulta->pet_id;
        
        if ($consulta) {
            try{
                 $consulta->delete();
            } catch(\Illuminate\Database\QueryException  $e) {
                return response()->json("error");
            }

        }

        return redirect()->route('expediente_ver', ['id' => $pet])->with('message', 'query.delete_redirect');
    }
}