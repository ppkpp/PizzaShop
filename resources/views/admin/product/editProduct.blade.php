@extends('admin.layouts.app')
@section('title','Product_change Page')

@section('content')
<!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">

                <div class="col-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Product Details</h3>
                            </div>
                            <hr>
                            <form action="{{route('submit#Product',$data->id)}}" method="post" novalidate="novalidate" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-4 offset-1 mt-5">

                                        <img src="{{asset('storage/'.$data->image)}}"/>

                                        <div class="my-3 font-sm">
                                            <input type="file" value="{{old('productImage',$data->image)}}" name="productImage" id="" class="@error('productImage') is-invalid @enderror ">
                                            @error('productImage')
                                                <small class="text-danger">{{$message}}</small>
                                            @enderror
                                        </div>

                                        <div class="">
                                            <button type="submit" class="btn btn-dark ">Update<i class="fas fa-arrow-alt-circle-right"></i></button>
                                        </div>

                                    </div>
                                    <input type="hidden" name="productId" value="{{$data->id}}">
                                    <div class="col-6 ">

                                        <div class="form-group">
                                            <label class="control-label mb-1">Product Name</label>
                                            <input id="cc-pament" name="productName" value="{{old('productName',$data->name)}}" type="text" value="" class="form-control @error('productName') is-invalid @enderror"  aria-required="true" aria-invalid="false" >
                                            @error('productName')
                                                <small class="text-danger">{{$message}}</small>
                                            @enderror
                                        </div>

                                        {{-- <div class="form-group">
                                            <label class="control-label">Email</label>
                                            <input id="cc-pament" name="email" type="email" value="" class="form-control @error('email') is-invalid @enderror"  aria-required="true" aria-invalid="false" >
                                            @error('email')
                                                <small class="text-danger">{{$message}}</small>
                                            @enderror
                                        </div> --}}

                                        <div class="form-group">

                                            <div class="form-floating">
                                                <div class="">
                                                    <label class="control-label mb-1">Category</label>
                                                </div>
                                                <select class="form-select col-12" id="floatingSelect" name="productCategory" aria-label="Floating label select example">
                                                    <option value="">Choose Category....</option>
                                                    @foreach ( $category as $c )
                                                        <option value="{{$c->id}}"  @if ($data->category_id == $c->id)  selected @endif >{{$c->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @error('productCategory')
                                                <small class="text-danger">{{$message}}</small>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label mb-1">Waiting Time</label>
                                            <input id="cc-pament" name="productWaitingTime" type="text" value="{{old('productWaitingTime',$data->waiting_time)}}" class="form-control @error('productWaitingTime') is-invalid @enderror"  aria-required="true" aria-invalid="false" >
                                            @error('productWaitingTime')
                                                <small class="text-danger">{{$message}}</small>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label mb-1">Description</label>
                                            <textarea name="productDescription" class="form-control @error('productDescription') is-invalid @enderror" id="" cols="30" rows="7" >{{old('productDescription',$data->description)}}</textarea>
                                            @error('productDescription')
                                                <small class="text-danger">{{$message}}</small>
                                            @enderror
                                        </div>


                                        <div class="form-group">
                                            <label class="control-label mb-1">Price</label>
                                            <input id="cc-pament" name="productPrice" type="integer" value="{{old('productPrice',$data->price)}}" class="form-control @error('productPrice') is-invalid @enderror"  aria-required="true" aria-invalid="false" >
                                            @error('productPrice')
                                                <small class="text-danger">{{$message}}</small>
                                            @enderror
                                        </div>


                                        <div class="form-group">
                                            <label class="control-label mb-1">View</label>
                                            <input id="cc-pament" name="productView" type="integer" value="{{old('productView',$data->view_count)}}" class="form-control @error('productPrice') is-invalid @enderror"  aria-required="true" aria-invalid="false" disabled>
                                            @error('productView')
                                                <small class="text-danger">{{$message}}</small>
                                            @enderror
                                        </div>


                                        <div class="form-group">
                                            <label class="control-label mb-1">Price</label>
                                            <input id="cc-pament" name="productCreatedAt" value="{{old('productCreatedAt',$data->created_at)}}" class="form-control @error('productCreatedAt') is-invalid @enderror"  aria-required="true" aria-invalid="false" disabled>
                                            @error('productCreatedAt')
                                                <small class="text-danger">{{$message}}</small>
                                            @enderror
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
