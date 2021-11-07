@extends('layouts.index')
@section('title', __('calendario.title3'))
@section('content')
<div class="row ">             
    <div class="col-md-9 col-sm-12">
        <div class=" card mt-4">
        <div class="card-header d-flex justify-content-between align-items-center">
                <h2>@lang('calendario.editarCita')</h2>
                <a href="{{ route('otroMes',['id'=>$cita->pet->id,'month'=>$cita->fechaCita]) }}" class="btn btn-primary float-right mr-2"><i class="far fa-calendar-alt"></i> @lang('calendario.boton_volverCale')</a>
                </div>
            <div class="card-body " > 
                <form method="POST" autocomplete="off" >
                    @csrf
                    <div class="form-group font-weight-bold" >@lang('calendario.datos_Vet')
                        <div class="row mt-2">
                            <div class="col">
                            <label for="veterinario_id" class="font-italic">Id</label>
                            <input name="veterinario_id" type="number" value="{{$veterinario->id}}" class="form-control" readonly >
                            </div>
                            <div class="col">
                                <label for="veterinario_nombre" class="font-italic"> @lang('calendario.nombre') </label>
                                <input name="veterinario_nombre" type="TEXT" value="{{$veterinario->nombre.' '.$veterinario->primerApellido.' '.$veterinario->segundoApellido}}" class="form-control" readonly >
                            </div>
                        </div>  
                    </div>
                    <div class="form-group font-weight-bold">@lang('calendario.datos_Pet')
                        <div class="row mt-2">
                        <div class="col">
                            <label for="nombre" class="font-italic">Id </label>
                            <input name="nombre" type="text" class="form-control" value="{{$cita->pet_id}}" readonly></div>
                        <div class="col">
                            <label for="pet_nombre" class="font-italic"> @lang('calendario.nombre') </label>
                            <input name="pet_nombre" type="text" class="form-control" value="{{$cita->pet->nombre}}" readonly> </div>
                        </div>
                    </div>
                    <div class=" form-group font-weight-bold">@lang('calendario.datos_Cita')
                        <div class="row mt-2">
                            <div class="col">
                                <label for="dia" class="font-italic">@lang('calendario.dia')</label>
                                <input name="dia" type="date" class="form-control" value="{{$cita->fechaCita}}" readonly >
                            </div>
                            <div class="col">
                                <label for="hora" class="font-italic">@lang('calendario.hora')</label>
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
                    <div class="form-group font-weight-bold">
                        <label for="descripcion">@lang('calendario.descripcion')</label>
                        <input class="form-control" type="text" id="descripcion" name="descripcion" value="{{$cita->descripcion}}" >
                        @error('descripcion')
						    <small class="text-danger mt-1 font-weight-bold">@lang($message)</small>
						@enderror
                    </div>
                    <div class="form-group font-weight-bold">
                        <label for="indicaciones">@lang('calendario.indicaciones')</label>
                        <textarea class="form-control" name="indicaciones" rows="3">{{$cita->indicaciones}}</textarea>
                        @error('indicaciones')
						    <small class="text-danger mt-1 font-weight-bold">@lang($message)</small>
						@enderror
                    </div>
                    

                    <button type="submit" class="btn btn-primary btn-block">@lang('calendario.boton_save_cita')</button>
                </form>
                <form method="POST">
                
                    @method('DELETE')
                        <input class="btn btn-danger btn-block mt-2" type="submit" value="@lang('calendario.boton_remove_cita')" />
                        <input type="hidden" name="_method" value="delete" />
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </form>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-12">
        @include('shared.menu-veterinario')
    </div>
</div>
@endsection
