@extends('layouts.index')
@section('title',__('indicador.title3'))
@section('content')

<script src=https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.bundle.min.js></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.js"></script>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script>

   
    var pesoFa =<?php echo $pesoF;?>;
    var pesoVa = <?php echo $pesoV; ?>;
    var estaturaFa = <?php echo $estaturaF; ?>;
    var estaturaVa =  <?php echo $estaturaV; ?>;
    var tempFa = <?php echo $tempF; ?>;
    var tempVa =  <?php echo $tempV; ?>;
    var sihayPeso=false; 
    if(pesoFa.length>0){
      sihayPeso=true;
    }
    var sihayEstatura=false; 
    if(estaturaFa.length>0){
      sihayEstatura=true;
    }
    var sihayTemperatura=false; 
    if(tempFa.length>0){
      sihayTemperatura=true;
    }
    
 window.onload = function() {
        var ctx = document.getElementById("graficoPeso").getContext("2d"); 
        var graficoPeso = new Chart(ctx, {
            type:'line',
            data: {
                labels:pesoFa,//barra de abajo
                datasets: [{
                    label:'@lang("grafico.peso")',
                    borderColor: "rgba(255, 187, 103,0.7)",
                    backgroundColor: 'rgba(0, 0, 0, 0.0)',
                    data: pesoVa
                }]
            },
            options: {  /// van las scalas, axisas, en donde se pone cosas a considerar
              responsive: true,
            }
          }); 
       if(sihayPeso==false){
          graficoPeso.destroy();
       }
        var ctx2 = document.getElementById("graficoEstatura").getContext("2d");
        var graficoEstatura = new Chart(ctx2, {
            type: 'line',
            data:{
              labels:estaturaFa,//barra de abajo
              datasets: [{
                label:'@lang("grafico.estatura")',
                borderColor: "rgba(255, 135, 136, 0.7)",
                backgroundColor: 'rgba(0, 0, 0, 0.0)',
                data: estaturaVa,
                
              }]
            },
            options: {  /// van las scalas, axisas, en donde se pone cosas a considerar
              responsive: true,
            }
        });
        if(sihayEstatura==false){
          graficoEstatura.destroy();
       }
       var ctx3 = document.getElementById("graficoTemperatura").getContext("2d");
       var graficoTemperatura = new Chart(ctx3, {
            type: 'line',
            data:{
              labels:tempFa,//barra de abajo
              datasets: [{
                label: '@lang("grafico.temperatura")',
                borderColor: "rgba(255, 86, 181, 0.7)",
                backgroundColor: 'rgba(0, 0, 0, 0.0)',
                data:tempVa,
              }]
            },
            options: {  /// van las scalas, axisas, en donde se pone cosas a considerar
              responsive: true
            }
        });
        if(sihayTemperatura==false){
          graficoTemperatura.destroy();
       }
  };

  </script>  

<div class="row ">             
  <div class="col-md-9 col-sm-12">
    <div class="card m-3">
      <div class="card-header font-weight-bold">
      @lang('grafico.titulo1')
        <a href="{{ route('expediente_ver', ['id' => $pet->id]) }}" class="btn btn-primary float-right "><i class="fas fa-folder"></i> @lang('grafico.botonExp')</a>
      </div>
      
      <div class="card-body d-flex align-items-center">
        <div><img lazy="loading" src="@php print App\Http\Controllers\ImageController::getImage($pet->foto); @endphp" class="rounded-circle" alt="" style="min-width:160px;min-height:160px;max-width: 160px; max-height: 160px;"></div>
        <div class="ml-3">
          <p><span class="font-weight-bold">@lang('grafico.nombrePet')</span> {{ $pet->nombre }}</p>
          <p><span class="font-weight-bold">@lang('grafico.propietario')</span> {{ $pet->client->FullName }}</p>
          <p><span class="font-weight-bold">@lang('grafico.edad')</span> {{ $pet->age }}</p>
        </div>
      </div>
    </div>



    <div class="card m-3">
      <div class="card-header font-weight-bold">
      @lang('grafico.titulo2')
      </div>
      <div class="card-body  ">
        <form method="post" action="{{route('expediente_indicadores_grafico_post', ['id' => $pet->id])}}">
          @csrf
            <div class="form-row ">
              <div class="col  font-weight-bold ">
                <label for="fecha">@lang('grafico.desde')</label>
                <input name="start" type="date" class="form-control" value="{{old('start')}}">
                @error('start')
                  <small class="text-danger mt-1 font-weight-bold">@lang($message)</small>
                @enderror
              </div>
              <div class="col font-weight-bold ">
                <label for="fecha">@lang('grafico.hasta')</label>
                <input name="end" type="date" class="form-control" value="{{old('end')}}">
                @error('end')
                  <small class="text-danger mt-1 font-weight-bold">@lang($message)</small>
                @enderror
              </div>
            </div>
            <button class="btn btn-primary float-right mt-3"><i class="fas fa-filter"></i> @lang('grafico.filtrar')</button>
            <a href="{{route('expediente_indicadores_grafico', ['id' => $pet->id])}}" class="btn btn-primary float-right mr-2 mt-3"><i class="fal fa-clock"></i> @lang('grafico.titulo3')</a>
        </form>
      </div>
    </div>
    <div class="card  m-3">
      <div class="card-body ">
        <div class="form-group">
          <div class="card-header font-weight-bold">@lang('grafico.titulo4')</div>
          @if($pesoF!="[]")
            <canvas id="graficoPeso" height="400" width="900">
          @else
            <div class="alert alert-info mb-0">@lang('grafico.mensaje1')</div>
            <canvas id="graficoPeso" height="20" width="900">
          @endif
        </div>

        <div class="form-group">
          <div class="card-header font-weight-bold">@lang('grafico.titulo5')</div>
          @if($estaturaF!="[]" )
            <canvas id="graficoEstatura" height="400" width="900">
          @else
            <div class="alert alert-info mb-0">@lang('grafico.mensaje2')</div>
            <canvas id="graficoEstatura" height="20" width="900"> 
          @endif
        </div>
        <div class="form-group">
          <div class="card-header font-weight-bold">@lang('grafico.titulo6')</div> 
          @if($tempF!="[]" )
              <canvas id="graficoTemperatura" height="400" width="900">
          @else
            <div class="alert alert-info mb-0">@lang('grafico.mensaje3')</div>
            <canvas id="graficoTemperatura" height="20" width="900">
          @endif
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-3 col-sm-12">
    @include('shared.menu-veterinario')
  </div>
</div>


 
@endsection