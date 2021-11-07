@extends('layouts.index')
@section('title', __('clients.add_page_title'))
@section('content')
<div class="row">
	<div class="col-md-9 col-sm-12">
		<div class="card m-3">
			<div class="card-body">
				<form method="POST" autocomplete="off">
					@csrf
					<div class="form-group">
						<label for="customerIdentification" class="font-weight-bold">@lang('clients.id')</label>
						<input name="cedula" type="text" class="form-control @error('cedula') is-invalid @enderror" value="{{old('cedula')}}" placeholder="@lang('clients.id_placeholder')">
						@error('cedula')
						    <small class="text-danger mt-1 font-weight-bold">{{ $message }}</small>
						@enderror
					</div>

					<div class="form-group">
						<label for="customerIdentification" class="font-weight-bold">@lang('clients.name')</label>
						<input name="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" value="{{old('nombre')}}" placeholder="@lang('clients.name_placeholder')">
						@error('nombre')
						    <small class="text-danger mt-1 font-weight-bold">{{ $message }}</small>
						@enderror
					</div>

					<div class="form-group">
						<label for="customerIdentification" class="font-weight-bold">@lang('clients.firstName')</label>
						<input name="primer_apellido" type="text" class="form-control @error('primer_apellido') is-invalid @enderror" value="{{old('primer_apellido')}}" placeholder="@lang('clients.firstName_placeholder')">
						@error('primer_apellido')
						    <small class="text-danger mt-1 font-weight-bold">{{ $message }}</small>
						@enderror
					</div>

					<div class="form-group">
						<label for="customerIdentification" class="font-weight-bold">@lang('clients.lastName')</label>
						<input name="segundo_apellido" type="text" class="form-control @error('segundo_apellido') is-invalid @enderror" value="{{old('segundo_apellido')}}" placeholder="@lang('clients.lastName_placeholder')">
						@error('segundo_apellido')
						    <small class="text-danger mt-1 font-weight-bold">{{ $message }}</small>
						@enderror
					</div>

					<div class="form-group">
						<label for="customerIdentification" class="font-weight-bold">@lang('clients.email')</label>
						<input name="correo" type="text" class="form-control @error('correo') is-invalid @enderror" value="{{old('correo')}}" placeholder="@lang('clients.email_placeholder')">
						@error('correo')
						    <small class="text-danger mt-1 font-weight-bold">{{ $message }}</small>
						@enderror
					</div>

					<div class="form-group">
						<label for="customerIdentification" class="font-weight-bold">@lang('clients.phone')</label>
						<input id="telefono" name="telefono" type="text" class="form-control @error('telefono') is-invalid @enderror" value="{{old('telefono')}}" placeholder="@lang('clients.phone_placeholder')" maxlength="8" minlength="8">
						@error('telefono')
						    <small class="text-danger mt-1 font-weight-bold">{{ $message }}</small>
						@enderror
					</div>

					<div class="form-group">
						<label for="customerIdentification" class="font-weight-bold">@lang('clients.birthday')</label>
						<div class="form-group">
						 	<input type="date" name="fecha_de_nacimiento" max="3000-12-31" min="1000-01-01" class="form-control @error('fecha_de_nacimiento') is-invalid @enderror" value="{{old('fecha_de_nacimiento')}}">
						 	@error('fecha_de_nacimiento')
						    	<small class="text-danger mt-1 font-weight-bold">{{ $message }}</small>
							@enderror
						</div>
					</div>

					<button type="submit" class="btn btn-primary btn-block"><i class="fas fa-plus"></i> @lang('clients.btn_agregar')</button>
				</form>
			</div>
		</div>
	</div>
	<div class="col-md-3 col-sm-12">
		@include('shared.menu-veterinario')
	</div>		
</div>
@endsection
