@extends('layouts.master2')

@section('head_asset')

@stop
@section('content')
<a href="{{route('fs.f3.index',['id_link'=>$id_link])}}" class="btn btn-info btn-circle"> <i class="fa fa-arrow-left"></i> </a><small> IDENTIFIKASI KEBIJAKAN PUSAT TAHUNA </small>
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
			<div class="col-md-3">
				<div class="form-group">
					<label>Kegiatan Prioritas</label>
					<textarea class="form-control" required="" name="kegiatan_prioritas"></textarea>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label>Target</label>
					<textarea class="form-control"  name="target"></textarea>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label>Lokus</label>
					<textarea class="form-control" name="lokus"></textarea>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label>Pelaksana</label>
					<textarea class="form-control" required="" name="pelaksana"></textarea>
				</div>
			</div>
			
			<div class="col-md-12">
				<hr>
			</div>
			<div class="col-md-6">
				@include('init.input.themplate.add_multy_data',['field_db'=>'a','name_field'=>'pro_pn[]','title'=>'Program Prioritas Nasional ','tb'=>'ab'])

				
			</div>
			
			
		</div>
	</div>
	<div class="card-footer modal-footer">
		<button type="submit" class="btn btn-warning border-bottom-info">Tambah</button>
	</div>
	</form>
</div>


@stop