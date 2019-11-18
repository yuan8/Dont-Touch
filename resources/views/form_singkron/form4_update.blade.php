@extends('layouts.master2')

@section('head_asset')

@stop
@section('content')
<a href="{{route('fs.f4.index',['id_link'=>$id_link,'q'=>$daerah->nama])}}" class="btn btn-info btn-circle"> <i class="fa fa-arrow-left"></i> </a>
<small>DATA PERMASALAHAN</small>
<hr>
<h5>TAMBAH DATA PERMASALAHAN</h5>
<hr>
<h5>{{$daerah->nama}}</h5>
<div class="card card-border-top-warning">
	<form action="{{route('fs.f4.update',['id_link'=>$id_link,'id'=>$data->id])}}" method="post">
		@csrf
		@method('PUT')
		<div class="card-body">
		<div class="row">
			<div class="col-md-6">

				<div class="form-group">
					<label>Masalah Pokok</label>
					<textarea class="form-control" name="masalah_pokok">{!!$data->masalah_pokok!!}</textarea>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					@include('init.input.themplate.add_multy_data',['field_db'=>'masalah','name_field'=>'masalah[]','title'=>'Masalah','tb'=>'','required'=>true,'value'=>$data->masalah])
				</div>
			</div>


		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					@include('init.input.themplate.add_multy_data',['field_db'=>'akar_masalah','name_field'=>'akar_masalah[]','title'=>'Akar Masalah','tb'=>'','value'=>$data->akar_masalah])
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					@include('init.input.themplate.add_multy_data',['field_db'=>'data_dukung','name_field'=>'data_dukung[]','title'=>'Data Dukung','tb'=>'','value'=>$data->data_pendukung])
				</div>
			</div>


		</div>
	</div>
	<div class="card-footer modal-footer">
		<button type="submit"  class="btn btn-warning border-bottom-info">Update</button>
	</div>

	</form>
</div>


@stop