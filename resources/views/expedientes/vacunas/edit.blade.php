@extends('layouts.index')
@section('title',__('vacunas.title2') )
@section('content')

<div class="row">
	<div class="col-md-9 col-sm-12">
		<div class="card m-3">
			<div class="card-body">
				<form method="POST" autocomplete="off">
						@csrf
						<!-- Static Form Data ---->
						<div class="form-group">
							<label for="" class="font-weight-bold">@lang('query.pet')</label>
							<input type="text" class="form-control" value="{{ $data->pet->nombre }} ({{ $data->pet->id }})" disabled>
						</div>
						<div class="form-group">
							<label for="" class="font-weight-bold">@lang('query.date_app')</label>
							<input name="fecha_de_aplicacion" type="date" class="form-control @error('fecha_de_aplicacion') is-invalid @enderror" value="{{ $data->fecha_aplicacion }}">
							@error('fecha_de_aplicacion')
							    <small class="text-danger mt-1 font-weight-bold">@lang($message)</small>
							@enderror
						</div>
			
						<div class="form-group">
							<label for="" class="font-weight-bold">@lang('query.vaccine')</label>
							<select name="vacuna" id="" class="form-control">
								@foreach($vaccines as $vaccine)
									<option value="{{ $vaccine->id }}" {{ ( $vaccine->id == $data->vaccine->id) ? 'selected' : '' }}>{{$vaccine->nombre}}</option>
								@endforeach
								
							</select>
						</div>
						<button class="btn btn-primary btn-block"><i class="fas fa-save"></i> @lang('vacunas.edit_register')</button>
					</form>
			</div>
		</div>
	</div>
	<div class="col-md-3 col-sm-12">
		@include('shared.menu-veterinario')
	</div>
</div>

@endsection