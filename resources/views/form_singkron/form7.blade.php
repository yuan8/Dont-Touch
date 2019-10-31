@extends('layouts.master2')

@section('head_asset')

@stop
@section('content')
<h5>INTEGRASI</h5>
<hr>
<div class="card card-border-top-warning">
	<div class="card-body table-responsive">
		<table class="table table-stripted table-bordered card-border-top-warning">
			<thead>
				<tr class="table-dark">
					<th>Kebijakan Pusat</th>
					<th>Target Nasioanal</th>
					<th>Program</th>
					<th>Kegiatan</th>
					<th>Sub Kegiatan</th>
					<th>Indikator</th>
					<th>Target Akumulasi</th>
					<th>Action</th>


				</tr>
			</thead>
			<tbody>
				@foreach($datas as $d)
					<tr>
						<td rowspan="3">{!!$d->prioritas_nasional!!}</td>
						<td rowspan="3">
							{!!$d->program_prioritas!!}
							<br>
							{!!$d->kegiatan_prioritas!!}
						</td>
						<td>aa</td>
						<td>bb</td>
						<td>cc</td>
						<td>dd</td>
						<td>ee</td>
						<td rowspan="3">
							<a href="" class="btn btn-warning btn-circle">
								<i class="fa fa-edit"></i>
							</a>
							<a href="javascript:void(0)" class="btn btn-danger btn-circle">
								<i class="fa fa-trash"></i>
							</a>
						</td>
					</tr>
					<tr>
						<td>aa</td>
						<td>bb</td>
						<td>cc</td>
						<td>dd</td>
						<td>ee</td>

					</tr>
					<tr>
						<td>1</td>
						<td>2</td>
						<td>3</td>
						<td>4</td>
						<td>5</td>
						
					</tr>
					
				@endforeach
			</tbody>
		</table>
	</div>
</div>

@stop