<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
<title>Aplikasi Ujian Online</title>
<!-- Bootstrap core CSS -->
<link href="{{ asset('frontend/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
<!-- Custom styles for this template -->
<link href="{{ asset('frontend/css/font-awesome.css') }}" rel="stylesheet">
<link href="{{ asset('frontend/css/full.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container">
        @include('flash::message')        
        @yield('content')
    </div>
<script src="{{ asset('frontend/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('frontend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>