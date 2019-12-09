@extends('layouts.master_def')

@section('head_asset')

@stop
@section('content')


<div class="d-sm-flex align-items-center justify-content-between mb-1">        
  <h5 class="mb-0 ">IDENTIFIKASI KEBIJAKAN PUSAT 5 TAHUNAN </h5>
        <a href="{{route('fs.f2.tambah',['id_link'=>$id_link])}}" class="border-bottom-primary  d-sm-inline-block btn btn-warning" style="margin-bottom: 10px; color:#222;">Tambah Indeftifikasi Kebijakan</a>
</div>
<hr>

<div class="card card-border-top-warning">
	<div class="card-body table-responsive">
		<table class="table table-stripted table-bordered card-border-top-warning">
		<thead>
			<tr class="table-dark">
				<th rowspan="2">Kondisi Saat ini</th>
				<th rowspan="2">Isu Strategis</th>
				<th rowspan="2">Arah Kebijakan</th>
				<th rowspan="2">Sasaran Indikator</th>
				<th rowspan="2">Target</th>
				<th rowspan="2" >Sub Urusan</th>
				<th colspan="3">Kewenangan</th>
				<th rowspan="2">Keterangan</th>
				<th rowspan="2" style="min-width: 100px;">Action</th>

			</tr>
			<tr class="table-dark">
				<th>Pusat</th>
				<th>Provinsi</th>
				<th>Kota/Kab</th>
			</tr>
		</thead>
		<tbody>
			@foreach($indentifikasis as $d)
				<tr>
					<td>{!! HP::SpliterArray($d->kondisi_saat_ini) !!}</td>
					<td>{!! HP::SpliterArray($d->isu_strategis) !!}</td>
					<td>{!! HP::SpliterArray($d->arah_kebijakan) !!}</td>
					<td>{!! HP::SpliterArray($d->sasaran) !!}</td>
					<td>{!! HP::SpliterArray($d->target) !!}</td>
					<td>{{$d->LinkSubUrusan->nama}}</td>
					<td>
						@if($d->kewenangan_pusat)
							<label class="label-primary btn btn-primary btn-sm">Berwenang</label>
						@else
							<label class="label-danger btn btn-danger btn-sm">Tidak</label>

						@endif

					</td>
					<td>
						@if($d->kewenangan_provinsi)
							<label class="label-primary btn btn-primary btn-sm">Berwenang</label>
						@else
							<label class="label-danger btn btn-danger btn-sm">Tidak</label>

						@endif
					</td>
					<td>
						@if($d->kewenangan_kota_kabupaten)
							<label class="label-primary btn btn-primary btn-sm">Berwenang</label>
						@else
							<label class="label-danger btn btn-danger btn-sm">Tidak</label>

						@endif
					</td>
					<td>{!!$d->keterangan!!}</td>
					<td>
						<a href="{{route('fs.f2.show',['id_link'=>$id_link,'id'=>$d->id])}}" class="btn btn-warning btn-circle">
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
						      	<form action="{{route('fs.f2.delete',['id_link'=>$id_link,'id'=>$d->id])}}" method="post">
						      		@csrf
						      		@method('delete')
						        	<input type="hidden"  name="id" value="{{$d->id}}">
						        	<button type="submit" class="btn btn-danger">Delete</button>

						      	</form>
						        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						      </div>
						    </div>
						  </div>
						</div>

					</td>
				</tr>
			@endforeach
			
		</tbody>
	</table>
	</div>
</div>


@stop