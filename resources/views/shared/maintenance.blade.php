@extends('layouts.index')
@section('title', 'Sección en mantenimiento')
@section('content')

	<div class="row">
		<div class="col-md-12 col-sm-12">
			<div class="card">
				<div class="card-body d-flex flex-column align-items-center">
					<img src="/images/maintenance.png" alt="error 404" style="width: 100px;height: 100px;">
					<h1 class="font-weight-bold">¡Atención!</h1>
					<p>Esta sección se encuentra actualmente en construcción.</p>
					<a href="{{ url()->previous() }}">Regresar</a>
				</div>
			</div>
		</div>
	</div>

@endsection