@extends('layouts.no-auth')

@section('head_asset')

@stop
@section('content')

  <?php 
    $categories=[];
    $categories2=[];

   

    $nspk=[];
    $spm=[];
    $pn=[];
    $sdgs=[];

    $nspk2=[];
    $spm2=[];
    $pn2=[];
    $sdgs2=[];
    $nspk_glob=0;
    $spm_glob=0;
    $pn_glob=0;
    $sdgs_glob=0;



    foreach ($data_head['data'] as $key => $value) {
        $categories[]=$value['nama'];
        $nspk[]=$value['jumlah_nspk'];
        $spm[]=$value['jumlah_spm'];
        $pn[]=$value['jumlah_pn'];
        $sdgs[]=$value['jumlah_sdgs'];

        foreach ($value['urusan'] as $k=> $u) {
              $categories2[$k]=$u['nama'];
              
              // $nspk2[$k]=((!isset($nspk2[$k]))?0:$nspk2[$k]);
              // $spm2[$k]=(!isset($spm[$k])?0:$spm2[$k]);
              // $pn2[$k]=((!isset($pn[$k]))?0:$pn2[$k]);
              // $sdgs2[$k]=(!isset($sdgs2[$k])?0:$sdgs2[$k]);

              if(!isset($pn2[$k])){
                $pn2[$k]=0;
              }
              if(!isset($spm2[$k])){
                $spm2[$k]=0;
              }
              if(!isset($nspk2[$k])){
                $nspk2[$k]=0;
              }
              if(!isset($sdgs2[$k])){
                $sdgs2[$k]=0;
              }

              $nspk2[$k]+=$u['jumlah_nspk'];
              $spm2[$k]+=$u['jumlah_spm'];
              $pn2[$k]+=$u['jumlah_pn'];
              $sdgs2[$k]+=$u['jumlah_sdgs']; 

              $nspk_glob+=$u['jumlah_nspk'];
              $spm_glob+=$u['jumlah_spm'];
              $pn_glob+=$u['jumlah_pn'];
              $sdgs_glob+=$u['jumlah_sdgs'];
        }


    }


    $categories2=array_values($categories2);
    $nspk2=array_values($nspk2);
    $spm2=array_values($spm2);
    $sdgs2=array_values($sdgs2);
    $pn2=array_values($pn2);


   ?>
  <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-graph1 icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>NSPK SPM PN SDGS PER PROVINSI
                    <div class="page-title-subheading">
                      <!-- This is an example dashboard created using build-in elements and components. -->
                    </div>
                </div>
            </div>
            <!-- <div class="page-title-actions">
                <a href="{{route('data.kegiatan_spud2_provinsi_table')}}" class="btn-shadow mr-3 btn btn-info" >
                    <span><i class="fa fa-table fa-sm "></i></span> Table
                </a>
               
            </div>     -->
        </div>
    </div>

