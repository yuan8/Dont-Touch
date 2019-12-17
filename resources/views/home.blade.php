@extends('layouts.layout-map')

@section('head_asset')
<script src="{{asset('mp/mp.id.js?v=1')}}" charset="utf-8"></script>
@stop
@section('content')


<div class="row">
  <div class="col-md-12">


    <div id="container" class="align-items-center" style="width:calc(100vw - 60px); margin:30px; margin-top:80px; min-height:calc(100vh - 15vh);">

    </div>
    <div class="menu-dashboard-input" style="bottom:15px; right:30px; position:fixed;z-index:99;">
        <a href="{{route('fs.index')}}" class="btn btn shadows btn-circle btn-lg text-gray-900 bg-gray-100 border-primary"><b>
            +
        </b> </a>
    </div>
  </div>


</div>

<script type="text/javascript">

    <?php
    $data=[];
    $cl=['red','green','blue','purple'];
        foreach ($data_provinsi as $key => $value) {
             # code...
            $random_keys=array_rand($cl,2);
            $data[]=[''.$value->kode_daerah,$cl[$random_keys[0]],$value->jumlah_kegiatan,$value->jumlah_anggaran];
        }

     ?>
  var data=<?php echo json_encode(($data)); ?>;

  Highcharts.mapChart('container', {
    chart: {
        map: 'idn',
        backgroundColor:'rgba(255, 255, 255, 0)',
    },

    title: {
        text: ''
    },


    mapNavigation: {
        enabled: true,
        buttonOptions: {
            verticalAlign: 'top'
        }
    },

    legend: {
        enabled: false
    },

    credits: {
        enabled: false
    },
     plotOptions:{
        series:{
            point:{
                events:{
                    click: function(){
                        //get_detail_info(this.x);
                        //alert(this.x);
                         // window.location.href = "http://101.255.10.225/home/detail/"+this.x;
                    }
                }
            }
        }
    },
    series: [{
        data:  data,
        keys: ['id_daerah', 'color','value','anggaran'],
        name: 'Provinsi',
        joinBy: 'id_daerah',
        tooltip: {
            headerFormat: '{point.name}',
            pointFormat: '<b>{point.name}</b><hr><br> {point.value} Kegiatan <br> Rp. {point.anggaran}'
        },
        dataLabels: {
                enabled: true,
                format: '{point.name}',
                 color: '#fff',
                 style: {
                            fontSize: 12,
                            font: '11px Trebuchet MS, Verdana, sans-serif'
                        },
            },
        states: {
            hover: {
                color: '#BADA55'
            }
        }
    }]
});



</script>

@endsection
