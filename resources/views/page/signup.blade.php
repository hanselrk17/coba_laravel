@extends('layout.app')
@section('title','Signup User')

@section('meta')
    @include('include.meta')
    <link href="{{asset('css/cropper.css')}}" rel="stylesheet">
    <style>
        #image-prev:hover{
         cursor: pointer;
        }
    </style>
@endsection

@section('content')
    <div class="wrapper">
        <div class="d-flex align-items-center justify-content-center my-5 my-lg-0">
            <div class="container">
                <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-2">
                    <div class="col mx-auto">
                        <div class="my-4 text-center">
                            <img src="{{asset('images/logo-img.png')}}" width="180" alt="" />
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="border p-4 rounded">
                                    <div class="text-center">
                                        <h3 class="">Sign Up</h3>
                                        <p>Already have an account? <a href="{{route('login-web.index')}}">Sign in here</a>
                                        </p>
                                    </div>
                                    <div class="d-grid">
                                        <a class="btn my-4 shadow-sm btn-white" href="javascript:;"> <span class="d-flex justify-content-center align-items-center">
                        <img class="me-2" src="{{asset('images/icons/search.svg')}}" width="16" alt="Image Description">
                        <span>Sign Up with Google</span>
                                            </span>
                                        </a> <a href="javascript:;" class="btn btn-facebook"><i class="bx bxl-facebook"></i>Sign Up with Facebook</a>
                                    </div>
                                    <div class="login-separater text-center mb-4"> <span>OR SIGN UP WITH EMAIL</span>
                                        <hr/>
                                    </div>
                                    <div class="form-body">
                                        <form class="row g-3" method="post" action="{{route('signup.index')}}" oninput='repasswordSignup.setCustomValidity(passwordSignup.value != repasswordSignup.value ? "Password tidak sama": "" )'  enctype="multipart/form-data">
                                            {{csrf_field()}}
                                            <div class="col-sm-6">
                                                <label for="inputFirstName" class="form-label">First Name</label>
                                                <input type="text" class="form-control" id="inputFirstName" placeholder="First Name" name="firstNameSignup" required>
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="inputLastName" class="form-label">Last Name</label>
                                                <input type="text" class="form-control" id="inputLastName" placeholder="Last Name" name="lastNameSignup" required>
                                            </div>
                                            <div class="col-12">
                                                <label for="inputEmailAddress" class="form-label">Email Address</label>
                                                <input type="email" class="form-control" id="inputEmailAddress" placeholder="example@user.com" name="emailSignup" required>
                                            </div>
                                            <div class="col-12">
                                                <label for="inputChoosePassword" class="form-label">Password</label>
                                                <div class="input-group" id="show_hide_password">
                                                    <input type="password" class="form-control border-end-0" id="inputChoosePassword" placeholder="Enter Password" name="passwordSignup" required> <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <label for="inputChoosePassword" class="form-label" name="passwordSignup">Re-Enter Password</label>
                                                <div class="input-group" id="show_hide_repassword">
                                                    <input type="password" class="form-control border-end-0" id="inputChoosePassword" placeholder="Re-Enter Password" name="repasswordSignup" required> <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <label for="formFile" class="form-label">Input your profile photo</label>
                                                <input class="form-control" type="file" id="formFile" name="fotoUser" />
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <div class="form-group">
                                                    <img class="backup_picture" id="image-prev" alt="Picture" width="200px"  src="{{ asset('images/null.jfif') }}">
                                                    <img id="image" alt="Picture" width="300px"  src="" style="display:none">
                                                    <img id="image-after" alt="After" src="" style="display:none">
                                                    <button id="crop" type="button" class="btn btn-primary" style="display:none; margin-top: 5px" >Crop</button>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <input id="after" type="text" class="form-control" placeholder="Url" name="aftercrop" style="display:none" >
                                            </div>
                                            <div class="col-12">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" required>
                                                    <label class="form-check-label" for="flexSwitchCheckChecked">I read and agree to Terms & Conditions</label>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <button id="button_submit" type="submit" class="btn btn-primary"><i class='bx bx-user'></i>Sign up</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end row-->
            </div>
        </div>
    </div>
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