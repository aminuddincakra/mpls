@extends('layouts.backend')

@section('content')
    <section class="content-header">
      <h1>
        Dashboard
        <small>Report</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>        
        <li class="active">Report</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="box">
                            <div class="box-header with-border">
                              <h3 class="box-title">Generate Laporan</h3>
                            </div>
                            <div class="box-body">
                                <form class="form-horizontal form-material" method="POST" action="{{ url('dashboard/report') }}">
                                    {{ csrf_field() }}                                    
                                    <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                                        <label class="col-md-12">Jenis Laporan</label>
                                        <div class="col-md-12">
                                            <select name="jenis" class="form-control form-control-line">
                                                <option value="hadir">Laporan Kehadiran</option>
                                                <option value="aktivitas">Laporan Aktivitas Peserta Didik</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group {{ $errors->has('date') ? ' has-error' : '' }}">
                                        <label class="col-md-12">Tanggal</label>
                                        <div class="col-md-12">
                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="text" class="form-control pull-right datepicker" name="tanggal" value="{{ \Carbon\Carbon::now()->format('m/d/Y') }}">
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
                                            <button type="submit" class="btn btn-success">Generate Laporan</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
    </section>
@endsection
