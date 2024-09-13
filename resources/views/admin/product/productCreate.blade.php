@extends('admin.layouts.app')
@section('title','Product_List Page')

@section('content')
<!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="container-fluid">

                    <div class="col-lg-6 offset-3">
                        <div class="">
                            <a href="{{route('product#list')}}"><button class="btn my-3"><i class="fa-solid fa-backward"></i></button></a>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title">
                                    <h3 class="text-center title-2">Adding Product</h3>
                                </div>
                                <hr>
                                <form action="" method="post" novalidate="novalidate" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label class="control-label mb-1">Name</label>
                                        <input id="cc-pament" name="productName" type="text" value="{{old('productName')}}" class="form-control @error('productName') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Food or Drink Name...">
                                        @error('productName')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>



                                    <div class="form-group">
                                        <div class="my-3 font-sm">
                                            <input type="file" name="productImage" id="" class="@error('productImage') is-invalid @enderror">
                                            @error('productImage')
                                                <small class="text-danger">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label mb-1">Description</label>
                                        <textarea name="productDescription" type="text" id="" cols="30" rows="10" class="form-control @error('productDescription') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Detail about the food ....">{{old('productDescription')}}</textarea>
                                        @error('productDescription')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label mb-1">Price</label>
                                        <input id="cc-pament" name="productPrice" type="text" value="{{old('productPrice')}}" class="form-control @error('productPrice') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Price in kyats...">
                                        @error('productPrice')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <div class="">
                                            <label class="control-label mb-1">Category</label>
                                        </div>
                                        <div class="col-12">
                                            <select name="productCategory" class="col-12" id="">
                                                <Option value="">Choose Category...</Option>
                                                @foreach ( $category as $c )
                                                    <option value="{{$c->id}}">{{$c->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('productCategory')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label mb-1">View Count</label>
                                        <input id="cc-pament" name="productViewCount" type="text" value="{{old('productViewCount')}}" class="form-control @error('productViewCount') is-invalid @enderror" aria-required="true" aria-invalid="false">
                                        @error('productViewCount')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label mb-1">Waiting Time</label>
                                        <input id="cc-pament" name="productWaitingTime" type="text" value="{{old('productWaitingTime')}}" class="form-control @error('productWaitingTime') is-invalid @enderror" aria-required="true" aria-invalid="false">
                                        @error('productWaitingTime')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div>
                                        <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                            <span id="payment-button-amount"> Add Product </span>
                                            <span id="payment-button-sending" style="display:none;">Sending…</span>
                                            <i class="fa-solid fa-circle-right"></i>
                                        </button>
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
