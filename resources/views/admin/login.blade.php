<?php 
$publicPath = env('ASSETS_PATH');
?>
<!DOCTYPE html>
<html>
<head>
<style>
html,
body {
  height: 100%;
}

body {
  display: -ms-flexbox;
  display: -webkit-box;
  display: flex;
  -ms-flex-align: center;
  -ms-flex-pack: center;
  -webkit-box-align: center;
  align-items: center;
  -webkit-box-pack: center;
  justify-content: center;
  padding-top: 40px;
  padding-bottom: 40px;
  background-color: #f5f5f5;
}

.form-signin {
  width: 100%;
  max-width: 330px;
  padding: 15px;
  margin: 0 auto;
}
.form-signin .checkbox {
  font-weight: 400;
}
.form-signin .form-control {
  position: relative;
  box-sizing: border-box;
  height: auto;
  padding: 10px;
  font-size: 16px;
}
.form-signin .form-control:focus {
  z-index: 2;
}
.form-signin input[type="email"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}
.form-signin input[type="password"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}
        
        .login-logo {
            width: 90%; padding: 1em;
        }
        .signin {
            display: block;font-size: 1em;font-weight: normal;
        }        
</style>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{ config('app.name', 'DIEREN PLAATS') }} | Admin Panel</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset( $publicPath . 'admin_assets/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset( $publicPath . 'admin_assets/dist/css/adminlte.min.css') }}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="text-center" onload="clearkeys()">

        <form class="form-signin border rounded" action="{{ url('/admin/check-admin') }}" method="post">
            @csrf
            <img style="border-radius: 2.5rem;" class="mb-4 login-logo" src="{{ asset( $publicPath . 'admin_assets/logo.png') }}" alt="Logo File" >
            <span class="mb-3 text-left text-muted signin">Sign in</span>
            <label for="username" class="sr-only">Username</label>
            <input type="username" id="email" name="email" class="form-control" placeholder="Email Address" required autofocus>
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
            <input class="btn btn-lg btn-primary btn-block" type="submit" name="login" value="Sign in">
        </form>
        <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- jQuery -->
<script src="{{ asset( $publicPath . 'admin_assets/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset( $publicPath . 'admin_assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset( $publicPath . 'admin_assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<script src="{{ asset( $publicPath . 'admin_assets/dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->

    </body>
    </html>