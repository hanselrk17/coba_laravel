@extends('layout.app')
@section('title','Beli Item')

@section('meta')
    @include('include.meta')
    <link href="{{asset('css/cropper.css')}}" rel="stylesheet">
    <style>
        #image-prev:hover{
            cursor: pointer;
        }
        .float{
            position:fixed;
            bottom:40px;
            right:40px;
            text-align:center;
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
                <div class="breadcrumb-title pe-3">User</div>
                    <div class="ps-3">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 p-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}"><i class="bx bx-home-alt"></i></a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">User</li>
                                <li class="breadcrumb-item active" aria-current="page">Beli Item</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="ms-auto">
                        <a href="{{ route('dashboard.index') }}"><button type="button" class="btn btn-danger me-3"><i class="bx bx-home-circle"></i> Back to Home</button></a>
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary">Settings</button>
                            <button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown"><span class="visually-hidden">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end"><a class="dropdown-item" href="javascript:;">Action</a>
                                <a class="dropdown-item" href="javascript:;">Another action</a>
                                <a class="dropdown-item" href="javascript:;">Something else here</a>
                                <div class="dropdown-divider"></div><a class="dropdown-item" href="javascript:;">Separated link</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="container-shop" class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-4 row-cols-xxl-5 product-grid">
                    @foreach ($items as $item)
                        <div id="cart_item_{{ $item->id }}" data-id="{{ $item->id }}" class="col card_item cursor-pointer"> <!-- ada 2 cara, data-id ato id -->
                            <div class="card">
                                @if($item->image_url == null)
                                    <img src="{{asset('/')}}images/null.jpg" class="card-img-top" alt="...">
                                @else
                                    <img src="{{ asset($item->image_url) }}" class="card-img-top" alt="...">
                                @endif
                                <div class="card-body">
                                    <h6 class="card-title mb-3">{{ $item->name }}</h6>
                                    <div class="clearfix">
                                        <p class="mb-0 float-start">harga per 1 kilogram</p>
                                        <p class="mb-0 float-end fw-bold">Rp.{{ $item->price }}</p>
                                    </div>
                                    <p class="mb-0 mt-2 float-start">ayo dibeli harga murah</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <button id="cart-button" class="float fadeIn animated bx bx-cart btn-lg btn-danger" type="button"></button>
@endsection

@section('footer')
    @include('include.footer')
    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasExampleLabel">List Belanja (Cart)</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div id="cart" class="offcanvas-body" style="overflow-y: scroll;">
        </div>
        <div class="m-auto mt-2">
            <h5><b>Total Harga: <span id='total-harga'></span></b></h5>
        </div>
        <div class="m-auto mb-2">
            <button id="submit-cart" type="button" class="btn-lg btn-primary">Submit</button>
            <button type="button" id="remove-all" class="btn-lg btn-danger" onclick="removeAllCartFunction()">Remove All</button>
        </div>
    </div>
@endsection

@section('custom_script')
    @include('include.custom_script')
    <script src="{{asset('js/sweetalert2@11.js')}}"></script>
    <script>
        const items = JSON.parse(`{!! json_encode($items) !!}`);
        let selectedItems = [];

        function removeAllCartFunction() {
            $("#cart").html(``);
            selectedItems = [];
        }

        function removeItem(selectedId){
            const indexSelectedItems = selectedItems.findIndex(function(data, i){
                return data.id === selectedId
            });

            //remove cart
            selectedItems.splice(indexSelectedItems, 1);
            $(`#cart_${selectedId}`).remove();
        }

        function addItem(selectedId, adjustQty){
            // alert($(this).attr("id").split("cart_item_").join("")); => ngambil ID pada line 58
            const selectedIndex = items["data"].findIndex(function(data, i){
                return data.id === selectedId
            });
            const selectedData = items["data"][selectedIndex];

            if ($("#cart").children(`#cart_${selectedId}`)[0]) {
                const indexSelectedItems = selectedItems.findIndex(function(data, i){
                    return data.id === selectedId
                });

                if (selectedItems[indexSelectedItems].qty == 1) {
                    //remove cart
                    removeItem(selectedId);
                    return 
                }
                
                selectedItems[indexSelectedItems].qty = selectedItems[indexSelectedItems].qty + adjustQty;
                $(`#cart_qty_${selectedId}`).html(selectedItems[indexSelectedItems].qty);
                $(`#cart_price_${selectedId}`).html(`Rp. ${selectedItems[indexSelectedItems].qty*selectedData.price}`);
            } else {
                $("#cart").append(`
                    <div id="cart_${selectedId}" class="col">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-title cursor-pointer">${selectedData.name}</h6>
                                <div class="clearfix">
                                    <p class="mb-0 float-start">
                                        <strong>Jumlah : 
                                            <button class="btn btn-primary btn-sm" onclick="addItem(${selectedId}, +1)">+</button>
                                            <button class="btn btn-danger btn-sm" onclick="addItem(${selectedId}, -1)">-</button>
                                            <button class="btn btn-danger btn-sm fadeIn animated bx bx-trash" onclick="removeItem(${selectedId})"></button>
                                            <span id="cart_qty_${selectedId}">${adjustQty}</span>
                                        </strong>
                                    </p>
                                    <p id="cart_price_${selectedId}" class="mb-0 float-end fw-bold price">Rp. ${adjustQty*selectedData.price}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                `)
                
                $("#total-harga").append(`
                
                `)
                selectedItems.push({
                    "id": selectedId,
                    "qty": adjustQty,
                    "total_price": adjustQty*selectedData.price
                });
            }
        }

        $( ".card_item" ).click(function() {
            const selectedId = $(this).data("id");
            Swal.fire({
                title: 'Masukkan Jumlah Makanan',
                input: 'number',
                inputValue: '1',
                showCancelButton: true,
                confirmButtonText: 'Tambah ke Keranjang',
                showLoaderOnConfirm: true,
                preConfirm: (value) => { // value -> inputan user
                    value = parseInt(value);
                    if (value <= 0){
                        Swal.showValidationMessage(
                            `jumlah tidak boleh kurang dari 0`
                        )
                    } else if (isNaN(value)) { // isNan -> is not a number
                        Swal.showValidationMessage(
                            `tidak boleh input selain angka`
                        )
                    }
                },
                allowOutsideClick: () => !Swal.isLoading()
                }).then((result) => {
                if (result.isConfirmed) {
                    addItem(selectedId, parseInt(result.value));
                }
            })
        });

        $("#cart-button").click(function(){
            var canvas = document.getElementById('offcanvasExample')
            var bsOffcanvas = new bootstrap.Offcanvas(canvas)
            bsOffcanvas.show();
        });

        $("#submit-cart").click(function() {
            Swal.fire({
            title: 'Checkout Cart',
            text: "Apakah Cart Sudah Benar?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Lanjut ke Pembayaran!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                    )
                }
            })
        });
    </script>
@endsection