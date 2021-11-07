<div class="card m-3">
	<div class="card-header d-flex justify-content-between align-items-center">
		<span class="font-weight-bold">@lang('diseases.titulo1')</span>
		<div>	
			<a href="{{ route('imprimir_tratamiento', ['id' => $pet->id, 'start' => $start, 'end' => $end]) }}" class="btn btn-primary float-right"><i class="fas fa-file-pdf"></i> @lang('record.export_treatment')</a>
			@role('Veterinario')
				<a href="{{route('expediente_enfermedad_crear', ['id' => $pet->id])}}" class="btn btn-primary float-right mr-1"><i class="fas fa-plus"></i> @lang('diseases.nuevoDiseases')</a>
			@endrole	
		</div>
	</div>
	<div class="card-body">
		@if(count($diseases)>0)
			<table class="table table-striped table-responsive-lg">
				<thead>
					<tr>
						<th scope="col">@lang('diseases.fechaDiag')</th>
					<th scope="col">@lang('diseases.Enfermedad')</th>
					<th scope="col">@lang('diseases.estado')</th>
					<th scope="col">@lang('diseases.opciones')</th>
					</tr>	
					
				</thead>
				<tbody>
					@foreach ($diseases as $disease)
						<tr>
							<td>{{ $disease->fecha_diagnostico }}</td>
							<td>{{ $disease->disease->nombre }}</td>
							<td>@lang('diseases.level_'.$disease->estado_avance) </td>
							<td>
								<form method="POST" action="{{route('expediente_enfermedad_delete', ['id' => $disease->id])}}">
									@csrf
									<input type="hidden" name="registroId" value="{{ $disease->id }}">
									@role('Veterinario')
										<div class="btn-group">
											<a href="{{ route('expediente_enfermedad_editar', ['id' => $disease->id]) }}" class="btn btn-primary"><i class="fas fa-pen"></i> @lang('diseases.boton_editar')</a>
											<button class="btn btn-danger"><i class="fas fa-trash"></i> @lang('diseases.boton_eliminar')</button>
										</div>
									@endrole
									<a href="{{ route('expediente_enfermedad_detalles', ['id' => $disease->id]) }}" class="btn btn-primary"><i class="far fa-eye"></i> @lang('diseases.boton_consultar')</a>
									
								</form>

							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		@else
			<div class="alert alert-info mb-0">@lang('diseases.mensaje1')</div>	
		@endif	
		{{$diseases->appends(['indicators' => $indicators->currentPage(), 'vaccines' => $vaccines->currentPage()])->links()}}  	
	</div>
</div>