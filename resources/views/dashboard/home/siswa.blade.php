@extends('layouts.siswa')

@section('content')
    <div class="container">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Dashboard          
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>          
          <li class="active">Dashboard</li>
        </ol>
      </section>

     <section class="content">
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title">Jadwal</h3>
              </div>
              <div class="box-body">
                <table id="tabel" class="table table-bordered table-striped">
      <thead>
  <tr>
    <th class="tg-0lax">No</th>
    <th class="tg-0lax">Materi</th>
    <th class="tg-0lax">Fasilitator</th>
    <th class="tg-0lax">Ketarangan</th>
    <th class="tg-0lax">Bahan Materi</th>
  </tr>
</thead>
<tbody>
  <tr>
    <td class="tg-0lax">1</td>
    <td class="tg-0lax">Pembelajaran</td>
    <td class="tg-0lax">Suratno, S.Pd, M.Pd - Wakil Kepala Sekolah Bidang Kurikulum</td>
    <td class="tg-0lax">Online</td>
    <td>Link</td>
  </tr>
  <tr>
    <td class="tg-0lax">2</td>
    <td class="tg-0lax">Pembinaan Kesiswaan</td>
    <td class="tg-0lax">Sumtingah, S.Pd - Wakil Kepala Sekolah Bidang Kesiswaan</td>
    <td class="tg-0lax">Online</td>
    <td>Link</td>
  </tr>
  <tr>
    <td class="tg-0lax">3</td>
    <td class="tg-0lax">Pengenalan Lingkungan Sekolah</td>
    <td class="tg-0lax">Drs. Yoga Pramono,MT - Wakil Kepala Sekolah Bidang Sarana dan Prasarana</td>
    <td class="tg-0lax">Online</td>
    <td>Link</td>
  </tr>
  <tr>
    <td class="tg-0lax">4</td>
    <td class="tg-0lax">Bursa Kerja / Tamatan</td>
    <td class="tg-0lax">Drs.Juwadi - Wakil Kepala Sekolah Bidang Hubungan Industri</td>
    <td class="tg-0lax">Online</td>
    <td>Link</td>
  </tr>
  <tr>
    <td class="tg-0lax">5</td>
    <td class="tg-0lax">Pengenalan Bengkel</td>
    <td class="tg-0lax">Kepala Kompetensi  masing - masing </td>
    <td class="tg-0lax">Online</td>
    <td>Link</td>
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
