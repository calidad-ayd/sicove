<?php

namespace App\Http\Controllers;
use Auth;
use App\Models\Event;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Jobs\SendMailDeleteEvent;

class ClientEventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $cliente = auth()->user()->client;
        $pendings = DB::table('events')
        ->join('pets', 'events.pet_id', '=', 'pets.id')
        ->join('clients', 'pets.client_id', '=', 'clients.id')
        ->join('veterinaries', 'events.veterinary_id', '=', 'veterinaries.id')
        ->where('clients.id', '=', $cliente->id)
        ->select('events.*', 'events.id AS citaId', 'pets.*', 'veterinaries.nombre AS veterinaryNombre', 'veterinaries.primerApellido')
         ->orderBy('fechaCita', 'desc')
        ->orderBy('horaCita', 'asc')
        ->get();
        return view('citasCliente.index', ['data' => $pendings]);
    }

    public function pendings()
    {
        $cliente = auth()->user()->client;
        $pendings = DB::table('events')
        ->join('pets', 'events.pet_id', '=', 'pets.id')
        ->join('clients', 'pets.client_id', '=', 'clients.id')
        ->join('veterinaries', 'events.veterinary_id', '=', 'veterinaries.id')
        ->where('clients.id', '=', $cliente->id)
        ->whereDate('fechaCita', '>=', \Carbon\Carbon::now('America/Costa_Rica')->format('Y-m-d'))
        ->select('events.*', 'events.id AS citaId', 'pets.*', 'veterinaries.nombre AS veterinaryNombre', 'veterinaries.primerApellido')
        ->get();
        return view('citasCliente.pendings', ['data' => $pendings]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $cita = Event::find($request->citaId);
        if (!$cita) {
            return view('errors.notFound');
        }
        SendMailDeleteEvent::dispatch($cita);

        $cita->delete();
        return redirect()->route('citas_index')->with('message', 'La cita se ha cancelado con éxito.');
    }

}
