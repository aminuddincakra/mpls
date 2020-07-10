@extends('layouts.backend')

@section('content')
    <section class="content-header">
      <h1>
        Dashboard
        <small>Dashboard Siswa</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard Siswa</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="box">
                            <div class="box-header with-border">
                              <h3 class="box-title">Dashboard Siswa</h3>
                            </div>
                            <div class="box-body">
                                <form class="form-horizontal form-material" method="POST" action="{{ url('dashboard/post') }}">
                                    {{ csrf_field() }}                                    
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
