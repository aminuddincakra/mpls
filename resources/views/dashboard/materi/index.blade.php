@extends('layouts.backend')

@section('content')
    <section class="content-header">
      <h1>
        Dashboard
        <small>Daftar Materi</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Materi</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="box">
                            <div class="box-header with-border">
                              <h3 class="box-title">Daftar Materi</h3>
                              <a href="{{ url('dashboard/materis/create') }}" class="btn btn-success pull-right">Tambah Materi</a>
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
                                                <th>Tanggal</th>
                                                <th>Detail</th>
                                                <th width="100">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(count($materis) > 0)                                               
                                                @foreach($materis as $key => $dt)
                                                    @php ($post = $dt->posts)
                                                    <tr>
                                                        <td class="active">
                                                            <input type="checkbox" class="select-item checkbox" name="items[]" value="{{ $dt->id }}" />
                                                        </td>
                                                        <td>{{ $dt->title }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($dt->date)->format('l, d F Y') }}</td>
                                                        <td>
                                                            @if(count($post) > 0)
                                                                <ol>
                                                                    @foreach($post as $keys => $d)
                                                                        <li>{{ $d->name }} (
                                                                            @if($d->jurusan_id == '')
                                                                                Semua Jurusan
                                                                            @else
                                                                                @php ($jur = $d->jurusan)
                                                                                {{ ($jur) ? $jur->name : 'Semua Jurusan' }}
                                                                            @endif
                                                                        )</li>
                                                                    @endforeach
                                                                </ol>
                                                            @else
                                                                -
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <a href="{!! route('materis.show', [$dt->id]) !!}"><i class="fa fa-tv">&nbsp;</i></a>
                                                            <a href="{!! route('materis.edit', [$dt->id]) !!}"><i class="fa fa-pencil">&nbsp;</i></a>
                                                            <a href="#" data-toggle="modal" data-target="#modal-delete" data-id="{!! route('materis.destroy', [$dt->id]) !!}" id="getConfirm" data-title="Materi" data-name="{{ $dt->title }}" class="getConfirm"><i class="fa fa-trash">&nbsp;</i></a>
                                                            <a href="{!! url('dashboard/review-materi/'.$dt->id) !!}"><i class="fa fa-eye">&nbsp;</i></a>
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
