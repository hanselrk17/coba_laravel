@extends('layout.app')
@section('title','Forgot Password')

@section('meta')
    @include('include.meta')
@endsection

@section('content')
	<div class="wrapper">
		<div class="authentication-forgot d-flex align-items-center justify-content-center">
            <div class="mx-auto">
                <div class="mb-4 text-center">
                    <img src="{{asset('images/logo-img.png')}}" width="180" alt="" />
                </div>
                <div class="card forgot-box">
                    <div class="card-body">
                        <div class="p-4 rounded  border">
                            <div class="text-center">
                                <img src="{{ asset('images/icons/forgot-2.png') }}" width="120" alt="" />
                            </div>
                            <h4 class="mt-5 font-weight-bold">Forgot Password?</h4>
                            <p class="text-muted">Enter your registered email ID to reset the password</p>
                            <form method="POST" action="{{route('forgot_password_send_email.index')}}">
                                {{csrf_field()}}
                                <div class="my-4">
                                    <label class="form-label">Email id</label>
                                    <input type="text" class="form-control form-control-lg" placeholder="example@user.com" name="emailForgotPassword" />
                                </div>
                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary btn-lg">Send</button> 
                                    <a href="{{ route('login-web.index') }}" class="btn btn-light btn-lg"><i class='bx bx-arrow-back me-1'></i>Back to Login</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
		</div>
	</div>
@endsection

@section('custom_script')
    @include('include.custom_script')
@endsection