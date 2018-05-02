<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Đăng nhập</title>

    <!-- Bootstrap core CSS -->
    <link href="{{asset('bootstrap/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{asset('css/signin.css')}}" rel="stylesheet">
  </head>

  <body>

    <div class="container">
    
      @include('blocks.login_error')
      <form class="form-signin" method="post" action="" autocomplete="off">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <h2 class="form-signin-heading">Đăng nhập</h2>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input value="{{old('txtEmail')}}" name="txtEmail" type="email" id="inputEmail" class="form-control" placeholder="Email" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input name="txtPass" type="password" id="inputPassword" class="form-control" placeholder="Mật khẩu" required>
        <div class="checkbox">
    
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Đăng nhập</button>
      </form>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="{{asset('js/ie10-viewport-bug-workaround.js')}}"></script>
  </body>
</html>