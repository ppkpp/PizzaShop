@extends('layouts.master')

@section('title','Contact_page')


@section('content')

    <div class="contact-form">

        <form action="{{route('submit#description')}}" method="post">
            @csrf
            <div class="p-10">
                <div class="form-group">
                    <label>Name</label>
                    <input class="au-input au-input--full" type="text" name="name" placeholder="Name">
                </div>
                @error('name')
                    <small class="text-danger">{{$message}}</small>
                @enderror

                <div class="form-group">
                    <label>Email Address</label>
                    <input class="au-input au-input--full" type="email" name="email" placeholder="Email">
                </div>
                @error('email')
                    <small class="text-danger">{{$message}}</small>
                @enderror

                <div class="form-group">
                    <label>Phone</label>
                    <input class="au-input au-input--full" type="text" name="phone" placeholder="Phone">
                </div>
                @error('phone')
                    <small class="text-danger">{{$message}}</small>
                @enderror

                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" id="description" rows="8" style="width:450px" placeholder="Please write your suggestion here."></textarea>
                </div>
                @error('description')
                    <small class="text-danger">{{$message}}</small>
                @enderror

                <div class="col-10 offset-1 w-100 btn btn-primary btn-block">
                    <button type="submit" class="btn btn-primary btn-sm btn-block">Submit</button>
                </div>
            </div>
        </form>
        <div class="col-10 offset-1 w-100 btn btn-dark btn-block mt-2">
            <a href="{{route('user#home')}}" class="align-center ">
                <button class="btn btn-sm text-white"><i class="fas fa-backward mr-1"></i> back</button>
            </a>
        </div>
    </div>
    {{-- <div class="login-form">
        <form action="{{route('register')}}" method="post">
            @csrf
            @error('terms')
                <small class="text-danger">{{$message}}</small>
            @enderror

            <div class="form-group">
                <label>Username</label>
                <input class="au-input au-input--full" type="text" name="name" placeholder="Username">
            </div>
            @error('name')
                <small class="text-danger">{{$message}}</small>
            @enderror

            <div class="form-group">
                <label>Email Address</label>
                <input class="au-input au-input--full" type="email" name="email" placeholder="Email">
            </div>
            @error('email')
                <small class="text-danger">{{$message}}</small>
            @enderror

            <div class="form-group">
                <label>Phone Number</label>
                <input class="au-input au-input--full" type="integer" name="phone" placeholder="09xxxxxxxxx">
            </div>
            @error('phone')
                <small class="text-danger">{{$message}}</small>
            @enderror

            <div class="form-group">
                <label>Gender</label>
                <select name="gender" class="form-control" id="">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>

            <div class="form-group">
                <label>Address</label>
                <input class="au-input au-input--full" type="text" name="address" placeholder="Address">
            </div>
            @error('address')
                <small class="text-danger">{{$message}}</small>
            @enderror

            <div class="form-group">
                <label>Password</label>
                <input class="au-input au-input--full" type="password" name="password" placeholder="Password">
            </div>
            @error('password')
                <small class="text-danger">{{$message}}</small>
            @enderror

            <div class="form-group">
                <label>Password</label>
                <input class="au-input au-input--full" type="password" name="password_confirmation" placeholder="Confirm Password">
            </div>
            @error('password_confirmation')
                <small class="text-danger">{{$message}}</small>
            @enderror

            <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">register</button>

        </form>
        <div class="register-link">
            <p>
                Already have account?
                <a href="{{route('auth#loginPage')}}">Sign In</a>
            </p>
        </div>
    </div> --}}
@endsection
