@extends('layouts.no-auth')

@section('head_asset')

@stop
@section('content')
<div class="container-fluid" style="padding-top: 30px;">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800">PROGRAM KEGIATAN LINGKUP SUPD II</h1>
	<a href="{{route('data.kegiatan_spud2_provinsi_chart')}}" class="d-none d-sm-inline-block btn btn-lg btn-warning shadow-sm">
		<i class="fa fa-bar-chart fa-sm "></i> Chart</a>
</div>
<hr>

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
		
		<!-- <div class="col-md-3">
			<label>Program</label>
			<select class="form-control" name="kode_program" id="program_pro">
					<option value="">- Pilih Program -</option>

				<?php foreach ($program_provinsi as $key => $value): ?>
					<option value="{{$value->kode}}" {{isset($_GET['kode_program'])?($_GET['kode_program']==$value->kode?'selected':''):''}}>{{$value->nomenklatur}}</option>
				<?php endforeach ?>

			</select>

			<script type="text/javascript">
				$('#program_pro').select2();
				$('#kode_urusan').select2();
				$('#sub_urusan').select2();
				$('#kode_daerah').select2();
			</script>
		</div>
		<div class="col-md-3">
			<label>Kegiatan</label>
			<select type="text" class="form-control" name="kode_kegiatan" id="kegiatan_pro" value="{{isset($_GET['kegiatan'])?$_GET['kegiatan']:''}}">

			</select>
		</div> -->
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

<div class="card card-border-top-warning">
	<div class="card-header">
		<p>{{$data_paginate->total()}} Data</p>
	</div>
	<div class="card-body table-responsive">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th rowspan="2" colspan="4">
						Jenis
					</th>
					<th rowspan="3">Daerah</th>
					<th rowspan="3">Sub Urusan</th>

					<th rowspan="3">Program</th>
					<th rowspan="3">Kegiatan</th>
					<th rowspan="3">Angaran</th>

					<th rowspan="3">Indikator</th>
					<th colspan="2">Target</th>
					<th rowspan="3">OPD Pelaksana</th>
				</tr>
			
				<tr>
				
					
					<th>Awal Perencanaan</th>
					<th>Ahir Perencanaan</th>
				</tr>
				<tr>
					<th>NSPK</th>
					<th>SPM</th>
					<th>PN</th>
					<th>SDGS</th>
					
					<th>Tahun {{session('focus_tahun')}}</th>
					<th>Tahun {{session('focus_tahun')+1}}</th>
				</tr>
			</thead>
			<tbody>
				@foreach($datas as $d)
				<tr>
					<td class="text-center">
						<!-- <div class="custom-control custom-switch">
						  <input onchange="update_taging_supd_2(this)" type="checkbox" id_dpk={{$d['id']}}  {{$d['nspk']==true?'checked':''}} class="custom-control-input" id="c-1-{{$d['id']}}" name="nspk">
						  <label class="custom-control-label" for="c-1-{{$d['id']}}">NSPK</label>
						</div> -->

						@if($d['nspk'])
							<i style="color:#f6c23e; " class=" fa fa-check"></i>
						@endif

					</td>
					<td class="text-center">
						<!-- <div class="custom-control custom-switch">
						  <input onchange="update_taging_supd_2(this)" type="checkbox" id_dpk={{$d['id']}}  {{$d['nspk']==true?'checked':''}} class="custom-control-input" id="c-1-{{$d['id']}}" name="nspk">
						  <label class="custom-control-label" for="c-1-{{$d['id']}}">NSPK</label>
						</div> -->

						@if($d['spm'])
							<i style="color:#f6c23e; " class=" fa fa-check"></i>
						@endif

					</td>
					<td class="text-center">
						<!-- <div class="custom-control custom-switch">
						  <input onchange="update_taging_supd_2(this)" type="checkbox" id_dpk={{$d['id']}}  {{$d['nspk']==true?'checked':''}} class="custom-control-input" id="c-1-{{$d['id']}}" name="nspk">
						  <label class="custom-control-label" for="c-1-{{$d['id']}}">NSPK</label>
						</div> -->

						@if($d['pn'])
							<i style="color:#f6c23e; " class=" fa fa-check"></i>
						@endif

					</td>
					<td class="text-center">
						<!-- <div class="custom-control custom-switch">
						  <input onchange="update_taging_supd_2(this)" type="checkbox" id_dpk={{$d['id']}}  {{$d['nspk']==true?'checked':''}} class="custom-control-input" id="c-1-{{$d['id']}}" name="nspk">
						  <label class="custom-control-label" for="c-1-{{$d['id']}}">NSPK</label>
						</div> -->

						@if($d['sdgs'])
							<i style="color:#f6c23e; " class=" fa fa-check"></i>
						@endif

					</td>
					<!-- <td>
						<div class="custom-control custom-switch">
						  <input onchange="update_taging_supd_2(this)" type="checkbox" id_dpk={{$d['id']}}  {{$d['spm']==true?'checked':''}} class="custom-control-input" id="c-2-{{$d['id']}}" name="spm">
						  <label class="custom-control-label" for="c-2-{{$d['id']}}">NSPK</label>
						</div>
					</td>
					<td>
						<div class="custom-control custom-switch">
						  <input onchange="update_taging_supd_2(this)" type="checkbox" id_dpk={{$d['id']}}  {{$d['pn']==true?'checked':''}} class="custom-control-input" id="c-3-{{$d['id']}}" name="pn">
						  <label class="custom-control-label" for="c-3-{{$d['id']}}">PN</label>
						</div>
					</td>
					<td>
						<div class="custom-control custom-switch">
						  <input onchange="update_taging_supd_2(this)" type="checkbox" id_dpk={{$d['id']}}  {{$d['sdgs']==true?'checked':''}} class="custom-control-input" id="c-4-{{$d['id']}}" name="sdgs">
						  <label class="custom-control-label" for="c-4-{{$d['id']}}">SGDS</label>
						</div>
					</td> -->
					<td>{{$d['daerah']}}</td>
					<td>{{$d['sub_urusan']}}</td>
					<td>{{$d['program']}}</td>
					<td>{{$d['kegiatan']}}</td>
					<td>Rp. {{number_format($d['anggaran'],2,',','.')}}</td>
					<td colspan="3"></td>

	
					<td>{!!nl2br($d['pelaksana'])!!}</td>

				</tr>
				@foreach($d['indikator'] as $i)
					<tr>
						<td colspan="9"></td>
						<td>{{$i['indikator']}}</td>
						<td>{{$i['target_awal']}} {{$i['satuan']}}</td>
						<td>{{$i['target_ahir']}} {{$i['satuan']}}</td>
						<td></td>
					</tr>
				@endforeach
				@endforeach
			</tbody>
		</table>
		{{$data_paginate->links()}}
	</div>
