@extends('layouts.index')
@section('title', 'Reconocimientos')
@section('content')
	<div class="row">
		<div class="col-sm-12 col-md-12">
			<div class="card">
				<div class="card-body text-center">
					<h1 class="font-weight-bold">@lang('acknowledgment.title')</h1>
					<p>@lang('acknowledgment.body')</p>
					<hr>
					<h4 class="font-weight-bold">@lang('acknowledgment.core.basic')</h4>
					<div class="d-flex justify-content-center">
						<a href="https://laravel.com" class="text-reset text-decoration-none">
							<div class="m-2"><i class="fab fa-laravel h1" style="color:#f55247"></i> Laravel</div>
						</a>
						<a href="https://getboostrap.com" class="text-reset text-decoration-none">
							<div class="m-2"><i class="fab fa-bootstrap h1" style="color:#7952b3"></i> Bootstrap</div>
						</a>
					</div>

					<hr>
					<h4 class="font-weight-bold">@lang('acknowledgment.core.secondary')</h4>
					<div class="d-flex justify-content-center align-items-center">
						<a href="https://fontawesome.com" class="text-reset text-decoration-none">
							<div class="m-2"><i class="fab fa-font-awesome-flag h1" style="color:#228ae6"></i> Fontawesome</div>
						</a>
						<a href="https://fonts.google.com" class="text-reset text-decoration-none">
							<div class="m-2"><i class="fab fa-google h1" style="color:#ea4335"></i> Fonts</div>
						</a>
						<a href="https://flaticon.com" class="text-reset text-decoration-none">
							<div class="m-2"><i class="fas fa-icons h1" style="color: #4ad295"></i> Flaticon</div>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection