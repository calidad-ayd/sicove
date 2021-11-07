<div class="card m-3">
	<div class="card-header d-flex justify-content-between align-items-center">
		<span class="font-weight-bold">@lang('query.query')</span>
		<div>	
			@role('Veterinario')
				@if(count($events)>0)
					<a href="{{route('expediente_consulta_crear', ['id' => $pet->id])}}" class="btn btn-primary float-right mr-1"><i class="fas fa-plus"></i>@lang('query.new')</a>
				@endif
			@endrole
		</div>

	</div>
	<div class="card-body">
		@if(count($queries)>0)
			<table class="table table-striped table-responsive-lg">
				<thead>
					<tr>
					<th scope="col">@lang('query.id')</th>
					<th scope="col">@lang('query.date')</th>
					<th scope="col">@lang('query.vet')</th>
					<th scope="col">@lang('query.options')</th>
					</tr>	
					
				</thead>
				<tbody>
					@foreach ($queries as $query)
						<tr>
							<td>{{ $query->id }}</td>
							<td>{{ $query->event->fechaCita }}</td>
							<td>{{ $query->event->veterinary_id }}</td>
							<td>
								<form method="POST" action="{{route('expediente_consulta_delete', ['id' => $query->id])}}">
									@csrf
									<input type="hidden" name="registroId" value="{{ $query->id }}">
									<div class="btn-group">
										@role('Veterinario')
										<a href="{{ route('expediente_consulta_editar', ['id' => $query->id]) }}" class="btn btn-primary"><i class="fas fa-pen"></i> @lang('diseases.boton_editar')</a>
										@endrole
										<a href="{{ route('expediente_consulta_detalles', ['id' => $query->id]) }}" class="btn btn-primary"><i class="far fa-eye"></i> @lang('query.obs')</a>
									</div>
									@role('Veterinario')
										<button class="btn btn-danger"><i class="fas fa-trash"></i> @lang('diseases.boton_eliminar')</button>
									@endrole
								</form>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		@else
			<div class="alert alert-info mb-0">@lang('query.warning')</div>	
		@endif	
		{{$diseases->appends(['indicators' => $indicators->currentPage(), 'vaccines' => $vaccines->currentPage()])->links()}}  	
	</div>
</div>