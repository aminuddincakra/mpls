@extends('layouts.backend')

@section('content')
    <section class="content-header">
      <h1>
        Dashboard
        <small>Tambah Jurusan</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ url('dashboard/jurusans') }}"> Jurusan</a></li>
        <li class="active">Create</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="box">
                            <div class="box-header with-border">
                              <h3 class="box-title">Tambah Jurusan</h3>
                            </div>
                            <div class="box-body">
                                <form class="form-horizontal form-material" method="POST" action="{{ url('dashboard/jurusans') }}">
                                    {{ csrf_field() }}
                                    <div class="form-group {{ $errors->has('kode') ? ' has-error' : '' }}">
                                        <label class="col-md-12">Kode Jurusan</label>
                                        <div class="col-md-12">
                                            <input type="text" placeholder="Masukkan kode jurusan" class="form-control form-control-line" name="kode" value="{{ old('kode') }}">
                                            @if ($errors->has('kode'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('kode') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                        <label class="col-md-12">Nama Jurusan</label>
                                        <div class="col-md-12">
                                            <input type="text" placeholder="Masukkan nama jurusan" class="form-control form-control-line" name="name" value="{{ old('name') }}">
                                            @if ($errors->has('name'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <a href="{{ url('dashboard/jurusans') }}" class="btn btn-default">Cancel</a>
                                            <button type="submit" class="btn btn-success">Simpan</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
    </section>
@endsection
