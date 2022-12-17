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

            <div id="container-shop" class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-4 row-cols-xxl-5 product-grid">
                x
                    <div id="cart_item_{{ $item->id }}" data-id="{{ $item->id }}" class="col card_item"> <!-- ada 2 cara, data-id ato id -->
                        <div class="card">
                            <img src="assets/images/products/01.png" class="card-img-top" alt="...">
                            <div class="">
                                <div class="position-absolute top-0 end-0 m-3 product-discount"><span class="">-10%</span></div>
                            </div>
                            <div class="card-body">
                                <h6 class="card-title cursor-pointer">{{ $item->name }}</h6>
                                <div class="clearfix">
                                    <p class="mb-0 float-start"><strong>134</strong> Sales</p>
                                    <p class="mb-0 float-end fw-bold"><span class="me-2 text-decoration-line-through text-secondary">$350</span><span>$240</span></p>
                                </div>
                                <div class="d-flex align-items-center mt-3 fs-6">
                                <div class="cursor-pointer">
                                    <i class='bx bxs-star text-warning'></i>
                                    <i class='bx bxs-star text-warning'></i>
                                    <i class='bx bxs-star text-warning'></i>
                                    <i class='bx bxs-star text-warning'></i>
                                    <i class='bx bxs-star text-secondary'></i>
                                </div>	
                                <p class="mb-0 ms-auto">4.2(182)</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('footer')
    @include('include.footer')
    
    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasExampleLabel">Cart</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div id="cart" class="offcanvas-body">
        </div>
    </div>
@endsection

@section('custom_script')
    @include('include.custom_script')
    <script>
        const items = JSON.parse(`{!! json_encode($items) !!}`);
        const selectedItems = [];

        $( ".card_item" ).click(function() {
            // alert($(this).attr("id").split("cart_item_").join("")); => ngambil ID pada line 54
            const selectedId = $(this).data("id"); // ngambil data-id pada line 54
            const selectedIndex = items["data"].findIndex(function(data, i){
                return data.id === selectedId
            });
            const selectedData = items["data"][selectedIndex];

            if ($("#cart").children(`#cart_${selectedId}`)[0]) {
                let currentValue = parseInt($(`#cart_qty_${selectedId}`).html());
                $(`#cart_qty_${selectedId}`).html(currentValue+1);
                const indexSelectedItems = selectedItems.findIndex(function(data, i){
                    return data.id === selectedId
                });
                selectedItems[indexSelectedItems].qty = selectedItems[indexSelectedItems].qty + 1;
            } else {
                $("#cart").append(`
                    <div id="cart_${selectedId}" class="col">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-title cursor-pointer">${selectedData.name}</h6>
                                <div class="clearfix">
                                    <p class="mb-0 float-start"><strong>Jumlah : <button class="btn btn-primary btn-sm rounded-pill">-</button> <span id="cart_qty_${selectedId}">1</span></strong></p>
                                    <p class="mb-0 float-end fw-bold">$240</p>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `)
                selectedItems.push({
                    "id":selectedId,
                    "qty": 1
                });
            }
            console.log(selectedItems);

            var canvas = document.getElementById('offcanvasExample')
            var bsOffcanvas = new bootstrap.Offcanvas(canvas)
            bsOffcanvas.show();
        });
    </script>
@endsection