@extends('layouts.backend')

@section('content')
    <section class="content-header">
      <h1>
        Dashboard
        <small>Edit Detail Materi</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ url('dashboard/materis/'.$ids) }}"> Detail Materi</a></li>
        <li class="active">Edit</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="box">
                            <div class="box-header with-border">
                              <h3 class="box-title">Edit Detail Materi</h3>
                            </div>
                            <div class="box-body">
                                {!! Form::model($post, ['route' => ['detail-materi.update', $post->id, $ids], 'method' => 'patch','class' => 'form-horizontal form-material', 'files' => true]) !!}
                                    <div class="form-group {{ $errors->has('jurusan_id') ? ' has-error' : '' }}">
                                        <label class="col-md-12">Judul</label>
                                        <div class="col-md-12">
                                            @php ($jur = ($post->jurusan_id == '') ? 0 : $post->jurusan_id)
                                            {{ Form::select('jurusan_id', $jurusan, $jur, ['placeholder' => 'Pilih Jurusan', 'class' => 'form-control select2', 'style' => 'width: 100%;']) }}
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
                                            <input type="text" placeholder="Masukkan judul" class="form-control form-control-line" name="name" value="{{ $post->name }}">
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
                                            <textarea name="text" class="editor" id="soal">{!! $post->text !!}</textarea>
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
                                            <input type="text" placeholder="Masukkan embed" class="form-control form-control-line" name="embed" value="{{ $post->embed }}">
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
                                                <input type="checkbox" name="status" value="1" class="icheck" {!! ($post->status == 1) ? 'checked="checked"' : '' !!}>
                                                <span class="slider round"></span>
                                            </label>
                                            @if ($errors->has('status'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('status') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group {{ $errors->has('file') ? ' has-error' : '' }}">
                                        <label class="col-md-12">File</label>
                                        <div class="col-md-12">
                                            {{ Form::file('file', $attributes = ['class' => 'form-control']) }}
                                            @if ($errors->has('file'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('file') }}</strong>
                                                </span>
                                            @endif                                              
                                        </div>                                       
                                    </div>
                                    <!-- <div class="form-group {{ $errors->has('pinned') ? ' has-error' : '' }}">
                                        <label class="col-md-12">Pinned</label>
                                        <div class="col-md-12">
                                            <label class="switch">
                                                <input type="checkbox" name="pinned" value="1" class="icheck" {!! ($post->pinned == 1) ? 'checked="checked"' : '' !!}>
                                                <span class="slider round"></span>
                                            </label>
                                            @if ($errors->has('pinned'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('pinned') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div> -->
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <a href="{{ url('dashboard/materis/'.$ids) }}" class="btn btn-default">Cancel</a>
                                            <button type="submit" class="btn btn-success">Update Changes</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
    </section>
@endsection
