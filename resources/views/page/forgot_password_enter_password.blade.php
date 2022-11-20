@extends('layout.app')
@section('title','Enter New Password')

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
                            <form method="POST" action="{{route('forgot_password_success.index',$id)}}" oninput='newRePassword.setCustomValidity(newPassword.value != newRePassword.value ? "Password tidak sama": "" )'  enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="my-4">
                                    <label for="inputChoosePassword" class="form-label">Enter New Password</label>
                                    <div class="input-group" id="show_hide_password">
                                        <input type="password" class="form-control border-end-0" id="inputChoosePassword" name="newPassword" placeholder="Enter Password"> <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                                    </div>
                                </div>
                                <div class="my-4">
                                    <label for="inputChoosePassword" class="form-label">Re-Enter Password</label>
                                    <div class="input-group" id="show_hide_repassword">
                                        <input type="password" class="form-control border-end-0" id="inputChoosePassword" name="newRePassword" placeholder="Enter Password"> <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                                    </div>
                                </div>
                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary btn-lg">Send</button> 
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
    <script>
		$(document).ready(function () {
			$("#show_hide_password a").on('click', function (event) {
				event.preventDefault();
				if ($('#show_hide_password input').attr("type") == "text") {
					$('#show_hide_password input').attr('type', 'password');
					$('#show_hide_password i').addClass("bx-hide");
					$('#show_hide_password i').removeClass("bx-show");
				} else if ($('#show_hide_password input').attr("type") == "password") {
					$('#show_hide_password input').attr('type', 'text');
					$('#show_hide_password i').removeClass("bx-hide");
					$('#show_hide_password i').addClass("bx-show");
				}
			});

            $("#show_hide_repassword a").on('click', function (event) {
				event.preventDefault();
				if ($('#show_hide_repassword input').attr("type") == "text") {
					$('#show_hide_repassword input').attr('type', 'password');
					$('#show_hide_repassword i').addClass("bx-hide");
					$('#show_hide_repassword i').removeClass("bx-show");
				} else if ($('#show_hide_repassword input').attr("type") == "password") {
					$('#show_hide_repassword input').attr('type', 'text');
					$('#show_hide_repassword i').removeClass("bx-hide");
					$('#show_hide_repassword i').addClass("bx-show");
				}
			});
		});
	</script>
@endsection