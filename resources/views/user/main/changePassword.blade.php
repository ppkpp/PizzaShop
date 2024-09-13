@extends('user.layout.master')
@section('title','Change_Password_Page')
@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">

                <div class="col-6 offset-3">

                    <div class="my-2 row">
                        <div class="col-4">
                            <a href="{{route('user#home')}}">
                                <button type="submit" class="btn btn-dark "><i class="fa-solid fa-backward mx-2"></i></i></button>
                            </a>
                        </div>
                        <div class="col-8">
                            @if (session('changePassword'))
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <strong>Alert!</strong>
                                    <div class="">
                                        {{session('changePassword')}}
                                    </div>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            @if (session('failPassword'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>Alert!</strong> {{session('failPassword')}}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Change Password</h3>
                            </div>
                            <hr>
                            <form action="{{route('submit#UserPassword')}}" method="post" novalidate="novalidate" enctype="multipart/form-data">
                                @csrf

                                <div class="row">

                                    <div class="col-6 offset-3">
                                        <div class="form-group">
                                            <label class="control-label mb-1">Old Password</label>
                                            <input id="cc-pament" name="oldPassword" type="password" value="" class="form-control @error('oldPassword') is-invalid @enderror"  aria-required="true" aria-invalid="false" >
                                            @error('oldPassword')
                                                <small class="text-danger">{{$message}}</small>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">New Password</label>
                                            <input id="cc-pament" name="newPassword" type="password" value="" class="form-control @error('newPassword') is-invalid @enderror"  aria-required="true" aria-invalid="false" >
                                            @error('newPassword')
                                                <small class="text-danger">{{$message}}</small>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label mb-1">Confirm Password</label>
                                            <input id="cc-pament" name="confirmPassword" type="password" value="" class="form-control @error('confirmPassword') is-invalid @enderror"  aria-required="true" aria-invalid="false" >
                                            @error('confirmPassword')
                                                <small class="text-danger">{{$message}}</small>
                                            @enderror
                                        </div>

                                        <div class="my-2 ">
                                            <button type="submit" class="btn btn-dark col-12"><i class="fa-solid fa-square-check mx-2"></i> Update Password</button>
                                        </div>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
