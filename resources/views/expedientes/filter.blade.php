<div class="card m-3">
	<div class="card-header font-weight-bold">@lang('record.filter_title')</div>
	<div class="card-body">
		<form method="post" action="{{route('expediente_ver_periodos', ['id' => $pet->id])}}">
			@csrf
			<div class="form-row">
				<div class="col">
					<label for="" class="font-weight-bold">@lang('record.start')</label>

					<input name="start" type="date" class="form-control  @error('start') is-invalid @enderror" value="{{old('start')}}">
					@error('start')
					<small class="text-danger mt-1 font-weight-bold">{{ $message }}</small>
					@enderror
				</div>
				<div class="col">
					<label for="" class="font-weight-bold">@lang('record.end')</label>
					<input name="end" type="date" class="form-control  @error('end') is-invalid @enderror" value="{{old('end')}}">
					@error('end')
					<small class="text-danger mt-1 font-weight-bold">{{ $message }}</small>
					@enderror
				</div>
			</div>
			<div class="form-group mt-2 mb-0 d-flex justify-content-between">
				<a href="{{route('expediente_ver', ['id' => $pet->id])}}" class="btn btn-primary"><i class="fas fa-border-all"></i> @lang('record.see_all')</a>
				<button class="btn btn-primary"><i class="fas fa-filter"></i> @lang('record.filter')</button>
			</div>
		</form>
	</div>
</div>