@extends('layouts.index')
@section('title', 'Error 404: La página no existe')
@section('content')

	<div class="row">
		<div class="col-md-12 col-sm-12">
			<div class="card">
				<div class="card-body d-flex flex-column align-items-center">
					<img src="/images/forbidden.png" alt="error 404" style="width: 100px;height: 100px;">
					<h1 class="font-weight-bold">¡Oops! Página restringida</h1>
					<p>No tienes una sesión activa o no cuentas con los permisos necesarios.</p>
					<a href="{{ url()->previous() }}">Regresar</a>
				</div>
			</div>
		</div>
	</div>

@endsection