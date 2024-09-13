@extends('admin.layouts.app')
@section('title','Product_List Page')

@section('content')
<!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">

                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="col-5 table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Pizza Menu List</h2>
                            </div>
                        </div>

                        <div class="col- table-data__tool-right">
                            <a href="{{route('product#create')}}">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="zmdi zmdi-plus"></i> Add Product
                                </button>
                            </a>
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                CSV download
                            </button>
                        </div>

                    </div>

                    <div class="d-flex">
                        <div class="col-1 pt-2 shadow-sm">
                            <i class="fas fa-database"></i> - {{$count}}
                        </div>
                        <div class="col-5 text-center pt-2">
                            Searching for : <a class="text-danger">{{request('key')}}</a>
                        </div>
                        <div class="col-6 offset-2 px-5">
                            <form action="{{route('product#list')}}" class="form-coontrol input-lg">
                                @csrf
                                <div class="d-flex">
                                    <input type="text" name='key' class="text-muted" placeholder="Searching for..." value="{{ request('key') }}">
                                    <button type="submit" class="btn btn-dark text-white">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>


                    {{-- deleted product message --}}
                    @if (session('deleteSuccess'))
                        <div class="row py-3 px-4">
                            <div class="col-6"></div>
                            <div class="alert alert-warning alert-dismissible fade show col-6" role="alert">
                                <strong class="me-2">Alert! </strong>{{session('deleteSuccess')}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    @endif

                    {{-- password change success --}}
                    {{-- @if (session('changeSuccess'))
                        <div class="row py-3 px-4">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Alert!</strong> {{session('changeSuccess')}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    @endif --}}

                    @if (count($menu) != 0)
                    <div class="table-responsive table-responsive-data2 text-center">
                        <table class="table table-data2">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                    <th>View</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="tr-shadow">
                                    @foreach ($menu as $m)

                                    <td class="col-2"><img src="{{asset('storage/'. $m->image)}}" alt="" class="img-thumbnail shadow-sm"></td>
                                    <td class="col-3">{{ $m ->name}}</td>
                                    <td class="col-2">{{ $m ->category_name}}</td>
                                    <td class="col-2">{{ $m ->price}}</td>
                                    <td class="col-1 ">{{ $m ->view_count}}</td>
                                    <td class="col-2">
                                        <div class="table-data-feature">
                                            <a href="{{route('view#Products',$m->id)}}">
                                                <button class="item mx-2" data-toggle="tooltip" data-placement="top" title="View">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </a>
                                            <a href="{{route('edit#Product',$m->id)}}">
                                                <button class="item mx-2" data-toggle="tooltip" data-placement="top" title="Edit">
                                                    <i class="zmdi zmdi-edit"></i>
                                                </button>
                                            </a>
                                            <a href="{{route('delete#product',$m->id)}}">
                                                <button class="item mx-2" data-toggle="tooltip" data-placement="top" title="Delete">
                                                    <i class="zmdi zmdi-delete"></i>
                                                </button>
                                            </a>
                                        </div>
                                    </td>
                                    </tr>
                                    @endforeach


                            </tbody>
                        </table>
                    </div>
                    @else
                        <div class="mt-5">
                            <h3 class="text-center">There is no product here.</h3>
                        </div>
                    @endif
                    <!-- END DATA TABLE -->

                    {{-- pagination box --}}
                    <div class="">
                        {{$menu->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
