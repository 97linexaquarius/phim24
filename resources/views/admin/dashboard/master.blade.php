<!DOCTYPE html>
<html lang="en" ng-app="my-app">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>CMS</title>

    <!-- Bootstrap core CSS -->
    <link href="{{asset('bootstrap/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{asset('css/dashboard.css')}}" rel="stylesheet" type='text/css'>
    
  </head>

  <body>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      <a class="navbar-brand" href="#"><img src="{{asset('images/logo.png')}}"/></a>
      <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
     
        <form class="form-inline my-10 my-lg-0 ml-auto">
            <span class="text-white">Xin chào, {{Auth::user()->name}}</span>
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">
                <i class="fa fa-sign-out" aria-hidden="true"></i>
                <a class="logout" href="{{route('getLogout')}}">Đăng xuất</a>
            </button>
        </form>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <nav class="col-sm-3 col-md-2 d-none d-sm-block bg-light sidebar">
          <ul class="nav nav-pills flex-column">
            
            <li class="nav-item">
              <a class="nav-link {{ Route::currentRouteNamed('admin') ? 'active' : '' }}" href="{{route('admin')}}">
                <i class="fa fa-list-ol" aria-hidden="true"></i>  
                Quản lý thể loại
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ Route::currentRouteNamed('nation') ? 'active' : '' }}" href="{{route('nation')}}">
                <i class="fa fa-globe" aria-hidden="true"></i>
                Quản lý quốc gia
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ Route::currentRouteNamed('movie') ? 'active' : '' }}" href="{{route('movie')}}"> 
                <i class="fa fa-film" aria-hidden="true"></i>   
                Quản lý phim
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ Route::currentRouteNamed('link') ? 'active' : '' }}" href="{{route('link')}}">
                <i class="fa fa-link" aria-hidden="true"></i>
                Quản lý link phim
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ Route::currentRouteNamed('info') ? 'active' : '' }}" href="{{route('info')}}">
                <i class="fa fa-info-circle" aria-hidden="true"></i>   
                Quản lý thông tin phim
              </a>
            </li>
            @unless (Auth::user()->level!=1)
              <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteNamed('user') ? 'active' : '' }}" href="{{route('user')}}">
                  <i class="fa fa-users" aria-hidden="true"></i>   
                  Quản lý tài khoản
                </a>
              </li>
            @endunless
          </ul>
        </nav>

        <main class="col-sm-9 ml-sm-auto col-md-10 pt-3" role="main">
          
            @yield('content')
        </main>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

    <script src="{{asset('angular/angular.min.js')}}"></script>
    <script src="{{asset('angular/ng-file-upload.min.js')}}"></script>
    <script src="{{asset('angular/ui-bootstrap-tpls-2.5.0.min.js')}}"></script>
    <script src="{{asset('angular/app.js')}}"></script>
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/popper.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="{{asset('js/ie10-viewport-bug-workaround.js')}}"></script>
  </body>
</html>
