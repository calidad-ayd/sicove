@extends('layouts.index')
@section('title', __('home.title'))
@section('content')
    <div class="row">
      <div class="col-md-12 col-sm-12">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
            <li data-target="#myCarousel" data-slide-to="3"></li>
          </ol>
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img class="d-block w-100" src="/images/1.png">
              <div class="container">
                <div class="carousel-caption">
                   <h1 style="">@lang('home.home_sicove')</h1>
                </div>
              </div>
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="/images/3.png">
              <div class="container">
                <div class="carousel-caption">
                  <h1 style="">@lang('home.home_vaccine')</h1>
                </div>
              </div>
            </div>
             <div class="carousel-item">
              <img class="d-block w-100" src="/images/4.png">
              <div class="container">
                <div class="carousel-caption">
                  <h1 style="">@lang('home.home_treatment')</h1>
                </div>
              </div>
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="/images/5.png">
              <div class="container">
                <div class="carousel-caption">
                  <h1 style="">@lang('home.home_citas')</h1>
                </div>
              </div>
            </div>
          </div>
          <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
      <div class="col-md-12 col-sm-12 mt-3 mb-2">
        <div class="card">
          <div class="card-body">
             <div class="row">
              <div class="col-lg-6 d-flex flex-column justify-content-center align-items-center">
                <img class="" src="/images/vet.png" width="140" height="140">
                <h2 class="font-weight-bolder">@lang('home.home_servicios')</h2>
                <p class="font-weight-light">@lang('home.home_informacion')</p>
                <a class="btn btn-primary"href="{{route('servicios')}}" role="button">@lang('home.home_details') <i class="fas fa-arrow-right"></i></a>
              </div>
              <div class="col-lg-6 d-flex flex-column justify-content-center align-items-center">
                <img src="/images/veterinary.png" width="140" height="140">
                <h2 class="font-weight-bolder">@lang('home.home_us')</h2>
                <p class="font-weight-light">@lang('home.home_acerca')</p>
                <a class="btn btn-primary" href="{{route('nosotros')}}" role="button">@lang('home.home_details') <i class="fas fa-arrow-right"></i></a>
              </div>
            </div>
          </div>
          <div class="col-md-12 col-lg-12 col-sm-12">
             <hr class="item">
          </div>
       
          <div class="card-body">
            <div class="d-flex align-items-center">
              <img class="m-2" style="width:150px;" src="/images/click.png">
              <div>
                <h2 class="font-weight-bolder">@lang('home.home_easy')</h2>
                <span class="font-weight-light text-muted">@lang('home.home_logic')</span>
                <p class="lead">@lang('home.logic_description') </p>
              </div>

            </div>
          </div>
          <div class="col-md-12 col-lg-12 col-sm-12">
               <hr class="item">
          </div>
          <div class="card-body">
            <div class="d-flex align-items-center">
              <img class="m-2" style="width:150px;" src="/images/all-in-one-site.png">
              <div>
                <h2 class="font-weight-bolder">@lang('home.home_vetuse')</h2>
                <span class="font-weight-light text-muted">@lang('home.vetuse_detail')</span>
                <p class="lead">@lang('home.home_consult') </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection
