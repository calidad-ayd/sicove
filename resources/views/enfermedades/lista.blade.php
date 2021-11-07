@extends('layouts.index')
@section('title', __('diseases.title2'))
@section('content')	
<div class="row">
	
	<div class="col-md-9 col-sm-12">

		@if(session('message'))
			@include('shared.success', ['message' => __(session('message'))])
		@endif

		<div class="card m-3">
			<div class="card-header d-flex align-items-center justify-content-between">
				<span class="font-weight-bold">@lang('diseases.diseases_list')</span>
				<a href="{{route('disease_create')}}" class="btn btn-primary"><i class="fas fa-plus"></i> @lang('diseases.new_disease')</a>
			</div>
			<div class="card-body">
				@if(count($enfermedades)>0)
					<table class="table table-striped table-responsive-lg">
						<thead>
							<th>@lang('diseases.id')</th>
							<th>@lang('diseases.type')</th>
							<th>@lang('diseases.category')</th>
							<th>@lang('diseases.name')</th>
							<th>@lang('diseases.opciones')</th>
						</thead>
						<tbody>
							@foreach ($enfermedades as $enfermedad)
								<tr>
									<td>{{ $enfermedad->id }}</td>
									<td>{{ __('diseases.category_type_'.$enfermedad->categoria) }}</td>
									<td>{{ $enfermedad->tipo }}</td>
									<td>{{ $enfermedad->nombre }}</td>
									<td>
										<form method="POST">
										    @csrf
										    <input type="hidden" name="enfermedadId" value="{{ $enfermedad->id }}">
											<a href=" {{ route('disease_edit', ['id' => $enfermedad->id]) }}" class="btn btn-primary"><i class="fas fa-pen"></i> @lang('diseases.boton_editar')</a>
											<button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> @lang('diseases.boton_eliminar')</button>
										</form>
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				@else
					<div class="alert alert-info mb-0">@lang('diseases.empty')</div>	
				@endif	
				{{ $enfermedades->links() }}
			</div>
		</div>
	</div>
	<div class="col-md-3 col-sm-12">
		@include('shared.menu-veterinario')
	</div>
</div>	
@endsection