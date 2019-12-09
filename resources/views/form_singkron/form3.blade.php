@extends('layouts.master_def')

@section('head_asset')

@stop
@section('content')


<div class="d-sm-flex align-items-center justify-content-between mb-1">        
  <h5 class="mb-0 ">IDENTIFIKASI KEBIJAKAN PUSAT TAHUNAN</h5>
        <a href="{{route('fs.f3.tambah',['id_link'=>$id_link])}}" class="border-bottom-primary  d-sm-inline-block btn btn-warning" style="margin-bottom: 10px; color:#222;">Tambah Identifikasi Kebijakan</a>
</div>
<hr>
<div class="card  card-border-top-warning">
	<div class="card-body table-responsive">
	<table class="table table-stripted table-bordered">
	<thead>
		<tr class="table-dark">
			<th>Prioritas Nasional</th>
			<th>Program Prioritas</th>
			<th>Kegiatan Prioritas</th>
			<th>RPO PN / Proyek K/L</th>
			<th class="text-center">TARGET NASIONAL</th>
			
			<th>Action</th>

		</tr>
	</thead>
	<tbody>
		@foreach($datas as $d)
			<tr>
				
				<td>{{($d->prioritas_nasional!=null)?$d->HavePn()->where('tahun',session('focus_tahun'))->first()->nama_pn:null}}</td>

				<td>{{($d->program_prioritas!=null)?$d->HavePp()->where('tahun',session('focus_tahun'))->first()->nama_pp:null}}</td>
				<td>{!!nl2br($d->kegiatan_prioritas)!!}</td>
				<td style="padding: 0px;">
					<table class="table" style="margin-bottom: 0px;">
					@foreach($d->HaveProPN as $propn)
						<tr >
							<td>{!!nl2br($propn->pro_pn)!!}</td>
						</tr>
					@endforeach
					</table>
					
				</td>
				<td style="padding: 0px; min-width: 800px!important">
					<table class="table" style="margin-bottom: 0px;">
						<thead>
							<tr>
							<th style="min-width: 30%!important;">TARGET</th>
							<th>LOKUS</th>
							<th>PELAKSANA</th>

						</tr>
						</thead>
					<tbody>
						@foreach($d->HaveTarget as $target)
						<tr>
							<td>{!!nl2br($target->target)!!} {!!nl2br($target->satuan_target)!!}</td>
							<td>{!!nl2br($target->lokus)!!}</td>
							<td>{!!nl2br($target->pelaksana)!!}</td>


						</tr>
					@endforeach
					</tbody>
					</table>

				</td>
				
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