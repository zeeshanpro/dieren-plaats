@extends('front_new/layout/login_layout')
@section('container')
<main class="main">
    <div class="login-page bg-image pt-5 pb-5" style="background-color: white;">
        <div class="container">
            <div class="form-box">
                <div class="form-tab">
                    <ul class="nav nav-pills nav-fill" role="tablist">
                        <li class="nav-item">
                            <span class="nav-link">Forgot Password</span>
                            <!-- <a class="nav-link" id="signin-tab-2" data-toggle="tab" href="#signin-2" role="tab" aria-controls="signin-2" aria-selected="false">Welcome Back</a> -->
                        </li>

                    </ul>
                    <div class="text-center custom-ft-w8-subheading">
                        <span>Enter your email to reset password </span>
                    </div>
                    <div class="tab-content">

                        <div class="tab-pane fade show active" id="signin-2" role="tabpanel" aria-labelledby="register-tab-2">
                            @error('msg') <small class="text-danger">{{$message}}</small> @enderror
                            <div class="row">
                                <x-notification />
                            </div>
                            <!-- <p>{{__("You don't have an account?")}} <a href="{{route('register')}}" class="red"><strong>{{__('Create a free account')}}</strong></a></p> -->

                            <form method="post" action="{{route('send_forgot_password_email')}}">
                                @csrf
                                <div class="form-group">
                                    <label for="singin-email-2">Email</label>
                                    &nbsp;<input type="text" class="form-control" id="singin-email-2" name="email" required style="padding-left:4rem;">
                                    <span class="email_icon"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                                </div>

                                <div class="form-footer">
                                    <button type="submit" class="btn btn-outline-primary-2 active mt-2">
                                        <span>Submit</span>

                                    </button>


                                </div><!-- End .form-footer -->

                            </form>

                        </div><!-- .End .tab-pane -->
                    </div><!-- End .tab-content -->
                </div><!-- End .tab-content -->
            </div><!-- End .form-tab -->
        </div><!-- End .form-box -->
    </div><!-- End .container -->
</div><!-- End .login-page section-bg -->
</main><!-- End .main -->
@endsection