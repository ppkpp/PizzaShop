@extends('admin.layouts.app')
@section('title','Admin_List Page')

@section('content')
{{-- <h5>This is admin List Page</h5> --}}
<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">

                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="col-5 table-data__tool-left">
                        <div class="overview-wrap">
                            <h2 class="title-1">Admin List</h2>
                        </div>
                    </div>

                    {{-- <div class="col- table-data__tool-right">
                        <a href="{{route('product#create')}}">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="zmdi zmdi-plus"></i> Add Product
                            </button>
                        </a>
                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                            CSV download
                        </button>
                    </div> --}}

                </div>

                <div class="d-flex">
                    <div class="col-1 pt-2 shadow-sm">
                        <i class="fas fa-database"></i> - {{$admin->total()}}
                    </div>
                    <div class="col-5 text-center pt-2">
                        Searching for : <a class="text-danger">{{request('key')}}</a>
                    </div>
                    <div class="col-6 offset-2 px-5">
                        <form action="{{route('admin#list')}}" class="form-coontrol input-lg">
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
                {{-- @if (session('deleteSuccess'))
                    <div class="row py-3 px-4">
                        <div class="col-6"></div>
                        <div class="alert alert-warning alert-dismissible fade show col-6" role="alert">
                            <strong class="me-2">Alert! </strong>{{session('deleteSuccess')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                @endif --}}

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


                <div class="table-responsive table-responsive-data2 text-center">
                    <table class="table table-data2">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Admin Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Address</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="tr-shadow">
                                @foreach ($admin as $m)

                                    <td class="col-2"><img @if ($m->image == null)
                                            @if ($m->gender == 'male')
                                                src="{{asset('image/male.jpg')}}"
                                            @else src="{{asset('image/default-female.jpg')}}"
                                            @endif
                                        @else src="{{asset('storage/'.$m->image)}}"
                                        @endif alt="" class="img-thumbnail shadow-sm"></td>
                                    <td class="col-3">{{ $m ->name}}</td>
                                    <td class="col-2">{{ $m ->email}}</td>
                                    <td class="col-2">{{ $m ->phone}}</td>
                                    <td class="col-1 ">{{ $m ->address}}</td>
                                    <td class="col-2">
                                        <div class="table-data-feature">
                                            @if (Auth::user()->id == 1)
                                                @if ($m->id != 1)
                                                    <a href="{{route('change#role',$m->id)}}">
                                                        <button class="item mx-2" data-toggle="tooltip" data-placement="top" title="Role Change">
                                                            <i class="fas fa-sync-alt"></i>
                                                        </button>
                                                    </a>
                                                    <a href="{{route('admin#delete',$m->id)}}">
                                                        <button class="item mx-2" data-toggle="tooltip" data-placement="top" title="Delete">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </button>
                                                    </a>
                                                @endif
                                            @else

                                            @endif

                                        </div>
                                </td>
                                </tr>
                                @endforeach


                        </tbody>
                    </table>
                </div>

                <!-- END DATA TABLE -->

                {{-- pagination box --}}
                {{$admin->links()}}
            </div>
        </div>
    </div>
</div>

@endsection


