@extends('layouts.master2')

@section('head_asset')

@stop
@section('content')
<a href="{{route('fs.f1.index',['id_link'=>$id_link])}}" class="btn btn-info btn-circle"> <i class="fa fa-arrow-left"></i> </a><small> Mandat </small>
<hr>

 <div class="d-sm-flex align-items-center justify-content-between mb-1">        
  <h5 class="mb-0 ">Tambah Mandat</h5>
       
</div>

<div class="card card-border-top-warning">
	<form method="post" action="{{route('fs.form1.store',['id_link'=>$id_link])}}">
		@csrf
		<div class="card-body">
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label>Sub Urusan</label>
					<select class="form-control" name="sub_urusan" required="" id="sub_urusan">
						<option value=""> - Pilih Program - </option>
						@foreach($sub_urusans as $sub_urusan)
							<option value="{{$sub_urusan->id}}">{{$sub_urusan->nama}}</option>
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
						<input type="checkbox" data-onstyle="warning" data-offstyle="danger" id="toggle-two" checked data-toggle="toggle" data-size="xs" data-on="Mandat" data-off="Kegiatan" onchange="changeMandatBtn(this)" name="set_mandat">
					  </label>
				</div>
			</div>
			<div class="col-md-12">
				<hr>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				   @include('init.input.themplate.add_data_master',['field_db'=>'nama','name_field'=>'uu[]','title'=>'UU','tb'=>'master_uu','use_id'=>true])
			</div>

			<div class="col-md-6">
				   @include('init.input.themplate.add_data_master',['field_db'=>'nama','name_field'=>'pp[]','title'=>'PP','tb'=>'master_pp','use_id'=>true])
  
			</div>
			<div class="col-md-12">
				<hr>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				   @include('init.input.themplate.add_data_master',['field_db'=>'nama','name_field'=>'perpres[]','title'=>'Perpres','tb'=>'master_perpres','use_id'=>true])
			</div>
			<div class="col-md-6">
				  @include('init.input.themplate.add_data_master',['field_db'=>'nama','name_field'=>'permen[]','title'=>'Permen','tb'=>'master_permen','use_id'=>true])
			</div>
			<div class="col-md-12">
				<hr>
			</div>

		</div>
		<div class="row">
			<div class="col-md-12" id="container-mandat-front">
				   @include('init.input.themplate.add_multy_data',['field_db'=>'mandat','name_field'=>'mandat[]','title'=>'Mandat Ke Daerah','tb'=>'form_1_permen'])
			</div>
		</div>
	</div>
	<div class="card-footer">
		<button type="submit" class="btn btn-warning border-bottom-info">Tambah</button>
	</div>
	</form>
</div>
<div id="container-mandat-back" style="display: none"></div>


<script type="text/javascript">

	function changeMandatBtn(dom){
		var d=$(dom).prop('checked');
		if(d){
			if($('#container-mandat-back').html()!=''){
				var vd=$('#container-mandat-back').html();
				$('#container-mandat-front').html(vd);
			}else{

			}
		}else{
			var vd=$('#container-mandat-front').html();
				$('#container-mandat-back').html(vd);
				$('#container-mandat-front').html('');

		}
	}
</script>

@stop