@extends('layouts.master2')

@section('head_asset')

@stop
@section('content')


<div class="d-sm-flex align-items-center justify-content-between mb-1">        
  <h5 class="mb-0 ">IDENTIFIKASI KEBIJAKAN PUSAT TAHUNAN</h5>
        <a href="{{route('fs.f3.tambah',['id_link'=>$id_link])}}" class="border-bottom-primary  d-sm-inline-block btn btn-warning" style="margin-bottom: 10px; color:#222;">Tambah Identifikasi Kebijakan</a>
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
			<th>Action</th>

		</tr>
	</thead>
	<tbody>
		@foreach($datas as $d)
			<tr>
				<td>{!!nl2br($d->prioritas_nasional)!!}</td>
				<td>{!!nl2br($d->program_prioritas)!!}</td>
				<td>{!!nl2br($d->kegiatan_prioritas)!!}</td>
				<td>
					@foreach($d->HaveProPN as $propn)
						<p>
							{!!nl2br($propn->pro_pn)!!}
						</p>
					@endforeach
					
				</td>
				<td>{!!nl2br($d->target)!!}</td>
				<td>{!!nl2br($d->lokus)!!}</td>
				<td>{!!nl2br($d->pelaksana)!!}</td>
				<td>
					<a href="{{route('fs.f3.show',['id_link'=>$id_link,'id'=>$d->id])}}" class="btn-warning btn btn-circle">
						<i class="fa fa-edit"></i>
					</a>
					<a href="javascript:void(0)" onclick="$('#modal-delete-{{$d->id}}').appendTo('body').modal()" class="btn btn-danger btn-circle">
							<i class="fa fa-trash"></i>
						</a>

							<div class="modal fade" id='modal-delete-{{$d->id}}' tabindex="-1" role="dialog">
						  <div class="modal-dialog" role="document">
						    <div class="modal-content">
						      <div class="modal-header">
						        <h5 class="modal-title">Konfirmasi Penghapusan</h5>
						        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						          <span aria-hidden="true">&times;</span>
						        </button>
						      </div>
						      <div class="modal-body">
						        <p>Apakah Anda Yakin Menhapus Data Ini</p>
						      </div>
						      <div class="modal-footer">
						      	<form action="{{route('fs.f3.delete',['id_link'=>$id_link,'id'=>$d->id])}}" method="post">
						      		@csrf
						      		@method('delete')
						        	<input type="hidden"  name="id" value="{{$d->id}}">
						        	<button type="submit" class="btn btn-danger">Delete</button>

						      	</form>
						        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						      </div>
				</td>


			</tr>

		@endforeach
	</tbody>
</table>
</div>
</div>

@stop