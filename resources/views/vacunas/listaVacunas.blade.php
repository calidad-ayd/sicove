@extends('layouts.index')

@section('title', __('vacunas.title3'))

@section('content')	
	<div class="row">

		<div class="col-md-9 col-sm-12 mt-2">
			<div class="card m-3">
				<div class="card-header d-flex justify-content-between align-items-center">
					<span class="font-weight-bold">@lang('vacunas.list')</span>
					<a href="{{route('vaccines_create')}}" class="btn btn-primary"><i class="fas fa-plus"></i> @lang('vacunas.new_vaccine')</a>
				</div>
				<div class="card-body">
					@if(count($vacunas)>0)
						<table class="table table-striped table-responsive-lg">
							<thead>
								<th>@lang('vacunas.id')</th>
								<th>@lang('vacunas.vaccine_category')</th>
								<th>@lang('vacunas.tipo')</th>
								<th>@lang('vacunas.nombre')</th>
								<th>@lang('query.options')</th>
							</thead>
							<tbody>
								@foreach ($vacunas as $vacuna)
									<tr>
										<td>{{ $vacuna->id }}</td>
										<td>{{ __('diseases.category_type_'.$vacuna->categoria) }}</td>
										<td>{{ $vacuna->tipo }}</td>
										<td>{{ $vacuna->nombre }}</td>
										<td>
											<form method="POST">
											    @csrf
											    <input type="hidden" name="vacunaId" value="{{ $vacuna->id }}">
												<a href="{{ route('vaccines_edit', ['id' => $vacuna->id]) }}" class="btn btn-primary"><i class="fas fa-pen"></i> @lang('vacunas.button_edit')</a>
												<button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> @lang('vacunas.button_delete')</button>
											</form>
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					@else
						<div class="alert alert-info mb-0">@lang('vacunas.warning')</div>
					@endif	
				</div>
			</div>
		</div>
		<div class="col-md-3 col-sm-12">
			@include('shared.menu-veterinario')
		</div>
	</div>	
@endsection