@extends('layouts.index')
@section('title', __('calendario.title2'))
@section('content')
<div class="row">
    @if(session('message'))
        <div class="col-md-12 col-sm-12">
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        </div>
    @endif

    <div class="col-md-9 col-sm-12">
        <div class="card m-3">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3>@lang('calendario.titulo')</h3>
                    <a href="{{ route('clients_show', ['id' => $pet->client_id]) }}"  class="btn btn-primary float-right mr-2" ><i class="fas fa-user"></i>@lang('calendario.boton_regresarCliente')</a>
            
            </div>
            <div class="card-body">
                <h5>@lang('calendario.vet') {{ $veterinario->nombre.' '.$veterinario->primerApellido.' '.$veterinario->segundoApellido}}</h4>
                <h5>ID : {{ $veterinario->id}}</h4>
            </div>
        </div>  
        <div class="card m-3">
        <div class="card-body">
        
        <table class="table  table-responsive-lg ">
            <thead>
                <tr>
                    <div class=" " style=" background:rgb( 115, 215, 248, 0.8) ;color:black"  >

                        <div class="col mt-2" style="display: flex; justify-content: space-between; padding: 5px;">
                    
                        <a  href="{{ route('otroMes',['id'=>$id,'month'=>$data['last'] ]) }}" style=" background-color: Transparent;  border: none;" class="btn  float-right mt-4"> <big><i class="fas fa-arrow-alt-left " " ></i>  </big></a>
                        <h2 style="font-weight:normal;margin:15px;">@lang('calendario.year_'.$mespanish) <normal><?= $data['year']; ?></normal></h2>
                        
                        <a  href="{{ route('otroMes',['id'=>$id,'month'=>$data['next'] ]) }}" style=" background-color: Transparent;  border: none;" class=" btn float-right mt-4"><big><i class="fas fa-arrow-alt-right"></i></big></a>
                    </div>
                </tr>
                <tr style=" background: rgb(115, 215, 248, 0.5);  color:black">
                    <th style=" border:1px solid #E3E9E5;background-color: #black" scope="col">@lang('calendario.day_1')</th>
                    <th style=" border:1px solid #E3E9E5;background-color: #black" scope="col">@lang('calendario.day_2')</th>
                    <th style=" border:1px solid #E3E9E5;background-color: #black" scope="col">@lang('calendario.day_3')</th>
                    <th style=" border:1px solid #E3E9E5;background-color: #black" scope="col">@lang('calendario.day_4')</th>
                    <th style=" border:1px solid #E3E9E5;background-color: #black" scope="col">@lang('calendario.day_5')</th>
                    <th  style=" border:1px solid #E3E9E5;background-color: #black"scope="col">@lang('calendario.day_6')</th>
                    <th  style=" border:1px solid #E3E9E5;background-color: #black"scope="col">@lang('calendario.day_7')</th>
                </tr>
            </thead>

            <tbody>
            <!-- inicio de semana -->
            @foreach ($data['calendar'] as $weekdata)
                <tr>
                <!-- ciclo de dia por semana -->
                @foreach  ($weekdata['datos'] as $dayweek)
                        @if  ($dayweek['mes']==$mes)
                            <th style=" border:1px solid #E3E9E5;height:165px;background-color: #black">
                                <form method="post">
                                @csrf
                                <div class="row">
                                    <div class="col"><big class="float-left"> <b>{{ $dayweek['dia']}}</b></big></div>
                                    @if  ($dayweek['fecha']>=$today)
                                        <div class="col"><a class="btn btn-primary align-item-end btn-sm " style="height:25px; " href="{{route('vet.agendarCita',['id'=>$id,'date'=>$dayweek['fecha']] )}}"><i class="fas fa-plus"></i></a> </div>
                                    @endif
                                </div>
                            <!-- las citas que tenga pendientes-->
                            @foreach ($agenda as $a)
                                    @if  ($a['fechaCita']==$dayweek['fecha'])
                                    <div class="col">
                                        <a class="btn btn-primary align-item-end btn-sm mt-1 "  href="{{route('vet.editEvent',['id_cita'=>$a['id']])}}"> <?php echo ''.date('g A',strtotime($a['horaCita'])); ?> {{ ' '.$a->pet->nombre }}</a> 
                                    </div>
                                    @endif
                            @endforeach
                                
                                </form>
                            </th>
                        @else
                            <th style=" border:1px solid #E3E9E5; height:165px; background-color: #ECF0F1"></th>
                        @endif
                    
                @endforeach
                </tr>
            @endforeach
            <tbody>
        </table>
        </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-12">
        @include('shared.menu-veterinario')
    </div>
</div>
@endsection