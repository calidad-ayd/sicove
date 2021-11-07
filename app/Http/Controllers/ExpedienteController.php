<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\DiseaseEntry;
use App\Models\Event;
use App\Models\Indicator;
use App\Models\Query;
use App\Models\VaccineEntry;
use App\Http\Controllers\ImageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use PDF;

class ExpedienteController extends Controller
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
    public function show($id, $start = null, $end = null)
    {
        $pet = Pet::find($id);
        $date_generator = \Carbon\Carbon::now('America/Costa_Rica')->format('Y-m-d');

        if(is_null($start) && is_null($end)) {
            //$events = Event::where('pet_id', $id)->where('estado', 0)->where('fechaCita', $date_generator)->paginate(10, ['*'], 'events');
            $events = Event::where('pet_id', $id)->where('estado', 0)->where('fechaCita', $date_generator)->orderBy('horaCita')->limit(1)->get()->toArray() ;
            $queries = Query::where('pet_id', $id)->paginate(10, ['*'], 'queries');
            $diseases = DiseaseEntry::where('pet_id', $id)->paginate(10, ['*'], 'diseases');
            $indicators = Indicator::where('pet_id', $id)->paginate(10, ['*'], 'indicators');
            $vaccines = VaccineEntry::where('pet_id', $id)->paginate(10, ['*'], 'vaccines');
        } else {
            //$events = Event::where('pet_id', $id)->where('estado', 0)->where('fechaCita', $date_generator)->paginate(10, ['*'], 'events');
            $events = Event::where('pet_id', $id)->where('estado', 0)->where('fechaCita', $date_generator)->orderBy('horaCita')->limit(1)->get()->toArray() ;
            $queries = Query::where('pet_id', $id)->paginate(10, ['*'], 'queries');
            $diseases = DiseaseEntry::where('pet_id', $id)->whereBetween('fecha_diagnostico', [$start, $end])->paginate(10, ['*'], 'diseases');
            $indicators = Indicator::where('pet_id', $id)->whereBetween('fechaConsulta', [$start, $end])->paginate(10, ['*'], 'indicators');
            $vaccines = VaccineEntry::where('pet_id', $id)->whereBetween('fecha_aplicacion', [$start, $end])->paginate(10, ['*'], 'vaccines');
        }

        return view('expedientes.show', ['pet' => $pet, 'events' => $events,'queries' => $queries, 'diseases' => $diseases, 'indicators' => $indicators, 'vaccines' => $vaccines, 'start' => $start, 'end' => $end]);
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
    public function destroy($id)
    {
        //
    }

    public function search(Request $request, $id)
    {
         $messages = [
            'required' =>'El :attribute es requerido',
            'start.required' =>'La fecha de inicio es requerida',
            'end.required' =>'La fecha de fin es requerida',
        ];

        $validator = Validator::make($request->all(), [
        'start' => 'required|date|before_or_equal:now',
        'end' => 'required|date|after_or_equal:start',
        ], $messages);

        if (!$validator->fails()) {
            return redirect()->route('expediente_ver',['id' => $id, 'start' => $request->start, 'end' => $request->end]);
        } else {
            return redirect()->route('expediente_ver', ['id' => $id, 'start' => null, 'end' => null])->withErrors($validator)->withInput();
        }
    }

    public function pdf($id, $start = null, $end = null)
    {
        $pet = Pet::find($id);
        $date_generator = \Carbon\Carbon::now('America/Costa_Rica')->format('d/m/Y');
        $image = ImageController::getImage($pet->foto);
        if(is_null($start) && is_null($end)) {
            $diseases = DiseaseEntry::where('pet_id', $id)->get();
            $indicators_kg = Indicator::where('pet_id', $id)->Tipo(1)->get();
            $indicators_cm = Indicator::where('pet_id', $id)->Tipo(2)->get();
            $indicators_gc = Indicator::where('pet_id', $id)->Tipo(3)->get();
            $vaccines = VaccineEntry::where('pet_id', $id)->get();
        } else {
            $diseases = DiseaseEntry::where('pet_id', $id)->whereBetween('fecha_diagnostico', [$start, $end])->get();
            $indicators_kg = Indicator::where('pet_id', $id)->Tipo(1)->whereBetween('fechaConsulta', [$start, $end])->get();
            $indicators_cm = Indicator::where('pet_id', $id)->Tipo(2)->whereBetween('fechaConsulta', [$start, $end])->get();
            $indicators_gc = Indicator::where('pet_id', $id)->Tipo(3)->whereBetween('fechaConsulta', [$start, $end])->get();
            $vaccines = VaccineEntry::where('pet_id', $id)->whereBetween('fecha_aplicacion', [$start, $end])->get();
        }
        $temporal = bin2hex(openssl_random_pseudo_bytes(3));

        $pdf = PDF::loadView('expedientes.pdf', ['pet' => $pet, 'foto' =>  $image, 'diseases' => $diseases, 'vaccines' => $vaccines, 'indicators_kg' => $indicators_kg, 'indicators_cm' => $indicators_cm, 'indicators_gc' => $indicators_gc, 'start' => $start, 'end' => $end, 'date' => $date_generator]);
        return $pdf->download('expediente_'.$pet->nombre.'_'.$temporal.'.pdf');
    }

    public function email($id, $start = null, $end = null)
    {
        $pet = Pet::find($id);
        $date_generator = \Carbon\Carbon::now('America/Costa_Rica')->format('d/m/Y');
        $image = ImageController::getImage($pet->foto);
        if(is_null($start) && is_null($end)) {
            $diseases = DiseaseEntry::where('pet_id', $id)->get();
            $indicators_kg = Indicator::where('pet_id', $id)->Tipo(1)->get();
            $indicators_cm = Indicator::where('pet_id', $id)->Tipo(2)->get();
            $indicators_gc = Indicator::where('pet_id', $id)->Tipo(3)->get();
            $vaccines = VaccineEntry::where('pet_id', $id)->get();
        } else {
            $diseases = DiseaseEntry::where('pet_id', $id)->whereBetween('fecha_diagnostico', [$start, $end])->get();
            $indicators_kg = Indicator::where('pet_id', $id)->Tipo(1)->whereBetween('fechaConsulta', [$start, $end])->get();
            $indicators_cm = Indicator::where('pet_id', $id)->Tipo(2)->whereBetween('fechaConsulta', [$start, $end])->get();
            $indicators_gc = Indicator::where('pet_id', $id)->Tipo(3)->whereBetween('fechaConsulta', [$start, $end])->get();
            $vaccines = VaccineEntry::where('pet_id', $id)->whereBetween('fecha_aplicacion', [$start, $end])->get();
        }
        $temporal = bin2hex(openssl_random_pseudo_bytes(3));

        $pdf = PDF::loadView('expedientes.pdf', ['pet' => $pet, 'foto' =>  $image, 'diseases' => $diseases, 'vaccines' => $vaccines, 'indicators_kg' => $indicators_kg, 'indicators_cm' => $indicators_cm, 'indicators_gc' => $indicators_gc, 'start' => $start, 'end' => $end, 'date' => $date_generator]);
        
        $data = ["user" => auth()->user(), "temporal" => $temporal, "pet" => $pet];

        Mail::send('emails.expedienteExportedMail', $data, function($message)use($data,$pdf) {
            $message->to($data["user"]->email, $data["user"]->name)
            ->subject("Expediente veterinario de ".$data["pet"]->nombre." exportado")
            ->attachData($pdf->output(), 'expediente_'.$data["pet"]->nombre.'_'.$data["temporal"].'.pdf');
            });

        return redirect()->route("expediente_ver", ['id' => $id, 'start' => $start, 'end' => $end]);
        //return $pdf->download('expediente_'.$pet->nombre.'_'.$temporal.'.pdf');
    }
}
