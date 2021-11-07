@extends('layouts.index')
@section('title',__('query.title2'))
@section('content')

<div class="row">
	<div class="col-md-9 col-sm-12">
		
		<div class="card m-3">
			<div class="card-body">
				<form method="POST">
					@csrf
					<div class="form-group">
						<label for="" class="font-weight-bold">@lang('query.pet')</label>
						<input type="text" class="form-control" value="{{ $pet->nombre }} ({{ $pet->id }})" disabled>
					</div>

					<div class="form-group">
						<div class="row">
							<div class="col-md-4 col-sm-12">
								<label for="" class="font-weight-bold">@lang('query.date')</label>
								<input type="text" class="form-control" value="{{$events[0]['fechaCita'] }}" readonly>
								<input type="hidden" name="idEvento" class="form-control" value="{{ $events[0]['id'] }}" >
							</div>
							<div class="col-md-8 col-sm-12">
								<label for="" class="font-weight-bold">@lang('query.desc')</label>
								<input type="text" class="form-control" value="{{$events[0]['descripcion'] }}" readonly>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="" class="font-weight-bold">@lang('query.indi')</label>
						<textarea name="indi" id="" cols="30" rows="10" readonly class="form-control ">{{$events[0]['indicaciones'] }}</textarea>	
					</div>
					<div class="form-group">
						<label for="" class="font-weight-bold">@lang('query.obs')</label>
						<textarea name="observaciones" id="" cols="30" rows="10" class="form-control @error('observaciones') is-invalid @enderror"></textarea>
						@error('observaciones')
						    <small class="text-danger mt-1 font-weight-bold">@lang($message)</small>
						@enderror
					</div>

					<button class="btn btn-primary btn-block">@lang('query.save')</button>
				</form>
			</div>
		</div>

	</div>
	<div class="col-md-3 col-sm-12">
		@include('shared.menu-veterinario')
	</div>
</div>
@endsection