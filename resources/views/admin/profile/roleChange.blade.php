@extends('admin.layouts.app')
@section('title','Role_change Page')

@section('content')
<!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">

                <div class="col-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Change Role</h3>
                            </div>
                            <hr>
                            <form action="{{route('submit#role',$data->id)}}" method="post" novalidate="novalidate" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-3 offset-1 mt-2">

                                        <a href="#">
                                            @if ($data->image == null)
                                                @if ($data->gender == 'male')
                                                    <img src="{{asset('image/male.jpg')}}" alt="">
                                                @else
                                                <img src="{{asset('image/default-female.jpg')}}" alt="">
                                                @endif
                                            @else
                                                <img src="{{asset('storage/'.$data->image)}}" />
                                            @endif
                                        </a>
                                        <a href="{{route('submit#role',$data->id)}}">
                                            <div class="my-3">
                                                <button type="submit" class="btn btn-dark ">Update<i class="fa-solid fa-angles-right mx-1"></i></button>
                                            </div>
                                        </a>
                                    </div>

                                    <div class="col-6 offset-1">
                                        <div class="form-group">
                                            <label class="control-label mb-1">Name</label>
                                            <input id="cc-pament" name="name" type="text" value="{{old('name',$data->name)}}" class="form-control "  aria-required="true" aria-invalid="false" disabled>

                                        </div>

                                        <div class="form-group">
                                            <label class="control-label mb-1">Role</label>
                                            {{-- <input id="cc-pament" name="role" type="text" value="{{old('role',$data->role)}}" class="form-control  aria-required="true" aria-invalid="false" > --}}
                                            <div class="">
                                                <select name="role" id="" class="mt-2 col-12">
                                                    <option value="user" @if ($data->role == 'user')selected @endif>User</option>
                                                    <option value="admin" @if ($data->role == 'admin')selected @endif>Admin</option>
                                                </select>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="control-label">Email</label>
                                            <input id="cc-pament" name="email" type="email" value="{{old('email',$data->email)}}"" class="form-control"  aria-required="true" aria-invalid="false" disabled>

                                        </div>

                                        <div class="form-group">
                                            <label class="control-label mb-1">Phone</label>
                                            <input id="cc-pament" name="phone" type="integer" value="{{old('phone',$data->phone)}}" class="form-control "  aria-required="true" aria-invalid="false" disabled>
                                        </div>

                                        {{-- <div class="form-group">
                                            <label class="control-label mb-1">Gender</label>
                                            <select name="gender" class="form-control @error('role') is-invalid @enderror">
                                                <option value="male" @if (Auth::user()->gender == 'male') selected @endif>Male</option>
                                                <option value="female" @if (Auth::user()->gender == 'female')selected @endif>Female</option>
                                            </select>
                                            @error('gender')
                                                <small class="text-danger">{{$message}}</small>
                                            @enderror
                                        </div> --}}

                                        <div class="form-group">
                                            <label class="control-label mb-1">Address</label>
                                            <input id="cc-pament" name="address" type="integer" value="{{old('address',$data->address)}}" class="form-control "  aria-required="true" aria-invalid="false" disabled>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label mb-1">Joined Date</label>
                                            <input id="cc-pament" name="created_at" type="integer" value="{{old('created_at',$data->created_at)}}" class="form-control "  aria-required="true" aria-invalid="false" disabled>
                                        </div>


                                        {{-- <div class="form-group">
                                            <label class="control-label mb-1">Address</label>
                                            <textarea name="address" class="form-control @error('address') is-invalid @enderror" id="" cols="30" rows="10" >{{old('address',Auth::user()->address)}}</textarea>
                                            @error('address')
                                                <small class="text-danger">{{$message}}</small>
                                            @enderror
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
