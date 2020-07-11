@extends('layouts.backend')

@section('content')
    <section class="content-header">
      <h1>
        Dashboard
        <small>Daftar Siswa</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Siswa</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="nav-tabs-custom">
		                    <ul class="nav nav-tabs">
		                      	<li class="active"><a {!! (isset($_GET['ids']) AND $_GET['ids'] != '')?'':'data-toggle="tab"' !!} href="{{ (isset($_GET['ids']) AND $_GET['ids'] AND $_GET['ids'] != '')?url('dashboard/siswa#daftar'):'#daftar' }}">Daftar Siswa</a></li>
		                      	<li><a {!! (isset($_GET['ids']) AND $_GET['ids'] != '')?'':'data-toggle="tab"' !!} href="{{ (isset($_GET['ids']) AND $_GET['ids'] AND $_GET['ids'] != '')?url('dashboard/siswa#kelas'):'#kelas' }}">Daftar Kelas</a></li>
		                      	<li><a {!! (isset($_GET['ids']) AND $_GET['ids'] != '')?'':'data-toggle="tab"' !!} href="{{ (isset($_GET['ids']) AND $_GET['ids'] AND $_GET['ids'] != '')?url('dashboard/siswa#import'):'#import' }}">Import Siswa</a></li>
		                    </ul>
		                    <div class="tab-content">
		                      	<!-- Font Awesome Icons -->
		                      	<div class="tab-pane active" id="daftar">
		                      		<table class="table">
                                        <thead>
                                            <tr>
                                                <th class="active" width="5">
                                                    <input type="checkbox" class="select-all checkbox" name="select-all" />
                                                </th>
                                                <th>NISN</th>
                                                <th>Nama</th>
                                                <th>Jurusan</th>                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(count($siswa) > 0)                                               
                                                @foreach($siswa as $key => $dt)
                                                    <tr>
                                                        <td class="active">
                                                            <input type="checkbox" class="select-item checkbox" name="items[]" value="{{ $dt->id }}" />
                                                        </td>
                                                        <td>{{ $dt->email }}</td>
                                                        <td>{{ $dt->name }}</td>
                                                        <td>
                                                        	@php ($jur = $dt->jurusane)
                                                        	{{ ($jur) ? $jur->name : '' }}
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
                                    {{ $siswa->links() }}
		                      	</div>
		                      	<div class="tab-pane" id="kelas">
		                      		<form class="form-horizontal form-material" method="POST" action="{{ url('dashboard/siswa/kelas') }}" enctype="multipart/form-data">
		                                {{ csrf_field() }}
			                      		<table class="table">
	                                        <thead>
	                                            <tr>
	                                                <th class="active" width="5">
	                                                    <input type="checkbox" class="select-all checkbox" name="select-all" />
	                                                </th>
	                                                <th>Kelas</th>
	                                                <th>Aktifkan</th>                                                
	                                            </tr>
	                                        </thead>
	                                        <tbody>
	                                            @if(count($kelas) > 0)                                               
	                                                @foreach($kelas as $key => $dt)
	                                                	@if($key != '')
		                                                    <tr>
		                                                        <td class="active">
		                                                            <input type="checkbox" class="select-item checkbox" name="items[]" value="{{ $dt }}" />
		                                                        </td>
		                                                        <td>{{ $key }}</td>
		                                                        <td>
		                                                        	<div class="input-group date">
					                                                    <div class="input-group-addon">
					                                                        <i class="fa fa-calendar"></i>
					                                                    </div>
					                                                    <input type="text" class="form-control pull-right datepicker" name="aktifkan[{{ $key }}]" value="{{ ($dt != '') ? date('m/d/Y', strtotime($dt)) : '' }}" required="required">
					                                                </div>
		                                                        </td>                                                        
		                                                    </tr>
	                                                    @endif
	                                                @endforeach
	                                            @else
	                                                <tr>
	                                                    <td colspan="3">No data available</td>
	                                                </tr>
	                                            @endif
	                                        </tbody>
	                                    </table>
	                                    <div class="form-group">
		                                    <div class="col-sm-12">
		                                        <button type="submit" class="btn btn-success">Simpan</button>
		                                    </div>
		                                </div>
	                                </form>
		                      	</div>
		                      	<div class="tab-pane" id="import">
		                      		<form class="form-horizontal form-material" method="POST" action="{{ url('dashboard/siswa/import') }}" enctype="multipart/form-data">
		                                {{ csrf_field() }}
		                                <div class="form-group {{ $errors->has('file') ? ' has-error' : '' }}">		                                	
		                                    <label class="col-md-12">File Import</label>
		                                    <div class="col-md-12">
		                                    	{{ Form::file('file', $attributes = []) }}
		                                       	@if ($errors->has('file'))
			                                        <span class="help-block">
			                                        	<strong>{{ $errors->first('file') }}</strong>
			                                       	</span>
		                                       	@endif		                                        
		                                    </div>                                       
		                                </div>
		                               	<div class="form-group">
		                                    <div class="col-sm-12">
		                                        <button type="submit" class="btn btn-success">Import</button>
		                                    </div>
		                                </div>
		                            </form>
		                      	</div>
		                    </div>
		                </div>
                    </div>
                </div>
    </section>
@endsection
