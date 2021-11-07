@extends('layouts.index')
@section('title',__('indicador.title2'))
@section('content')
<div class="row">
	<div class="col-md-9 col-sm-12">
		<div class="card m-3">
			<div class="card-body">
				<form  method="POST" autocomplete="off">
                	@csrf
                <div class="form-group">
                    <label for="date">@lang( 'indicador.fechaConsulta' ):</label>
                    <input class="form-control" type="date" id="fecha" name="fecha" value="{{$indicadores->fechaConsulta}}">
                    @error('fecha')
                        <small class="text-danger mt-1 font-weight-bold">@lang( $message )</small>
                    @enderror
                </div>
                <div class="form-group">
                        <label for="consulta" class="font-italic">@lang( 'indicador.consulta' )</label>
                        <select name="consulta" class="custom-select">
                            @if  ($indicadores->tipo==1)
                                <option value="1">@lang( 'indicador.tipo_indicador_1' )</option>
                                <option value="2">@lang( 'indicador.tipo_indicador_2' )</option>
                                <option value="3">@lang( 'indicador.tipo_indicador_3' )</option>
                            @endif
                            @if  ($indicadores->tipo==2)
                                <option value="2">@lang( 'indicador.tipo_indicador_2' )</option>
                                <option value="1">@lang( 'indicador.tipo_indicador_1' )</option>
                                <option value="3">@lang( 'indicador.tipo_indicador_3' )</option>
                            @endif
                            @if  ($indicadores->tipo==3)
                                <option value="3">@lang( 'indicador.tipo_indicador_3' )</option>
                                <option value="1">@lang( 'indicador.tipo_indicador_1' )</option>
                                <option value="2">@lang( 'indicador.tipo_indicador_2' )</option>
                                
                            @endif
                            
                        </select>
                    </div>
                
                
                <div class="form-group">
                    <label for="valor">@lang( 'indicador.valor' )</label>
                    <input class="form-control" type="number" step="0.1" id="valor" name="valor" value="{{$indicadores->valor}}">
                    @error('valor')
                        <small class="text-danger mt-1 font-weight-bold">@lang( $message )</small>
                    @enderror
                </div>

                <input  type="submit" class="btn btn-primary btn-block" value= " @lang( 'indicador.boton_Save' ) " >
            </form>
			</div>
		</div>
	</div>
	<div class="col-md-3 col-sm-12">
		@include('shared.menu-veterinario')
	</div>
</div>
@endsection