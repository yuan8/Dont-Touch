@extends('layouts.master_def')

@section('head_asset')

@stop
@section('content')
<a href="{{route('fs.f3.index',['id_link'=>$id_link])}}" class="btn btn-info btn-sm"> <i class="fa fa-arrow-left"></i> </a><small> IDENTIFIKASI KEBIJAKAN PUSAT TAHUNAN </small>
<hr>

<div class="card card-border-top-warning">
	<form class="" action="{{route('fs.f3.update',['id_link'=>$id_link,'id'=>$data->id])}}" method="post">
		@csrf
		@method('PUT')
		<div class="card-body">
		<div class="row">
			<div class="col-md-6">
				<div class=form-group>
					@include('init.input.themplate.add_data_master',['field_db'=>'nama_pn','name_field'=>'pn[]','title'=>'Prioritas Nasional','tb'=>'master_prioritas_nasional','tahun'=>session('focus_tahun'),'multiple'=>false,'value'=>isset($data->HavePn)?[$data->HavePn->toArray()]:[],'use_id'=>true])
				</div>
			</div>
			<div class="col-md-6">
				<div class=form-group>
					@include('init.input.themplate.add_data_master',['field_db'=>'nama_pp','name_field'=>'pp[]','title'=>'Program Prioritas','tb'=>'master_program_prioritas','tahun'=>session('focus_tahun'),'multiple'=>false,'value'=>isset($data->HavePp)?[$data->HavePp->toArray()]:[],'use_id'=>true])
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<label>Kegiatan Prioritas</label>
					<textarea class="form-control" required="" cols="3" rows="3" style="min-height: 100px!important" name="kegiatan_prioritas">{!!nl2br($data->kegiatan_prioritas)!!}</textarea>
				</div>
			</div>
			<!-- <div class="col-md-3">
				<div class="form-group">
					<label>Target</label>
					<textarea class="form-control"  name="target">{!!nl2br($data->target)!!}</textarea>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label>Lokus</label>
					<textarea class="form-control" name="lokus">{!!nl2br($data->lokus)!!}</textarea>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label>Pelaksana</label>
					<textarea class="form-control" required="" name="pelaksana">{!!nl2br($data->pelaksana)!!}</textarea>
				</div>
			</div> -->
			
			<div class="col-md-12">
				<hr class="card-border-top-warning">
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
							@foreach($data->haveProPN as $key=> $propn)
								<tr>
									<td>{{$propn->pro_pn}}
									</td>
									<td>
										<button onclick="$('#modal-delete-propn-{{$propn->id}}').appendTo('body').modal()" type="button" class="btn btn-danger btn-sm btn-circle">
											<i class="fa fa-trash"></i>
										</button>
									</td>
								</tr>
							@endforeach
							
						</tbody>
					</table>

				</div>	
			</div>
			<div class="col-md-8">
				<div class="form-group">
					<table style="display: none;">
						<tbody id="container-themplate-target" >
						<tr>
							<td>
								<textarea name="new_target[xxxx][uraian]" class="form-control"   style="min-height: 100px!important"></textarea>
							</td>
							<td>
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
								<th>URAIAN TARGET</th>

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
												$('#container-new-target textarea,#container-new-target input,#container-new-target select').attr('required','true');

										}

										// btn_create_new_propn();
									
									</script>
								</th>
			
							</tr>
						</thead>
						<tbody  id="container-new-target">
							@foreach($data->HaveTarget as $key=> $target)
								<tr>
									<td>
										<p>{!!$target->uraian_target!!}</p>
										<textarea class="form-control" style="display: none; min-height: 100px!important;" name="target[{{$target->id}}][uraian]">{!!($target->uraian_target)!!}</textarea>
									</td>
									<td>
										<p class="text">{!!nl2br($target->target)!!}</p>
										<div class="input-group">
											<input  type="number" class="form-control" style="display: none;;" name="target[{{$target->id}}][target]" value="{{$target->target}}"></input>
										<select  style="display: none;" class="form-control" name="target[{{$target->id}}][satuan_target]">
											@foreach(\DB::table('master_satuan')->get() as $satuan)
												<option value="{{$satuan->label}}" {{$satuan->label==$target->satuan_label?"selected":''}}>{{$satuan->label}}</option>
											@endforeach
										</select>
										</div>
										
									</td>
									<td>
										<p class="text">{!!nl2br($target->lokus)!!}</p>
										<textarea class="form-control" style="display: none; min-height: 100px!important;" name="target[{{$target->id}}][lokus]">{!!($target->lokus)!!}</textarea>
										
									</td>
									
									<td>
										<p class="text">{!!nl2br($target->pelaksana)!!}</p>
										<textarea class="form-control" style="display: none; min-height: 100px!important;" name="target[{{$target->id}}][pelaksana]">{!!($target->pelaksana)!!}</textarea>
									</td>
									<td>
										<button type="button" onclick="$(this).parent().parent().find('td p.text').css('display','none'); $(this).parent().parent().find('textarea,input,select').css('display','block');autosize($('textarea')); $(this).parent().find('.btn.btn-hidden-check').css('display','inline-flex'); $(this).remove();" class="btn btn-warning btn-sm btn-circle">
											<i class="fa fa-edit"></i>
										</button>

										<button style="display: none" onclick="$('#form-target-update').html($(this).parent().parent().html()); $('#form-target-update').parent().submit();" type="button" class="btn btn-hidden-check btn-warning btn-sm btn-circle">
											<i class="fa fa-check"></i>
										</button>

										<button type="button" class="btn btn-danger btn-sm btn-circle" onclick="$('#modal-delete-target-{{$target->id}}').appendTo('body').modal()">
											<i class="fa fa-trash"></i>
										</button>

											
													
									</td>
								</tr>
							@endforeach
							
						</tbody>
					</table>

				</div>	
			</div>
			
			
		</div>
	</div>
	<div class="card-footer modal-footer">
		<button type="submit" class="btn btn-warning border-bottom-info">Update</button>
	</div>
	</form>
