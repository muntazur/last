<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Management</title>
     <meta name="csrf-token" content="{{ csrf_token() }}" />

    <script src="{{asset('assets/jquery-3.3.1.js')}}">
    </script>
    <script src="{{asset('assets/js/bootstrap.bundle.js')}}">
    </script>
    <!script src="{{asset('assets/js/bootstrap.bundle.js.map')}}">
    <!/script>
    <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}">
    </script>
    <!script src="{{asset('assets/js/bootstrap.bundle.min.js.map')}}">
    <!/script>
    <script src="{{asset('assets/js/bootstrap.js')}}">
    </script>
    <script src="{{asset('assets/js/bootstrap.min.js')}}">
    </script>
    <!script src="{{asset('assets/js/bootstrap.min.js.map')}}">
    <!/script>


    <link rel="stylesheet" href="{{asset('assets/css/bootstrap-grid.css')}}">    
    <!link rel="stylesheet" href="{{asset('assets/css/bootstrap-grid.css.map')}}">    
    <!link rel="stylesheet" href="{{asset('assets/css/bootstrap-gird.min.css')}}">    
    <!link rel="stylesheet" href="{{asset('assets/css/bootstrap-gird.min.css.map')}}">


    <link rel="stylesheet" href="{{asset('assets/css/bootstrap-reboot.css')}}">
    <!link rel="stylesheet" href="{{asset('assets/css/bootstrap-reboot.css.map')}}">

    <link rel="stylesheet" href="{{asset('assets/css/bootstrap-reboot.min.css')}}">
    <!link rel="stylesheet" href="{{asset('assets/css/bootstrap-reboot.min.css.map')}}">

    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.css')}}">  
    <!link rel="stylesheet" href="{{asset('assets/css/bootstrap.css.map')}}">

    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
     <!link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css.map')}}">
 
    
    <!custom css>
    <link rel="stylesheet" type="text/css" href="{{asset('custom/style.css')}}">
</head>

<body>


        @yield('navigation')

	    @yield('content')
</body>
   
    @yield('jquery')
</html>