@extends('layouts.master2')

@section('head_asset')

@stop
@section('content')
<h5> </h5>
<hr>


<div class="d-sm-flex align-items-center justify-content-between mb-1">        
  <h5 class="mb-0 ">IDENTIFIKASI KEBIJAKAN PUSAT TAHUNAN</h5>
        <a href="{{route('fs.f4.tambah',['id_link'=>$id_link])}}" class="border-bottom-primary  d-sm-inline-block btn btn-warning" style="margin-bottom: 10px; color:#222;">Tambah Identifikasi Kebijakan</a>
</div>
<hr>
<div class="card  card-border-top-warning">
	<div class="card-body">
	<table class="table table-stripted table-bordered">
	<thead>
		<tr class="table-dark">
			<th>Prioritas Nasional</th>
			<th>Program Prioritas</th>
			<th>Kegiatan Prioritas</th>
			<th>RPO PN / Proyek K/L</th>
			<th>Target</th>
			<th>Lokus</th>
			<th>Pelaksana</th>
		</tr>
	</thead>
	<tbody>
	</tbody>
</table>
</div>
</div>

@stop