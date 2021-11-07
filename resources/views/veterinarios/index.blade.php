@extends('layouts.index')
@section('title', 'Listado de usuarios')
@section('content')

	<div class="row">

		<div class="col-md-12 col-sm-12 m-3">
			<h3 style="font-weight: 700">@lang('veterinario.vet')</h3>
		</div>

		<div class="col-md-9 col-sm-12">

			@if (session()->has('message'))
				@include('shared.success', ['message' => __(session('message'))])
			@endif

			<div class="card m-3">
				<div class="card-body pb-0">
					<a href="{{route('veterinary_create')}}" class="btn btn-primary float-right"><i class="fas fa-user-plus"></i> @lang('veterinario.new')</a>
				</div>
				<div class="card-body">
					<table class="table table-striped table-responsive-lg">
						<thead>
							<tr>
								<th>@lang('veterinario.cedula')</th>
								<th>@lang('veterinario.nombre')</th>
								<th>@lang('veterinario.primer_apellido')</th>
								<th>@lang('veterinario.segundo_apellido')</th>
								<th>@lang('veterinario.tel')</th>
								<th>@lang('veterinario.mail_2')</th>
								<th>@lang('veterinario.opciones')</th>
							</tr>
						</thead>
						<tbody>
							@foreach($veterinarios as $veterinary)
								<tr>
									<td>{{ $veterinary->id }}</td>
									<td>{{ $veterinary->nombre }}</td>
									<td>{{ $veterinary->primerApellido }}</td>
									<td>{{ $veterinary->segundoApellido }}</td>
									<td>{{ $veterinary->telefono }}</td>
									<td>{{ $veterinary->correo }}</td>
									<td>
										<a href="{{ route('veterinary_edit', ['id' => $veterinary->id]) }}" class="btn btn-primary"><i class="fas fa-user-cog"></i> @lang('vacunas.boton_editar')</a>
									</td>
								</tr>
							@endforeach							
						</tbody>
					</table>
					{{ $veterinarios->links() }}
				</div>
			</div>
		</div>
		<div class="col-md-3 col-sm-12">
			@include('shared.menu-veterinario')	
		</div>
	</div>


@endsection