</div>


<div style="display:none" class=>
	
	<form  method="POST" action="{{route('fs.f3.target_update',['id_link'=>$id_link,'id'=>$data->id])}}">
		@csrf
		<div id="form-target-update">
			
		</div>
		
	</form>
</div>


<script type="text/javascript">
	$('textarea').on('change',function(){
		var val=$(this).val();
		var val=$(this).html(val);
	});
</script>


@foreach($data->HaveTarget as $target)
	<div class="modal fade" id="modal-delete-target-{{$target->id}}" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title">Konfirmasi Penghapusan</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">×</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <p>Apakah Anda Yakin Menhapus Data Ini</p>
	      </div>
	      <div class="modal-footer">
	      	<form action="{{route('fs.f3.target_delete',['id_link'=>$id_link,'id'=>$data->id,'id_target'=>$target->id])}}" method="post">
	      		@method('DELETE')
	      		@csrf
	        	<button type="submit" class="btn btn-danger">Delete</button>

	      	</form>
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	      </div>
	    </div>
	  </div>
	</div>
@endforeach



@foreach($data->haveProPN as $propn)
	<div class="modal fade" id="modal-delete-propn-{{$propn->id}}" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title">Konfirmasi Penghapusan</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">×</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <p>Apakah Anda Yakin Menhapus Data Ini</p>
	      </div>
	      <div class="modal-footer">
	      	<form action="{{route('fs.f3.propn_delete',['id_link'=>$id_link,'id'=>$data->id,'id_propn'=>$propn->id])}}" method="post">
	      		@method('DELETE')
	      		@csrf
	        	<button type="submit" class="btn btn-danger">Delete</button>

	      	</form>
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	      </div>
	    </div>
	  </div>
	</div>
@endforeach
@stop