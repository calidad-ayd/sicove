@extends('layouts.index')
@section('title', __('dashboard.page_title'))
@section('content')
	<div class="row">
		<div class="col-md-9 col-sm-12">
			@if (session()->has('error'))
				@include('shared.error', ['message' => __(session('error'))])
			@endif
			<div class="card m-3">
				<div class="card-header font-weight-bold">@lang('dashboard.consulta_title_1')</div>
				
				<div class="card-body">
					<form method="POST" autocomplete="off">
						@csrf
						<div class="form-row">
						    <div class="col">
								<input name="client_id" type="text" class="form-control" placeholder="@lang('dashboard.consulta_input_1_placeholder')">
						    </div>
						    <div class="col">
						      	<button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> @lang('dashboard.consulta_btn_1')</button>	
						    </div>
						</div>
					</form>
				</div>
			</div>
			<div class="card m-3">
				<div class="card-header font-weight-bold">@lang('dashboard.pending_appointments')</div>
				<div class="card-body">
					@if(count($agenda)>0)
						<div class="form-row">
						    <div class="col">
								<table class="table table-striped table-responsive-lg">
									<thead>
										<tr>
											<th scope="col">@lang('dashboard.pending_appointments_h1_fecha')</td>
											<th scope="col">@lang('dashboard.pending_appointments_h2_np') </td>
											<th scope="col">@lang('dashboard.pending_appointments_h3_obs') </td>
											<th scope="col"></th>
										</tr>
									</thead>
									<tbody>
									@foreach ($agenda as $a)
										<tr>
											<td> <?php echo ''.date('g A',strtotime($a['horaCita'])); ?> </td>
											<td> {{$a->pet->nombre}} </td>
											<td> {{$a->descripcion}} </td>
											<td>
												<input type="hidden" name="idCita"><a href="{{route('expediente_ver', ['id' => $a->pet->id])}}" class="btn btn-primary"><i class="fas fa-clipboard-check
"></i> @lang('dashboard.make_attendance')</a>
											</td>
										</tr>
									@endforeach 
									</tbody>
								</table>
						    </div>
						</div>
					@else
						<div class="alert alert-info mb-0">@lang('dashboard.no_pendings')</div>
					@endif
				</div>
			</div>
			<div class="h3 m-3 font-weight-bold">@lang('dashboard.statistics')</div>
			<div class="card m-3" style="border-radius: 5px!important;">
				<div class="card-body d-flex m-0 p-0">
					<div  class="p-4" style="border-right: 1px solid #674172;background-color: #9b59b6">
						<img src="/images/team.png" alt="" style="width: 60px;">
					</div>
					<div class="d-flex justify-content-between w-100 ml-4 align-items-center mr-4">
						<div class="title h5 font-weight-bold">@lang('dashboard.statistics_1')</div>
						<div class="data font-weight-bold" style="font-size: 40px;">{{$countable['clients']}}</div>
					</div>
				</div>
			</div>
			<div class="card m-3" style="border-radius: 5px!important;">
				<div class="card-body d-flex m-0 p-0">
					<div  class="p-4" style="border-right: 1px solid #2574a9;background-color: #1e8bc3">
						<img src="/images/pets.png" alt="" style="width: 60px;">
					</div>
					<div class="d-flex justify-content-between w-100 ml-4 align-items-center mr-4">
						<div class="title h5 font-weight-bold">@lang('dashboard.statistics_2')</div>
						<div class="data font-weight-bold" style="font-size: 40px;">{{$countable['pets']}}</div>
					</div>
				</div>
			</div>
			<div class="card m-3" style="border-radius: 5px!important;">
				<div class="card-body d-flex m-0 p-0">
					<div  class="p-4" style="border-right: 1px solid #d35400;background-color: #e87e04">
						<img src="/images/schedule.png" alt="" style="width: 60px;">
					</div>
					<div class="d-flex justify-content-between w-100 ml-4 align-items-center mr-4">
						<div class="title h5 font-weight-bold">@lang('dashboard.statistics_3')</div>
						<div class="data font-weight-bold" style="font-size: 40px;">{{$countable['appointments']}}</div>
					</div>
				</div>
			</div>


		</div>
		<div class="col-md-3 col-sm-12">
			@include('shared.menu-veterinario')			
		</div>
	</div>	
@endsection