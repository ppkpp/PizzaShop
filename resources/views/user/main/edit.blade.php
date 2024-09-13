@extends('user.layout.master')
@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">

                <div class="col-8 offset-2">
                    <div class="my-2">
                        <a href="{{route('user#home')}}">
                            <button type="submit" class="btn btn-dark "><i class="fa-solid fa-backward mx-2"></i></i></button>
                        </a>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Edit Profile</h3>
                            </div>
                            <hr>
                            <form action="{{route('update#userProfile',Auth::user()->id)}}" method="post" novalidate="novalidate" enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <div class="col-4 offset-1 mt-2">

                                        <a href="#">
                                            @if (Auth::user()->image == null)
                                                @if (Auth::user()->gender == 'male')
                                                    <img src="{{asset('image/male.jpg')}}" alt="" class="w-100">
                                                @else
                                                <img src="{{asset('image/default-female.jpg')}}" alt="" class="w-100">
                                                @endif
                                            @else
                                                <img src="{{asset('storage/'.Auth::user()->image)}}" class="w-100" />
                                            @endif
                                        </a>

                                            <div class="my-3 font-sm">
                                                <input type="file" name="image" id="" class="@error('image') is-invalid @enderror">
                                                @error('image')
                                                    <small class="text-danger">{{$message}}</small>
                                                @enderror
                                            </div>

                                            <div class="">
                                                <button type="submit" class="btn btn-dark ">Update<i class="fa-solid fa-angles-right mx-1"></i></button>
                                            </div>



                                    </div>

                                    <div class="col-6 offset-1">
                                        <div class="form-group">
                                            <label class="control-label mb-1">Name</label>
                                            <input id="cc-pament" name="name" type="text" value="{{old('name',Auth::user()->name)}}" class="form-control @error('name') is-invalid @enderror"  aria-required="true" aria-invalid="false" >
                                            @error('name')
                                                <small class="text-danger">{{$message}}</small>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">Email</label>
                                            <input id="cc-pament" name="email" type="email" value="{{old('email',Auth::user()->email)}}"" class="form-control @error('email') is-invalid @enderror"  aria-required="true" aria-invalid="false" >
                                            @error('email')
                                                <small class="text-danger">{{$message}}</small>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label mb-1">Phone</label>
                                            <input id="cc-pament" name="phone" type="integer" value="{{old('phone',Auth::user()->phone)}}" class="form-control @error('phone') is-invalid @enderror"  aria-required="true" aria-invalid="false" >
                                            @error('phone')
                                                <small class="text-danger">{{$message}}</small>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label mb-1">Gender</label>
                                            <select name="gender" class="form-control @error('role') is-invalid @enderror">
                                                <option value="male" @if (Auth::user()->gender == 'male') selected @endif>Male</option>
                                                <option value="female" @if (Auth::user()->gender == 'female')selected @endif>Female</option>
                                            </select>
                                            @error('gender')
                                                <small class="text-danger">{{$message}}</small>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label mb-1">Address</label>
                                            <textarea name="address" class="form-control @error('address') is-invalid @enderror" id="" cols="30" rows="10" >{{old('address',Auth::user()->address)}}</textarea>
                                            @error('address')
                                                <small class="text-danger">{{$message}}</small>
                                            @enderror
                                        </div>

                                        {{-- <div class="form-group">
                                            <label class="control-label mb-1">Role</label>
                                            <input id="cc-pament" name="role" type="text" value="{{old('role',Auth::user()->role)}}" class="form-control  aria-required="true" aria-invalid="false" disabled>

                                        </div> --}}

                                        {{-- <div class="row">
                                            <div class="col-6">
                                                <a href="{{route('category#list')}}">
                                                    <button type="submit" class="btn btn-dark">Cancel <i class="fa-solid fa-xmark mx-1"></i></button>
                                                </a>
                                            </div>
                                            <div class="col-6">
                                                <button type="submit" class="btn btn-dark ">Update<i class="fa-solid fa-angles-right mx-1"></i></button>
                                            </div>
                                        </div> --}}
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
