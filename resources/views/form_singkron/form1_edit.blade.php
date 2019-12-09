@extends('layouts.master_def')

@section('head_asset')

@stop
@section('content')
<a href="{{route('fs.f1.index',['id_link'=>$id_link])}}" class="btn btn-info btn-sm"> <i class="fa fa-arrow-left"></i> </a><small> Mandat </small>
<hr>

<div class="card card-border-top-warning">
	<form method="post" action="{{route('fs.f1.update',['id_link'=>$id_link,'id'=>$mandat->id])}}">
		@csrf
		@method('PUT')
		<div class="card-body">
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label>Sub Urusan</label>
					<select class="form-control" name="sub_urusan" required="" id="sub_urusan">
						<option value=""> - Pilih Program - </option>
						@foreach($sub_urusans as $sub_urusan)
							<option value="{{$sub_urusan->id}} " {{$mandat->id_sub_urusan==$sub_urusan->id?'selected':''}}>{{$sub_urusan->nama}}</option>
						@endforeach
					</select>
					<script type="text/javascript">
							$('#sub_urusan').select2();
					</script>
				</div>
			</div>
			<div class="col-md-6" >
				<div class="form-check">
					    
					<label>Mandat / Kegiatan</label>
					<br>
					  <label class="form-check-label">
						<input type="checkbox" data-onstyle="warning" data-offstyle="danger" id="set_mandat" {{$mandat['jenis']==0?'checked':''}} data-toggle="toggle" data-size="xs" data-on="Mandat"  data-off="Kegiatan" onchange="changeMandatBtn(this)" name="set_mandat">
					  </label>
				</div>
			</div>
			<div class="col-md-12">
				<hr>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				    @include('init.input.themplate.add_data_master',['field_db'=>'nama','name_field'=>'uu[]','title'=>'UU','tb'=>'master_uu','use_id'=>true,'value'=>$mandat->listUu])
			</div>

			<div class="col-md-6">
				 @include('init.input.themplate.add_data_master',['field_db'=>'nama','name_field'=>'pp[]','title'=>'PP','tb'=>'master_pp','use_id'=>true,'value'=>$mandat->listPp])
  
  
			</div>
			<div class="col-md-12">
				<hr>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				   @include('init.input.themplate.add_data_master',['field_db'=>'nama','name_field'=>'perpres[]','title'=>'Perpres','tb'=>'master_perpres','use_id'=>true,'value'=>$mandat->listPerpres])
			</div>
			<div class="col-md-6">
				    @include('init.input.themplate.add_data_master',['field_db'=>'nama','name_field'=>'permen[]','title'=>'Permen','tb'=>'master_permen','use_id'=>true,'value'=>$mandat->listPermen])
			</div>
			<div class="col-md-12">
				<hr>
			</div>

		</div>
		<div class="row">
			<div class="col-md-12" id="container-mandat-front">
				
				<div class="form-group">
				 	<label>Mandat</label>
				 	<textarea class="form-control" name="mandat">{!!nl2br($mandat->mandat)!!}</textarea>
				 </div>
			
			</div>
		</div>
	</div>
	<div class="card-footer">
		<button type="submit" class="btn btn-warning border-bottom-info">Update</button>
	</div>
	</form>
</div>

<div id="container-mandat-back" style="display: none"></div>


<script type="text/javascript">

	function changeMandatBtn(dom){
		var d=$(dom).prop('checked');
		// if(d){
		// 	if($('#container-mandat-back').html().replace(/ /g,null)!=""){
		// 		var vd=$('#container-mandat-back').html();
		// 		$('#container-mandat-front').html(vd);
		// 		console.log('mandat-del');
		// 	}else{
		// 		console.log('mandat-stay');

		// 	}
		// }else{
		// 	var vd=$('#container-mandat-front').html();
		// 		$('#container-mandat-back').html(vd);
		// 		$('#container-mandat-front').html('');

		// }
	}

	$('#set_mandat').trigger('change');


</script>

@stop