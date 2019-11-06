@extends('layouts.master2')

@section('head_asset')

@stop
@section('content')
<hr>
<h5>IDENTIFIKASI KEBIJAKAN PUSAT TAHUNAN | <small>{{$data->kegiatan_prioritas}}</small></h5> 
<hr>
<div class="card card-border-top-warning card-shadow">
	<form action="{{route('fs.f3.update_indikator',['id_link'=>$id_link,'id'=>$data->id])}}" method="post">
		@csrf
		@method('PUT')
		<div class="card-body table-responsive ">
		<table class="table table-bordered card-border-top-warning">
			<thead>
				<tr class="table-dark">
					<th>
						Prioritas Nasional
					</th>
					<th>
						Program Prioritas 
					</th>
					<th>
						Kegiatan Prioritas 
					</th>
					<th>
						Target
					</th>
					<th>
						Lokus
					</th>
					<th>
						Pelaksana
					</th>

				</tr>
			</thead>
			<tbody>
				<tr>
					<td>
						{!!nl2br($data->prioritas_nasional)!!}
					</td>
					<td>
						{!!nl2br($data->program_prioritas)!!}
					</td>
					<td>
						{!!nl2br($data->kegiatan_prioritas)!!}
					</td>
					<td>
						{!!nl2br($data->target)!!}
					</td>
					<td>
						{!!nl2br($data->lokus)!!}
					</td>
					<td>
						{!!nl2br($data->pelaksana)!!}
					</td>

				</tr>
			</tbody>
		</table>
		<div class="row">
			<div class="col-md-4">
				<div class="form-group">
					<label>Indikator</label>
					<textarea class="form-control" name="indikator" required="">{!!nl2br($data->indikator)!!}</textarea>
				</div>
		
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label>Target Akumulatif</label>
					<input type="number" class="form-control" name="target_akumulatif" required="" value="{{$data->target_akumulatif}}">

				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label>Target Akumulatif Satuan</label>
					<select class="form-control" required="" name="target_akumulatif_satuan" required="">
						@foreach($satuans as $satuan)
							<option value="{{$satuan->label}}" {{$data->target_akumulatif_satuan==$satuan->label?'selected':''}}>{{$satuan->label}}</option>
						@endforeach
					</select>

				</div>
			</div>
		</div>
	</div>
	<div class="card-footer modal-footer">
		<button class="btn btn-warning border-bottom-info">Update</button>
	</div>
	</form>
