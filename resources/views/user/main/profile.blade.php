@extends('user.layout.master')
@section('title','Profile_Page')
@section('content')
    <div class="main-content h-75">

        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="container-fluid">
                    <div class="col-8  offset-2">
                        <div class="row mb-2">
                            <div class="col-2">
                                <a href="{{route('user#home')}}">
                                    <button type="submit" class="btn btn-dark "><i class="fa-solid fa-backward mx-2"></i></i></button>
                                </a>
                            </div>
                            <div class="col-6 offset-4">
                                @if (session('updateSuccess'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong>Alert!</strong>
                                        {{session('updateSuccess')}}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="card">

                            <div class="card-body">
                                <div class="card-title">
                                    <h3 class="text-center title-2">Your Profile</h3>
                                </div>
                                <hr>
                                <form action="{{route('edit#Profile',Auth::user()->id)}}" method="get" novalidate="novalidate">
                                    @csrf
                                    <div class="row ">
                                        <div class="col-3 offset-1 mt-5">
                                            @if (Auth::user()->image == null)
                                                @if (Auth::user()->gender == 'male')
                                                    <img src="{{asset('image/male.jpg')}}" alt="" class="w-100">
                                                @else
                                                <img src="{{asset('image/default-female.jpg')}}" alt="" class="w-100">
                                                @endif
                                            @else
                                                <img src="{{asset('storage/'.Auth::user()->image)}}"  class="w-100"/>
                                            @endif
                                        </div>
                                        <div class="col-6 offset-1">
                                            <h4 class="my-3"><i class="fa-solid fa-user-pen mx-2"> </i> {{Auth::user()->name}} </h4>
                                            <h4 class="my-3"><i class="fa-solid fa-envelope-circle-check mx-2"> </i> {{Auth::user()->email}} </h4>
                                            <h4 class="my-3"><i class="fa-solid fa-phone-volume mx-3"> </i>{{Auth::user()->phone}} </h4>
                                            <h4 class="my-3"><i class="fa-solid fa-location-dot mx-3"> </i>{{Auth::user()->address}}</h4>
                                            <h4 class="my-3"><i class="fa-solid fa-venus-mars mx-2"> </i>{{Auth::user()->gender}}</h4>
                                            <h4 class="my-3"><i class="fa-solid fa-user-clock mx-2"> </i> {{Auth::user()->created_at}}</h4>
                                        </div>
                                        {{-- <div class="col-1 offset-1 my-3">
                                            <h4 class="my-3"><i class="fa-solid fa-user-pen mx-2"> </i>  </h4>
                                            <h4 class="my-3"><i class="fa-solid fa-envelope-circle-check mx-2"> </i>  </h4>
                                            <h4 class="my-3"><i class="fa-solid fa-phone-volume mx-2"> </i> </h4>
                                            <h4 class="my-3"><i class="fa-solid fa-location-dot mx-2"> </i></h4>
                                            <h4 class="my-3"><i class="fa-solid fa-venus-mars"> </i></h4>
                                            <h4 class="my-3"><i class="fa-solid fa-user-clock mx-2"> </i> </h4>
                                        </div>
                                        <div class="col-5 my-3">
                                            <h4 class="my-3">{{Auth::user()->name}}</h4>
                                            <h4 class="my-3">{{Auth::user()->email}}</h4>
                                            <h4 class="my-3">{{Auth::user()->phone}}</h4>
                                            <h4 class="my-3">{{Auth::user()->address}}</h4>
                                            <h4 class="my-3">{{Auth::user()->gender}}</h4>
                                            <h4 class="my-3">{{Auth::user()->created_at->format('d-m-y')}}</h4>
                                        </div> --}}
                                    </div>
                                    <div class="row">
                                        <div class="col-3 offset-8 float-end">
                                            <button type="submit" class="btn btn-dark"><i class="fa-solid fa-user-pen mx-2"></i>Edit Profile</button>
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
