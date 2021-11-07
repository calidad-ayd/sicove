@extends('layouts.index')
@section('title', __('record.disease_title'))
@section('content')

<div class="row">
	<div class="col-md-9 col-sm-12">
		
		<div class="card m-3">
			<div class="card-body">
				<form method="POST">
					@csrf
					<div class="form-group">
						<label for="" class="font-weight-bold">@lang('record.pet')</label>
						<input type="text" class="form-control" value="{{ $pet->nombre }} ({{ $pet->id }})" disabled>
					</div>

					<div class="form-group">
						<label for="" class="font-weight-bold">@lang('record.diagnostic_date')</label>
						<input name="fecha_diagnostico" type="date" class="form-control @error('fecha_diagnostico') is-invalid @enderror">
						@error('fecha_diagnostico')
						    <small class="text-danger mt-1 font-weight-bold">@lang($message)</small>
						@enderror
					</div>

					<div class="form-group">
						<label for="" class="font-weight-bold">@lang('record.disease_level')</label>
						<select name="estado_avance" class="form-control @error('estado_avance') is-invalid @enderror">
							@for($i=0; $i<3; $i++)
								<option value="{{$i}}">{{ __('diseases.level_'.$i) }}</option>
							@endfor
						</select>
						@error('estado_avance')
						    <small class="text-danger mt-1 font-weight-bold">@lang($message)</small>
						@enderror
					</div>

					<div class="form-group">
						<label for="" class="font-weight-bold">@lang('record.disease_name')</label>
						<select name="disease_id" id="" class="form-control  @error('disease_id') is-invalid @enderror">
							@foreach($diseases as $disease)
								<option value="{{$disease->id}}">{{ $disease->nombre }}</option>
							@endforeach
						</select>
						@error('disease_id')
						    <small class="text-danger mt-1 font-weight-bold">@lang($message)</small>
						@enderror
					</div>
					<button class="btn btn-primary btn-block"><i class="fas fa-plus"></i> @lang('record.disease_create')</button>
				</form>
			</div>
		</div>

	</div>
	<div class="col-md-3 col-sm-12">
		@include('shared.menu-veterinario')
	</div>
</div>
@endsection