@extends('layouts.no-auth')

@section('head_asset')

@stop
@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-ticket icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>ANGGARAN
                <div class="page-title-subheading">
                  <!-- This is an example dashboard created using build-in elements and components. -->
                </div>
            </div>
        </div>
        <!-- <div class="page-title-actions">
            <a href="{{route('data.kegiatan_spud2_provinsi_chart')}}" class="btn-shadow mr-3 btn btn-info" >
                <span><i class="fa fa-bar-chart fa-sm "></i></span> Chart
            </a>
           
        </div> -->    
    </div>
</div>
<div class="container-fluid" style="padding-top: 10px; padding-bottom: 10px;">
	<div class="row">
		<div class="col-xl-3 col-md-6 mb-4">
          <div class="card  card-shadow-warning border-warning card-btm-border shadow  py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold  text-uppercase mb-1">Jumlah Provinsi</div>
                  <div class="h6 mb-0 text-gray-800">
                    {{number_format($data_head['count']['daerah'],0,',','.')}}
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
                  <div class="text-xs font-weight-bold  text-uppercase mb-1">Jumlah Bidang Urusan</div>
                  <div class="h6 mb-0 text-gray-800">
                    {{number_format($data_head['count']['urusan'],0,',','.')}}

                    
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
                  <div class="text-xs font-weight-bold  text-uppercase mb-1">Jumlah Anggaran</div>
                  <div class="h6 mb-0 text-gray-800">
                    Rp. {{number_format($data_head['count']['anggaran'],0,',','.')}}
                    
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
                  <div class="text-xs font-weight-bold  text-uppercase mb-1">Jumlah Kegiatan</div>
                  <div class="h6 mb-0 text-gray-800">
                    {{number_format($data_head['count']['kegiatan'],0,',','.')}}
                    
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
		<div class="col-xl-12 col-md-6 mb-4">
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
                <div id="chart" class="chart-cn"></div>
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
    $anggaran=[];
    $kegiatan=[];

    $anggaran2=[];
    $kegiatan2=[];

    foreach ($data_head['data'] as $key => $value) {
        $categories[]=$value['nama'];
        $anggaran[]=$value['jumlah_anggaran'];
        // $kegiatan[]=$value['jumlah_kegiatan'];

        foreach ($value['urusan'] as $k=> $u) {
              $categories2[$k]=$u['nama'];
              if(!isset($anggaran2[$k])){
                $anggaran2[$k]=0;
              }
             

              $anggaran2[$k]+=$u['jumlah_anggaran'];

              // $kegiatan2[$k]+=$u['jumlah_kegiatan'];  
        }


    }

    $anggaran2=array_values($anggaran2);
    $categories2=array_values($categories2);
    // $kegiatan2=array_values($kegiatan2);



   ?>
Highcharts.chart('chart', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'JUMLAH ANGGARAN KEGIATAN PER PROVINSI'
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
            '<td style="padding:0"><b>: Rp. '+val+'</b></td></tr>'

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
        name: 'Angaran',
        data: <?php echo json_encode($anggaran) ?>

    }
    ]
});


Highcharts.chart('chart-2', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'JUMLAH ANGGARAN KEGIATAN PER BIDANG URUSAN'

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
            '<td style="padding:0"><b>: Rp. '+val+'</b></td></tr>'

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
        	name: 'Angaran',
        	data: <?php echo json_encode($anggaran2) ?>

   		 }
    ]
});


Highcharts.chart('pie', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'PEMBIYAYAAN KEGIATAN (NSPK,SPM,PN,SDGS)'
    },
     subtitle: {
        text: 'SUMBER DATA RKPD'
    },
     tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormatter:function(){
          var val=(this.y).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
          return '<tr><td style="color:{series.color};padding:0">'+this.series.name+' </td>' +
            '<td style="padding:0"><b>: Rp. '+val+'</b></td></tr>'

        },

        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                formatter: function(){
            	  var val=(this.y).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                  return this.key+"<br>Rp. "+val;                
              }
            



            }
        }
    },

    <?php 
    $d_pie=[];
    foreach ($data_pie as $key => $value) {
      $d_pie[]=array(
        'name'=>strtoupper(str_replace('_',' ',$key)),
        'y'=>(int) ($value==null?0:$value)
      );
    }

    ?>

    series: [{
        name: 'ANGGARAN',
        colorByPoint: true,
        data: <?php echo json_encode($d_pie); ?>
    }]
});
</script>
@stop