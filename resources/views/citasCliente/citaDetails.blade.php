<div class="card-body d-flex mt-2" style="background: #e8e8e8;border-radius: 5px;">
	<div class="mr-3">
		<img class="img-thumbnail" src="@php print App\Http\Controllers\ImageController::getImage($cita->foto); @endphp" alt="" style="max-height: 100px;min-height: 100px;max-width: 100px;min-width: 100px">
	</div>
	<div>
		<p>
			<span class="font-weight-bold">@lang('clients.ap_t1')</span> {{ $cita->fechaCita }} {{ $cita->horaCita }}
		</p>
		<p>
			<span class="font-weight-bold">@lang('clients.ap_t2'):</span> {{ $cita->descripcion }}
		</p>
		@if(!empty($cita->veterinaryNombre))
			<p>
				<span class="font-weight-bold">@lang('clients.ap_t3'):</span> {{ $cita->veterinaryNombre }} {{ $cita->primerApellido }}
			</p>
		@endif	
		@if ($excludeOption)
			<div>
				<form method="POST">
					@csrf
					<input type="hidden" name="citaId" value="{{ $cita->citaId }}">
					<button class="btn btn-danger"><i class="fas fa-trash"></i> @lang('clients.ap_t4')</button>
				</form>
			</div>
		@endif
	</div>
</div>