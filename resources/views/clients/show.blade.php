@extends('layouts.index')
@section('title', __('clients.title2'))
@section('content')
	
	<div class="row">
		
		<div class="col-md-9 col-sm-12">
			
			<div class="card m-3">
				<div class="card-header font-weight-bold">@lang('pet.ficha')</div>
				<div class="card-body">
					<p><span class="font-weight-bold">@lang('veterinario.nombre'):</span> {{ $client->nombre }} {{ $client->primerApellido }} {{ $client->segundoApellido }}</p>
					<p><span class="font-weight-bold">@lang('veterinario.tel'):</span> {{ $client->telefono }}</p>
					<p><span class="font-weight-bold">@lang('veterinario.mail_2'):</span> {{ $client->correo }}</p>
				</div>
			</div>

			<div class="card m-3">
				<div class="card-header d-flex align-items-center justify-content-between">
					<p class="font-weight-bold">@lang('pet.pets')</p>
					@role('Veterinario')
						<a href="{{route('pet_create', ['id' => $client->id])}}" class="btn btn-primary"><i class="fas fa-plus"></i> @lang('pet.button_add')</a>
					@endrole
				</div>
				<div class="card-body">
					@if(count($client->pets)>0)
						<table class="table table-striped table-responsive-md">
							<thead>
								<th>@lang('pet.photo')</th>
								<th>@lang('veterinario.nombre')</th>
								<th>@lang('pet.Type_pet')</th>
								<th>@lang('pet.Race')</th>
								<th>@lang('pet.birth')</th>
								<th>@lang('veterinario.opciones')</th>
							</thead>
							<tbody>
								@foreach($client->pets as $pet)
									<tr class="flex-wrap">
										<td>
											<img lazy="loading" src="@php print App\Http\Controllers\ImageController::getImage($pet->foto); @endphp" class="rounded-circle" alt="" style="min-width:60px;min-height:60px;max-width: 60px; max-height: 60px;">
										</td>
										<td>{{$pet->nombre}}</td>
										<td>@lang('tipoDeAnimal.tipo_'.$pet->tipoDeAnimal)</td>
										<td>{{$pet->raza}}</td>
										<td>{{$pet->fechaNacimiento}}</td>
										<td>
											<a href="{{ route('expediente_ver', ['id' => $pet->id]) }}" class="btn btn-primary"><i class="fas fa-folder"></i> @lang('pet.exp')</a>
											@role('Veterinario')
												<a href="{{ route('pet_edit', ['id' => $pet->id])}}" class="btn btn-primary"><i class="fas fa-pencil-alt"></i> @lang('clients.edit')</a>
												<a href="{{route('vet.calendario', ['id' => $pet->id]) }}" class="btn btn-primary"><i class="far fa-calendar-alt"></i> @lang('pet.agendar')</a>
											@endrole	
										</td>
									</tr>
								@endforeach
							</tbody>							
						</table>
					@else
						<div class="alert alert-info mb-0">@lang('pet.warning')</div>
					@endif
				</div>
			</div>

		</div>

		<div class="col-md-3 col-sm-12">
			@include('shared.menu')
		</div>

	</div>

@endsection