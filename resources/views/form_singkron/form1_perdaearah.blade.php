@extends('layouts.master2')

@section('head_asset')

@stop
@section('content')
<a href="{{route('fs.f1.index',['id_link'=>$id_link])}}" class="btn btn-info btn-circle"> <i class="fa fa-arrow-left"></i> </a><small> Mandat </small>
<hr>

<h5>Penilaian Mandat Daerah</h5>
<form action="{{url()->current()}}" method="get">
	<div class="input-group mb-3">
  <input type="text" class="form-control" placeholder="Search.." name="q" value="{{isset($_GET['q'])?$_GET['q']:''}}" aria-label="Search.." aria-describedby="basic-addon2">
  <div class="input-group-append">
    <button type="submit" class="btn btn-warning">Search</button>
  </div>
</div>
	
</form>


<div class="card card-border-top-warning">
	<div class="card-body">
		<table class="table table-bordered  table-striped">
			<thead>
				
			</thead>
			<tbody>
				@foreach($datas as $d)
					<tr class="bg bg-warning">
						<td colspan="7">{{$d['nama']}}</td>
					</tr>
					<tr class="table-dark">
						<th>Sub Urusan</th>
						<th>
							Mandat
						</th>
						<th>Perda</th>
						<th>Perkada</th>
						<th>Kesesuaian</th>
						<th>Keterangan</th>
						<th>Action</th>


					</tr>
					<?php foreach ($d['mandat'] as $key => $value): ?>
						<tr>
							<td>{{$value['link_sub_urusan']?$value['link_sub_urusan']['nama']:''}}</td>
							<td>
								{!!HP::SpliterArray($value['mandat'])!!}
							</td>
							<td>
								{!!HP::SpliterArrayLink(($value['perda_perkada'])?$value['perda_perkada']['perda']:'[]')!!}
							</td>
							<td>
								{!!HP::SpliterArrayLink(($value['perda_perkada'])?$value['perda_perkada']['perkada']:'[]')!!}
							</td>
							<td>
								@if(($value['perda_perkada'])?$value['perda_perkada']['telah_dinilai']:0)

									@if(($value['perda_perkada'])?$value['perda_perkada']['kesesuaian']:0)
										<button class="btn btn-sm btn-info">Sesuai</button>
									@else
										<button class="btn btn-sm btn-danger">Tidak Sesuai</button>

									@endif
								@else
									<button class="btn btn-sm btn-success">Belum Dinilai</button>
								@endif
							</td>
							<td>{!!nl2br($value['perda_perkada']?$value['perda_perkada']['keterangan']:'')!!}</td>
							<td>
								<a href="{{route('fs.f1.edit_mandat_perdaerah',[
								'id_link'=>$id_link,
								'mandat'=>$value['id'],
								'provinsi'=>$d['level']==1?$d['id']:0,
								'kota_kabupaten'=>$d['level']==2?$d['id']:0,'level'=>$d['level']

								])}}" class="btn btn-warning  btn-circle">
									<i class="fa fa-edit"></i>
								</a>
								@if($value['perda_perkada'])

									<button onclick="$('#modal-delete-{{$value['perda_perkada']?$value['perda_perkada']['id']:''}}').appendTo('body').modal()" class="btn btn-danger  btn-circle">
									<i class="fa fa-trash"></i>
								</button>
								<div class="modal fade" id="modal-delete-{{$value['perda_perkada']?$value['perda_perkada']['id']:''}}">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-body">
												<h5 class="text-center">Apakah yakin Menghapus Data Ini?</h5>
											</div>
											<div class="modal-footer">
												<form action="{{route('fs.f1.perda.perkada.perda.delete',['id_link'=>$id_link])}}" method="post">
													@csrf
													<input type="hidden" name="perda_perkada" value="{{$value['perda_perkada']['id']}}">
													<button class="btn btn-danger" type="submit">
														<i class="fa fa-trash"></i>
													</button>
												</form>
											</div>
										</div>
									</div>
								</div>

								@endif
							</td>

						</tr>
					<?php endforeach ?>
				@endforeach
			</tbody>
		</table>

		{{$link->links()}}
	</div>
</div>

@stop