@extends('layouts.index')
@section('title', __('treatment.add_treatment'))
@section('content')

	<div class="row">
		<div class="col-md-9 col-sm-12">
			<div class="card m-3">
				<div class="card-body">
					<form method="POST" autocomplete="off">
					@csrf
					<div class="form-group">
						<label for="" class="font-weight-bold">@lang('treatment.indicaciones')</label>
						<textarea name="indicacion" id="" cols="30" rows="10" class="form-control"></textarea>
						@error('indicacion')
                            <small class="text-danger mt-1 font-weight-bold">@lang($message)</small>
                        @enderror
					</div>

					<div class="form-group">
						<label for="" class="font-weight-bold">@lang('treatment.periodicidad')</label>
						<input name="periodicidad" type="text" class="form-control">
						@error('periodicidad')
                            <small class="text-danger mt-1 font-weight-bold">@lang($message)</small>
                        @enderror
					</div>

					<div class="form-group">
						<label for="" class="font-weight-bold">@lang('treatment.duracion')</label>
						<input name="duracion" type="number" class="form-control" min="1" value="1">
						@error('duracion')
                            <small class="text-danger mt-1 font-weight-bold">@lang($message)</small>
                        @enderror
					</div>

                    <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-plus"></i> @lang('treatment.add_treatment')</button>


				</form>
				</div>
			</div>
		</div>
		<div class="col-md-3 col-sm-12">
			@include('shared.menu-veterinario')
		</div>
	</div>

@endsection