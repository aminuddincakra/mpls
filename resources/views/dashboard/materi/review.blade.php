@extends('layouts.backend')

@section('content')
    <section class="content-header">
      <h1>
        Dashboard
        <small>Review Materi</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ url('dashboard/materis') }}"> Materi</a></li>
        <li class="active">Review</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="box">
                    <div class="box-header with-border">
                      <h3 class="box-title">Review Materi</h3>
                    </div>
                    <div class="box-body">
                        @php ($name = array_column($post->toArray(), 'name'))
                          <div class="stepwizard">
                              <div class="stepwizard-row setup-panel">
                                  @foreach($name as $key => $dt)
                                    <div class="stepwizard-step col-xs-3"> 
                                        <a href="#step-{{ $key+1 }}" type="button" class="btn {!! ($key == 0) ? 'btn-success' : 'btn-default' !!} btn-circle" {!! ($key == 0) ? '' : 'disabled="disabled"' !!}>{{ $key+1 }}</a>
                                        <p><small>{{ $dt }}</small></p>
                                      </div>
                                  @endforeach
                              </div>
                        </div>
                        @foreach($post as $key => $dt)
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
                                  @if($key != intval(count($post)) - 1)
                                    <button class="btn btn-primary nextBtn pull-right" type="button">Next</button>
                                  @endif
                              </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
