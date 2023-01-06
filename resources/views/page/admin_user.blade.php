@extends('layout.app')
@section('title','Tabel User')

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
                            <li class="breadcrumb-item active" aria-current="page">Pilih Admin</li>
                            <li class="breadcrumb-item active" aria-current="page">Table User</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary">Settings</button>
                        <button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown">	<span class="visually-hidden">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end"><a class="dropdown-item" href="javascript:;">Action</a>
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
                        <div class="ms-auto">
                            <a href="{{ route('admin.index') }}" class="btn btn-primary radius-30 mt-2 mt-lg-0"><i class="fadeIn animated bx bx-arrow-back"></i>Back</a>
                            <a href="{{ route('tambah_user_index.adminController') }}" class="btn btn-primary radius-30 mt-2 mt-lg-0"><i class="bx bxs-plus-square"></i>Add New User</a>
                            <a href="{{ route('tambah_admin_index.adminController') }}" class="btn btn-primary radius-30 mt-2 mt-lg-0"><i class="bx bxs-plus-square"></i>Add New Admin User</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table mb-0" id="table_user">
                            <thead class="table-light">
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Image URL</th>
                                    <th>Role</th>
                                    <th>Created At</th>
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
        $('#table_user').dataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('user.datatable') }}",
            columns: [
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'image_url', name: 'image_url',render:function(data, type, row){
                    if (data == "") {
                        return `<img src="{{asset('/')}}images/null.jpg">`
                    }
                    return `<img src="{{asset('/')}}${data}">`
                }},
                {data: 'role', name: 'role',render:function(data, type, row){
                    if (data == "1") {
                        return `ADMIN`
                    }
                    return `USER`
                }},
                {data: 'created_at', name: 'created_at',render:function(data, type, row){
                    return moment(data).format("MMMM Do YYYY");  
                }},
                {orderable:false, searchable:false, data: 'action', name: 'action',render: function(data,type,row){
                    if (row.role == "2") {
                        return `<a class="bx bxs-trash btn btn-delete" href="{{route('delete_user.adminController','')}}/${row.id}">delete</a>`;
                    }
                    return `admin != didelete`
                }},
            ]
        })
    </script>
@endsection