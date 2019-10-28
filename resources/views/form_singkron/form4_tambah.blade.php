@extends('layouts.master2')

@section('head_asset')

@stop
@section('content')
<a href="{{route('fs.f4.index',['id_link'=>$id_link])}}" class="btn btn-info btn-circle"> <i class="fa fa-arrow-left"></i> </a>
<small>DATA PERMASALAHAN</small>
<hr>
<h5>TAMBAH DATA PERMASALAHAN</h5>
<hr>

<div class="card card-border-top-warning">
	<form action="{{route('fs.f4.store',['id_link'=>$id_link])}}" method="post">
		@csrf
		<div class="card-body">
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label>Sub Urusan</label>
					<select class="form-control" name="sub_urusan" required="">
						@foreach($sub_urusans as $sub)
								<option value="{{$sub->id}}">{{$sub->nama}}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					@include('init.input.themplate.add_multy_data',['field_db'=>'masalah','name_field'=>'masalah[]','title'=>'Masalah','tb'=>'','required'=>true])
				</div>
			</div>


		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					@include('init.input.themplate.add_multy_data',['field_db'=>'akar_masalah','name_field'=>'akar_masalah[]','title'=>'Akar Masalah','tb'=>''])
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					@include('init.input.themplate.add_multy_data',['field_db'=>'data_dukung','name_field'=>'data_dukung[]','title'=>'Data Dukung','tb'=>''])
				</div>
			</div>


		</div>
	</div>
	<div class="card-footer modal-footer">
		<button type="submit"  class="btn btn-warning border-bottom-info">Tambah</button>
	</div>

	</form>
</div>


@stop