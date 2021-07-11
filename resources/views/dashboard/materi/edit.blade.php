@extends('layouts.backend')

@section('content')
    <section class="content-header">
      <h1>
        Dashboard
        <small>Edit Materi</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ url('dashboard/materis') }}"> Materi</a></li>
        <li class="active">Edit</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="box">
                            <div class="box-header with-border">
                              <h3 class="box-title">Edit Materi</h3>
                            </div>
                            <div class="box-body">
                                {!! Form::model($materi, ['route' => ['materis.update', $materi->id], 'method' => 'patch','class' => 'form-horizontal form-material']) !!}
                                    <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                                        <label class="col-md-12">Judul</label>
                                        <div class="col-md-12">
                                            <input type="text" placeholder="Masukkan judul" class="form-control form-control-line" name="title" value="{{ $materi->title }}">
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
                                            <textarea name="content" class="editor" id="soal">{!! $materi->content !!}</textarea>
                                            @if ($errors->has('content'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('content') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>                                    
                                    <div class="form-group {{ $errors->has('date') ? ' has-error' : '' }}">
                                        <label class="col-md-12">Tanggal</label>
                                        <div class="col-md-12">
                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="text" class="form-control pull-right datepicker" name="date" value="{{ \Carbon\Carbon::parse($materi->date)->format('m/d/Y') }}">
                                            </div>
                                            @if ($errors->has('date'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('date') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>                              
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <a href="{{ url('dashboard/materis') }}" class="btn btn-default">Cancel</a>
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
