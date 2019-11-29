@extends('layouts.no-auth')

@section('head_asset')

@stop
@section('content')
<div class="container-fluid" style="padding-top: 10px; padding-bottom: 10px;">
	<div class="row">
		<div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold  text-uppercase mb-1">Jumlah Provinsi</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">
                    {{number_format($data_head['count']['daerah'],0,',','.')}}
                  </div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-calendar fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold  text-uppercase mb-1">Jumlah Bidang Urusan</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">
                    {{number_format($data_head['count']['urusan'],0,',','.')}}

                    
                  </div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-calendar fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold  text-uppercase mb-1">Jumlah Program</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">
                    {{number_format($data_head['count']['program'],0,',','.')}}
                    
                  </div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-calendar fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold  text-uppercase mb-1">Jumlah Kegiatan</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">
                    {{number_format($data_head['count']['kegiatan'],0,',','.')}}
                    
                  </div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-calendar fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>

	</div>

	<div class="row">
		<div class="col-xl-6 col-md-6 mb-4">
          <div class="card card-border-top-warning shadow h-100 py-2">
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
                <div id="chart"></div>
              </div>
            </div>
          </div>
    </div>

    <div class="col-xl-6 col-md-6 mb-4">
          <div class="card card-border-top-warning shadow h-100 py-2">
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
                <div id="chart-2"></div>
              </div>
            </div>
          </div>
    </div>

	</div>

  <div class="row">
    
    <div class="col-xl-12 col-md-12 mb-4">
      <div class="card card-border-top-warning shadow h-100 py-2">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-black-400"> </h6>
                  <div class=" no-arrow">
                    <a class=" btn btn-sm btn-warning" href="#">
                      <i class="fas fa-info fa-sm fa-fw text-black-400"></i> Info
                    </a>
                    
                  </div>
                </div>
            <div class="card-body">
              <div class="row  justify-content-md-center no-gutters align-items-center">
                <div class="col-md-offset-3 col-md-6">
                  <div class="row">
                    <div id="pie"></div>
    
                  </div>
                </div>
              </div>
            </div>
          </div>
      
    </div>
  </div>

</div>

<script type="text/javascript">
  <?php 
    $categories=[];
    $categories2=[];

    $urusan=[];
    $sub_urusan=[];
    $program=[];
    $kegiatan=[];

    $program2=[];
    $kegiatan2=[];

    foreach ($data_head['data'] as $key => $value) {
        $categories[]=$value['nama'];
        $program[]=$value['jumlah_program'];
        $kegiatan[]=$value['jumlah_kegiatan'];

        foreach ($value['urusan'] as $k=> $u) {
              $categories2[$k]=$u['nama'];
              if(!isset($program2[$k])){
                $program2[$k]=0;
              }
              if(!isset($kegiatan2[$k])){
                $kegiatan2[$k]=0;
              }

              $program2[$k]+=$u['jumlah_program'];

              $kegiatan2[$k]+=$u['jumlah_kegiatan'];  
        }


    }

    $program2=array_values($program2);
    $categories2=array_values($categories2);
    $kegiatan2=array_values($kegiatan2);



   ?>
Highcharts.chart('chart', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'JUMLAH PROGRAM, KEGIATAN PER PROVINSI'
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
        name: 'Program',
        data: <?php echo json_encode($program) ?>

    }, {
        name: 'Kegiatan',
        data: <?php echo json_encode($kegiatan) ?>

    }]
});


Highcharts.chart('chart-2', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'JUMLAH PROGRAM, KEGIATAN PER BIDANG URUSAN'

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
        name: 'Program',
        data: <?php echo json_encode($program2) ?>

    }, {
        name: 'Kegiatan',
        data: <?php echo json_encode($kegiatan2) ?>

    }]
});


Highcharts.chart('pie', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'TAGGING KEGIATAN NSPK,SPM,PN,SDGS'
    },
     subtitle: {
        text: 'SUMBER DATA RKPD'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.y}</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.y}'
            }
        }
    },

    <?php 
    $d_pie=[];
    foreach ($data_pie as $key => $value) {
      $d_pie[]=array(
        'name'=>strtoupper(str_replace('_',' ',$key)),
        'y'=>$value
      );
    }

    ?>

    series: [{
        name: 'Brands',
        colorByPoint: true,
        data: <?php echo json_encode($d_pie); ?>
    }]
});
</script>
@stop