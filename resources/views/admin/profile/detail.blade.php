@extends('admin.layouts.app')
@section('title','Password_change Page')

@section('content')
<!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="row">
            <div class="col-4 offset-6">
                @if (session('updateSuccess'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{session('updateSuccess')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
            </div>
        </div>

        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="container-fluid">

                <div class="col-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Admin Profile</h3>
                            </div>
                            <hr>
                            <form action="{{route('edit#adminProfile')}}" method="get" novalidate="novalidate">
                                @csrf
                                <div class="row">
                                    <div class="col-3 offset-2 mt-5">
                                        @if (Auth::user()->image == null)
                                            @if (Auth::user()->gender == 'male')
                                                <img src="{{asset('image/male.jpg')}}" alt="">
                                            @else
                                            <img src="{{asset('image/default-female.jpg')}}" alt="">
                                            @endif
                                        @else
                                            <img src="{{asset('storage/'.Auth::user()->image)}}" />
                                        @endif
                                    </div>
                                    <div class="col-1 offset-1 my-3">
                                        <h4 class="my-3"><i class="fas fa-user mx-2"></i>  </h4>
                                        <h4 class="my-3"><i class="fas fa-comment-alt mx-2"> </i>  </h4>
                                        <h4 class="my-3"><i class="fas fa-phone mx-2"></i> </h4>
                                        <h4 class="my-3"><i class="fas fa-home mx-2"> </i></h4>
                                        <h4 class="my-3"><i class="fas fa-venus-mars mx-2"> </i></h4>
                                        <h4 class="my-3"><i class="fas fa-clock mx-2"> </i> </h4>
                                    </div>
                                    <div class="col-5 my-3">
                                        <h4 class="my-3">{{Auth::user()->name}}</h4>
                                        <h4 class="my-3">{{Auth::user()->email}}</h4>
                                        <h4 class="my-3">{{Auth::user()->phone}}</h4>
                                        <h4 class="my-3">{{Auth::user()->address}}</h4>
                                        <h4 class="my-3">{{Auth::user()->gender}}</h4>
                                        <h4 class="my-3">{{Auth::user()->created_at->format('d-m-y')}}</h4>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-3 offset-8 float-end">
                                        <button type="submit" class="btn btn-dark"><i class="fas fa-edit mx-2"></i>Edit Profile</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="col-10 offset-1">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h3 class="text-center title-2">Admin Profile</h3>
                </div>
                <hr>
                <form action="{{route('admin#passwordSubmit')}}" method="post" novalidate="novalidate">
                    <div class="row">
                        <div class="col-3 offset-2 bg-danger">
                            @if (Auth::user()->image == null)
                                <img src="{{asset('image/Default-welcomer.png')}}" alt="">

                            @else
                                <img src="{{asset('admin/images/icon/avatar-01.jpg')}}" />
                            @endif
                        </div>
                        <div class="col">
                            2
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div> --}}

@endsection
