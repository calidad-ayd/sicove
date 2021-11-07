@extends('layouts.index')
@section('title', 'Error 500: Error interno')
@section('content')

	<div class="row">
		<div class="col-md-12 col-sm-12">
			<div class="card">
				<div class="card-body d-flex flex-column align-items-center">
					<img src="/images/server.png" alt="error 500" style="width: 100px;height: 100px;">
					<h1 class="font-weight-bold">¡Oops! Ha ocurrido un error interno</h1>
					<p>Existe un problema con el servidor. Intente de nuevo.</p>
					<a href="{{ url()->previous() }}">Regresar</a>
				</div>
			</div>
		</div>
	</div>

@endsection