</div>



<script type="text/javascript">
	

	$('#program_pro').on('change',function(){

		var data={'kode_program':this.value,'pro':true};

		CNDSSApi.post('{{route('nomen.program.kegiatan')}}',data).then(function(response){
			var dom='';
			var data=response.data;
			var data_kode_kegiatan="{{(isset($_GET['kode_kegiatan'])?($_GET['kode_kegiatan']):'')}}";

			dom+='<option value=""> - Hanya Program - </option>';
			for (var i =0; i < data.length ; i++) {
				selected=data[i]['kode']==data_kode_kegiatan;
				if(selected){
					selected = 'selected';
					console.log('selected');
					console.log(data[i]['kode']);

				}

				dom+='<option value="'+data[i].kode+'" '+selected+' >'+data[i].nomenklatur+'</option>';
			}

			$('#kegiatan_pro').html(dom);
			$('#kegiatan_pro').select2();
			$('#kegiatan_pro').trigger('change');

		});
	});

	$('#program_pro').trigger('change');

	var data_kode_kegiatan="{{(isset($_GET['kode_kegiatan'])?($_GET['kode_kegiatan']):'')}}";

	setTimeout(function(){
		if(data_kode_kegiatan!=""){
			
			// console.log($('#kegiatan_pro').find('option[value='+data_kode_kegiatan+']'));
			// $('#kegiatan_pro').find('option[value='+data_kode_kegiatan+']').attr('selected');
			$('#kegiatan_pro').val(data_kode_kegiatan);

			console.log('ss');
		}
	},3000);

	function update_taging_supd_2(dom){
		var id=$(dom).attr('id_dpk');
		var value=$(dom).prop('checked');
		var key=$(dom).attr('name');
		var data={};
		data[key]=value;
		data={'data':data};
		CNDSSApi.post(('form/f5/pkl-sipd-2/provinsi/update/'+id),data).then(function(response){

			console.log(response);

		});
		
		
	}
</script>

</div>
@stop