<div class="container-fluid" style="padding-top: 10px; padding-bottom: 10px;">
	<div class="row">
		<div class="col-xl-3 col-md-6 mb-4">
          <div class="card  card-shadow-warning border-warning card-btm-border shadow  py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold  text-uppercase mb-1">Jumlah NSPK</div>
                  <div class="h8 mb-0text-gray-800">
                    {{number_format($nspk_glob,0,',','.')}}
                  </div>
                </div>
                <div class="col-auto">
                  <i class="pe-7s-medal fa-2x text-primary"></i>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card  card-shadow-warning border-warning card-btm-border shadow  py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold  text-uppercase mb-1">Jumlah SPM</div>
                  <div class="h8 mb-0text-gray-800">
                     {{number_format($spm_glob,0,',','.')}}

                    
                  </div>
                </div>
                <div class="col-auto">
                  <i class="pe-7s-medal fa-2x text-success"></i>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card  card-shadow-warning border-warning card-btm-border shadow  py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold  text-uppercase mb-1">Jumlah PN</div>
                  <div class="h8 mb-0text-gray-800">
                    {{number_format($pn_glob,0,',','.')}}
                    
                  </div>
                </div>
                <div class="col-auto">
                  <i class="pe-7s-medal fa-2x text-warning"></i>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card  card-shadow-warning border-warning card-btm-border shadow  py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold  text-uppercase mb-1">Jumlah SDGS</div>
                  <div class="h8 mb-0text-gray-800">
                    {{number_format($sdgs_glob,0,',','.')}}
                    
                  </div>
                </div>
                <div class="col-auto">
                  <i class="pe-7s-medal fa-2x text-info"></i>
                  
                </div>
              </div>
            </div>
          </div>
        </div>

	</div>

	<div class="row">
		<div class="col-xl-12 col-md-12 mb-4">
          <div class="card card-border-top-warning shadow  py-2">
          	<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-black-400"> </h6>
                  <div class=" no-arrow">
                    <a class=" btn btn-sm btn-warning" href="#">
                      <i class="fas fa-info fa-sm fa-fw text-black-400"></i> Info
                    </a>
                    
                  </div>
                </div>
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div id="chart" style="min-width: 100%"></div>
              </div>
            </div>
          </div>
    </div>

    <div class="col-xl-12 col-md-12 mb-4">
          <div class="card card-border-top-warning shadow  py-2">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-black-400"> </h6>
                  <div class=" no-arrow">
                    <a class=" btn btn-sm btn-warning" href="#">
                      <i class="fas fa-info fa-sm fa-fw text-black-400"></i> Info
                    </a>
                    
                  </div>
                </div>
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div id="chart-2" class="chart-cn"></div>
              </div>
            </div>
          </div>
    </div>

	</div>

  

</div>

<script type="text/javascript">

Highcharts.chart('chart', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'JUMLAH NSPK,SPM,PN,SDGS PER PROVINSI'
    },
    subtitle: {
        text: 'SUMBER DATA RKPD'

    },
    xAxis: {

        categories: <?php echo json_encode($categories) ?>,
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'JUMLAH'
        }
    },
     tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormatter:function(){
          var val=(this.y).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
          return '<tr><td style="color:{series.color};padding:0">'+this.series.name+' </td>' +
            '<td style="padding:0"><b>: '+val+'</b></td></tr>'

        },

        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        },
         series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                formatter: function(){
              var val=(this.y).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                  return val;                }
            }
        }
    },
    series: [
     {
        name: 'NSPK',
        data: <?php echo json_encode($nspk) ?>

    }, {
        name: 'SPM',
        data: <?php echo json_encode($spm) ?>

    },
    {
        name: 'PN',
        data: <?php echo json_encode($pn) ?>

    },
    {
        name: 'SDGS',
        data: <?php echo json_encode($sdgs) ?>

    }]
});

Highcharts.chart('chart-2', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'JUMLAH NSPK,SPM,PN,SDGS PER PROVINSI'
    },
    subtitle: {
        text: 'SUMBER DATA RKPD'

    },
    xAxis: {

        categories: <?php echo json_encode($categories2) ?>,
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'JUMLAH'
        }
    },
     tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormatter:function(){
          var val=(this.y).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
          return '<tr><td style="color:{series.color};padding:0">'+this.series.name+' </td>' +
            '<td style="padding:0"><b>: '+val+'</b></td></tr>'

        },

        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        },
         series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                formatter: function(){
              var val=(this.y).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                  return val;                }
            }
        }
    },
    series: [
     {
        name: 'NSPK',
        data: <?php echo json_encode($nspk2) ?>

    }, {
        name: 'SPM',
        data: <?php echo json_encode($spm2) ?>

    },
    {
        name: 'PN',
        data: <?php echo json_encode($pn2) ?>

    },
    {
        name: 'SDGS',
        data: <?php echo json_encode($sdgs2) ?>

    }]
});

</script>
@stop