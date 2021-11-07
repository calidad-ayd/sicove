@extends('layouts.index')
@section('title', __('diseases.new_disease_title'))
@section('content')	
	<div class="row">
		
		<div class="col-md-9 col-sm-12 mt-2">
			<div class="card m-3">
				<div class="card-header font-weight-bold">@lang('diseases.new_disease_title')</div>
				<div class="card-body">
					<form method="post" autocomplete="off">
						@csrf
						<div class="form-group">
							<label for="codeOfDecease" class="font-weight-bold">@lang('diseases.type')</label>
							<input name="tipo" type="text" class="form-control @error('tipo') is-invalid @enderror" placeholder="@lang('diseases.type_placeholder')" value="{{ old('tipo') }}">
							@error('tipo')
							    <small class="text-danger mt-1 font-weight-bold">@lang($message)</small>
							@enderror
						</div>
						<div class="form-group">
							<label for="" class="font-weight-bold @error('categoria') is-invalid @enderror">@lang('diseases.category')</label>
							<select name="categoria" id="" class="form-control">
								@for($i=0; $i<3; $i++)
                                   <option value="{{ $i }}">{{ __('diseases.category_type_'.$i) }}</option>
								@endfor
							</select>
							@error('categoria')
							    <small class="text-danger mt-1 font-weight-bold">@lang($message)</small>
							@enderror
						</div>
						<div class="form-group">
						   <label for="nameOfDecease" class="font-weight-bold">@lang('diseases.name')</label>
						   <input name="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" placeholder="@lang('diseases.name_placeholder')" value="{{ old('nombre') }}">
						   	@error('nombre')
							    <small class="text-danger mt-1 font-weight-bold">@lang($message)</small>
							@enderror
						</div>
						<div class="form-group">
							<button class="btn btn-primary btn-block"><i class="fas fa-plus"></i> @lang('diseases.new_disease_title')</button>
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