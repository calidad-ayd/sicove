@extends('layouts.index')
@section('title',__('treatment.titulo2'))
@section('content')

	<div class="row">
		<div class="col-md-9 col-sm-12">
			<div class="card m-3">
                <div class="card-header  ">
                    <span class="font-weight-bold">@lang('treatment.titulo2')</span>
                    <a href="{{ route('expediente_tratamiento_advance', ['id' => $tratamiento->id]) }}" class="btn btn-primary  float-right"><i class="fas fa-book-open"></i> @lang('treatment.boton1')</a>
                    <a href="{{ route('expediente_enfermedad_detalles', ['id' => $tratamiento->id]) }}" class="btn btn-primary  float-right mr-2 ">@lang('treatment.boton2')</a>
                </div>
                <div class="card-body">
					<form method="POST" autocomplete="off">
					@csrf
					<div class="form-group">
                        <div class="row ">
                            <div class="col-md-9 col-sm-12">
                                <label for="" class="font-weight-bold">@lang('treatment.indicaciones')</label>
                                <textarea name="indicacion" id="" col="20"  rows="10" class="form-control">{{$tratamiento->indicacion}}</textarea>
                                @error('indicacion')
                                    <small class="text-danger mt-1 font-weight-bold">@lang($message)</small>
                                @enderror
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <label for="" class="font-weight-bold">@lang('treatment.dosis')</label>
                                <select name="dosis" class="custom-select">
                                    <option value="4">@lang('treatment.dosis_4')</option>
                                    <option value="1">@lang('treatment.dosis_1')</option>
                                    <option value="2">@lang('treatment.dosis_2')</option>
                                    <option value="3">@lang('treatment.dosis_3')</option>
                                </select>
                            </div>
                        </div>
					</div>
					<div class="form-group">
                        <div class="row ">
                            <div class="col-md-4 col-sm-12">
                                <label for="" class="font-weight-bold">@lang('treatment.finalizacionF') </label>
                                <input name="fecha" type="date" class="form-control" value="{{$tratamiento->finalizacion}}" disabled>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <label for="" class="font-weight-bold">@lang('treatment.periodicidad')</label>
                                <input name="periodicidad" type="text" value="{{$tratamiento->periodicidad}}"class="form-control">
                                @error('periodicidad')
                                    <small class="text-danger mt-1 font-weight-bold">@lang( $message )</small>
                                @enderror
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <label for="" class="font-weight-bold">@lang('treatment.duracion') </label>
                                <input name="duracion" type="number" value="0" class="form-control">
                                @error('duracion')
                                    <small class="text-danger mt-1 font-weight-bold">@lang( $message )</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="font-weight-bold">@lang('treatment.observaciones')</label>
                        <textarea name="observaciones" id="" cols="30" rows="10" class="form-control"></textarea>
                        @error('observaciones')
                            <small class="text-danger mt-1 font-weight-bold">@lang( $message )</small>
                        @enderror
					</div>

                    <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-save"></i> @lang('treatment.boton_Actu')</button>


				</form>
				</div>
			</div>
		</div>
		<div class="col-md-3 col-sm-12">
			@include('shared.menu-veterinario')
		</div>
	</div>

@endsection