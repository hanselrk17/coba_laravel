@extends('layout.app')
@section('title','Edit Item')

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
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Admin</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Admin</li>
                            <li class="breadcrumb-item active" aria-current="page">Table Item</li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Item</li>
                        </ol>
                    </nav>
                </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-9 mx-auto">
                    <h6 class="mb-0 text-uppercase">Edit Item</h6>
                    <hr/>
                    <div class="card border-top border-0 border-4 border-info">
                        <div class="card-body">
                            <div class="border p-4 rounded">
                                <div class="card-title d-flex align-items-center">
                                    <div><i class="bx bxs-user me-1 font-22 text-info"></i>
                                    </div>
                                    <h5 class="mb-0 text-info">Edit Item Form</h5>
                                </div>
                                <hr/>
                                <form method="POST" action="{{ route('update_item.itemController',$item->id) }}">
                                    {{csrf_field()}}
                                    <div class="row mb-3">
                                        <label for="inputEnterYourName" class="col-sm-3 col-form-label">Item Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="inputEnterYourName" name ="namaItem" placeholder="Nama Item" value="{{ $item->name }}">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputPhoneNo2" class="col-sm-3 col-form-label">Quantity</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="inputPhoneNo2" name ="quantityItem" placeholder="Quantity Item" value="{{ $item->qty }}">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputEmailAddress2" class="col-sm-3 col-form-label">Price</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="inputEmailAddress2" name ="priceItem" placeholder="Item Price" value="{{ $item->price }}">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputChoosePassword2" class="col-sm-3 col-form-label">Expired Time</label>
                                        <div class="col-sm-9">
                                            <input class="result form-control" type="text" id="date-time" name ="expiredTimeItem" placeholder="Expired Time" value="{{ Carbon::parse( $item->expired_time)->format('D M Y') }}">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Gambar Item</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input class="form-control" type="file" id="formFile" name="fotoItem" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <div class="form-group">
                                                <img class="backup_picture" id="image-prev" alt="Picture" width="200px"  src="{{ $item->image_url ? asset($item->image_url) : asset('images/null.jpg')}}">
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
                                        <label for="inputAddress4" class="col-sm-3 col-form-label"></label>
                                        <div class="col-sm-9">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="gridCheck4" required>
                                                <label class="form-check-label" for="gridCheck4">Ceklis jika sudah benar</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-3 col-form-label"></label>
                                        <div class="col-sm-9">
                                            <button id="button_submit" type="submit" class="btn btn-info px-4 me-3">Edit Item</button>
                                            <a href="{{ route('admin_item.index') }}"><button type="button" class="btn btn-info px-4">Back</button></a>
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
@endsection

@section('footer')
    @include('include.footer')
@endsection

@section('custom_script')
    @include('include.custom_script')
    <script src="{{asset('js/cropper.js')}}"></script>
    <script src="{{asset('js/jquery-cropper.js')}}"></script>
    <script>
		$('.datepicker').pickadate({
			selectMonths: true,
	        selectYears: true
		}),
		$('.timepicker').pickatime()
	</script>
	<script>
		$(function () {
			$('#date-time').bootstrapMaterialDatePicker({
				format: 'YYYY-MM-DD HH:mm'
			});
			$('#date').bootstrapMaterialDatePicker({
				time: false
			});
			$('#time').bootstrapMaterialDatePicker({
				date: false,
				format: 'HH:mm'
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