<!DOCTYPE html>
<html lang="en" dir="ltr">
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  
  <title>DSS</title>

  <!-- Custom fonts for this template -->
  <link href="{{url('')}}/admin_dist/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="{{url('')}}/admin_dist/css/sb-admin-2.min.css" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="{{url('')}}/admin_dist/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

  <script src="{{asset('admin_dist/fs/highcharts.js')}}"></script>
  <script src="{{asset('admin_dist/fs/highcharts-3d.js')}}"></script>
  <script src="{{asset('admin_dist/fs/modules/exporting.js')}}"></script>
  <script src="{{asset('admin_dist/fs/modules/export-data.js')}}"></script>

  
  <link rel="stylesheet" href="{{asset('admin_dist/css/custome.css?v='.date('i:s'))}}">
   <style type="text/css">
    *{
      font-family: 'Roboto Condensed';
    }
  </style>

</head>
  <body>
    @yield('content')
  </body>


</html>
