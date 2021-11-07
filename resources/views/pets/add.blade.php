@extends('layouts.index')
@section('title', __('pet.title'))
@section('content')

	<div class="row">
		<div class="col-md-9 col-sm-12">
			<div class="card m-3">
				<div class="card-body">
					<form method="POST" autocomplete="off" enctype="multipart/form-data">
						@csrf
					<div class="form-group">
						<label for="customerIdentification" class="font-weight-bold">@lang('pet.name')</label>
						<input name="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" value="{{old('nombre')}}" placeholder="@lang('pet.place_name')">
						@error('nombre')
						    <small class="text-danger mt-1 font-weight-bold">@lang($message)</small>
						@enderror
					</div>

					<div class="form-group">
						<label for="customerIdentification" class="font-weight-bold">@lang('pet.Type_pet')</label>
						<div class="form-check">
							<label>
							    <input name="tipo" type="radio" class="option-input checkbox @error('tipo') is-invalid @enderror" value="0"/>
							    @lang('pet.Dog')
  							</label>
    						<label class="ml-2">
   						 	<input name="tipo" type="radio" class="option-input checkbox @error('tipo') is-invalid @enderror"value="1"/>
    							@lang('pet.Cat')
  							</label>

						</div>
						@error('tipo')
						    <small class="text-danger mt-1 font-weight-bold">@lang($message)</small>
						@enderror
					</div>

					<div class="form-group">
						<label for="customerIdentification" class="font-weight-bold">@lang('pet.Race')</label>
						<input name="raza" type="text" class="form-control @error('raza') is-invalid @enderror" value="{{old('raza')}}" placeholder="@lang('pet.place_race')">
						@error('raza')
						    <small class="text-danger mt-1 font-weight-bold">@lang($message)</small>
						@enderror
					</div>

					<div class="form-group">
						<label for="customerIdentification" class="font-weight-bold">@lang('pet.birth')</label>
						<div class="form-group">
						 	<input type="date" name="fecha_de_nacimiento" max="3000-12-31" 
						        min="1000-01-01" class="form-control @error('fecha_de_nacimiento') is-invalid @enderror" value="{{old('fecha_de_nacimiento')}}">
						    @error('fecha_de_nacimiento')
							    <small class="text-danger mt-1 font-weight-bold">@lang($message)</small>
							@enderror
						</div>
					</div>

					<div class="form-group">
						<label for="customerIdentification" class="font-weight-bold">@lang('pet.photo')</label>
						<div class="form-group">
						    <label for="exampleFormControlFile1" class="font-weight-bold">@lang('pet.image')</label>
						    <div class="alert alert-info">
						    	    <input name="foto" type="file" class="form-control-file @error('foto') is-invalid @enderror" id="exampleFormControlFile1" value="{{old('foto')}}">
						    </div>
						
						    @error('foto')
							    <small class="text-danger mt-1 font-weight-bold">@lang($message)</small>
							@enderror
						</div>
					</div>

			
						<div class="card-body">
							<button type="submit" class="btn btn-primary btn-block">@lang('pet.button_add')</button>

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