@extends('layouts.layout_nuwas')

@section('head_asset')
    <script src="{{asset('js/jq.js')}}" charset="utf-8"></script>
    <script src="{{asset('admin_dist/js/highmaps.js')}}"></script>
    <script src="{{asset('js/treer9.js')}}" charset="utf-8"></script>
    <script src="{{asset('js/gl.clouds.js')}}" charset="utf-8"></script>
<script src="{{asset('mp/mp.id.js?v=1')}}" charset="utf-8"></script>



@stop
@section('content')
<script type="text/javascript">
     <?php
    $data=[];
    $cl=['red','green','blue','purple'];
    $max_anggaran=0;
    $min_anggaran=9999999999999999999999999999999999999999999;
    $total_anggran=0;

        foreach ($data_provinsi as $key => $value) {
            if($max_anggaran<$value->jumlah_anggaran){
                $max_anggaran=$value->jumlah_anggaran;

            }

            $total_anggran+=$value->jumlah_anggaran;

            if($min_anggaran>$value->jumlah_anggaran){
                $min_anggaran=$value->jumlah_anggaran;
                $d_pro=$value;
            }

            
        }

     //    $frex=$max_anggaran-$min_anggaran;
     //    $frex=$frex/3;

        $frek=[];
        $key_frex=-1;
        $frex_rank='';
        $frex_max=0;
        $frex_min=0;

        foreach ($data_provinsi as $key => $value) {
             # code...
            $random_keys=array_rand($cl,2);

            $d=[''.$value->kode_daerah,$value->color,$value->jumlah_kegiatan,(double) $value->jumlah_anggaran,$value->tahun,(($value->jumlah_anggaran)/$total_anggran)*100];

            if((count($frek)==0)||($frex_rank!=$value->color)){
                $key_frex+=1;
                $frex_max=0;
                $frex_min=99999999999999999;
                $frex_rank=$value->color;
               
            }

            if($frex_max<$value->jumlah_anggaran){
                
                $frek[$key_frex][0]=$value->jumlah_anggaran;
                if(!isset($frek[$key_frex][1])){
                    $frek[$key_frex][1]=$value->jumlah_anggaran;
                    $frex_min=$value->jumlah_anggaran;

                }
                $frex_max=$value->jumlah_anggaran;

            }



            if($frex_min>$value->jumlah_anggaran){
               
                $frek[$key_frex][1]=$value->jumlah_anggaran;
                if(!isset($frek[$key_frex][0])){
                    $frek[$key_frex][0]=$value->jumlah_anggaran;
                    $frex_max=$value->jumlah_anggaran;

                }
                $frex_min=$value->jumlah_anggaran;

            }



            $data[]=$d;
        }


     ?>
</script>

<style type="text/css">
	.drop-menu{
		width:calc(100% - 20px);
		margin-left: 20px;
	}
	.br-primary{
		border-left: 1px solid blue!Important;
	}
	.br-warning{
		border-left: 1px solid yellow!Important;
	}

	.br-success{
		border-left: 1px solid green!Important;
	}
	.listing-menu .drop-menu{
		margin-top: 3px;
	}
</style>
<style type="text/css">
	 .app-theme-white.app-container{
            background-color:#bd9010ba;
            /*background-color: #c2c8cc;*/
        }
	   body{
            background-image: url('{{asset('ass_img/giphy.gif')}}')!important;
             /*background-size: auto auto;*/
        }
</style>

<div id="container_map" style="z-index: 9999; width: 100%; position: relative;"></div>
<div class="row justify-content-md-center no-gutter legend" >
     <div class="col col-md-auto bg bg-primary color-white">
    <small>Legenda</small>
        
       <p>Jumlah Anggaran</p>

    </div>
    <div class="col col-md-auto bg bg-" style="background-color:#00a65a; ">
        <small>Prinkat I</small>
        <p>{{number_format($frek[0][0],0,',','.')}} - {{number_format($frek[0][1],0,',','.')}}</p>

    </div>
    <div class="col col-md-auto bg bg-" style="background-color:#f39c12; ">
        <small>Prinkat II</small>

       
        <p>{{number_format($frek[1][0],0,',','.')}} - {{number_format($frek[1][1],0,',','.')}}</p>
        
    </div>
    <div class="col col-md-auto bg bg-" style="background-color:#dd4b39; ">
        <small>Prinkat III</small>

        
        <p>{{number_format($frek[2][0],0,',','.')}} - {{number_format($frek[2][1],0,',','.')}}</p>
        
    </div>

</div>
<div id="chart-container" class="col"></div>

<style type="text/css">

</style>
<script type="text/javascript">

   
  var data=<?php echo json_encode(($data)); ?>;

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
    console.log(this.id_daerah);

                        getChart([['Daerah','daerah',this.id_daerah],['Program','program','DB_kode_program']],{kode_daerah:this.id_daerah},this.id_daerah);
                    }
                }
            }
        }
    },
    series: [{
        data:  data,
        keys: ['id_daerah', 'color','value','anggaran','tahun','persentase_anggaran'],
        name: 'Provinsi',
        joinBy: 'id_daerah',
        tooltip: {
            headerFormat: '<b>{point.key}</b><br><table>',
	        pointFormatter:function(){
	          var val=(this.anggaran).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
	          return '<tr><td style="color:{series.color};padding:0">Anggaran </td>' +
	            '<td style="padding:0"><b>: Rp. '+ val+'</b></td></tr><br>'+
	            '<tr><td>Persentase Anggaran</td><td><b>: '+this.persentase_anggaran.toFixed(2)+'%</b><td></tr>'
	        },

	        footerFormat: '</table>',
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
    }],
     
});

$('.highcharts-container,.highcharts-root').css('width','100%');



function getChart(map,where,id=0){
    $.post('{{url("api/nuwas/get/chart")}}',{where:where,map:map,id_daerah:id},function(res){

        $('#chart-container').html(res);

        $(window).scrollTop(300);

    });


}

</script>


<style type="text/css">
	 {
		width: 100% !important;
	}
</style>
<style type="text/css">
    .legend p,.legend small{
        color: #222;
    }


</style>
@stop