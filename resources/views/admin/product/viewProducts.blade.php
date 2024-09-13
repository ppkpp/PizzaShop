@extends('admin.layouts.app')
@section('title','Product Details Page')

@section('content')
<!-- MAIN CONTENT-->
    <div class="main-content">
        {{-- <div class="row">
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
        </div> --}}

        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="container-fluid">
                <div class="col-10 offset-1">
                    <div class="">
                        <a href="{{route('product#list')}}"><button class="btn my-3"><i class="fas fa-backward"></i></button></a>
                    </div>
                    <div class="card">

                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Product Details</h3>
                            </div>
                            <hr>
                            <form action="" method="get" novalidate="novalidate">
                                @csrf
                                <div class="row">
                                    <div class="col-5 mt-2">
                                        <img src="{{asset('storage/'. $data->image)}}" alt="" class="img-thumbnail shadow-sm">
                                    </div>
                                    <div class="col-7 my-3">
                                        <button class="btn btn-dark text-white p-1"><i class="fas fa-utensils mr-2"></i>{{$data->name}}</button>
                                        <div class="mt-2">
                                            <button class="btn btn-dark btn-sm"><i class="fas fa-dollar-sign mr-2"></i>{{$data->price}}</button>
                                            <button class="btn btn-dark btn-sm"><i class="far fa-clock mr-2"></i>{{$data->waiting_time}} mins</button>
                                            <button class="btn btn-dark btn-sm"><i class="fas fa-eye mr-2"></i>{{$data->view_count}}</button>
                                            <button class="btn btn-dark btn-sm"><i class="fab fa-codepen mr-2"></i>{{$data->category_id}}</button>
                                            <button class="btn btn-dark btn-sm"><i class="fas fa-hourglass-half mr-2"></i>{{$data->created_at->format('d-m-y')}}</button>
                                        </div>
                                        <div class="detail text-muted mt-2">
                                            <i class="fas fa-info mr-2"></i> Details
                                        </div>
                                        <div class="detail-content">
                                            {{$data->description}}
                                        </div>
                                    </div>
                                    {{-- <div class="col-5 my-3">
                                        <h4 class="my-3"></h4>
                                        <h4 class="my-3"></h4>
                                        <h4 class="my-3"></h4>
                                        <h4 class="my-3"></h4>
                                        <h4 class="my-3"></h4>
                                        <h4 class="my-3"></h4>
                                    </div> --}}
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
