@extends('admin.layouts.app')
@section('title','Password_change Page')

@section('content')
<!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="container-fluid">

                    <div class="col-lg-6 offset-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title">
                                    <h3 class="text-center title-2">Change Password</h3>
                                </div>
                                <hr>
                                <form action="{{route('admin#passwordSubmit')}}" method="post" novalidate="novalidate">
                                    @csrf
                                    @if (session('wrongOldPassword'))
                                        <div class="row justify-content-center py-3 px-4">
                                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                <strong>{{ session('wrongOldPassword') }}</strong>
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="form-group">
                                        <label class="control-label mb-1">Old Password</label>
                                        <input id="cc-pament" name="oldPassword" type="password" class="form-control @if (session('wrongOldPassword')) is-invalid @endif @error('oldPassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter the old password...">
                                        @error('oldPassword')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                        {{-- @if (session('wrongOldPassword'))
                                            <small class="text-danger">{{ session('wrongOldPassword') }}</small>
                                        @endif --}}
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label mb-1">New Password</label>
                                        <input id="cc-pament" name="newPassword" type="password" class="form-control @error('newPassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter the new password...">
                                        @error('newPassword')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror

                                    </div>

                                    <div class="form-group">
                                        <label class="control-label mb-1">Confirm Password</label>
                                        <input id="cc-pament" name="confirmPassword" type="password" class="form-control @error('confirmPassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Confirm the new password...">
                                        @error('confirmPassword')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div>
                                        <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                            <i class="fa-solid fa-key"></i>
                                            <span id="payment-button-amount">Submit</span>
                                        </button>
                                        {{-- <a href="{{route('admin#passwordSubmit')}}">
                                            <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                                <i class="fa-solid fa-key"></i>
                                                <span id="payment-button-amount">Submit</span>
                                            </button>
                                        </a>
                                        <a href="{{route('admin#cancelChange')}}">
                                            <button type="submit" class="btn btn-lg btn-info btn-block">
                                                <span id="payment-button-amount">Cancel</span>
                                                <i class="fa-solid fa-square-xmark"></i>
                                            </button>
                                        </a> --}}
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
