@extends('layouts.backend')

@section('content')
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Users</h4> </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">                        
                        <ol class="breadcrumb">
                            <li><a href="{{ url('dashboard') }}">Dashboard</a></li>
                            <li class="active">Users</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($user) > 0)
                                            @foreach($user as $key => $dt)
                                                <tr>
                                                    <td>{{ $dt->id }}</td>
                                                    <td>{{ $dt->name }}</td>
                                                    <td>{{ $dt->email }}</td>
                                                    @php ($perm = $dt->perm)
                                                    <td>{{ isset($perm->name) ? $perm->name : '' }}</td>
                                                    @if($key == '0')
                                                        <td align="center">-</td>
                                                    @else
                                                        <td><a href="#" data-toggle="modal" data-target="#modal-delete" data-id="{!! route('users.destroy', [$dt->id]) !!}" id="getConfirm" data-title="User" data-name="{{ $dt->name }}" class="getConfirm"><i class="fa fa-trash">&nbsp;</i></a></td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="5">No data available</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
@endsection
