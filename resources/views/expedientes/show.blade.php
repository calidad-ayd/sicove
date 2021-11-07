@extends('layouts.index')
@section('title', __('record.page_title'))
@section('content')
	<div class="row">
		<div class="col-md-9 col-sm-12">
			<div class="card m-3">
				<div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
					<span>@lang('record.ficha_title')</span>
					<div class="d-flex justify-content-between align-items-center">
						<a href="{{ route('expediente_descarga', ['id' => $pet->id, 'start' => $start, 'end' => $end]) }}" class="btn btn-primary"><i class="fas fa-file-pdf"></i> @lang('record.export_pdf')</a>
						<a href="{{ route('expediente_email', ['id' => $pet->id, 'start' => $start, 'end' => $end]) }}" class="btn btn-primary ml-2"><i class="fas fa-envelope"></i> @lang('record.export_email')</a>
					</div>
				</div>
				<div class="card-body d-flex align-items-center">
					<div><img lazy="loading" src="@php print App\Http\Controllers\ImageController::getImage($pet->foto); @endphp" class="rounded-circle" alt="" style="min-width:160px;min-height:160px;max-width: 160px; max-height: 160px;"></div>
					<div class="ml-3">
						<p><span class="font-weight-bold">@lang('record.pet_name'):</span> {{ $pet->nombre }}</p>
						<p><span class="font-weight-bold">@lang('record.propietario'):</span> {{ $pet->client->FullName }}</p>
						<p><span class="font-weight-bold">@lang('record.age'):</span> {{ $pet->age }}</p>
					</div>
				</div>
			</div>
			@include('expedientes.filter', ['pet' => $pet])
			@include('expedientes.consultas.list', ['pet' => $pet, 'queries' => $queries, 'events' => $events])
			@include('expedientes.enfermedades.list', ['pet' => $pet, 'diseases' => $diseases])
			@include('expedientes.indicadores.list', ['pet' => $pet, 'indicators' => $indicators])
			@include('expedientes.vacunas.list', ['vaccines' => $vaccines])
     	</div>
		<div class="col-md-3 col-sm-12">
			@include('shared.menu')
		</div>
	</div>
@endsection