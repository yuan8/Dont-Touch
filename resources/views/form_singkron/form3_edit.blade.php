@extends('layouts.master2')

@section('head_asset')

@stop
@section('content')
<a href="{{route('fs.f3.index',['id_link'=>$id_link])}}" class="btn btn-info btn-circle"> <i class="fa fa-arrow-left"></i> </a><small> IDENTIFIKASI KEBIJAKAN PUSAT TAHUNAN </small>
<hr>

<div class="card card-border-top-warning">
	<form class="" action="{{route('fs.f3.update',['id_link'=>$id_link,'id'=>$data->id])}}" method="post">
		@csrf
		@method('PUT')
		<div class="card-body">
		<div class="row">
			<div class="col-md-6">
				<div class=form-group>
					<label>Prioritas Nasional</label>
					<textarea class="form-control" required="" name="prioritas_nasional">{!!nl2br($data->prioritas_nasional)!!}</textarea>
				</div>
			</div>
			<div class="col-md-6">
				<div class=form-group>
					<label>Program Prioritas</label>
					<textarea class="form-control" required="" name="program_prioritas">{!!nl2br($data->prioritas_nasional)!!}</textarea>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-3">
				<div class="form-group">
					<label>Kegiatan Prioritas</label>
					<textarea class="form-control" required="" name="kegiatan_prioritas">{!!nl2br($data->prioritas_nasional)!!}</textarea>
				</div>
			</div>
			<div class="col-md-3">
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
			</div>
			
			<div class="col-md-12">
				<hr>
			</div>
			<div class="col-md-6">
				@include('init.input.themplate.add_multy_data',['field_db'=>'a','name_field'=>'pro_pn[]','title'=>'Program Prioritas Nasional ','tb'=>'ab','value'=>(!empty($data->haveProPN)?$data->haveProPN->pluck('pro_pn'):[])])

				
			</div>
			
			
		</div>
	</div>
	<div class="card-footer modal-footer">
		<button type="submit" class="btn btn-warning border-bottom-info">Update</button>
	</div>
	</form>
</div>


@stop