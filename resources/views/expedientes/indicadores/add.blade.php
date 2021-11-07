@extends('layouts.index')
@section('title',__('indicador.title1'))
@section('content')
<div class="row">
	<div class="col-md-9 col-sm-12">
		<div class="card m-3">
			<div class="card-body">
				<form  method="POST" autocomplete="off" >
                    
                    @csrf
                    <div class="form-group">
                        <label for="fecha">@lang( 'indicador.fechaConsulta' ):</label>
                        <input class="form-control" type="date" id="fecha" name="fecha"  value="<?php echo date("Y-m-d");?>" required>
                        @error('fecha')
                            <small class="text-danger mt-1 font-weight-bold">@lang( $message )</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="consulta" >@lang( 'indicador.consulta' )</label>
                        <select name="consulta" class="custom-select">
                            <option value="1">@lang( 'indicador.tipo_indicador_1' )</option>
                            <option value="2">@lang( 'indicador.tipo_indicador_2' )</option>
                            <option value="3">@lang( 'indicador.tipo_indicador_3' )</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="valor">@lang( 'indicador.valor' ):</label>
                        <input class="form-control" type="number" step="0.1" id="valor" name="valor" min="0">
                        @error('valor')
                            <small class="text-danger mt-1 font-weight-bold">@lang( $message )</small>
                        @enderror
                        

                    </div>
                
                    <button  type="submit" class="btn btn-primary btn-block"><i class="fas fa-plus"></i> @lang( 'indicador.add' )</button>
                </form>
			</div>
		</div>
	</div>
	<div class="col-md-3 col-sm-12">
		@include('shared.menu-veterinario')
	</div>
</div>
@endsection