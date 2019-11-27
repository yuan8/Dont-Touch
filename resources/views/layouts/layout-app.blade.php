<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
   <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>DSS</title>

  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
  <script src="{{url('')}}/admin_dist/vendor/jquery/jquery.min.js"></script>
  <script src="{{asset('admin_dist/js/autosizetexta.js')}}" charset="utf-8"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script type="text/javascript" src="{{url('admin_dist/js/axios.js')}}"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
  <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed&display=swap" rel="stylesheet">
  
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/qs/6.9.0/qs.min.js"></script>
  <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>


 
  <script type="text/javascript">

    const CNDSSApi = axios.create({
          baseURL: '{{url('api')}}',
          timeout: 6000,
          headers: {
            'Authorization': '{{(Auth::User())?'Bearer '.Auth::User()->api_token:''}}',
            'Content-Type': 'application/json',
          }
    });

  </script>
  @yield('head_asset')

  <!-- Custom fonts for this template -->
  <link href="{{url('')}}/admin_dist/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="{{url('')}}/admin_dist/css/sb-admin-2.min.css" rel="stylesheet">


  <!-- Custom styles for this page -->
  <link href="{{url('')}}/admin_dist/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
   <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>
  </head>

  <body style="background-color: #f1f1f1">
       <div class="container" style="padding-top: 30px;">
            @yield('content')
       </div>
  </body>



  <script src="{{url('')}}/admin_dist/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="{{asset('admin_dist/css/component-chosen.min.css')}}">


  <!-- Core plugin JavaScript-->
  <script src="{{url('')}}/admin_dist/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{url('')}}/admin_dist/js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="{{url('')}}/admin_dist/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="{{url('')}}/admin_dist/vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="{{url('')}}/admin_dist/js/demo/datatables-demo.js"></script>
  <link rel="stylesheet" href="{{url('admin_dist/css/animate.css')}}">
  <script type="text/javascript">
    autosize($('textarea'));
    $(".select-box").chosen();
    $("textarea").css('height',38);
  </script>
  
  

  <link rel="stylesheet" href="{{asset('admin_dist/css/custome.css?v='.date('i:s'))}}">
   <style type="text/css">
    *{
      font-family: 'Roboto Condensed';
    }
  </style>
  </html>