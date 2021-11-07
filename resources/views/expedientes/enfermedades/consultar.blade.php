@extends('layouts.index')
@section('title', __('diseases.entrydetails'))
@section('content')
	<div class="row">
		<div class="col-md-9 col-sm-12">
			<div class="card m-3">
				<div class="card-header d-flex align-items-center justify-content-between">
					<span class="font-weight-bold">@lang('record.entry_details')</span>
					<a href="{{ route('expediente_ver', ['id' => $data->pet->id]) }}" class="btn btn-primary  float-right mr-2 "><i class="fas fa-arrow-left"></i> @lang('treatment.boton_volver')</a>
				</div>
				<div class="card-body">
					<table class="table table-striped table-responsive-lg">
						<tr>
							<td>@lang('record.pet'):</td>
							<td><strong>{{ $data->pet->nombre }}</strong></td>
						</tr>
						<tr>
							<td>@lang('record.diagnostic_date'):</td>
							<td><strong>{{ $data->fecha_diagnostico }}</strong></td>
						</tr>
						<tr>
							<td>@lang('record.disease_name'):</td>
							<td><strong>{{ $data->disease->nombre }}</strong></td>
						</tr>
						<tr>
							<td>@lang('record.disease_level')</td>
							<td><strong>{{ __('diseases.level_'.$data->estado_avance) }}</strong></td>
						</tr>
					</table>
				</div>
			</div>
			<div class="card m-3">
				<div class="card-header d-flex justify-content-between">
					<p class="font-weight-bold">@lang('treatment.titulo3')</p>
					@role('Veterinario')
					<a href="{{ route('expediente_tratamiento_crear', ['id' => $data->id]) }}" class="btn btn-primary"><i class="fas fa-plus"></i> @lang('treatment.boton_add')</a>
					@endrole
				</div>
				<div class="card-body">
					@if(count($data->treatments)>0)
						<table class="table table-striped">
							<thead>
								<tr>
									<th>Id</th>
								    <th>@lang('treatment.indicaciones')</th>
								    <th>@lang('treatment.periodicidad')</th>
								    <th>@lang('treatment.duracion')</th>
								    <th>@lang('treatment.options')</th>
								</tr>
							</thead>
							<tbody>
								@foreach($data->treatments as $treatment)
								<tr>
									<td>{{ $treatment->id }}</td>
									<td>{{ $treatment->indicacion }}</td>
									<td>{{ $treatment->periodicidad }}</td>
									<td>{{ $treatment->finalizacion }}</td>
									<td>
										<form method="POST">
											@csrf
											@role('Veterinario')
											<input type="hidden" name="id" value="{{ $treatment->id }}">
											<a href="{{ route('expediente_tratamiento_edit', ['id' => $treatment->id]) }}" class="btn btn-primary"><i class="fas fa-folder-open"></i> @lang('treatment.boton_segui')</a>
											<button name="delete" class="btn btn-danger"><i class="fas fa-trash"></i> @lang('indicador.boton_eliminar')</button>
											@endrole
											<a href="{{ route('expediente_tratamiento_advance', ['id' => $treatment->id]) }}" class="btn btn-primary"><i class="fas fa-book-open"></i> @lang('treatment.boton1')</a>
										</form>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
						
					@else
						<div class="alert alert-info mb-0">@lang('treatment.error')</div>
					@endif
				</div>
			</div>
		</div>
		<div class="col-md-3 col-sm-12">
			@include('shared.menu-veterinario')
		</div>
	</div>

@endsection