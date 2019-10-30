@extends('layouts.master2')

@section('head_asset')

@stop
@section('content')
<a href="{{route('fs.f1.index',['id_link'=>$id_link])}}" class="btn btn-info btn-circle"> <i class="fa fa-arrow-left"></i> </a><small> Mandat </small>
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
			<div class="col-md-12">
				<hr>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				   @include('init.input.themplate.add_data_master',['field_db'=>'nama_uu','name_field'=>'uu[]','title'=>'UU','tb'=>'form_1_uu','value'=>$mandat->uu])
			</div>

			<div class="col-md-6">
				   @include('init.input.themplate.add_data_master',['field_db'=>'nama_pp','name_field'=>'pp[]','title'=>'PP','tb'=>'form_1_pp',
				   'value'=>$mandat->pp])
  
			</div>
			<div class="col-md-12">
				<hr>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				   @include('init.input.themplate.add_data_master',['field_db'=>'nama_perpres','name_field'=>'perpres[]','title'=>'Perpres','tb'=>'form_1_perpres','value'=>$mandat->perpres])
			</div>
			<div class="col-md-6">
				  @include('init.input.themplate.add_data_master',['field_db'=>'nama_permen','name_field'=>'permen[]','title'=>'Permen','tb'=>'form_1_permen','value'=>$mandat->permen])
			</div>
			<div class="col-md-12">
				<hr>
			</div>

		</div>
		<div class="row">
			<div class="col-md-12">
				 <div class="form-group">
				 	<label>Mandat</label>
				 	<textarea class="form-control" name="mandat[0]">{!!(json_decode($mandat->mandat)[0])!!}</textarea>
				 </div>
			</div>
		</div>
	</div>
	<div class="card-footer">
		<button type="submit" class="btn btn-warning border-bottom-info">Update</button>
	</div>
	</form>
</div>

@stop