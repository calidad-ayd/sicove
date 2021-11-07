@extends('layouts.index')
@section('title',__('pet.title2'))
@section('content')
<div class="row">
	<div class="col-md-9 col-sm-12">
		<div class="card m-3">
			<div class="card-body d-flex align-items-center justify-content-between flex-wrap">
				<div class="d-flex align-items-center">
					<img lazy="loading" src="@php print App\Http\Controllers\ImageController::getImage($pet->foto); @endphp" class="rounded-circle" alt="" style="min-width:100px;min-height:100px;max-width: 100px; max-height: 100px;">
					<div class="ml-2">
						<p><span class="font-weight-bold">@lang('pet.name'):</span> {{$pet->nombre}}</p>
						<p><span class="font-weight-bold">@lang('pet.owner'):</span> {{$pet->client->FullName}}</p>
						<p><span class="font-weight-bold">@lang('pet.age'):</span> {{$pet->age}}</p>
						<div>
							
						</div>
					</div>
				</div>
				<form action="{{route('pet_delete', ['id' => $pet->id])}}" method="POST">
					@csrf
					<button class="btn btn-danger"> <i class="fas fa-trash-alt"></i> @lang('pet.delete')</button>
				</form>
			</div>	
		</div>

		<div class="card m-3">
			<div class="card-body">
				<form method="POST" autocomplete="off" enctype="multipart/form-data">					@csrf
					<div class="form-group">
						<label for="customerIdentification" class="font-weight-bold">@lang('pet.name')</label>
						<input name="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" value="{{$pet->nombre}}">
						@error('nombre')
						    <small class="text-danger mt-1 font-weight-bold">@lang($message)</small>
						@enderror
					</div>

					<div class="form-group">
						<label for="customerIdentification" class="font-weight-bold">@lang('pet.Race')</label>
						<input name="raza" type="text" class="form-control @error('raza') is-invalid @enderror" value="{{$pet->raza}}">
						@error('raza')
						    <small class="text-danger mt-1 font-weight-bold">@lang($message)</small>
						@enderror
					</div>

					<div class="form-group">
						<label for="customerIdentification" class="font-weight-bold">@lang('pet.birth')</label>
						<div class="form-group">
						 	<input type="date" name="fecha_de_nacimiento" max="3000-12-31" 
						        min="1000-01-01" class="form-control @error('fecha_de_nacimiento') is-invalid @enderror" value="{{$pet->fechaNacimiento}}">
						    @error('fecha_de_nacimiento')
						    	<small class="text-danger mt-1 font-weight-bold">@lang($message)</small>
							@enderror
						</div>
					</div>

					<div class="form-group">
						<label for="customerIdentification" class="font-weight-bold">@lang('pet.photo')</label>
						<div class="form-group">
							<div class="alert alert-info">
														    <input name="foto" type="file" class="form-control-file @error('foto') is-invalid @enderror" id="exampleFormControlFile1">
							</div>

						    @error('foto')
						    <small class="text-danger mt-1 font-weight-bold">@lang($message)</small>
							@enderror
						</div>
					</div>

					<button type="submit" class="btn btn-primary btn-block"><i class="fas fa-save"></i> @lang('pet.save')</button>
				</form>
			</div>
		</div>
	</div>
	<div class="col-md-3 col-sm">
		@include('shared.menu-veterinario')
	</div>
</div>
@endsection