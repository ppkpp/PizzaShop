@extends('admin.layouts.app')
@section('title','Category_List Page')

@section('content')
<!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-8">
                        </div>
                        <div class="col-4 pl-2">
                            <a href="{{route('category#list')}}"><button class="btn bg-dark text-white my-3">List</button></a>
                        </div>
                    </div>
                    <div class="col-lg-6 offset-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title">
                                    <h3 class="text-center title-2">Editing Category</h3>
                                </div>
                                <hr>
                                <form action="{{route('update#category')}}" method="post" novalidate="novalidate">
                                    @csrf
                                    <div class="form-group">
                                        <label class="control-label mb-1">Name</label>
                                        <input type="hidden" name="categoryId" value="{{$data->id}}">
                                        <input id="cc-pament" name="categoryName" type="text" value="{{old('categoryName',$data->name)}}" class="form-control @error('categoryName') is-invalid @enderror" aria-required="true" aria-invalid="false">
                                        @error('categoryName')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div>
                                        <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                            <span id="payment-button-amount">Update</span>
                                            <i class="fas fa-arrow-alt-circle-right"></i>
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
