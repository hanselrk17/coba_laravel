@extends('layout.app')
@section('title','Edit Profile Password')

@section('meta')
    @include('include.meta')
@endsection

@section('sidebar')
    @include('include.sidebar')
@endsection

@section('header')
    @include('include.header')
@endsection

@section('content') 
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">User Profile</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Show Profile</li>
                            <li class="breadcrumb-item active" aria-current="page">Update Profile Password</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary">Settings</button>
                        <button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown">	<span class="visually-hidden">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">	<a class="dropdown-item" href="javascript:;">Action</a>
                            <a class="dropdown-item" href="javascript:;">Another action</a>
                            <a class="dropdown-item" href="javascript:;">Something else here</a>
                            <div class="dropdown-divider"></div><a class="dropdown-item" href="javascript:;">Separated link</a>
                        </div>
                    </div>
                </div>
            </div>
            <!--end breadcrumb-->
            <div class="container">
                <div class="main-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex flex-column align-items-center text-center">
                                        <img src="{{ $user->image_url ? asset($user->image_url) : Avatar::create($user->name)->toBase64()}}" alt="Admin" class="rounded-circle p-1 bg-primary" width="150" height="150">
                                        <div class="mt-3">
                                            <h4>{{ ($user->name) }}</h4>
                                            <p class="text-secondary mb-1 fw-bold">{{ $user->get_role->name }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-body">
                                    <form method="POST" action="{{ route('update_profile_password.userController',$user->id) }}" oninput='passwordBaruUser.setCustomValidity(passwordBaruUser.value != rePasswordBaruUser.value ? "Password tidak sama": "" )'  enctype="multipart/form-data">
                                        {{csrf_field()}}
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <label for="inputChoosePassword" class="form-label"><h6 class="mb-0">Masukkan Password Sekarang</h6></label>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <div class="input-group" id="show_hide_password">
                                                    <input type="password" class="form-control border-end-0" id="inputChoosePassword" name="passwordUser" placeholder="masukkan password anda sekarang" required> <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <label for="inputChoosePassword" class="form-label"><h6 class="mb-0">Masukkan Password Baru</h6></label>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <div class="input-group" id="show_hide_passwordBaru">
                                                    <input type="password" class="form-control border-end-0" id="inputChoosePassword" name="passwordBaruUser" placeholder="masukkan password baru" required> <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <label for="inputChoosePassword" class="form-label"><h6 class="mb-0">Masukkan Password Baru Sekali Lagi</h6></label>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <div class="input-group" id="show_hide_repasswordBaru">
                                                    <input type="password" class="form-control border-end-0" id="inputChoosePassword" name="rePasswordBaruUser" placeholder="masukkan password baru sekali lagi" required> <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-3"></div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="submit" id="button_submit" class="btn btn-primary px-4" value="Save Changes" />
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    @include('include.footer')
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
		});
        $(document).ready(function () {
			$("#show_hide_passwordBaru a").on('click', function (event) {
				event.preventDefault();
				if ($('#show_hide_passwordBaru input').attr("type") == "text") {
					$('#show_hide_passwordBaru input').attr('type', 'password');
					$('#show_hide_passwordBaru i').addClass("bx-hide");
					$('#show_hide_passwordBaru i').removeClass("bx-show");
				} else if ($('#show_hide_passwordBaru input').attr("type") == "password") {
					$('#show_hide_passwordBaru input').attr('type', 'text');
					$('#show_hide_passwordBaru i').removeClass("bx-hide");
					$('#show_hide_passwordBaru i').addClass("bx-show");
				}
			});
		});
        $(document).ready(function () {
			$("#show_hide_rePasswordBaru a").on('click', function (event) {
				event.preventDefault();
				if ($('#show_hide_rePasswordBaru input').attr("type") == "text") {
					$('#show_hide_rePasswordBaru input').attr('type', 'password');
					$('#show_hide_rePasswordBaru i').addClass("bx-hide");
					$('#show_hide_rePasswordBaru i').removeClass("bx-show");
				} else if ($('#show_hide_rePasswordBaru input').attr("type") == "password") {
					$('#show_hide_rePasswordBaru input').attr('type', 'text');
					$('#show_hide_rePasswordBaru i').removeClass("bx-hide");
					$('#show_hide_rePasswordBaru i').addClass("bx-show");
				}
			});
		});
	</script>
@endsection