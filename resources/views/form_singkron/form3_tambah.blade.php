@extends('layouts.master_def')

@section('head_asset')

@stop
@section('content')
<a href="{{route('fs.f3.index',['id_link'=>$id_link])}}" class="btn btn-info btn-sm"> <i class="fa fa-arrow-left"></i> </a><small> IDENTIFIKASI KEBIJAKAN PUSAT TAHUNA </small>
<hr>

<div class="d-sm-flex align-items-center justify-content-between mb-1">        
  <h5 class="mb-0 ">TAMBAH IDENTIFIKASI KEBIJAKAN PUSAT TAHUNAN</h5>
       
</div>
<hr>

<div class="card card-border-top-warning">
	<form class="" action="{{route('fs.f3.store',['id_link'=>$id_link])}}" method="post">
		@csrf
		<div class="card-body">
		<div class="row">
			<div class="col-md-6">
				<div class=form-group>
					@include('init.input.themplate.add_data_master',['field_db'=>'nama_pn','name_field'=>'pn[]','title'=>'Prioritas Nasional','tb'=>'master_prioritas_nasional','tahun'=>session('focus_tahun'),'multiple'=>false,'use_id'=>true])
				</div>
			</div>
			<div class="col-md-6">
				<div class=form-group>
					@include('init.input.themplate.add_data_master',['field_db'=>'nama_pp','name_field'=>'pp[]','title'=>'Program Prioritas','tb'=>'master_program_prioritas','tahun'=>session('focus_tahun'),'multiple'=>false,'use_id'=>true])
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<label>Kegiatan Prioritas</label>
					<textarea class="form-control" required="" style="min-height: 200px!important" name="kegiatan_prioritas"></textarea>
				</div>
			</div>
		
			
			<div class="col-md-12">
				<hr>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<table style="display: none;">
						<tbody id="container-themplate-propn" >
						<tr>
							<td>
								<textarea name="new_propn[xxxx]" class="form-control" style="min-height: 100px!important" ></textarea>
							</td>
							<td>
								<button type="button" class="btn btn-danger btn-sm btn-circle" onclick="$(this).parent().parent().remove()">
									<i class="fa fa-trash"></i>
								</button>
							</td>
						</tr>
						</tbody>
					</table>
					<table class="table table-stripted table-bordered">
						<thead>
							<tr>
								<th>PROGRAM PRIORITAS NASIONAL</th>
								<th>
									<button type="button" class="btn  btn-warning btn-sm btn-circle " onclick="btn_create_new_propn();">
										<i class="fa fa-plus"></i>
									</button>

									<script type="text/javascript">
										var count_propn=0;
										function btn_create_new_propn(){
												var themplate_target= $('#container-themplate-propn').html();
												themplate_target=themplate_target.replace(/xxxx/g,count_propn);
												count_propn+=1;
												$('#container-new-propn').append(themplate_target);
												$('#container-new-propn textarea').attr('required','true');
										}
									
									</script>
								</th>
			
							</tr>
						</thead>
						<tbody  id="container-new-propn">
						
							
						</tbody>
					</table>

				</div>	
			</div>
			<div class="col-md-8">
				<div class="form-group">
					<table style="display: none;">
						<tbody id="container-themplate-target" >
						<tr>
							<td class="input-group">
								<input type="number" min="1" name="new_target[xxxx][target]"  class="form-control" ></input>
								<select class="form-control" name="new_target[xxxx][satuan_target]">
									@foreach(\DB::table('master_satuan')->get() as $satuan)
										<option value="{{$satuan->label}}">{{$satuan->label}}</option>
									@endforeach
								</select>
							</td>
							<td>
								<textarea name="new_target[xxxx][lokus]" class="form-control"   style="min-height: 100px!important"></textarea>
							</td>
							<td>
								<textarea name="new_target[xxxx][pelaksana]" class="form-control"   style="min-height: 100px!important"></textarea>
							</td>
							<td>
								<button type="button" class="btn btn-danger btn-sm btn-circle" onclick="$(this).parent().parent().remove()">
									<i class="fa fa-trash"></i>
								</button>
							</td>
						</tr>
						</tbody>
					</table>
					<table class="table table-stripted table-bordered">
						<thead>
							<tr>
								<th>TARGET NASIOANAL</th>
								<th>LOKUS</th>
								<th>PELAKSANA</th>

								<th>
									<button type="button" class="btn  btn-warning btn-sm btn-circle " onclick="btn_create_new_target();">
										<i class="fa fa-plus"></i>
									</button>

									<script type="text/javascript">
										var count_taget=0;
										function btn_create_new_target(){
												var themplate_target= $('#container-themplate-target').html();
												themplate_target=themplate_target.replace(/xxxx/g,count_taget);
												count_taget+=1;
												$('#container-new-target').append(themplate_target);
												$('#container-new-target textarea').attr('required','true');
												$('#container-new-target input,#container-new-target select').attr('required','true');

										}

										// btn_create_new_propn();
									
									</script>
								</th>
			
							</tr>
						</thead>
						<tbody  id="container-new-target">
							
							
						</tbody>
					</table>

				</div>	
			</div>
			
			
			
		</div>
	</div>
	<div class="card-footer modal-footer">
		<button type="submit" class="btn btn-warning border-bottom-info">Tambah</button>
	</div>
	</form>
</div>


@stop