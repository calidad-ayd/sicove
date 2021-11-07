@extends('layouts.index')
@section('title', __('clients.title1'))
@section('content')
	<div class="row">
		<div class="col-md-8 col-sm-12">
			<div class="card m-3">
				<div class="card-body">					
					<form method="POST" autocomplete="off">
						@csrf
						<label for="" class="font-weight-bold" style="font-size: 18px!important;">@lang('clients.pi')</label>
						<div class="form-group">
							<label for="customerIdentification" class="font-weight-bold">@lang('clients.id')</label>
							<input name="cedula" type="text" class="form-control @error('cedula') is-invalid @enderror" value="{{$client->id}}" readonly>
							@error('cedula')
							    <small class="text-danger mt-1 font-weight-bold">{{ $message }}</small>
							@enderror
						</div>

						<div class="form-group">
							<label for="customerIdentification" class="font-weight-bold">@lang('clients.name')</label>
							<input name="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" value="{{$client->nombre}}">
							@error('nombre')
							    <small class="text-danger mt-1 font-weight-bold">{{ $message }}</small>
							@enderror
						</div>

						<div class="form-group">
							<label for="customerIdentification" class="font-weight-bold">@lang('clients.firstName')</label>
							<input name="primer_apellido" type="text" class="form-control @error('primer_apellido') is-invalid @enderror" value="{{$client->primerApellido}}">
							@error('primer_apellido')
							    <small class="text-danger mt-1 font-weight-bold">{{ $message }}</small>
							@enderror
						</div>

						<div class="form-group">
							<label for="customerIdentification" class="font-weight-bold">@lang('clients.lastName')</label>
							<input name="segundo_apellido" type="text" class="form-control @error('segundo_apellido') is-invalid @enderror" value="{{$client->segundoApellido}}">
							@error('segundo_apellido')
							    <small class="text-danger mt-1 font-weight-bold">{{ $message }}</small>
							@enderror
						</div>

						<div class="form-group">
							<label for="customerIdentification" class="font-weight-bold">@lang('clients.birthday')</label>
							<div class="form-group">
							 	<input name="fecha_de_nacimiento" value="{{$client->fechaNacimiento}}" type="date" name="bday" max="3000-12-31" min="1000-01-01" class="form-control @error('fecha_de_nacimiento') is-invalid @enderror">
							 	@error('fecha_de_nacimiento')
							    	<small class="text-danger mt-1 font-weight-bold">{{ $message }}</small>
								@enderror
							</div>
						</div>
						
						<label for="" class="font-weight-bold" style="font-size: 18px!important;">@lang('clients.ci')</label>
						<div class="form-group">
							<label for="customerIdentification" class="font-weight-bold">@lang('clients.email')</label>
							<input name="correo" type="text" class="form-control @error('correo') is-invalid @enderror" value="{{$client->correo}}">
							@error('correo')
							    <small class="text-danger mt-1 font-weight-bold">{{ $message }}</small>
							@enderror
						</div>

						<div class="form-group">
							<label for="customerIdentification" class="font-weight-bold">@lang('clients.phone')</label>
							<input name="telefono" type="text" class="form-control @error('telefono') is-invalid @enderror" value="{{$client->telefono}}">
							@error('telefono')
							    <small class="text-danger mt-1 font-weight-bold">{{ $message }}</small>
							@enderror
						</div>

						

						<button type="submit" class="btn btn-primary btn-block"><i class="fas fa-save"></i>
 @lang('clients.btn_save')</button>
					</form>
				</div>
			</div>
		</div>
		<div class="col-md-4 col-sm-12">
			@include('shared.menu')	
		</div>
	</div>
@endsection