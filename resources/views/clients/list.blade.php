@extends('layouts.index')
@section('title', __('clients.list_title'))
@section('content')
	<div class="row">
		<div class="col-md-12 col-sm-12 m-3">
			<h3 style="font-weight: 700">@lang('clients.title')</h3>
		</div>
		<div class="col-md-9 col-sm-12">
			@if (session()->has('message'))
				@include('shared.success', ['message' => __(session('message'))])
			@endif
			<div class="card m-3">
				<div class="card-body pb-0">
					<a href="{{route('clients_create')}}" class="btn btn-primary float-right"><i class="fas fa-user-plus"></i> @lang('clients.new_client')</a>
				</div>
				<div class="card-body">
					<table class="table table-striped table-responsive-lg">
						<thead>
							<tr>
								<th>@lang('clients.id')</th>
								<th>@lang('clients.name')</th>
								<th>@lang('clients.firstName')</th>
								<th>@lang('clients.lastName')</th>
								<th>@lang('clients.phone')</th>
								<th>@lang('clients.email')</th>
								<th>@lang('clients.options')</th>
							</tr>
						</thead>
						<tbody>
							@foreach($clients as $client)
								<tr>
									<td>{{ $client->id }}</td>
									<td>{{ $client->nombre }}</td>
									<td>{{ $client->primerApellido }}</td>
									<td>{{ $client->segundoApellido }}</td>
									<td>{{ $client->telefono }}</td>
									<td>{{ $client->correo }}</td>
									<td>
										<a href="{{ route('clients_show', ['id' => $client->id]) }}" class="btn btn-primary"><i class="fas fa-eye"></i> @lang('clients.view')</a>
										<a href="{{ route('clients_edit', ['id' => $client->id]) }}" class="btn btn-primary"><i class="fas fa-pencil-alt"></i> @lang('clients.edit')</a>
									</td>
								</tr>
							@endforeach							
						</tbody>
					</table>
					{{ $clients->links() }}
				</div>
			</div>
		</div>
		<div class="col-md-3 col-sm-12">
			@include('shared.menu-veterinario')	
		</div>
	</div>
@endsection