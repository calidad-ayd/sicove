@extends('layouts.index')
@section('title', __('veterinario.titulo2'))
@section('content')
	<div class="row">
		<div class="col-md-9 col-sm-12">
			<div class="card m-3">
				<div class="card-body">
										<form method="POST" autocomplete="off">
					@csrf
					<div class="form-group">
						<label for="customerIdentification" class="font-weight-bold">@lang('veterinario.code')</label>
						<input name="codigo" type="text" class="form-control @error('codigo') is-invalid @enderror" placeholder="@lang('veterinario.place_c')." value="{{$veterinary->id}}" disabled="">
						@error('codigo')
						    <small class="text-danger mt-1 font-weight-bold">@lang($message)</small>
						@enderror
					</div>

					<div class="form-group">
						<label for="customerIdentification" class="font-weight-bold">@lang('veterinario.nombre')</label>
						<input name="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" value="{{$veterinary->nombre}}" placeholder="@lang('veterinario.place_n')">
						@error('nombre')
						    <small class="text-danger mt-1 font-weight-bold">@lang($message)</small>
						@enderror
					</div>

					<div class="form-group">
						<label for="customerIdentification" class="font-weight-bold">@lang('veterinario.primer_apellido')</label>
						<input name="primer_apellido" type="text" class="form-control @error('primer_apellido') is-invalid @enderror" value="{{$veterinary->primerApellido}}" placeholder="@lang('veterinario.place_p')">
						@error('primer_apellido')
						    <small class="text-danger mt-1 font-weight-bold">@lang($message)</small>
						@enderror
					</div>

					<div class="form-group">
						<label for="customerIdentification" class="font-weight-bold">@lang('veterinario.segundo_apellido')</label>
						<input name="segundo_apellido" type="text" class="form-control @error('segundo_apellido') is-invalid @enderror" value="{{$veterinary->segundoApellido}}" placeholder="@lang('veterinario.place_s')">
						@error('segundo_apellido')
						    <small class="text-danger mt-1 font-weight-bold">@lang($message)</small>
						@enderror
					</div>

					<div class="form-group">
						<label for="customerIdentification" class="font-weight-bold">@lang('veterinario.mail_2')</label>
						<input name="correo" type="text" class="form-control @error('correo') is-invalid @enderror" value="{{$veterinary->correo}}" placeholder="@lang('veterinario.place_mail')">
						@error('correo')
						    <small class="text-danger mt-1 font-weight-bold">@lang($message)</small>
						@enderror
					</div>

					<div class="form-group">
						<label for="customerIdentification" class="font-weight-bold">@lang('veterinario.tel')</label>
						<input name="telefono" type="text" class="form-control @error('telefono') is-invalid @enderror" value="{{$veterinary->telefono}}" placeholder="########" maxlength="8" minlength="8">
						@error('telefono')
						    <small class="text-danger mt-1 font-weight-bold">@lang($message)</small>
						@enderror
					</div>

					<button type="submit" class="btn btn-primary btn-block"><i class="fas fa-pen"></i> @lang('veterinario.edit')</button>

				</form>
				</div>
			</div>
		</div>
		<div class="col-md-3 col-sm-12">
			@include('shared.menu-veterinario')
		</div>
	</div>
@endsection