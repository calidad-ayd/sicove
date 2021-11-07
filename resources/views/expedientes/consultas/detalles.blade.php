@extends('layouts.index')
@section('title', __('query.title3'))
@section('content')

	<div class="row">
		<div class="col-md-9 col-sm-12">
			<div class="card m-3">
				<div class="card-header font-weight-bold">@lang('query.details')</div>
				<div class="card-body">
					<table class="table table-striped table-responsive-lg">
						<tr>
							<td>@lang('pet.name'):</td>
							<td><strong>{{ $data->event->pet->nombre }}</strong></td>
						</tr>
						<tr>
							<td>@lang('query.date'):</td>
							<td><strong>{{ $data->event->fechaCita }}</strong></td>
						</tr>
						<tr>
							<td>@lang('query.obs'):</td>
							<td><strong>{{ $data->observaciones }}</strong></td>
						</tr>
					</table>
				</div>
			</div>
		</div>
		<div class="col-md-3 col-sm-12">
			@include('shared.menu-veterinario')
		</div>
	</div>

@endsection