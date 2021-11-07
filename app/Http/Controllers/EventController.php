<?php

namespace App\Http\Controllers;
use App\Models\Veterinary;
use App\Models\Client;
use App\Models\Pet;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Jobs\SendMailCreationEvent;
use App\Jobs\SendMailUpdateEventDetails;
use App\Jobs\SendMailDeleteEvent;
use Illuminate\Support\Facades\Auth;
// carbon
use Carbon\Carbon;

class EventController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id  = null)
    {
      
      $veterinario=Veterinary::find(Auth::user()->veterinary->id);

      $pet= Pet::find($id);
      if($veterinario and $pet){
        $month = date("Y-m");
        //
        $data = $this->calendar_month($month);
        $mes = $data['month'];
        // obtener mes en espanol
        $mespanish = $this->spanish_month($mes);
        $mes = $data['month'];
        $agendaMes= Event::where("veterinary_id","=",$veterinario->id)->get()->sortBy('horaCita');

        return view("citas.calendario",['id'=>$id,'pet'=>$pet,'veterinario'=>$veterinario,
          'data' => $data,
          'mes' => $mes,
          'mespanish' => $mespanish,
          'agenda'=>$agendaMes,
          'today'=>date("Y-m-d")
        ]);
      }else{
        return view('errors.notFound');
      }
    }

   public function create($id, $date)
    {
       $pet=Pet::find($id);
        if(date("Y-m-d",strtotime($date))>=date("Y-m-d")){
          $veterinario=Veterinary::find(Auth::user()->veterinary->id);
          $citas=Event::where("veterinary_id","=",$veterinario->id)->where("fechaCita","=",$date)->get();
          $horasDisponiles=$this->getHoras($veterinario->id,$date);
         
          return view('citas.agendarCita',['id' => $id,'pet'=>$pet,'veterinario'=>$veterinario,'date'=>$date,'citas'=>$citas,"horasDisponiles"=>$horasDisponiles]);
        }else{
          return redirect()->route('otroMes',['id' => $id,'pet'=>$pet,'month'=>$date])->with('message', 'La fecha seleccionada es inválida!');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id, $date)
    { 
      $pet= Pet::find($id);
      $message= [
        'hora.required'=>'calendario.hora_M',
        'descripcion.required'=>'calendario.descripcion_M',
        'dia.after'=>'calendario.dia_M',
        'indicaciones.required'=>'calendario.indicaciones_M',
       
      ];
      $validator = Validator::make($request->all(), [
        'hora' => 'required',
        'descripcion' => 'required',
        'indicaciones' => 'required',
        'dia'=>'required|date|after:yesterday',
      ],$message);
      if($validator->fails()){
          return redirect()->route('vet.agendarCita',['id'=>$id,'pet'=>$pet,'date'=>$date])->withErrors($validator)->withInput();
      }else{
          $cita = new Event;
          $cita->fechaCita = $request->dia;
          $month=date('Y-m',strtotime($cita->fechaCita));
          $cita->horaCita = $request->hora;
          $cita->veterinary_id = $request->veterinario_id;
          $cita->pet_id = $request->selectPet;
          $cita->descripcion = $request->descripcion;
          $cita->indicaciones = $request->indicaciones;
          $cita->estado=0;
          $cita->save();

          SendMailCreationEvent::dispatch($cita);
          //return view('errors.notFound');
          
          return redirect()->route('otroMes',['id' => $id,'pet'=>$pet,'month'=>$month])->with('message', 'La cita se ha agendado con éxito!');  //id mascota
      }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id_cita)
    {
      $cita= Event::find($id_cita);
      if($cita){
        $message= [
            'hora.required'=>'calendario.hora_M',
            'descripcion.required'=>'calendario.descripcion_M',
            'indicaciones.required'=>'calendario.indicaciones_M',
        ];
        $validator = Validator::make($request->all(), [
            'hora' => 'required',
            'descripcion' => 'required',
            'indicaciones'=>'required'
        ],$message);
        if($validator->fails()){
            return redirect()->route('vet.editEvent',['id_cita'=> $id_cita])->withErrors($validator)->withInput();
        }
        else{
          //old event store if required.
          $oldTime = $cita->horaCita;
          $oldDescription = $cita->descripcion;

          $month=date('Y-m',strtotime($cita->fechaCita));
          $cita->horaCita = $request->hora;
          $cita->descripcion = $request->descripcion;
          $cita->indicaciones = $request->indicaciones;
          $cita->save();
          $pet=Pet::find($cita->pet_id);
          SendMailUpdateEventDetails::dispatch($cita);
          return redirect()->route('otroMes',['id' => $pet->id,'pet'=> $pet,'month'=>$month])->with('message', 'La cita se ha modificado con éxito!');
        }
    }else{
      return view('errors.notFound');
    }
  }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_cita)
    {
      $veterinario = auth()->user()->veterinary;
        $cita=Event::find($id_cita);
        $month=date('Y-m',strtotime($cita->fechaCita));
        $pet=Pet::find($cita->pet_id);
        $id_Vet=$cita->veterinary_id ;
        if ($cita) 
        {
            SendMailDeleteEvent::dispatch($cita);
            $cita->delete();
            return redirect()->route('otroMes',['id' => $pet->id, 'pet' => $pet,'month'=>$month])->with('message', 'La cita se ha eliminado con éxito!');;
        }else{
          return view('errors.notFound');
        }
        
    
    }
    public function edit($id)
    {   
      $veterinario = auth()->user()->veterinary;
      $cita= Event::find($id);
      if($cita){
        $horasDisponiles=$this->getHoras($cita->veterinary_id,$cita->fechaCita);
        $veterinario= Veterinary::find($cita->veterinary_id);
        array_unshift($horasDisponiles,$cita->horaCita);
        return view('citas.editEvent',['cita'=>$cita, 'horasDisponiles'=>$horasDisponiles,'veterinario'=>$veterinario]);
      }else{
        return view('errors.notFound');
      }
    }
  
    public function index_month($id,$month){
        //$veterinario = auth()->user()->veterinary;
        $veterinario= Veterinary::find(Auth::user()->veterinary->id);
        $month=date("Y-m",strtotime($month));
        $data = $this->calendar_month($month);
        $mes = $data['month'];
        $mespanish = $this->spanish_month($mes);
        $mes = $data['month'];
        $pet=Pet::find($id);
        $agendaMes= Event::where("veterinary_id","=",$veterinario->id)->get()->sortBy('horaCita');
        return view("citas.calendario",[ 'id'=>$id,'pet'=>$pet,'veterinario'=>$veterinario,
            'data' => $data,
            'mes' => $mes,
            'mespanish' => $mespanish,
            'agenda'=>$agendaMes,
            'today'=>date("Y-m-d")
        ]);
 
     }
     public function getHoras($id_vet,$date){
      $horasDisponiles = array();
      if(Veterinary::find($id_vet)){
        $citas=Event::where("veterinary_id","=",$id_vet)->where("fechaCita","=",$date)->get();
        $horasConsulta=array("00:00:00");
        foreach($citas as $c){
            array_push($horasConsulta,$c->horaCita);
        }
        $ini=7;
        if(date("Y-m-d",strtotime($date))==date("Y-m-d")){
            $ini=date("H")+1;
            if($ini<7){
              $ini=7;
            }
        }
        
        for($i=$ini;$i<=16;$i++){
            $hora="".$i.":00:00";
            if($i<10){
                $hora="0".$i.":00:00";
            }
            if(array_search($hora,$horasConsulta)==false){
                array_push($horasDisponiles,$hora);
            }
        }
      }
      return $horasDisponiles;
     }
 
     public static function calendar_month($month){
        $mes = $month;
        $calendario = array();
        $iweek = 0;
        $diaInicio="Monday";
        $diaFin="Sunday";
        $strFecha = strtotime($month.'-01');
        $fechaInicio = date('Y-m-d',strtotime('last '.$diaInicio,$strFecha));
        if(date("l",$strFecha)==$diaInicio){
            $fechaInicio= date("Y-m-d",$strFecha);
        }
        
        $daylast =  date("Y-m-d", strtotime("last day of ".$month));//ultimo dia del mes
        $strFecha = strtotime($daylast);
        $fechaFin = date('Y-m-d',strtotime('next '.$diaFin,$strFecha));
        if(date("l",$strFecha)==$diaFin){
            $fechaFin= date("Y-m-d",$strFecha);
        }

        $datafecha = date("Y-m-d",strtotime($fechaInicio)); //primer dia de la semana en la que esta el 1 en x mes
        while ($datafecha<$fechaFin):
            $iweek++;
            $weekdata = [];
            for ($iday=0; $iday < 7 ; $iday++){
              $datanew['mes'] = date("M", strtotime($datafecha));
              $datanew['dia'] = date("d", strtotime($datafecha));
              $datanew['fecha'] = $datafecha;
              array_push($weekdata,$datanew);
              $datafecha = date("Y-m-d",strtotime($datafecha."+ 1 day"));
            }
            $dataweek['semana'] = $iweek;
            $dataweek['datos'] = $weekdata;
            array_push($calendario,$dataweek);
        endwhile;
        $nextmonth = date("Y-M",strtotime($mes."+ 1 month"));
        $lastmonth = date("Y-M",strtotime($mes."- 1 month"));
        $month = date("M",strtotime($mes));
        $yearmonth = date("Y",strtotime($mes));
        $data = array(
          'next' => $nextmonth,
          'month'=> $month,
          'year' => $yearmonth,
          'last' => $lastmonth,
          'calendar' => $calendario,
        );
    
        return $data;
    
      }
 
     public static function spanish_month($month)
     {
 
         $mes = $month;
         if ($month=="Jan") {
           $mes = "1";
         }
         elseif ($month=="Feb")  {
           $mes = "2";
         }
         elseif ($month=="Mar")  {
           $mes = "3";
         }
         elseif ($month=="Apr") {
           $mes = "4";
         }
         elseif ($month=="May") {
           $mes = "5";
         }
         elseif ($month=="Jun") {
           $mes = "6";
         }
         elseif ($month=="Jul") {
           $mes = "7";
         }
         elseif ($month=="Aug") {
           $mes = "8";
         }
         elseif ($month=="Sep") {
           $mes = "9";
         }
         elseif ($month=="Oct") {
           $mes = "10";
         }
         elseif ($month=="Nov") {
           $mes = "11";
         }
         elseif ($month=="Dec") {
           $mes = "12";
         }
         else {
           $mes = $month;
         }
         return $mes;
     }

}
