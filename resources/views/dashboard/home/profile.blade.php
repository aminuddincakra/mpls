@extends('layouts.siswa')

@section('content')
    <div class="container">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Profile          
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>          
          <li class="active">Profile</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title">Profile Peserta Didik</h3>
              </div>
              <div class="box-body">
                <table id="tabel" class="table table-bordered table-striped">      
                <tbody>
                  <tr>
                    <td class="tg-0lax" width="200px">Nama</td>
                    <td class="tg-0lax">: {{ \Auth::user()->name }}</td>
                  </tr>
                  <tr>
                    <td class="tg-0lax" width="200px">Kelas</td>
                    <td class="tg-0lax">: {{ \Auth::user()->kelas }}</td>
                  </tr>
                  <tr>
                    <td class="tg-0lax" width="200px">Jurusan</td>
                    <td class="tg-0lax">: {{ \Auth::user()->jurusan }}</td>
                  </tr>
                  <tr>
                    <td class="tg-0lax" width="200px">Wali Kelas</td>
                    <td class="tg-0lax">: {{ \Auth::user()->wali_kelas }}</td>
                  </tr>
                  <tr>
                    <td class="tg-0lax" width="200px">Link WA Group</td>
                    <td class="tg-0lax">: {{ \Auth::user()->link }}</td>
                  </tr>
                </tbody>
                </table>
              </div>
            </div>
          </section>
      <!-- /.content -->
    </div>
    <!-- /.container -->
@endsection
