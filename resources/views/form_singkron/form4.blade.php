@extends('layouts.master2')

@section('head_asset')

@stop
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-1">        
  <h5 class="mb-0 ">DATA PERMASALAHAN URUSAN</h5>
        <a href="{{route('fs.f4.tambah',['id_link'=>$id_link])}}" class="border-bottom-primary  d-sm-inline-block btn btn-warning" style="margin-bottom: 10px; color:#222;">Tambah Permasalahan</a>
</div>
<hr>


<form action="{{url()->current()}}" method="get">
	<div class="input-group mb-3">
  <input type="text" class="form-control" placeholder="Search.." name="q" value="{{isset($_GET['q'])?$_GET['q']:''}}" aria-label="" aria-describedby="basic-addon2">
  <div class="input-group-append">
    <button type="submit" class="btn btn-warning">Search</button>
  </div>
</div>
	
</form>

<div class="card  card-border-top-warning">
	<div class="card-body">
		<table class="table table-bordered table-striped">
			<tbody>
				@foreach($datas as $d)
				<tr class="bg bg-warning">
					<td colspan="4">{{$d['nama']}}</td>
					<td >
						<a href="{{route('fs.f4.tambah',['id_link'=>$id_link,'provinsi'=>$d['provinsi'],'kota_kabupaten'=>$d['kota_kabupaten']])}}" class="btn btn-warning border-bottom-info ">
							<i class="fa fa-plus"></i>
						</a>
					</td>
				</tr>
				<tr class="table-dark">
					<th>Masalah Pokok</th>
					<th>
						Masalah
					</th>
					<th>Akar Masalah</th>
					<th>Data Pendunkung</th>

					<th>Action</th>
				</tr>
				@foreach($d['permasalahan'] as $p)
					<tr>
						<td>{!!nl2br($p['masalah_pokok'])!!}</td>
						<td>{!!HP::SpliterArray($p['masalah'])!!}</td>
						<td>{!!HP::SpliterArray($p['akar_masalah'])!!}</td>
						<td>{!!HP::SpliterArray($p['data_pendukung'])!!}</td>
						<td>
							<a href="{{route('fs.f4.show',['id_link'=>$id_link,'id'=>$p['id']])}}" class="btn btn-warning btn-circle">
								<i class="fa fa-edit"></i>
							</a>
							<a href="javascript:void(0)" onclick="$('#modal-delete-{{$p['id']}}').appendTo('body').modal();" class="btn btn-danger btn-circle">
								<i class="fa fa-trash"></i>
							</a>

							<div class="modal fade" id="modal-delete-{{$p['id']}}">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-body">
												<h5 class="text-center">Apakah Anda Yakin Menghapus Data Ini?</h5>
											</div>
											<div class="modal-footer">
												<form action="{{route('fs.f4.delete',['id_link'=>$id_link,'id'=>$p['id']])}}" method="post">
													@csrf
													@method('DELETE')
													<input type="hidden" name="permasalahan" value="{{$p['id']}}">
													<button class="btn btn-danger" type="submit">
														<i class="fa fa-trash"></i>
													</button>
												</form>
											</div>
										</div>
									</div>
								</div>

							
						</td>



					</tr>
				@endforeach
				
					
				@endforeach
			</tbody>
		</table>
		{{$link->links()}}

	</div>
</div>

@stop