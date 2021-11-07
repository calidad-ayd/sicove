@extends('layouts.index')
@section('title', __('clients.title1'))
@section('content')

	<div class="row">
		
		<div class="col-md-9 col-sm-12">

			<div class="card m-3">
				<div class="card-header font-weight-bold">@lang('clients.pending_appointment')</div>
				<div class="card-body">
					@if(count($countable["appointments"])>0)
 					   @foreach($countable["appointments"] as $cita)
 					    	@php
						   	  $canExclude = false;
						   	  $carbon_now = \Carbon\Carbon::now('America/Costa_Rica');
						   	  $cita_carbon = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $cita->fechaCita.' '.$cita->horaCita);
						   	  if ($cita_carbon->isFuture()) {
						   	  	$canExclude = false;
						   	  }
					   	  	@endphp
					      @include('citasCliente.citaDetails', ['cita' => $cita, 'excludeOption' => $canExclude])
 					   @endforeach
 					@else
 					  <div class="alert alert-info mb-0">@lang('clients.no_pending_7')</div>
 					@endif
				</div>
			</div>

		</div>
		<div class="col-md-3 col-sm-12">
			@include('shared.menu')
		</div>

	</div>
	
@endsection