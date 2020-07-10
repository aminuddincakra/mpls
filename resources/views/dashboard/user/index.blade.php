@extends('layouts.backend')

@section('content')
    <section class="content-header">
      <h1>
        Dashboard
        <small>Daftar User</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">User</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="box">
                            <div class="box-header with-border">
                              <h3 class="box-title">Daftar User</h3>
                            </div>
                            <div class="box-body">
                                <form method="POST" action="{{ url('dashboard/search_users') }}">
                                    {{ csrf_field() }}
                                    <div class="row">
                                        <div class="col-md-2">
                                            <select name="action" class="form-control" placeholder="Action" onchange="this.form.submit()">
                                                <option value="">Action</option>
                                                <option value="hapus">Hapus</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4"></div>
                                        <div class="col-md-3"></div>
                                        <div class="col-md-3"><input type="text" class="form-control" name="search" placeholder="Cari" value="{{ $search }}"></div>
                                    </div>
                                <div class="table-responsive table-select">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="active" width="5">
                                                    <input type="checkbox" class="select-all checkbox" name="select-all" />
                                                </th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Role</th>
                                                <th width="230">Status</th>
                                                <th width="100">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(count($user) > 0)
                                                @foreach($user as $key => $dt)
                                                    <tr class="{{ $dt->id }}">
                                                        <td class="active">
                                                            <input type="checkbox" class="select-item checkbox" name="items[]" value="{{ $dt->id }}" />
                                                        </td>
                                                        <td>{{ $dt->name }}</td>
                                                        <td>{{ $dt->email }}</td>
                                                        @php ($perm = $dt->perm)
                                                        <td>{{ isset($perm->name) ? $perm->name : '' }}</td>
                                                        <td>
                                                            <div class="col-sm-5">
                                                                <label class="switch">
                                                                    <input class="cek-user" type="checkbox" name="randomno" value="1" {!! ($dt->activate == 1)?'checked="checked"':'' !!}>
                                                                    <span class="slider round"></span>
                                                                </label>
                                                            </div>
                                                        </td>
                                                        @if($dt->id == '1')
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
                                    @if(count($user) > 0)
                                        {{ $user->links() }}
                                    @endif
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
    </section>
@endsection
