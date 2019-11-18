<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>SUPD2</title>
    <script src="{{asset('js/jq.js')}}" charset="utf-8"></script>
    <!-- <link rel="stylesheet" href="{{asset('vendor/adminlte/dist/css/AdminLTE.min.css')}}"> -->
    <!-- <script src="https://code.highcharts.com/maps/modules/data.js"></script> -->
    <script src="{{asset('admin_dist/js/highmaps.js')}}"></script>
    <script src="{{asset('js/treer9.js')}}" charset="utf-8"></script>
    <!-- <script src="{{asset('js/gl.globe.js')}}" charset="utf-8"></script> -->
    <!-- <script src="{{asset('js/gl.bird.js')}}" charset="utf-8"></script> -->
    <!-- <script src="{{asset('js/gl.rings.js')}}" charset="utf-8"></script> -->
    <!-- <script src="{{asset('js/gl.waves.js')}}" charset="utf-8"></script> -->
    <script src="{{asset('js/gl.clouds.js')}}" charset="utf-8"></script>
    <link rel="stylesheet" href="{{asset('admin_dist/css/sb-admin-2.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin_dist/css/custome.css?v='.date('i:s'))}}">





    @yield('head_asset')
  </head>
  <style media="screen">
    body{
      max-width: 100vh;
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
    <div id="bg-globe-animate">

    </div>
    <script type="text/javascript">
      setTimeout(function(){
        // VANTA.GLOBE({
        //     el: "#bg-globe-animate"
        //   });
        // VANTA.BIRDS({
        //     el: "#bg-globe-animate"
        //   });
        // VANTA.RINGS({
        //     el: "#bg-globe-animate"
        //   });
        // VANTA.CLOUDS({
        //     el: "#bg-globe-animate"
        //   });
      },1000);
    </script>



    <div class="" id="bg">
    </div>
    <div class="" id="title-page">
      <h4 class="text-center text-gray-900"><b>{{isset($title)?$title:''}} ({{session('focus_tahun')}})</b></h4>
    </div>
    @yield('content')
  </body>
    @include('sweetalert::alert')
  

 <script src="{{url('')}}/admin_dist/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


  <!-- Core plugin JavaScript-->
  <script src="{{url('')}}/admin_dist/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{url('')}}/admin_dist/js/sb-admin-2.min.js"></script>

  
</html>
