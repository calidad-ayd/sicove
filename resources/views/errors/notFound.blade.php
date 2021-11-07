@extends('layouts.index')
@section('title', 'Ha ocurrido un error')
@section('content')

	<div class="row">
		<div class="col-md-12 col-sm-12">
			<div class="card">
				<div class="card-body d-flex flex-column align-items-center">
					<img src="/images/not-found.png" alt="error 404" style="width: 100px;height: 100px;">
					<h1 class="font-weight-bold">¡Oops! Ha ocurrido un error</h1>
					<p>No hemos podido recuperar el recurso solicitado. Pruebe con otro valor.</p>
					<a href="{{ url()->previous() }}">Regresar</a>
				</div>
			</div>
		</div>
	</div>

@endsection