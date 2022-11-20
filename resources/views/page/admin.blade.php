@extends('layout.app')
@section('title','Admin')

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
            <div class="card">
                <div class="card-body">
                    <div class="d-lg-flex align-items-center mb-4 gap-3">
                        <div class="position-relative">
                            <input type="text" class="form-control ps-5 radius-30" placeholder="Search Order"> <span class="position-absolute top-50 product-show translate-middle-y"><i class="bx bx-search"></i></span>
                        </div>
                    <div class="ms-auto"><a href="{{ route('tambah_item_web.itemController') }}" class="btn btn-primary radius-30 mt-2 mt-lg-0"><i class="bx bxs-plus-square"></i>Add New Item</a></div>
                    </div>
                    <div class="table-responsive">
                        <table class="table mb-0" id="table_item">
                            <thead class="table-light">
                                <tr>
                                    <th>Name</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Expired Time</th>
                                    <th>Gambar Item</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
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
        $('#table_item').dataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('item.datatable') }}",
        columns: [
            {data: 'name', name: 'name'},
            {data: 'qty', name: 'qty'},
            {data: 'price', name: 'price'},
            {data: 'expired_time', name: 'expired_time',render:function(data, type, row){
                return moment().format("MMMM Do YYYY");  
            }},
            {data: 'image_url', name: 'image_url',render:function(data, type, row){
                if (data == "") {
                    return `<img src="{{asset('/')}}images/null.jfif">`
                }
                return `<img src="{{asset('/')}}${data}">`
            }},
            {orderable:false, searchable:false, data: 'action', name: 'action',render: function(data,type,row){
                return `<a class="bx bxs-edit btn btn-edit" href="{{route('edit_item.itemController','')}}/${row.id}">edit</a>
                        <a class="bx bxs-trash btn btn-delete" href="{{route('delete_item.itemController','')}}/${row.id}">delete</a>`;
            }},
        ]
        })
    </script>
@endsection