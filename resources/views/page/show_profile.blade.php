@extends('layout.app')
@section('title','Profile')

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
                                            <a href="{{route('edit_profile.userController',$user->id)}}" class="btn btn-primary">Edit Profile</a>
                                            <a href="{{route('edit_profile_password.userController',$user->id)}}" class="btn btn-primary">Edit Profile Password</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Full Name:</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" class="form-control" name="namaUser" value="{{ $user->name }}" readonly />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Email:</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" class="form-control" name="emailUser" value="{{ $user->email }}" readonly />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Foto Profile:</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <img src="{{ $user->image_url ? asset($user->image_url) : Avatar::create($user->name)->toBase64()}}" alt="Admin" width="250" height="250">
                                        </div>
                                    </div>
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
@endsection