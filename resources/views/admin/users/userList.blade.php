@extends('admin.layouts.app')
@section('title','User_List Page')

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
                            <h2 class="title-1">User List</h2>
                        </div>
                    </div>

                </div>

                {{-- <div class="d-flex">
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
                </div> --}}


                <div class="table-responsive table-responsive-data2 text-center">
                    <table class="table table-data2">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Role</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($users as $u)
                                <tr class="tr-shadow">

                                    <td class="col-1"><img @if ($u->image == null)
                                            @if ($u->gender == 'male')
                                                src="{{asset('image/male.jpg')}}"
                                            @else src="{{asset('image/default-female.jpg')}}"
                                            @endif
                                        @else src="{{asset('storage/'.$u->image)}}"
                                        @endif alt="" class="img-thumbnail shadow-sm"></td>
                                    <td class="col-2">{{ $u ->name}}</td>
                                    <input type="hidden" id="userId" value="{{$u->id}}">
                                    <td class="col-2">{{ $u ->email}}</td>
                                    <td class="col-2">{{ $u ->phone}}</td>
                                    <td class="col-2">{{ $u ->address}}</td>
                                    <td class="col-2 form-select" >
                                        <select name="rolechange" id="rolechange" class="rolechange">
                                            <option value="user" @if ($u->role == 'user') selected @endif>User</option>
                                            <option value="admin" @if ($u->role == 'admin') selected @endif>Admin</option>
                                        </select>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- END DATA TABLE -->

                {{-- pagination box --}}
                <div class="">
                    {{$users->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scriptSource')
    <script>
        $(document).ready(function(){
            $('.rolechange').change(function(){
                $currentRole = $(this).val();
                console.log($currentRole);
                $parentNode = $(this).parents("tr");
                $userId = $parentNode.find('#userId').val();
                console.log($userId);
                $data = {
                    'userId' : $userId ,
                    'role' : $currentRole
                };
                // console.log($data);
                $.ajax({
                    type : 'get',
                    url : '/admin/user/change/role',
                    data : $data,
                    dataType : 'json' ,
                })
                location.reload();
            })
        })
    </script>
@endsection
