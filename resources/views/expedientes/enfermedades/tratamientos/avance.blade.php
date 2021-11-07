@extends('layouts.index')
@section('title',__('record.treatmente_advance'))
@section('content')
<div class="row">
	@if(session('message'))
		@include('shared.success', ['message' => session('message')])
	@endif
	<div class="col-md-9 col-sm-12">
		<div class="card m-3">
	<div class="card-header  ">
		<span class="font-weight-bold">@lang('record.treatmente_advance')</span>
		@role('Veterinario')
        	<a href="{{ route('expediente_tratamiento_edit', ['id' => $tratamiento->id]) }}" class="btn btn-primary  float-right"><i class="fas fa-folder-open"></i> @lang('treatment.boton_segui')</a>				
        @endrole				
        <a href="{{ route('expediente_enfermedad_detalles', ['id' => $tratamiento->id]) }}" class="btn btn-primary  float-right mr-2 "><i class="fas fa-arrow-left"></i> @lang('treatment.boton_volver')</a>
	</div>
	<div class="card-body">
		@if(count($tratamiento->advances)>0)
			<table class="table table-striped table-responsive-lg">
				<thead>
					<tr>
                    <th scope="col">@lang('treatment.estadoDosis')</th>
					<th scope="col">@lang('treatment.indicaciones')</th>
                    <th scope="col">@lang('treatment.estadoPeriodo')</th>
                    <th scope="col">@lang('treatment.periodicidad')</th>
                    <th scope="col">@lang('treatment.finalizacion')</th>
                    <th scope="col">@lang('treatment.observaciones')</th>
					</tr>	
					
				</thead>
				<tbody>
					@foreach ($tratamiento->advances as $avance)
						<tr>
							<td>@lang('treatment.dosis_'.$avance->dosis )</td>
							<td>{{ $avance->indicaciones }} </td>
                            <td>@lang('treatment.estado_'.$avance->periodoModif ) </td>
                            <td>{{ $avance->periodicidad }} </td>
                            <td>{{ $avance->finalizacion}} </td>
                            <td>{{ $avance->observaciones }} </td>
							
						</tr>
					@endforeach
				</tbody>
			</table>
		@else
			<div class="alert alert-info mb-0">@lang('diseases.mensaje1')</div>	
		@endif	
		 	
	</div>
</div>
	</div>
	<div class="col-md-3 col-sm-12">
		@include('shared.menu-veterinario')
	</div>
</div>
@endsection