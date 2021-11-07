@extends('layouts.index')
@section('title',__('query.title1') )
@section('content')

<div class="row">
	<div class="col-md-9 col-sm-12">
		<div class="card m-3">
			<div class="card-body">
				<form method="POST">
						@csrf
						<!-- Static Form Data ---->
						<div class="form-group">
							<label for="" class="font-weight-bold">@lang('query.pet')</label>
							<input type="text" class="form-control" value="{{ $consulta->pet->nombre }} ({{ $consulta->pet->id }})" disabled>
						</div>
						<div class="form-group">
							<label for="" class="font-weight-bold">@lang('query.date')</label>
							<input type="text" class="form-control" value="{{$consulta->event->fechaCita}}" readonly>
						</div>

						<div class="form-group">
							<label for="" class="font-weight-bold">@lang('query.obs')</label>
							<textarea name="observaciones" id="" cols="30" rows="10" class="form-control">{{$consulta->observaciones}}</textarea>
						</div>
					
						<button class="btn btn-primary btn-block">@lang('query.edit')</button>
					</form>
			</div>
		</div>
	</div>
	<div class="col-md-3 col-sm-12">
		@include('shared.menu-veterinario')
	</div>
</div>

@endsection