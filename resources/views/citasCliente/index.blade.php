@extends('layouts.index')
@section('content')

<div class="row">

	<div class="col-md-9 col-sm-12 mt-2">
		<div class="card">
			<div class="card-header d-flex align-items-center justify-content-between">
				<p class="font-weight-bold">@lang('clients.appointments_history')</p>
				<a href="{{route('citas_pendings')}}" class="btn btn-primary"><i class="fas fa-clock"></i> @lang('clients.pending_appointment')</a>
			</div>
			<div class="card-body">
				@if(count($data)>0)
				   @foreach($data as $cita)
				   	  @php
				   	  $canExclude = false;
				   	  $carbon_now = \Carbon\Carbon::now('America/Costa_Rica');
				   	  $cita_carbon = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $cita->fechaCita.' '.$cita->horaCita);
				   	  if ($cita_carbon->isFuture()) {
				   	  	$canExclude = true;
				   	  }
				   	  @endphp

				      @include('citasCliente.citaDetails', ['cita' => $cita, 'excludeOption' => $canExclude])
				   @endforeach
				@else
				  <div class="alert alert-success mb-0">@lang('clients.no_pending')</div>
				@endif
			</div>
		</div>
	</div>
	<div class="col-md-3 col-sm-12">
		@include('shared.menu')
	</div>

</div>

@endsection