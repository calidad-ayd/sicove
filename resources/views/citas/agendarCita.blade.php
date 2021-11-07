@extends('layouts.index')
@section('title', __('calendario.title1'))
@section('content')
<div class="row ">             
    <div class="col-md-9 col-sm-12">
        <div class="card m-3">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h2>@lang('calendario.agregarCita')</h2>
                <a href="{{ route('otroMes',['id'=>$pet->id,'month'=>$date]) }}" class="btn btn-primary float-right mr-2"><i class="far fa-calendar-alt"></i> @lang('calendario.boton_volverCale')</a>
            </div>
            <div class="card-body " > 
                <form method="POST" autocomplete="off" >
                    @csrf
                    <div class="form-group font-weight-bold"> @lang('calendario.datos_Vet')
                        <div class="row mt-2">
                            <div class="col">
                                <label for="nombreVet" class="font-weight-bold">@lang('calendario.nombre')</label>
                                <input name="nombreVet" type="text" value="{{$veterinario->nombre.' '.$veterinario->primerApellido.' '.$veterinario->segundoApellido}}" class="form-control"  readonly>
                            </div>
                            <div class="col">
                                <label for="veterinario_id" class="font-weight-bold">Id</label>
                                <input name="veterinario_id" type="number" value="{{$veterinario->id}}" class="form-control"  readonly>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mt-4  font-weight-bold">@lang('calendario.datos_Pet')
                        <div class="row mt-2">
                            <div class="col">
                                <label for="nombreMascota" class="font-weight-bold">@lang('calendario.nombre') </label>
                                <input name="nombreMascota" type="text" class="form-control" value="{{$pet->nombre}}" readonly>
                            </div>
                            <div class="col">
                                <label for="selectPet" class="font-weight-bold">Id </label>
                                <input name="selectPet" type="number" class="form-control" value="{{$pet->id}}" readonly>
                            </div>
                        </div> 
                    </div>
                    <div class="form-group  mt-4 font-weight-bold">@lang('calendario.datos_Cita')
                        <div class="row mt-2">
                            <div class="col">
                                <label for="dia" class="font-weight-bold">@lang('calendario.dia') </label>
                                <input name="dia" type="date" class="form-control" value="{{$date}}" readonly>
                                @error('dia')
							        <small class="text-danger mt-1 font-weight-bold">@lang($message)</small>
							    @enderror
                            </div>
                            <div class="col">
                                <label for="hora" class="font-weight-bold">@lang('calendario.hora')</label>
                                <select name="hora" class="custom-select">
                                    @foreach ($horasDisponiles as $h)
                                        <option value="{{$h}}">{{$h}}</option>
                                    @endforeach	
                                </select>
                                @error('hora')
							        <small class="text-danger mt-1 font-weight-bold">@lang($message)</small>
							    @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group mt-2 font-weight-bold">
                        <label for="descripcion">@lang('calendario.descripcion')</label>
                        <input class="form-control" type="text" id="descripcion" name="descripcion" >
                        @error('descripcion')
							<small class="text-danger mt-1 font-weight-bold">@lang($message)</small>
						@enderror
                    </div>
                    <div class="form-group mt-2 font-weight-bold">
                        <label for="indicaciones">@lang('calendario.indicaciones')</label>
                        <textarea class="form-control" name="indicaciones" rows="3"></textarea>
                        @error('indicaciones')
						    <small class="text-danger mt-1 font-weight-bold">@lang($message)</small>
						@enderror
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">@lang('calendario.boton_add_cita')</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-12">
        @include('shared.menu-veterinario')
    </div>
</div>
@endsection
