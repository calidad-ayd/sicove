@extends('layouts.index')
@section('title', __('home.menu.about_us'))
@section('content')
<div class="row">
	<div class="col-sm-12 col-md-12">
		<div class="card">
			<div class="card-body">
				<h1 class="font-weight-bold">@lang('home.aboutus')</h1>
				<p>@lang('home.aboutus_detail')</p>
				<p class="font-weight-bolder pt-2">@lang('home.contribuyente')</p>
				<p>Jorge Andrés Cortés Sánchez</p>
				<p>Yoselyn Venegas Ceciliano</p>
				<p>Karina Gómez Rodríguez</p>
				<p>Sung Jae Moon </p>
			</div>
		</div>
	</div>
</div>
@endsection