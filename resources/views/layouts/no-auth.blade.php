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
<style media="screen">
    body{
      /*width: 100vh;*/
    }
    body, div,body div{
      z-index: 5!important;
    }
    #bg-img{
      background-color: #2AF598;
      background-image: url('{{asset('ass_img/bg.jpg')}}');
      background-size: 100% auto;
      opacity: 1!important;
      z-index: 1!important;
      width: 100vw;
      height: 100vh;
      position: fixed;
      top:0px;
      left: 0;
    }

    #bg{
      background-size: 100% auto;
      width:100vw;
      height: 100vh;
      background-image: linear-gradient(344deg, #bd9010 5%, #bd9010 62%);
      z-index: 3!important;
      position: fixed;
      top:0;
      opacity: 0.5!important;
      left:0;

    }
    #bg-globe-animate{
      /* display: none; */
      background-size: 100% auto;
      width:100vw;
      height: 100vh;
      background-image: linear-gradient(344deg, #bd9010 5%, #bd9010 62%);
      z-index: 2!important;
      position: fixed;
      top:0;
      opacity: 0.8!important;
      left:0;

    }
    #title-page{
      position: absolute;
      top:0px;
      margin:auto;
      left:0;
      right:0;
      min-height:50px;
      background: #f1f1f1;
      width: calc(60vw);
      border-bottom-left-radius: 100px;
      border-bottom-right-radius: 100px;
      /* border:1px solid #000; */
      box-shadow: 1px 5px 7px #222;
      z-index: 10;
      border-top:5px solid #cdd6d2;
      opacity: 1!important;
    }
  </style>

  <body>
    <div class="" id="bg-img">
    </div>
      <div class="" id="bg">
    </div>
    @yield('content')
  </body>


</html>