</div>
<br>
<div class="row">
	<div class="col-md-12">
		<div class="" style="max-width:calc(100% - 30px); margin-left: 15px;">
			<div class="row">
					<div class="col-md-6 border-bottom-primary padding-space">
						<div class="d-sm-flex align-items-center justify-content-between mb-0">        
						  	<h5 class="mb-0">SUB KEGIATAN PROVINSI</h5>
						    <a href="javascript:void(0)" class="border-bottom-primary  d-sm-inline-block btn btn-warning" style="margin-bottom: 10px; color:#222;" onclick="$('#modal-add-sub-urusan-{{$data->id}}').appendTo('body').modal()" >
						    	<i class="fa fa-plus"></i>
						    </a>

						<div class="modal fade" id='modal-add-sub-urusan-{{$data->id}}' tabindex="-1" role="dialog">
						  <div class="modal-dialog modal-lg" role="document">
						    <div class="modal-content ">
						      <div class="modal-header">
						        <h5 class="modal-title">Tambah Sub Kegiatan Provinsi</h5>
						        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						          <span aria-hidden="true">&times;</span>
						        </button>
						      </div>
						      <form action="{{route('fs.f7.show.identifikasi.add_sub_provinsi',['id_link'=>$id_link,'id'=>$data->id])}}" method="post">
						      		@csrf
						      <div class="modal-body">
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
						      <div class="modal-footer">
						        	<input type="hidden"  name="id" value="{{$data->id}}">
						        	<button type="submit" class="btn btn-warning border-bottom-info">Tambah</button>
						        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						      </div>
						      	</form>

						    </div>
						  </div>
						</div>





						</div>
						<hr>
						<table class="table">
							
						
						@foreach($data->HaveSubUrusanProvinsi as $subp)
						<tr class="bg-primary">
								<td colspan="" style="color:#fff">
									{{ $subp->nomenklatur->programUp()['nomenklatur']}}
								</td>
								<td>
									<nav class="navbar navbar-expand-lg navbar-light bg-primary" style="margin:0px;padding: 0px;">
										  <div class="collapse navbar-collapse pull-right" id="navbarSupportedContent">
										    <ul class="navbar-nav mr-auto form-inline">
										      <li class="nav-item dropdown">
										        <a class="nav-link dropdown-toggle btn-sm btn btn-warning" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										          <i class="fa fa-bars"></i>
										        </a>
										        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
										      
										          <a class="dropdown-item" href="#">Delete</a>
										          
										        </div>
										      </li>
										     
										    </ul>
										   
										  </div>
									</nav>

								</td>
							</tr>
							<tr>
								<td colspan="2">
									<p style="margin-left: 20px;">{{ $subp->nomenklatur->kegiatanUp()['nomenklatur']}}</p>
								</td>
							</tr>
							
							<tr class="">
									<td colspan="2">
										<p style="margin-left: 40px;">{{$subp->nomenklatur->nomenklatur}}</p>
									</td>
								
							</tr>
							
							
						@endforeach
						</table>

					</div>
					<div class="col-md-6 padding-space border-bottom-info">
						<div class="d-sm-flex align-items-center justify-content-between mb-0">        
						  	<h5 class="mb-0">SUB KEGIATAN KOTA KABUPATEN</h5>
						    <a href="javascript:void(0)" class="border-bottom-primary  d-sm-inline-block btn btn-warning" style="margin-bottom: 10px; color:#222;" onclick="$('#modal-add-sub-urusan-kab-{{$data->id}}').appendTo('body').modal()" >
						    	<i class="fa fa-plus"></i>
						    </a>
						<div class="modal fade" id='modal-add-sub-urusan-kab-{{$data->id}}' tabindex="-1" role="dialog">
						  <div class="modal-dialog modal-lg" role="document">
						    <div class="modal-content ">
						      <div class="modal-header">
						        <h5 class="modal-title">Tambah Sub Kegiatan Kota Kabupaten</h5>
						        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						          <span aria-hidden="true">&times;</span>
						        </button>
						      </div>
						      <form action="{{route('fs.f7.show.identifikasi.add_sub_kotakab',['id_link'=>$id_link,'id'=>$data->id])}}" method="post">
						      		@csrf
						      <div class="modal-body">
						        <div class="row">
						        	<div class="col-md-12">
						        		<div class="form-group">
								        	<label>Program</label>
								        	<select id="program_kab" class="form-control col-md-12" style="width:100%;">
							        			@foreach($program_provinsi as $program)
							        				<option value="{{$program->kode}}">{{$program->nomenklatur}}</option>
							        			@endforeach
								        	</select>
						        	
								        	
									        </div>

									        <div id="container_kegiatan_kab">
								        		<label>Kegiatan</label>

									        	<select id="kegiatan_kab" class="form-control col-md-12" style="width:100%;">
								        			
								        		</select>
						        	
									        </div>
									        <br>
									        <div id="container_sub_kegiatan_kab">
									        	<label>Sub Kegiatan</label>
									        	<select id="sub_kegiatan_kab" name="sub_urusan_provinsi" class="form-control col-md-12" required="" style="width:100%;">
								        			
								        		</select>
						        	
								        		
									        	
									        </div>

						        	</div>
						        </div>


						      </div>
						      <div class="modal-footer">
						        	<input type="hidden"  name="id" value="{{$data->id}}">
						        	<button type="submit" class="btn btn-warning border-bottom-info">Tambah</button>
						        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						      </div>
						      	</form>

						    </div>
						  </div>
						</div>

						</div>
						<hr>



						<table class="table">
						@foreach($data->HaveSubUrusanKabKota as $subp)
							<tr class="bg-info">
								<td colspan="" style="color:#fff">
									{{ $subp->nomenklatur->programUp()['nomenklatur']}}
								</td>
								<td>
									<nav class="navbar navbar-expand-lg navbar-light bg-info" style="margin:0px;padding: 0px;">
										  <div class="collapse navbar-collapse pull-right" id="navbarSupportedContent">
										    <ul class="navbar-nav mr-auto form-inline">
										      <li class="nav-item dropdown">
										        <a class="nav-link dropdown-toggle btn-sm btn btn-warning" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										          <i class="fa fa-bars"></i>
										        </a>
										        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
										      
										          <a class="dropdown-item" href="#">Delete</a>
										          
										        </div>
										      </li>
										     
										    </ul>
										   
										  </div>
									</nav>

								</td>
							</tr>
							<tr>
								<td colspan="2">
									<p style="margin-left: 20px;">{{ $subp->nomenklatur->kegiatanUp()['nomenklatur']}}</p>
								</td>
							</tr>
							
							<tr class="">
									<td colspan="2">
										<p style="margin-left: 40px;">{{$subp->nomenklatur->nomenklatur}}</p>
									</td>
								
							</tr>
							
							
						@endforeach
						</table>
						
					</div>
			</div>
			
		</div>
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



	// kota kab
	$('#program_kab').select2();

	$('#program_kab').on('change',function(){

		$data={'kode_program':this.value,'pro':false};

		CNDSSApi.post('{{route('nomen.program.kegiatan')}}',$data).then(function(response){
			var dom='';
			var data=response.data;

			for (var i =0; i < data.length ; i++) {
				dom+='<option value="'+data[i].kode+'">'+data[i].nomenklatur+'</option>';
			}

			$('#kegiatan_kab').html(dom);
			$('#kegiatan_kab').select2();
			$('#kegiatan_kab').trigger('change');

		});
	});

	$('#kegiatan_kab').on('change',function(){

		$data={'kode_kegiatan':this.value,'pro':false};

		CNDSSApi.post('{{route('nomen.kegiatan.sub_kegiatan')}}',$data).then(function(response){
			var dom='';
			var data=response.data;

			for (var i =0; i < data.length ; i++) {
				dom+='<option value="'+data[i].kode+'">'+data[i].nomenklatur+'</option>';
			}

			$('#sub_kegiatan_kab').html(dom);
			$('#sub_kegiatan_kab').select2();

		});
	});

	$('#program_kab').trigger('change');









</script>

@stop

