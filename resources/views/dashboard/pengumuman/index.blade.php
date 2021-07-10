@extends('layouts.backend')

@section('content')
    <section class="content-header">
      <h1>
        Dashboard
        <small>Daftar Pengumuman</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Pengumuman</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="box">
                            <div class="box-header with-border">
                              <h3 class="box-title">Daftar Pengumuman</h3>
                              <a href="{{ url('dashboard/pengumumans/create') }}" class="btn btn-success pull-right">Tambah Pengumuman</a>
                            </div>
                            <div class="box-body">
                                <form method="POST" action="{{ url('dashboard/search_ujians') }}">
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
                                        <div class="col-md-3"></div>
                                    </div>
                                <div class="table-responsive table-select">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="active" width="5">
                                                    <input type="checkbox" class="select-all checkbox" name="select-all" />
                                                </th>
                                                <th>Judul</th>
                                                <th>Status</th>
                                                <th width="100">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(count($pengumumen) > 0)                                               
                                                @foreach($pengumumen as $key => $dt)
                                                    <tr>
                                                        <td class="active">
                                                            <input type="checkbox" class="select-item checkbox" name="items[]" value="{{ $dt->id }}" />
                                                        </td>
                                                        <td>{{ $dt->title }}</td>
                                                        <td>{{ ($dt->status == 1) ? 'Active' : 'Inactive' }}</td>
                                                        <td>
                                                            <a href="{!! route('pengumumans.edit', [$dt->id]) !!}"><i class="fa fa-pencil">&nbsp;</i></a>
                                                            <a href="#" data-toggle="modal" data-target="#modal-delete" data-id="{!! route('pengumumans.destroy', [$dt->id]) !!}" id="getConfirm" data-title="Pengumuman" data-name="{{ $dt->name }}" class="getConfirm"><i class="fa fa-trash">&nbsp;</i></a>
                                                        </td>
                                                    </tr>                                                   
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="3">No data available</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
    </section>
@endsection
