@extends('layouts.index')

@section('title', __('vacunas.title1'))

@section('content')	
	<div class="row">

		<div class="col-md-9 col-sm-12">
			<div class="card m-3">
				<div class="card-header font-weight-bold">@lang('vacunas.add_vaccine')</div>
				<div class="card-body">
					<form method="post" autocomplete="off">
						@csrf
						<div class="form-group">
							<label for="codeOfVaccine" class="font-weight-bold">@lang('vacunas.tipo')</label>
							<input name="tipo_de_vacuna" type="text" class="form-control @error('tipo_de_vacuna') is-invalid @enderror" placeholder="@lang('vacunas.place_vaccine')">
							@error('tipo_de_vacuna')
							    <small class="text-danger mt-1 font-weight-bold">@lang($message)</small>
							@enderror
						</div>
						<div class="form-group">
							<label for="" class="font-weight-bold">@lang('vacunas.vaccine_category')</label>
							<select name="categoria_de_la_vacuna" id="" class="form-control @error('categoria_de_la_vacuna') is-invalid @enderror">
								@for($i=0; $i<3; $i++)
                                   <option value="{{ $i }}">{{ __('diseases.category_type_'.$i) }}</option>
								@endfor
							</select>
							@error('categoria_de_la_vacuna')
							    <small class="text-danger mt-1 font-weight-bold">@lang($message)</small>
							@enderror
						</div>
						<div class="form-group">
						   <label for="name_of_vaccine" class="font-weight-bold">@lang('vacunas.nombre')</label>
						   <input name="nombre_de_la_vacuna" type="text" class="form-control @error('nombre_de_la_vacuna') is-invalid @enderror" placeholder="@lang('vacunas.place_nombre')">
						   	@error('nombre_de_la_vacuna')
						    	<small class="text-danger mt-1 font-weight-bold">@lang($message)</small>
							@enderror
						</div>

						<div class="form-group">
							<button class="btn btn-primary btn-block"><i class="fas fa-plus"></i> @lang('vacunas.create')</button>
						</div>

					</form>
				</div>
			</div>
		</div>
		<div class="col-md-3 col-sm-12">
					@include('shared.menu-veterinario')
		</div>

	</div>	
@endsection