@extends('layout.app')
@section('title','Edit Profile')

@section('meta')
    @include('include.meta')
    <link href="{{asset('css/cropper.css')}}" rel="stylesheet">
    <style>
        #image-prev:hover{
         cursor: pointer;
        }
    </style>
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
                            <li class="breadcrumb-item active" aria-current="page">Lihat Profile</li>
                            <li class="breadcrumb-item active" aria-current="page">Update Profile</li>
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
                            <div class="dropdown-divider"></div>	<a class="dropdown-item" href="javascript:;">Separated link</a>
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
                                    <form method="POST" action="{{ route('update_profile.userController',$user->id) }}">
                                        {{csrf_field()}}
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Full Name</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="text" class="form-control" name="namaUser" placeholder="masukkan nama lengkap" value="{{ $user->name }}" />
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Email</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="text" class="form-control" name="emailUser" placeholder="masukkan email baru" value="{{ $user->email }}" />
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Photo Profile</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input class="form-control" type="file" id="formFile" name="fotoUser" />
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <div class="form-group">
                                                    <img class="backup_picture" id="image-prev" alt="Picture" width="200px"  src="{{ $user->image_url ? asset($user->image_url) : Avatar::create($user->name)->toBase64()}}">
                                                    <img id="image" alt="Picture" width="300px"  src="" style="display:none">
                                                    <img id="image-after" alt="After" src="" style="display:none">
                                                    <button id="crop" type="button" class="btn btn-primary" style="display:none; margin-top: 5px" >Crop</button>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <input id="after" type="text" class="form-control" placeholder="Url" name="aftercrop" style="display:none" >
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <label for="inputChoosePassword" class="form-label"><h6 class="mb-0">Enter Password</h6></label>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <div class="input-group" id="show_hide_password">
                                                    <input type="password" class="form-control border-end-0" id="inputChoosePassword" name="passwordUser" placeholder="masukkan password anda"> <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
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
    <script src="{{asset('js/cropper.js')}}"></script>
    <script src="{{asset('js/jquery-cropper.js')}}"></script>
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
	</script>
    <script>
        $( "#image-prev" ).click(function()
        {
            $('#formFile').trigger('click');

        });
        var $crop = $('#crop');
        var $image = $('#image');
        $image.cropper({
            aspectRatio: 1,
        });
        function readURL(input) {
            if (input.files && input.files[0]) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    $('#image').attr('src', e.target.result);
                    $image.cropper("destroy");
                    $image.cropper({
                        cropBoxResizable: false,
                        minCropBoxWidth: 600,
                        minCropBoxHeight:600,
                        maxWidth: 600,
                        maxHeight: 600,
                        background:false,
                        aspectRatio: 1,
                        data:{
                            width: 600,
                            height:  600,
                        },
                    });
                    $image.show();
                    $('#image-prev').hide();

                }
                reader.readAsDataURL(input.files[0]);
            } else {
                alert('select a file to see preview');
                $('#image').attr('src', '');
                $image.hide();
            };
        }
        $("#formFile").change(function() {
            readURL(this);
            $('#image-after').hide()
            $crop.show();
            $('#button_submit').attr("disabled",true)
        });
        $('#crop').click(function(){
            $image = $('#image');
            var cropper = $image.data('cropper');
            var url = cropper.getCroppedCanvas( {fillColor: '#fff','width': 150, 'height': 150}).toDataURL('image/jpeg').replace(/^data:image\/[^;]+/, 'data:application/octet-stream');
            $("#image-after").attr('src', url);
            $("#after").val( url);
            var $url = ("#url");
            $("#image-after").show();
            $(this).hide();
            $("#image").cropper("destroy");
            $("#image").hide();
            $('#button_submit').attr("disabled",false)
        })
    </script>
@endsection