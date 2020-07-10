@extends('layouts.backend')

@section('content')
    <section class="content-header">
      <h1>
        Dashboard
        <small>Tambah Post</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ url('dashboard/post') }}"> Post</a></li>
        <li class="active">Create</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="box">
                            <div class="box-header with-border">
                              <h3 class="box-title">Tambah Post</h3>
                            </div>
                            <div class="box-body">
                                <form class="form-horizontal form-material" method="POST" action="{{ url('dashboard/post') }}">
                                    {{ csrf_field() }}
                                    <div class="form-group {{ $errors->has('jurusan_id') ? ' has-error' : '' }}">
                                        <label class="col-md-12">Judul</label>
                                        <div class="col-md-12">
                                            {{ Form::select('jurusan_id', $jurusan, old('jurusan_id'), ['placeholder' => 'Pilih Jurusan', 'class' => 'form-control select2', 'style' => 'width: 100%;', 'required' => 'required']) }}
                                            @if ($errors->has('jurusan_id'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('jurusan_id') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                        <label class="col-md-12">Judul</label>
                                        <div class="col-md-12">
                                            <input type="text" placeholder="Masukkan judul" class="form-control form-control-line" name="name" value="{{ old('name') }}">
                                            @if ($errors->has('name'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group {{ $errors->has('text') ? ' has-error' : '' }}">
                                        <label class="col-md-12">Teks</label>
                                        <div class="col-md-12">
                                            <textarea name="text" class="editor" id="soal">{!! old('text') !!}</textarea>
                                            @if ($errors->has('text'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('text') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group {{ $errors->has('embed') ? ' has-error' : '' }}">
                                        <label class="col-md-12">Embed</label>
                                        <div class="col-md-12">
                                            <input type="text" placeholder="Masukkan embed" class="form-control form-control-line" name="embed" value="{{ old('embed') }}">
                                            @if ($errors->has('embed'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('embed') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group {{ $errors->has('status') ? ' has-error' : '' }}">
                                        <label class="col-md-12">Status</label>
                                        <div class="col-md-12">
                                            <label class="switch">
                                                <input type="checkbox" name="status" value="1" class="icheck" checked="checked">
                                                <span class="slider round"></span>
                                            </label>
                                            @if ($errors->has('status'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('status') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group {{ $errors->has('pinned') ? ' has-error' : '' }}">
                                        <label class="col-md-12">Pinned</label>
                                        <div class="col-md-12">
                                            <label class="switch">
                                                <input type="checkbox" name="pinned" value="1" class="icheck">
                                                <span class="slider round"></span>
                                            </label>
                                            @if ($errors->has('pinned'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('pinned') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <a href="{{ url('dashboard/post') }}" class="btn btn-default">Cancel</a>
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
