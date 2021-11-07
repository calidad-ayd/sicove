<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="SICOVE es un sistema de expediente veterinario que permite al cliente obtener información referente a los tratamientos, consultas, diagnósticos brindados en la veterinaria." />
        <meta name="keywords" content="veterinaria, expediente, control, mascotas, foto mascota, cliente, control veterinario" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>SICOVE › @yield('title')</title>
        <link rel="stylesheet" href=" {{ mix('/css/app.css') }} ">
        <link rel="icon" href="/images/icon_web.png" type="image/png" sizes="16x16"> 
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
       <meta name="theme-color" content="#4285f4">
    </head>
    <body>
    	<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <img src="/images/logo.png" alt="Logo SICOVE" width="140" height="55">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
          <a class="nav-item nav-link" href="{{ route('home') }}"><i class="fas fa-home"></i> @lang('home.menu.home')</a>
          <a class="nav-item nav-link" href="{{route('servicios')}}"><i class="fas fa-boxes"></i> @lang('home.menu.our_services')</a>
          <a class="nav-item nav-link" href="{{route('nosotros')}}"><i class="fas fa-info"></i> @lang('home.menu.about_us')</a>
        </div>
      </div>
      @auth
        <div class="nav-item dropdown">
           <a id="navbarDropdown" class="btn btn-primary dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-user"></i> {{ Auth::user()->name }}
            </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
              <a href="{{route('dashboard')}}" class="dropdown-item">
                <i class="fas fa-home"></i> @lang('home.panel')
              </a>
              <a class="dropdown-item" href="{{ route('logout') }}"
                 onclick="
                    event.preventDefault();
                    document.getElementById('logout-form').submit();
                  ">
                  <i class="fas fa-power-off"></i> @lang('home.exit')
              </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
              </form>
              <form  class="mt-2" action="{{route('setLang')}}" method="POST">
                @csrf
                <div class="form-group ml-2 mr-2">
                  <label class="font-weight-bold">@lang('home.select_lang')</label>
                <select name="lang" id="lang" class="form-control" onchange="this.form.submit()">
                  <option value="es" @if(auth()->user()->language=="es") selected="selected"@endif>@lang('home.es')</option>
                  <option value="en" @if(auth()->user()->language=="en") selected="selected"@endif>@lang('home.en')</option>
                </select>
              </div>
              </form>

          </div>
        </div>
        @else
        <a href="{{route('login')}}" class="btn btn-primary"><i class="fas fa-user"></i> Iniciar sesión</a>
      @endauth
    </nav>
    <main style="margin: 20px;" role="main" id="page-content">
      <div class="container-fluid">
        @yield('content')
      </div>
      
    </main>
    <footer class="footer mt-2">
      <div class="container">
        <span>SICOVE <i class="far fa-copyright"></i> {{date('Y')}}.</span>
        <a class="text-muted float-right" href="{{route('thanks')}}"><i class="fas fa-heart"></i> @lang('home.footer.thanks')</a>
      </div>
    </footer>
    <script src="{{ mix('/js/app.js') }}"></script>
    </body>
  </html>