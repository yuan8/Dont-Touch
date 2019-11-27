@extends('layouts.master2')

@section('head_asset')

@stop
@section('content')
<a href="{{route('fs.f7.identifikasi.integrasi_provinsi',['id_link'=>$id_link,'q'=>$daerah->nama])}}" class="btn btn-info btn-sm btn-circle"> <i class="fa fa-arrow-left"></i> </a>
<small> INTEGRASI PROVINSI</small>
<hr>
<h5>TAMBAH TARGET  {{$daerah->nama}}</h5> 
<hr>

<div class="card ">
	<div class="card-body">
		<table class="table table-stripted table-bordered">
				<thead>
					<tr>
						<th>Prioritas Nasional</th>
						<th>Target</th>
						<th>Lokus</th>
						<th>Pelaksana</th>
					</tr>	
				</thead>
				<tbody>

					<tr>
						<td>
							<p><span class="dot lev1"></span>{{$parent['pp']}} <b>(PP)</b>
								<ptab class="ptab">
									<span class="dot lev2"></span>{{$parent['pn']}} <b>(PN)</b>
									<ptab class="ptab"><span class="dot lev3"></span>{{$parent['kp']}} <b>(KP)</b></ptab>
								</ptab>
							</p>
						</td>
						<td>
							{{$parent['target']}}
						</td>
						<td>
							{{$parent['lokus']}}
						</td>
						<td>
							{{$parent['pelaksana']}}
						</td>
					</tr>
				</tbody>		
		</table>

		
	</div>
</div>

<div class="card " style="margin-top: 20px; margin-bottom: 20px">
	<div class="card-body">
		<div class="row">
			<div class="col-md-12">
				<hr>
			</div>
			<div class="col-md-6">
							   
			        <div class="row">
			        	<div class="col-md-12">
			        		<div class="form-group">
					        	<label>Program</label>
					        	<select id="program_pro" class="form-control col-md-12" style="width:100%;">
				        			@foreach($program_provinsi as $program)
				        				<option value="{{$program->kode}}">{{$program->nomenklatur}}</option>
				        			@endforeach
					        	</select>
			        	
					        	
						        </div>

						        <div id="container_kegiatan_pro">
					        		<label>Kegiatan</label>
						        	<select id="kegiatan_pro" class="form-control col-md-12" style="width:100%;">
					        			
					        		</select>
			        	
						        </div>
						        <br>
						        <div id="container_sub_kegiatan_pro">
						        	<label>Sub Kegiatan</label>
						        	<select id="sub_kegiatan_pro" name="sub_urusan_provinsi" class="form-control col-md-12" required="" style="width:100%;">
					        			
					        		</select>
						        </div>
			        	</div>
			        </div>			     
			</div>
			<div class="col-md-6 ">
				<div class="form-group">
					<label>Indikator</label>
					<textarea class="form-control" cols="6" rows="5" style="min-height: 160px!important"></textarea>
				</div>

				<div class="input-group">
					 <div class="input-group-prepend">
					    <span class="input-group-text" id="">Target</span>
					  </div>
					  <input type="number" class="form-control">
					  <select type="text" class="form-control">
					  	@foreach($master_satuan as $satuan)
					  		<option value="{{$satuan->label}}">{{$satuan->label}}</option>
					  	@endforeach
					  </select>
				</div>
				

			</div>
		</div>
	</div>
	<div class="card-footer modal-footer">
		<button class="btn btn-warning btn-sm">Tambah</button>
	</div>
</div>



<script type="text/javascript">
	
	
	$('#program_pro').select2();

	$('#program_pro').on('change',function(){

		$data={'kode_program':this.value,'pro':true};

		CNDSSApi.post('{{route('nomen.program.kegiatan')}}',$data).then(function(response){
			var dom='';
			var data=response.data;

			for (var i =0; i < data.length ; i++) {
				dom+='<option value="'+data[i].kode+'">'+data[i].nomenklatur+'</option>';
			}

			$('#kegiatan_pro').html(dom);
			$('#kegiatan_pro').select2();
			$('#kegiatan_pro').trigger('change');

		});
	});

	$('#kegiatan_pro').on('change',function(){

		$data={'kode_kegiatan':this.value,'pro':true};

		CNDSSApi.post('{{route('nomen.kegiatan.sub_kegiatan')}}',$data).then(function(response){
			var dom='';
			var data=response.data;

			for (var i =0; i < data.length ; i++) {
				dom+='<option value="'+data[i].kode+'">'+data[i].nomenklatur+'</option>';
			}

			$('#sub_kegiatan_pro').html(dom);
			$('#sub_kegiatan_pro').select2();

		});
	});

	$('#program_pro').trigger('change');


</script>
@stop