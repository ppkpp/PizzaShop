@extends('admin.layouts.app')
@section('title','Category_List Page')

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
                                <h2 class="title-1">Category List</h2>
                            </div>
                        </div>

                        <div class="col- table-data__tool-right">
                            <a href="{{route('category#createPage')}}">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="zmdi zmdi-plus"></i>add item
                                </button>
                            </a>
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                CSV download
                            </button>
                        </div>

                    </div>

                    <div class="d-flex">
                        <div class="col-1 pt-2 shadow-sm">
                            <i class="fas fa-database"></i> - {{$categories->total()}}
                        </div>
                        <div class="col-5 text-center pt-2">
                            Searching for : <a class="text-danger">{{request('key')}}</a>
                        </div>
                        <div class="col-6 offset-2 px-5">
                            <form action="{{route('category#list')}}" class="form-coontrol input-lg">
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



                    {{-- delete message --}}
                    @if (session('deleteSuccess'))
                        <div class="row py-3 px-4">
                            <div class="col-6"></div>
                            <div class="alert alert-warning alert-dismissible fade show col-6" role="alert">
                                <strong>Delete Alert!</strong> A Category is deleted!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    @endif

                    {{-- created message --}}
                    @if (session('createSuccess'))
                        <div class="row py-3 px-4">
                            <div class="col-6"></div>
                            <div class="alert alert-success alert-dismissible fade show col-6" role="alert">
                                <strong>Good!</strong>{{session('createSuccess')}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    @endif

                    {{-- password change success --}}
                    @if (session('changeSuccess'))
                        <div class="row py-3 px-4">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Alert!</strong> {{session('changeSuccess')}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    @endif

                    @if (count($categories) != 0)
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Category Name</th>
                                    <th>Created Date</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="tr-shadow">
                                    @foreach ($categories as $category)
                                    <td>{{ $category -> id}}</td>
                                    <td>
                                        {{ $category -> name}}
                                    </td>
                                    <td>{{ $category -> created_at->format('j-F-Y')}}</td>
                                    <td>
                                        <div class="table-data-feature">
                                            <a href="{{route('edit#category',$category->id)}}">
                                                <button class="item mx-2" data-toggle="tooltip" data-placement="top" title="Edit">
                                                    <i class="zmdi zmdi-edit"></i>
                                                </button>
                                            </a>
                                            <a href="{{route('delete#category',$category->id)}}">
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
                            <h3 class="text-center">There is no category data here.</h3>
                        </div>
                    @endif
                    <!-- END DATA TABLE -->

                    {{-- pagination box --}}
                    {{$categories->links()}}
                </div>
            </div>
        </div>
    </div>

@endsection
