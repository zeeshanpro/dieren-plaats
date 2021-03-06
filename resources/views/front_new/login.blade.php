@extends('front_new/layout/login_layout')
@section('container')
<main class="main">

<div class="login-page bg-image pt-5 pb-5" style="background-color: white;">
    <div class="container">
        <div class="form-box">
            <div class="form-tab">
                <ul class="nav nav-pills nav-fill" role="tablist">
                    <li class="nav-item">
        <span class="nav-link">Welcome Back</span>
                        <!-- <a class="nav-link" id="signin-tab-2" data-toggle="tab" href="#signin-2" role="tab" aria-controls="signin-2" aria-selected="false">Welcome Back</a> -->
                    </li>

                </ul>
                <div class="text-center">
                    <span>Login to remora services</span>
                </div>
                <div class="tab-content">

                    <div class="tab-pane fade show active" id="signin-2" role="tabpanel" aria-labelledby="register-tab-2">
                    @error('msg') <small class="text-danger">{{$message}}</small> @enderror
                        <form method="post" action="{{ route('login') }}">
                        @csrf
                            <div class="form-group">
                                <label for="singin-email-2 cstm-pl-1">Email</label>
                                &nbsp;<input type="text" class="form-control" id="singin-email-2" name="email" required style="padding-left:4rem;">
            <span class="email_icon" >
                <!-- <i class="fa fa-envelope" aria-hidden="true"></i> -->
                <img src="{{ URL::to('public/assets/images/icons/envelope.svg') }}">
            </span>
                            </div>


                            <div class="form-group">
                                <label for="singin-password-2">Password</label>
                                <input type="password" class="form-control" id="singin-password-2" name="password" required style="padding-left:4rem;">
            <span class="password_icon" >
                <!-- <i class="fa fa-lock" aria-hidden="true"></i> -->
                <img src="{{ URL::to('public/assets/images/icons/lock.svg') }}">
            </span>
            <img class="password_icon_hide_register_login" src="{{ URL::to('public/assets/images/icons/eye.svg') }}">

                            </div><!-- End .form-group -->
                            <div class="form-footer">
                            <a href="{{route('show_forgot_password')}}" class="forgot-link">Forgot Password?</a>
                        </div>
                            <div class="form-footer">
                                <button type="submit" class="btn btn-outline-primary-2 active mt-1">
                                    <span>LOG IN</span>

                                </button>


                            </div><!-- End .form-footer -->
                            <div class="m-4 text-center">
                            
                                <span>Don't have an account?</span> <a href="#">Register</a>
                            </div>
                        </form>

                    </div><!-- .End .tab-pane -->
                </div><!-- End .tab-content -->
                </div><!-- End .tab-content -->
            </div><!-- End .form-tab -->
        </div><!-- End .form-box -->
    </div><!-- End .container -->
</div><!-- End .login-page section-bg -->
</main><!-- End .main -->

<!-- Sign in / Register Modal -->
<div class="modal fade" id="signin-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="icon-close"></i></span>
                </button>

                <div class="form-box">
                    <div class="form-tab">
                        <ul class="nav nav-pills nav-fill" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="signin-tab" data-toggle="tab" href="#signin" role="tab" aria-controls="signin" aria-selected="true">Sign In</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="register-tab" data-toggle="tab" href="#register" role="tab" aria-controls="register" aria-selected="false">Register</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="tab-content-5">
                            <div class="tab-pane fade show active" id="signin" role="tabpanel" aria-labelledby="signin-tab">
                                <form action="#">
                                    <div class="form-group">
                                        <label for="singin-email">Username or email address *</label>
                                        <input type="text" class="form-control" id="singin-email" name="singin-email" required>
                                    </div><!-- End .form-group -->

                                    <div class="form-group">
                                        <label for="singin-password">Password *</label>
                                        <input type="password" class="form-control" id="singin-password" name="singin-password" required>
                                    </div><!-- End .form-group -->

                                    <div class="form-footer">
                                        <button type="submit" class="btn btn-outline-primary-2">
                                            <span>LOG IN</span>
                                            <i class="icon-long-arrow-right"></i>
                                        </button>

                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="signin-remember">
                                            <label class="custom-control-label" for="signin-remember">Remember Me</label>
                                        </div><!-- End .custom-checkbox -->

                                        <a href="" class="forgot-link">Forgot Your Password?</a>
                                    </div><!-- End .form-footer -->
                                </form>
                                <div class="form-choice">
                                    <p class="text-center">or sign in with</p>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <a href="#" class="btn btn-login btn-g">
                                                <i class="icon-google"></i>
                                                Login With Google
                                            </a>
                                        </div><!-- End .col-6 -->
                                        <div class="col-sm-6">
                                            <a href="#" class="btn btn-login btn-f">
                                                <i class="icon-facebook-f"></i>
                                                Login With Facebook
                                            </a>
                                        </div><!-- End .col-6 -->
                                    </div><!-- End .row -->
                                </div><!-- End .form-choice -->
                            </div><!-- .End .tab-pane -->
                            <div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="register-tab">
                                <form action="#">
                                    <div class="form-group">
                                        <label for="register-email">Your email address *</label>
                                        <input type="email" class="form-control" id="register-email" name="register-email" required>
                                    </div><!-- End .form-group -->

                                    <div class="form-group">
                                        <label for="register-password">Password *</label>
                                        <input type="password" class="form-control" id="register-password" name="register-password" required>
                                    </div><!-- End .form-group -->

                                    <div class="form-footer">
                                        <button type="submit" class="btn btn-outline-primary-2">
                                            <span>SIGN UP</span>
                                            <i class="icon-long-arrow-right"></i>
                                        </button>

                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="register-policy" required>
                                            <label class="custom-control-label" for="register-policy">I agree to the <a href="#">privacy policy</a> *</label>
                                        </div><!-- End .custom-checkbox -->
                                    </div><!-- End .form-footer -->
                                </form>
                                <div class="form-choice">
                                    <p class="text-center">or sign in with</p>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <a href="#" class="btn btn-login btn-g">
                                                <i class="icon-google"></i>
                                                Login With Google
                                            </a>
                                        </div><!-- End .col-6 -->
                                        <div class="col-sm-6">
                                            <a href="#" class="btn btn-login  btn-f">
                                                <i class="icon-facebook-f"></i>
                                                Login With Facebook
                                            </a>
                                        </div><!-- End .col-6 -->
                                    </div><!-- End .row -->
                                </div><!-- End .form-choice -->
                            </div><!-- .End .tab-pane -->
                        </div><!-- End .tab-content -->
                    </div><!-- End .form-tab -->
                </div><!-- End .form-box -->
            </div><!-- End .modal-body -->
        </div><!-- End .modal-content -->
    </div><!-- End .modal-dialog -->
</div><!-- End .modal -->
@endsection
