@extends('layouts.backend')

@section('content')
    <section class="content-header">
      <h1>
        Dashboard
        <small>Edit Jurusan</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ url('dashboard/jurusans') }}"> Jurusan</a></li>
        <li class="active">Edit</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="box">
                            <div class="box-header with-border">
                              <h3 class="box-title">Edit Jurusan</h3>
                            </div>
                            <div class="box-body">
                                {!! Form::model($jurusan, ['route' => ['jurusans.update', $jurusan->id], 'method' => 'patch','class' => 'form-horizontal form-material']) !!}
                                    <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                        <label class="col-md-12">Nama Role</label>
                                        <div class="col-md-12">
                                            <input type="text" placeholder="Masukkan nama jurusan" class="form-control form-control-line" name="name" value="{{ $jurusan->name }}">
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
