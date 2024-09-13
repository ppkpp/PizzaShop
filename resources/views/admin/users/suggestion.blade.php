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
                            <h2 class="title-1">Users' Suggestion</h2>
                        </div>
                    </div>

                </div>


                <div class="table-responsive table-responsive-data2 text-center">
                    <table class="table table-data2">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Suggestion</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($contact as $c)
                                <tr class="tr-shadow">
                                    <td class="col-2">{{ $c ->name}}</td>
                                    <td class="col-2">{{ $c ->phone_number}}</td>
                                    <td class="col-2">{{ $c ->email}}</td>
                                    <td class="col-6">{{ $c ->message}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- END DATA TABLE -->

                {{-- pagination box --}}
                <div class="">
                    {{$contact->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

