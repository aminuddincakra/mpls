@extends('layouts.siswa')

@section('content')
    <div class="container">
      <section class="content-header">
        <h1>
          Dashboard          
        </h1>
        <ol class="breadcrumb">
          <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>          
          <li class="active">Dashboard</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
          <div class="row">
              @if(isset($pengumuman))
                <div id="modal-pengumuman" class="modal fade" role="dialog">
                  <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <input type="hidden" name="_method" value="DELETE">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">{{ $pengumuman->title }}</h4>
                        </div>
                        <div class="modal-body">
                            {!! $pengumuman->title !!}
                        </div>
                        <div class="modal-footer">
                            <a href="#" class="btn btn-default" data-dismiss="modal">Tutup</a>
                        </div>        
                    </div>
                  </div>
                </div>
              @endif
              <div class="col-sm-12">
                  <div class="box">
                    @if($materi)
                      <div class="box-header with-border">
                        <h3 class="box-title">Review Materi</h3>
                      </div>
                      <div class="box-body">
                          @php ($name = array_column($data->toArray(), 'name'))
                          @php ($materi = array_column($data->toArray(), 'id'))
                            <div class="stepwizard">
                                <div class="stepwizard-row setup-panel">
                                    @foreach($name as $key => $dt)
                                      <div class="stepwizard-step col-xs-3"> 
                                        <a href="#step-{{ $key+1 }}" type="button" class="btn {!! ($key == 0) ? 'btn-success' : 'btn-default' !!} btn-circle submit-activity" {!! ($key == 0) ? '' : 'disabled="disabled"' !!} data-user="{{ \Auth::user()->id }}" data-materi="{{ (array_key_exists($key, $materi)) ? $materi[$key] : '' }}">{{ $key+1 }}</a>
                                        <p><small>{{ $dt }}</small></p>
                                      </div>
                                    @endforeach
                                </div>
                          </div>
                          @foreach($data as $key => $dt)
                              <div class="panel panel-primary setup-content" id="step-{{ $key+1 }}">
                                <div class="panel-heading">
                                     <h3 class="panel-title">{{ $dt->name }}</h3>
                                </div>
                                <div class="panel-body">
                                    {!! $dt->text !!}
                                    @if($dt->embed != '')                        
                                      {!! Embed::make($dt->embed)->parseUrl()->getIframe() !!}
                                    @endif
                                    @if($dt->file != '' AND file_exists('uploads/'.$dt->file))
                                      <embed src="{{ asset('uploads/'.$dt->file) }}" width="600" height="500" alt="pdf" />
                                    @endif
                                    @if($key != intval(count($data)) - 1)
                                      <button class="btn btn-primary nextBtn pull-right submit-activity" type="button" data-user="{{ \Auth::user()->id }}" data-materi="{{ (array_key_exists($key+1, $materi)) ? $materi[$key+1] : '' }}">Selanjutnya</button>
                                    @endif
                                </div>
                              </div>
                          @endforeach
                      </div>
                    @else
                      <div class="box-body">
                        <p>Maaf tidak ada materi hari ini</p>
                      </div>
                    @endif
                  </div>
              </div>
          </div>
      </section>
    </div>
    <!-- /.container -->
@endsection
