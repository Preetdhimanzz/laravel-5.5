<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- CSRF Token -->
  <meta name="_token" content="{{ csrf_token() }}">
  <title>{{ config('app.name', 'Laravel') }}</title>
  <!-- Styles -->
  <link href="{{ asset('public/css/app.css') }}" rel="stylesheet">

  <link rel="stylesheet" href="{{ asset('assets/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('assets/bower_components/font-awesome/css/font-awesome.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset('assets/bower_components/Ionicons/css/ionicons.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('assets/css/AdminLTE.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/toaster.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/iCheck/square/blue.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/skins/_all-skins.min.css') }}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="skin-blue fixed sidebar-mini sidebar-mini-expand-feature" style="height: auto; min-height: 100%;">
  <div class="wrapper" style="height: auto; min-height: 100%;">
    <div id="app">


      @yield('content')

    </div>

  </div>
  <script type="text/javascript">
    var siteurl = '<?php echo url('');?>';
  </script>
  <!-- Scripts -->
  <script src="{{ asset('assets/bower_components/jquery/dist/jquery.min.js')}}"></script>

  <!-- SlimScroll -->
  <script src="{{asset('assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
  <!-- FastClick -->
  <script src="{{asset('assets/bower_components/fastclick/lib/fastclick.js')}}"></script>
  <!-- AdminLTE App -->
  <script src="{{asset('assets/js/adminlte.min.js')}}"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{asset('assets/js/demo.js')}}"></script>


  <script src="{{ asset('public/js/app.js') }}"></script>
  <script src="{{ asset('assets/core/jquery.form.js')}}"></script>
  <script src="{{ asset('assets/core/toaster.js')}}"></script>
  <script type="text/javascript">
  function toster(type,message,delay) {
    $.toast({
      heading             : type,
      text                :  message,
      loader              : true,
      loaderBg            : '#fff',
      showHideTransition  : 'fade',
      icon                : type.toLowerCase(),
      hideAfter           : delay || 1000,
      position            : 'top-right'
    });
  }
  </script>
  <script src="{{ asset('assets/core/jquery.validate.js')}}"></script>
  <script src="{{ asset('assets/core/jquery.validate.min.js')}}"></script>
  <script src="{{ asset('assets/core/form-validate.js')}}"></script>
  <script src="{{ asset('assets/core/custom.js')}}"></script>
  <script type="text/javascript">
  $('.loader_div').show();
  $(window).on('load', function () {
    $('.loader_div').fadeOut('slow');
  });

  </script>
</body>
</html>
