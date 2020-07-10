@extends('layouts.backend')

@section('content')
    <section class="content-header">
      <h1>
        Dashboard
        <small>Edit Role</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ url('dashboard/roles') }}"> Role</a></li>
        <li class="active">Edit</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="box">
                            <div class="box-header with-border">
                              <h3 class="box-title">Edit Role</h3>
                            </div>
                            <div class="box-body">
                                {!! Form::model($perm, ['route' => ['roles.update', $perm->id], 'method' => 'patch','class' => 'form-horizontal form-material']) !!}
                                    <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                        <label class="col-md-12">Nama Role</label>
                                        <div class="col-md-12">
                                            <input type="text" placeholder="Masukkan nama role" class="form-control form-control-line" name="name" value="{{ $perm->name }}">
                                            @if ($errors->has('name'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group {{ $errors->has('permission') ? ' has-error' : '' }}">
                                        <label class="col-md-12">Role</label>
                                        <div class="col-md-12">
                                            @php ($permissons = @unserialize($perm->permission) ? @unserialize($perm->permission) : [])
                                            <div class="checkbox">
                                              <label>
                                                <input type="checkbox" value="User" name="permission[]" {!! in_array('User',$permissons) ? 'checked="checked"' : '' !!} class="icheck">
                                                User Management
                                              </label>
                                            </div>
                                            <div class="checkbox">
                                              <label>
                                                <input type="checkbox" value="Role" name="permission[]" {!! in_array('Role',$permissons) ? 'checked="checked"' : '' !!} class="icheck">
                                                Role
                                              </label>
                                            </div>
                                            <div class="checkbox">
                                              <label>
                                                <input type="checkbox" value="Jurusan" name="permission[]" {!! in_array('Jurusan',$permissons) ? 'checked="checked"' : '' !!} class="icheck">
                                                Data Jurusan
                                              </label>
                                            </div>
                                            <div class="checkbox">
                                              <label>
                                                <input type="checkbox" value="Siswa" name="permission[]" {!! in_array('Siswa',$permissons) ? 'checked="checked"' : '' !!} class="icheck">
                                                Data Siswa
                                              </label>
                                            </div>
                                            <div class="checkbox">
                                              <label>
                                                <input type="checkbox" value="Post" name="permission[]" {!! in_array('Post',$permissons) ? 'checked="checked"' : '' !!} class="icheck">
                                                Post
                                              </label>
                                            </div>                                            
                                            @if ($errors->has('permission'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('permission') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <a href="{{ url('dashboard/roles') }}" class="btn btn-default">Cancel</a>
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
