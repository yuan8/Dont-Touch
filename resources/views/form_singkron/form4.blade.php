@extends('layouts.master2')

@section('head_asset')

@stop
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-1">        
  <h5 class="mb-0 ">DATA PERMASALAHAN URUSAN</h5>
        <a href="{{route('fs.f4.tambah',['id_link'=>$id_link])}}" class="border-bottom-primary  d-sm-inline-block btn btn-warning" style="margin-bottom: 10px; color:#222;">Tambah Permasalahan</a>
</div>
<hr>
<div class="card  card-border-top-warning">
	<div class="card-body">
		<table class="table table-stripted table-bordered">
	<thead>
		<tr class="table-dark">
			<th>Sub Urusan</th>
			<th>Masalah</th>
			<th>Akar Masalah</th>
			<th>Data Dukung</th>
			<th>Action</th>

		</tr>
	</thead>
	<tbody>
		@foreach($permasalahans as $permasalahan)
		<tr>
			<td>{{$permasalahan->LinkSubUrusan->nama}}</td>
			<td>{!!HP::SpliterArray($permasalahan->masalah)!!}</td>
			<td>{!!HP::SpliterArray($permasalahan->akar_masalah)!!}</td>
			<td>{!!HP::SpliterArray($permasalahan->data_pendukung)!!}</td>


			<td></td>
			

		</tr>
		@endforeach
	</tbody>
</table>
	</div>
</div>

@stop