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
                <h3 class="box-title">Materi {{ $post->name }}</h3>
              </div>
              <div class="box-body">
                  {!! $post->text !!}
                  @if(strpos($post->embed, 'youtube') !== false)
                    @php (preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $post->embed, $matches))                    
                    <iframe width="100%" height="500" src="https://www.youtube.com/embed/{{ $matches['1'] }}"></iframe>
                  @endif                 
              </div>
            </div>
          </section>
      <!-- /.content -->
    </div>
    <!-- /.container -->
@endsection
