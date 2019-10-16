@extends('layouts.layout-maps')

@section('title', 'SUPD2')

@section('head-asset')
<script type="text/javascript" src="{{asset('mp/mp.id.js?v='.date('h:i:s'))}}"></script>

@stop

@section('content')
<div class="row">
  <div class="col-md-12 map" id="container_map" style="min-height:100vh">

  </div>

</div>



<script type="text/javascript">

var data=[['01','#CA3333','1',[{'nama_urusan':'lala','tahun':2018}]]];

	Highcharts.mapChart('container_map', {
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
                        console.log(this);
                         // window.location.href = "http://101.255.10.225/home/detail/"+this.x;
                    }
                }
            }
        }
    },
    series: [{
        data:  data,
        keys: ['id_daerah', 'color','value','urusan'],
        name: 'Provinsi',
        joinBy: 'id_daerah',
        tooltip: {
            headerFormat: '',
            // pointFormat: '<b>{point.name}</b><hr><br>LAJU PERUMBUHAN EKONOMI : {point.lpe} {point.simbol_lpe} <br>TINGKAT PENGANGGURAN TERBUKA : {point.tpt} {point.simbol_tpt}<br>INDEKS PERTUMBUHAN MANUSIA : {point.ipm}  {point.simbol_ipm} <br>GINI RASIO : {point.gini}  {point.simbol_gini}<br>TINGKAT KEMISKINAN : {point.miskinlu}  {point.simbol_miskin}'
        },
        dataLabels: {
                enabled: true,
                format: '{point.name}',
                 color: '#fff',
                 style: {
                            fontSize: 8,
                            font: '11px'
                        },
            },
        states: {
            hover: {
                color: 'blue'
            }
        }
    }]
});

</script>

@stop
