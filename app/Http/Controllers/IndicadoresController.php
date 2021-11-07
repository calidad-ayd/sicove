<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\Indicator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IndicadoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexVeterinario($id)
    {
        $pet = Pet::find($id);
        if($pet){
            return view('indicadores.inicioVeterinarioInd', ['pet'=>$pet, 'id'=>$id]);
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexCliente($id)
    {
        $pet = Pet::find($id);
        if($pet){
            return view('indicadores.inicioClienteInd', ['pet'=>$pet]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        return view('expedientes.indicadores.add', ['id' => $id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\redirect
     */
    public function store(Request $request, $id)
    {
        $messages= [
            'fecha.required'=>'indicador.fecha_required',
            'fecha.date'=>'indicador.fecha_date',
            'valor.required'=>'indicador.valor_required',
            'valor.min'=>'indicador.valor_min'
        ];
        $validator = Validator::make($request->all(), [
            'fecha' => 'required|date',
            'consulta' => 'numeric',
            'valor' => 'required|numeric|min:1',
        ],$messages);
        if($validator->fails()){
            return redirect()->route('expediente_indicadores_crear',['id'=>$id])->withErrors($validator)->withInput();
        }else{
            $indicadores = new Indicator;
            $indicadores->fechaConsulta = $request->fecha;
            $indicadores->tipo = $request->consulta;
            $indicadores->valor = $request->valor;
            $indicadores->pet_id = $id;
            $indicadores->save();
            return redirect()->route('expediente_ver',['id' => $id]);
        }
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    { 
        $indicadores = Indicator::find($id);
        if($indicadores){
            return view('expedientes.indicadores.edit',['id'=> $id,'indicadores'=>$indicadores]);
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
        $indicadores = Indicator::find($id);
        if($indicadores){
            $messages= [
                'fecha.required'=>'indicador.fecha_required',
                'fecha.date'=>'indicador.fecha_date',
                'valor.required'=>'indicador.valor_required',
                'valor.min'=>'indicador.valor_min'
            ];
            $validator = Validator::make($request->all(), [
                'fecha' => 'required|date',
                'consulta' => 'numeric',
                'valor' => 'required|numeric|min:1',
            ],$messages);

            if($validator->fails()){
                return redirect()->route('expediente_indicadores_editar',['id'=> $id])->withErrors($validator)->withInput();
            }
            else{
                $indicadores->fechaConsulta = $request->fecha;
                $indicadores->tipo = $request->consulta;
                $indicadores->valor = $request->valor;
                
                $indicadores->save();
                return redirect()->route('expediente_ver',['id' => $indicadores->pet_id])->with('message', 'El indicador ha sido actualizado satisfactoriamente.');
            
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $indicadores = Indicator::find($id);
        $pet = $indicadores->pet_id;
        if ($indicadores) 
        {
            $indicadores->delete();
        }
        return redirect()->route('expediente_ver',['id'=> $pet])->with('message', 'El registro de indicadores se ha eliminado con éxito.');
    }
    public function highchart($id, $start = null, $end = null)//primer grafico
    {
        $pet=Pet::find($id);
        $peso = array();
        $estatura = array();
        $temp = array();
        if(is_null($start) && is_null($end)) {
            $peso= Indicator::where('tipo', 1)->where('pet_id',  $id)->select( 'fechaConsulta', 'valor')->orderBy('fechaConsulta')->limit(10)->get()->toArray() ;
            $estatura = Indicator::where('tipo',2)->where('pet_id',  $id)->select( 'fechaConsulta', 'valor')->orderBy('fechaConsulta')->limit(10)->get()->toArray() ;
            $temp = Indicator::where('tipo', 3)->where('pet_id',  $id)->select( 'fechaConsulta', 'valor')->orderBy('fechaConsulta')->limit(10)->get()->toArray() ;
            
        } else {
            
            $peso= Indicator::where('tipo',  1)->where('pet_id',  $id)->select( 'fechaConsulta', 'valor')->whereBetween('fechaConsulta', [$start, $end])->orderBy('fechaConsulta')->limit(10)->get()->toArray() ;
            $estatura = Indicator::where('tipo',  2)->where('pet_id',  $id)->select( 'fechaConsulta', 'valor')->orderBy('fechaConsulta')->whereBetween('fechaConsulta', [$start, $end])->limit(10)->get()->toArray() ;
            $temp = Indicator::where('tipo',  3)->where('pet_id',  $id)->select( 'fechaConsulta', 'valor')->orderBy('fechaConsulta')->whereBetween('fechaConsulta', [$start, $end])->limit(10)->get()->toArray() ;
        
        }
        $pesoF = array();
        $pesoV = array();
        foreach ( $peso as $row ) {
            array_push($pesoF,$row["fechaConsulta"]);
            array_push($pesoV, $row["valor"]);
        }
        $tempF = array();
        $tempV = array();
        foreach ( $temp as $row ) {
            array_push($tempF,$row["fechaConsulta"]);
            array_push($tempV, $row["valor"]);
        }
        $estaturaF = array();
        $estaturaV = array();
        foreach ( $estatura as $row ) {
            array_push($estaturaF,$row["fechaConsulta"]);
            array_push($estaturaV, $row["valor"]);
        }
        return view('expedientes.indicadores.grafico',['pet'=>$pet])
        ->with('pesoF',json_encode($pesoF,JSON_NUMERIC_CHECK))
        ->with('pesoV',json_encode($pesoV,JSON_NUMERIC_CHECK))
        ->with('estaturaF',json_encode($estaturaF,JSON_NUMERIC_CHECK))
        ->with('estaturaV',json_encode($estaturaV,JSON_NUMERIC_CHECK))
        ->with('tempF',json_encode($tempF,JSON_NUMERIC_CHECK))
        ->with('tempV',json_encode($tempV,JSON_NUMERIC_CHECK));
    }
    public function searchG(Request $request, $id)
    {
        $messages= [
            'start.required'=>'indicador.start_required',
            'end.required'=>'indicador.end_required',
            
        ];
        $validator = Validator::make($request->all(), [
            'start' => 'required',
            'end' => [
            'required',
                function ($attribute, $value, $fail) use ($request) {
                    if ($value < $request['start']) {
                        $fail('indicador.fechaInvalida');
                    }
                }]
            ],$messages);

        if($validator->fails()){
            return redirect()->route('expediente_indicadores_grafico',['id'=> $id,'start' => $request->start, 'end' => $request->end])->withErrors($validator)->withInput();
        }
        return redirect()->route('expediente_indicadores_grafico',['id' => $id, 'start' => $request->start, 'end' => $request->end]);
       
    }
}