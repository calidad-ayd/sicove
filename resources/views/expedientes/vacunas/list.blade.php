<div class="card m-3">
	<div class="card-header d-flex align-items-center justify-content-between">
		<span class="font-weight-bold">@lang('vacunas.titulo1')</span>
		@role('Veterinario')
	    <a href="{{ route('expediente_vacuna_crear',['id' => $pet->id])}}" class="btn btn-primary  float-right"><i class="fas fa-plus"></i> @lang('vacunas.nuevoVaccine')</a>
	    @endrole
	</div>
	<div class="card-body">
		@if(count($vaccines)>0)
			<table class="table table-striped table-responsive-lg">
				<thead>
					<th>@lang('vacunas.fechaApli')</th>
					<th>@lang('vacunas.nombre')</th>
					<th>@lang('vacunas.tipo')</th>
					@role('Veterinario')
					<th>@lang('vacunas.opciones')</th>
					@endrole
				</thead>
				<tbody>
					@foreach ($vaccines as $vaccine)
						<tr>
							<td>{{ $vaccine->fecha_aplicacion }}</td>
							<td>{{ $vaccine->vaccine->nombre }}</td>
							<td>{{ $vaccine->vaccine->tipo }}</td>
							@role('Veterinario')
							<td>
								<form method="POST" action="{{route('expediente_vacuna_destroy', ['id' => $vaccine->id])}}">
									@csrf
									<input type="hidden" name="registroId" value="{{ $vaccine->id }}">
									<div class="btn-group">
										<a href="{{ route('expediente_vacuna_editar', ['id' => $vaccine->id]) }}" class="btn btn-primary"><i class="fas fa-pen"></i> @lang('vacunas.boton_editar')</a>
									</div>
									<button class="btn btn-danger"><i class="fas fa-trash"></i> @lang('vacunas.boton_eliminar')</button>
								</form>
							</td>
							@endrole
						</tr>
					@endforeach
				</tbody>
			</table>
		@else
			<div class="alert alert-info mb-0">@lang('vacunas.mensaje1')</div>	
		@endif		
		 {{$vaccines->appends(['diseases' => $diseases->currentPage(), 'indicators' => $indicators->currentPage()])->links()}}   
	</div>
</div>