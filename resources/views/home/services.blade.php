@extends('layouts.index') 
@section('title', __('home.menu.our_services')) 
@section('content')
<style>
  ul.a {
  list-style-type: circle;
}
</style>

<div class="row">
  <div class="col-md-12 col-sm-12">
    <div class="card mt-3">
      <div class="card-body">
        <h1 class="font-weight-bold">@lang('home.services')</h1>
        <p>@lang('home.service_detail')</p>        
      </div>
    </div>
  </div>
</div>
<div class="row">
   <div class="col-md-6 col-sm-12 mt-2">   
      <div class="card">
        <div class="card-body d-flex justify-content-between align-items-center">
          <div>
            <h1 class="font-weight-bolder">@lang('home.available')</h1>
            <p class="font-weight-light">@lang('home.consult')</p>
            <ul class ="a">
              <li>@lang('home.pt1')</li>
              <li>@lang('home.pt2')</li>
              <li>@lang('home.pt3')</li>
              <li>@lang('home.pt4')</li>
            </ul>
        </div>
        <img class="ml-2" src="/images/shield.png" style="width: 100px;">
        </div>
      </div>
  </div>
  <div class="col-md-6 col-sm-12 mt-2 mb-2">
    <div class="card">
        <div class="card-body d-flex justify-content-between align-items-center">
          <div>
            <h1 class="font-weight-bolder">@lang('home.vetservice')</h1>
            <p class="font-weight-light">@lang('home.etc')</p>
            <ul class ="a">
              <li>@lang('home.pt6')</li>
              <li>@lang('home.pt7')</li>
              <li>@lang('home.pt8')</li>
              <li>@lang('home.pt9')</li>
              <li>@lang('home.pt10')</li>
            </ul>
            <p>@lang('home.moredetail')</p>
            <ul class="a">
              <li>@lang('home.list1')</li>
              <li>@lang('home.list2')</li>
              <li>@lang('home.list3')</li>
            </ul> 
          </div>
          <img class="ml-2" src="/images/benefits.png" style="width: 100px;">
        </div>
      </div>
  </div>
</div>
@endsection