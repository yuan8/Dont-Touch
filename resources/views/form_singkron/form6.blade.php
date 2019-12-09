@extends('layouts.master_def')

@section('head_asset')

@stop
@section('content')
<h5>Data Pelaksanaan Urusan Lingkup SUPD 2 </h5>
<hr>
<div class="row">
	<!-- <div class="col-md-4">
		<a href="http://localhost/dss/sinkron/bidang/4/f1/penilaian" class=" animated slideInRight  btn btn-warning col-md-12 border-bottom-primary " style="color:#222">Penilaian</a>
	</div> -->
	<div class="col-md-4">
		<a href="{{route('fs.f6.daerah',['id_link'=>$id_link])}}" class=" animated slideInRight btn btn-warning col-md-12 border-bottom-primary" style="color:#222">Data Pelaksanaan Urusan Lingkup SUPD 2 Daerah</a>
	</div>	
</div>
<hr>
<div class="d-sm-flex align-items-center justify-content-between mb-1">        
  <h5 class="mb-0 ">Data Pelaksanaan Urusan Lingkup SUPD 2 Pusat</h5>
        <a href="{{route('fs.f6.pusat_create',['id_link'=>$id_link])}}" class="border-bottom-primary  d-sm-inline-block btn btn-warning" style="margin-bottom: 10px; color:#222;">Tambah Data</a>
</div>

	<div class="card card-border-top-warning ">
		<div class="card-body ">
			<table class="table table-bordered  table-striped">
				<thead>
					<!-- <tr class="table-dark">
						<th rowspan="3" style="">Action</th>

						<th colspan="3">Kewenagan</th>

					</tr>
					<tr class="table-dark">
						<th rowspan="2">Sub Urusan</th>
						<th colspan="2">Pusat</th>
					</tr>
					<tr class="table-dark">
						<th>Indikator</th>
						<th>Data</th>
					</tr> -->
					<tr class="table-dark">
						<th>Action</th>
						<th>Sub Urusan</th>
						<th>Indikator</th>
						<th>Data</th>
						
					</tr>
				</thead>
				<tbody>
					@foreach($datas as $key=> $d)
						<tr>
							<td>
								<a href="{{route('fs.f6.pusat_show',['id_link'=>$id_link,'id'=>$d->id])}}" class="btn btn-warning btn-circle" href="">
									<i class="fa fa-edit"></i>
								</a>
								<button  onclick="$('#modal-delete-{{$d->id}}').appendTo('body').modal()"  class="btn btn-danger btn-circle"><i class="fa fa-trash"></i> </button>

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
								      	<form action="{{route('fs.f6.pusat_delete',['id_link'=>$id_link,'id'=>$d->id])}}" method="post">
								      		@csrf
								      		@method('delete')
								        	<button type="submit" class="btn btn-danger">Delete</button>

								      	</form>
								        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
								      </div>
								    </div>
								  </div>
							</div>

							</td>
							<td>{{$d->program->nama}}</td>
							<td>{!! nl2br($d->indikator)!!}</td>
							<td>{!! HP::SpliterArray($d->data)!!}</td>
						</tr>
					@endforeach
				</tbody>
			</table>

		</div>
	</div>


@stop