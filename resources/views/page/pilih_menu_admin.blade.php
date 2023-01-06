@extends('layout.app')
@section('title','Pilih Menu Admin')

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
            <div class="card-body">
                <h5 class="card-title">Sihkan pilih menu yang mau dilihat</h5>
                <hr/>
                <div class="row row-cols-auto g-3">
                    <div class="col">
                        <a href="{{ route('admin_user.index') }}"><button type="button" class="btn btn-info px-4">Lihat Users</button></a>
                    </div>
                    <div class="col">
                        <a href="{{ route('admin_item.index') }}"><button type="button" class="btn btn-danger px-4">Lihat Items</button></a>
                    </div>
                    <div class="col">
                        <a href="{{ route('dashboard.index') }}"><button type="button" class="btn btn-primary px-4"><i class="fadeIn animated bx bx-arrow-back"></i>Back</button></a>
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
@endsection