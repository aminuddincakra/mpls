@extends('layouts.backend')

@section('content')
    <section class="content-header">
      <h1>
        Dashboard
        <small>Edit Pengumuman</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ url('dashboard/pengumumans') }}"> Pengumuman</a></li>
        <li class="active">Edit</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="box">
                            <div class="box-header with-border">
                              <h3 class="box-title">Edit Pengumuman</h3>
                            </div>
                            <div class="box-body">
                                {!! Form::model($pengumuman, ['route' => ['pengumumans.update', $pengumuman->id], 'method' => 'patch','class' => 'form-horizontal form-material']) !!}
                                    <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                                        <label class="col-md-12">Judul</label>
                                        <div class="col-md-12">
                                            <input type="text" placeholder="Masukkan judul" class="form-control form-control-line" name="title" value="{{ $pengumuman->title }}">
                                            @if ($errors->has('title'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('title') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group {{ $errors->has('content') ? ' has-error' : '' }}">
                                        <label class="col-md-12">Content</label>
                                        <div class="col-md-12">
                                            <textarea name="content" class="editor" id="soal">{!! $pengumuman->content !!}</textarea>
                                            @if ($errors->has('content'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('content') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>                                    
                                    <div class="form-group {{ $errors->has('status') ? ' has-error' : '' }}">
                                        <label class="col-md-12">Status</label>
                                        <div class="col-md-12">
                                            <label class="switch">
                                                <input type="checkbox" name="status" value="1" class="icheck" {!! ($pengumuman->status == 1) ? 'checked="checked"' : '' !!}>
                                                <span class="slider round"></span>
                                            </label>
                                            @if ($errors->has('status'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('status') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>                                   
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <a href="{{ url('dashboard/pengumumans') }}" class="btn btn-default">Cancel</a>
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
