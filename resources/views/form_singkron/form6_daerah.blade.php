@extends('layouts.master2')

@section('head_asset')

@stop
@section('content')
<a href="{{route('fs.f6.index',['id_link'=>$id_link])}}" class="btn btn-info btn-circle"> <i class="fa fa-arrow-left"></i> </a>

<small> Data Pelaksanaan Urusan Lingkup SUPD 2 </small>
<hr>
<h5>Tambah Data Pelaksanaan Urusan Lingkup SUPD 2 Daerah</h5>
<hr>

<div class="card crad-border-top-warning">
	<div class="card-body">
		<table class="table table-bordered ">
			<thead>
				<tr class="table-dark">
					<th >Action</th>
					<th >Daerah</th>
					<th >Sub Urusan</th>
					<th>Indikator</th>
					<th>Data</th>
				</tr>
				
			</thead>
			<tbody>
				@foreach($program as $p)

				@endforeach
				
			</tbody>
		</table>
	</div>
</div>


@stop