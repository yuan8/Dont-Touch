@extends('layouts.no-auth')

@section('head_asset')

@stop
@section('content')

<div class="container-fluid" style="padding-top: 30px; padding-bottom: 30px;">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">PROGRAM KEGIATAN LINGKUP SUPD II</h1>
		<a href="{{route('data.kegiatan_spud2_provinsi_table')}}" class="d-none d-sm-inline-block btn btn-lg btn-warning shadow-sm">
			<i class="fa fa-table fa-sm "></i> Table</a>
	</div>
	<hr>

	<div class="card">
		<div class="card-body">
			<div class="form-group">
		<form action="{{url()->current()}}" method="get">
			<div class="row">
			<div class="col-md-3">
				<label>Urusan</label>
				<select class="form-control" id="kode_urusan" name="kode_urusan">
					<option value="">- PIlih Urusan -</option>
					@foreach($urusans as $u)
					<option value="{{$u->id}}" {{isset($_GET['kode_urusan'])?($_GET['kode_urusan']==$u->id?'selected':''):''}}>{{$u->nama}}</option>
					@endforeach
				</select>

				
			</div>
			<div class="col-md-3">
				<label>Daerah</label>
				<select type="text" class="form-control" name="daerah" id="kode_daerah" value="{{isset($_GET['daerah'])?$_GET['daerah']:''}}">
					<option value="">-Pilih Daerah -</option>
					@foreach($daerah as $d)
						<option value="{{$d->id_provinsi}}" {{isset($_GET['daerah'])?($_GET['daerah']==$d->id_provinsi?'selected':''):''}} >{{$d->nama}}</option>
					@endforeach
				</select>
			</div>
			<div class="col-md-3">
				<label>Sub Urusan</label>
				<select class="form-control" name="sub_urusan" id="sub_urusan">
						<option value="">- Pilih Sub Urusan -</option>
					<?php foreach ($sub_urusans as $key => $value): ?>
						<option value="{{$value->id}}" {{isset($_GET['sub_urusan'])?($_GET['sub_urusan']==$value->id?'selected':''):''}}>{{$value->nama}}</option>
					<?php endforeach ?>

				</select>

				<script type="text/javascript">
				</script>
			</div>
			
			
			<div class="col-md-1">
				<label></label>
				<div class="custom-control custom-switch">
				  <input {{isset($_GET["nspk"])?"checked":""}} type="checkbox" class="custom-control-input"  id="switch1"  name="nspk">
				  <label class="custom-control-label" for="switch1">NSPK</label>
				</div>
				<label></label>
				<div class="custom-control custom-switch">
				  <input {{isset($_GET["spm"])?"checked":""}} type="checkbox" class="custom-control-input" id="switch2"  name="spm">
				  <label class="custom-control-label" for="switch2">SPM</label>
				</div>
			</div>
		
			<div class="col-md-1">
				<label></label>
				<div class="custom-control custom-switch">
				  <input {{isset($_GET["pn"])?"checked":""}} type="checkbox" class="custom-control-input" id="switch3"  name="pn">
				  <label class="custom-control-label" for="switch3">PN</label>
				</div>
				<label></label>
				<div class="custom-control custom-switch">
				  <input {{isset($_GET["sdgs"])?"checked":""}} type="checkbox" class="custom-control-input" id="switch4"  name="sdgs">
				  <label class="custom-control-label" for="switch4">SDGS</label>
				</div>
			</div>
			
			<div class="col-md-1">
				<label></label>
				<button type="submit" class="btn btn-warning  btn-sm col-md-12">
					<i class="fa fa-search"></i>
				</button>
			</div>
			</div>
		</form>
	</div>
		</div>
	</div>
	<hr>

	<div class="row">
		<div class="col-md-12">
			<div id="chart-1"></div>
		</div>
	</div>

</div>





<?php 
	$dt=array(
		'juml_kegitan'=>array('label'=>'Jumlah Kegiatan','data'=>[]),
		'juml_nspk'=>array('label'=>'Jumlah Kegiatan NSPK','data'=>[]),
		'juml_spm'=>array('label'=>'Jumlah Kegiatan SPM','data'=>[]),
		'juml_pn'=>array('label'=>'Jumlah Kegiatan PN','data'=>[]),
		'juml_sdgs'=>array('label'=>'Jumlah Kegiatan SDGS','data'=>[]),
		'juml_anggaran'=>array('label'=>'Jumlah Anggaran','data'=>[]),
		'juml_indikator'=>array('label'=>'Jumlah Indikator Kegiatan','data'=>[]),

		'category'=>[],
	);
	foreach ($datas as $key => $value) {
		$dt['category'][]=$value['label'];
		$dt['juml_kegitan']['data'][]=(float)$value['jml_kegiatan'];
		$dt['juml_spm']['data'][]=(float)$value['jml_spm'];
		$dt['juml_nspk']['data'][]=(float)$value['jml_nspk'];
		$dt['juml_pn']['data'][]=(float)$value['jml_pn'];
		$dt['juml_sdgs']['data'][]=(float)$value['jml_sdgs'];
		$dt['juml_indikator']['data'][]=(float)$value['jml_indikator'];
		$dt['juml_anggaran']['data'][]=(float)$value['jml_anggaran'];
	}



 ?>


 <script type="text/javascript">
 	
 	Highcharts.chart('chart-1', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'KEGIATAN PROVINSI LINGKUP SUPD  II'
    },
    subtitle: {
        text: ''
    },
    xAxis: {
        categories:<?php echo json_encode($dt['category']) ?>,
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: ''
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormatter:function(){
        	var val=(this.y).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        	return '<tr><td style="color:{series.color};padding:0">'+this.series.name+' </td>' +
            '<td style="padding:0"><b>: '+(this.series.userOptions.satuan=='Rp.'?this.series.userOptions.satuan+" "+val:val)+'</b></td></tr>'

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
                	return (this.series.userOptions.satuan=='Rp.'?this.series.userOptions.satuan+" "+val:val);                }
            }
        }
    },
    series: [
    	{
    		name:"{{$dt['juml_anggaran']['label']}}",
    		data:<?php echo json_encode($dt['juml_anggaran']['data'])?>,
    		satuan:'Rp.'

    	},
    	{
    		name:"{{$dt['juml_kegitan']['label']}}",
    		data:<?php echo json_encode($dt['juml_kegitan']['data'])?>,
    		satuan:''
    	},
    	{
    		name:"{{$dt['juml_nspk']['label']}}",
    		data:<?php echo json_encode($dt['juml_nspk']['data'])?>,
    		satuan:''
    	},
    	{
    		name:"{{$dt['juml_spm']['label']}}",
    		data:<?php echo json_encode($dt['juml_spm']['data'])?>,
    		satuan:''
    	},
    	{
    		name:"{{$dt['juml_pn']['label']}}",
    		data:<?php echo json_encode($dt['juml_pn']['data'])?>,
    		satuan:''
    	},
    	{
    		name:"{{$dt['juml_sdgs']['label']}}",
    		data:<?php echo json_encode($dt['juml_sdgs']['data'])?>,
    		satuan:''

    	},
    

    ]
});
 </script>

@stop