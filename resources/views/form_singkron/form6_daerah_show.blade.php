@extends('layouts.master_def')

@section('head_asset')

@stop
@section('content')

<h5>Data Pelaksanaan Urusan Lingkup SUPD 2</h5>
<hr>
<a href="{{route('fs.f6.daerah',['id_link'=>$id_link])}}" class="btn btn-info btn-sm"> <i class="fa fa-arrow-left"></i> </a>

<small> Data Pelaksanaan Urusan Lingkup SUPD 2 Daerah | {{$program->nama}}</small>
<hr>
<div class="row">
	<div class="col-md-6">
		<table class="table bg-w table-bordered">
			<thead>
				<tr>
					<th colspan="2"><h5>{{$daerah->nama}}</h5></th>
					<th>
						<button class="btn btn-sm btn-warning " onclick="$('#modal-add').appendTo('body').modal()">
							<i class="fa fa-plus"></i>
						</button>


						<div class="modal fade" id="modal-add" aria-modal="true" >
							<div class="modal-dialog">
								<form action="{{route('fs.f6.add_program_daerah',['id_link'=>$id_link,'id_program'=>$program->id,'kode_daerah'=>$daerah->id] )}}" method="post">
									@csrf
									@method('PUT')
									<div class="modal-content">
									<div class="modal-header">
										<h5>{{$program->nama}}</h5>
									</div>
									<div class="modal-body">
										<div class="form-group">
											<label>Indikator</label>
											<textarea class="form-control" name="indikator"required></textarea>
										</div>
										<div class="form-group">
											@include('init.input.themplate.add_multy_data',['field_db'=>'','name_field'=>'data[]','title'=>'Data','tb'=>''])
										</div>
									</div>
									<div class="modal-footer">
										
											<button class="btn btn-warning btn-sm" type="submit">
												<i class="fa fa-check"></i>
											</button>
									</div>
								</div>
								</form>
							</div>
						</div>

					</th>
					<th rowspan="2">Action</th>
				</tr>
				<tr>
					<th>Sub Urusan</th>
					<th>Indikator</th>
					<th>Data</th>
				</tr>
			</thead>
			<tbody>
				@foreach($data as $dp)
				<tr>
					<td>{{$program->nama}}</td>
					<td>{!!nl2br($dp['indikator'])!!}</td>
					<td>{!!HP::SpliterArray($dp['data'])!!}</td>
				
					<td>
						<a href="javascript:void(0)" class="btn btn-warning btn-sm btn-circle" onclick="$('#modal-show-{{$dp['id']}}').appendTo('body').modal()">
							<i class="fa fa-edit"></i>
						</a>

						<div class="modal fade" id="modal-show-{{$dp['id']}}" aria-modal="true" >
							<div class="modal-dialog">
								<form action="{{route('fs.f6.update_program_daerah',['id_link'=>$id_link,'id'=>$dp['id']] )}}" method="post">
									@csrf
									@method('PUT')
									<div class="modal-content">
									<div class="modal-header">
										<h5>{{$program->nama}}</h5>
									</div>
									<div class="modal-body">
										<div class="form-group">
											<label>Indikator</label>
											<textarea class="form-control" name="indikator">{!!nl2br($dp['indikator'])!!}</textarea>
										</div>
										<div class="form-group">
											@include('init.input.themplate.add_multy_data',['field_db'=>'','name_field'=>'data[]','title'=>'Data','tb'=>'','value'=>$dp['data']])
										</div>
									</div>
									<div class="modal-footer">
										
											<button class="btn btn-warning btn-sm" type="submit">
												<i class="fa fa-check"></i>
											</button>
									</div>
								</div>
								</form>
							</div>
						</div>

						<button class="btn btn-sm btn-danger btn-circle" onclick="$('#modal-delete-{{$dp['id']}}').appendTo('body').modal()">
							<i class="fa fa-trash"></i>
						</button>

						<div class="modal fade" id="modal-delete-{{$dp['id']}}" aria-modal="true" >
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-body">
										<h5 class="text-center">Apakah Anda Yakin Menghapus Data Ini?</h5>
									</div>
									<div class="modal-footer">
										<form action="{{route('fs.f6.delete_program_daerah',['id_link'=>$id_link,'id'=>$dp['id']])}}" method="post">
											@csrf
											@method('DELETE')
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

			</tbody>
		</table>

	</div>


	<div class="col-md-6">
		<table class="table bg-w table-bordered">
			<thead>
				<tr>
					<th colspan="3"><h5>PUSAT</h5></th>
				</tr>
				<tr>
					<th>Sub Urusan </th>
					<th>Indikator</th>
					<th>Data</th>
				</tr>
			</thead>
			<tbody>
				@foreach($data_pusat as $dp)
				<tr>
					<td>{{$program->nama}}</td>
					<td>{!!nl2br($dp['indikator'])!!}</td>
					<td>{!!HP::SpliterArray($dp['data'])!!}</td>

					
				</tr>
				@endforeach
			</tbody>
			
		</table>
	</div>
</div>

@stop