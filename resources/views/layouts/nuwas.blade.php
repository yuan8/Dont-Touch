<!doctype html>
<html lang="en">

<!-- Mirrored from demo.dashboardpack.com/architectui-html-pro/ by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 27 Nov 2019 14:35:58 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<!-- /Added by HTTrack -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>SUPD2</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="This is an example dashboard created using build-in elements and components.">

    <!-- Disable tap highlight on IE -->
    <meta name="msapplication-tap-highlight" content="no">

    <link href="{{asset('main.css')}}" rel="stylesheet">

    <link href="{{url('')}}/admin_dist/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    
    @yield('head_asset')

    <script type="text/javascript" src="{{asset('js/jq.js')}}"></script>

    <script src="{{asset('admin_dist/fs/highcharts.js')}}"></script>
    

    <script src="{{asset('admin_dist/fs/highcharts-3d.js')}}"></script>
    <script src="{{asset('admin_dist/fs/modules/exporting.js')}}"></script>
    <script src="{{asset('admin_dist/fs/modules/export-data.js')}}"></script>
    <script type="text/javascript" src="{{url('admin_dist/js/axios.js')}}"></script>
    <script type="text/javascript" src="{{url('admin_dist/js/sort.js')}}"></script>



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


</head>

<body>
    <style type="text/css">
        .chart-cn{
            width: calc(100% - 0px);
        }

        .app-theme-white.app-container{
            /*background-color:#bd9010ba;*/
            background-color: #c2c8cc;
        }
        body{
            background-image: url('{{asset('ass_img/bg.jpg')}}')!important;
             background-size: 100% auto;
        }

        .h8{
            font-size: 12px;
        }
        .app-main__inner{
          padding-bottom: 10px!important;
        }
        .app-page-title{
            padding-top:10px;
            padding-bottom: 10px;
        }
        .app-page-title .page-title-icon{
            width:40px;
            height: 40px;
            padding: 3px;
        }
        .app-page-title {
            margin-bottom: 10px;
        }
        
    </style>

    <div id="side-bar" class="app-container app-theme-white body-tabs-shadow fixed-header fixed-sidebar closed-sidebar">
    

        <div class="app-header header-shadow bg-warning">
            <div class="app-header__logo">
                <div class="logo-src-ss"></div>
                <div class="header__pane ml-auto">
                    <div>
                        <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                            <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="app-header__mobile-menu">
                <div>
                    <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                        <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </div>
            </div>
            <div class="app-header__menu">
                <span>
                <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                    <span class="btn-icon-wrapper">
                        <i class="fa fa-ellipsis-v fa-w-6"></i>
                    </span>
                </button>
                </span>
            </div>
            <div class="app-header__content">
                <div class="app-header-left">
                  
                    <H5><b>DSS    | </b> <span style="font-size: 18px;">{{isset($tahun)?''.$tahun.'':''}} </span> </H5>
                    <small> {!!isset($title)?'&nbsp;&nbsp; '.$title:''!!}</small>
                </div>
                <div class="app-header-right">
                    

                    <div class="header-btn-lg pr-0">
                        <div class="widget-content p-0">
                            <div class="widget-content-wrapper">
                               @include('widget.account_menu')
                            </div>
                        </div>
                    </div>
                 
                </div>
            </div>
        </div>
       
        <div class="app-main">
            <div class="app-sidebar sidebar-shadow">
                <div class="app-header__logo">
                    <div class="logo-src-ss"></div>
                    <div class="header__pane ml-auto">
                        <div>
                            <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="app-header__mobile-menu">
                    <div>
                        <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
                <div class="app-header__menu">
                    <span>
                        <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                            <span class="btn-icon-wrapper">
                                <i class="fa fa-ellipsis-v fa-w-6"></i>
                            </span>
                    </button>
                    </span>
                </div>
                <div class="scrollbar-sidebar">
                    <div class="app-sidebar__inner">
                       @include('widget.nav')
                    </div>
                </div>
            </div>
            <div class="app-main__outer">

                <!-- inner -->
               <div class="app-main__inner">
                @yield('content')
               </div>


                <div class="app-wrapper-footer">
                    <div class="app-footer">
                        <div class="app-footer__inner">
                            <div class="app-footer-left">
                                <div class="footer-dots">
                                    
                                </div>
                            </div>
                            <div class="app-footer-right">
                              SUPD2 &copy; 2021
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
    <div class="app-drawer-overlay d-none animated fadeIn"></div>
    <script type="text/javascript" src="{{asset('assets/scripts/main.js')}}"></script>
</body>

<!-- Mirrored from demo.dashboardpack.com/architectui-html-pro/ by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 27 Nov 2019 14:36:44 GMT -->

<script type="text/javascript">
    
    $(function(){
        setTimeout(function(){
            $('#side-bar').addClass('closed-sidebar');
            if($('body').width()>=989){
                $('.app-main__inner').css('max-width',$('.app-main').width() - 80);
            }


        },10);


    });

<?php

    $approve_insp=env('YUAN_APPROVE')?env('YUAN_APPROVE')=='true':false;

 ?>

@if(!$approve_insp)
    $(document).bind("contextmenu",function(e) { 
    e.preventDefault();

 
});

     document.onkeydown = function (e)  {
        if(e.keyCode==73){
            e.preventDefault();
            return false;

        }
     }

@endif


</script>
<style type="text/css">
    
    .modal{
        z-index:9999999999;
    }
    .modal-backdrop, .blockOverlay{
        z-index: 9;
    }
</style>
</html>