@extends('layouts.master_def')

@section('head_asset')

@stop
@section('content')
<style type="text/css">
	tbody tr td p{
		font-size: 14px;
	}
</style>
<a href="" class="btn btn-warning">Berdasarkan Mandat / Kegiatan</a>
<hr>
<h5>INTEGRASI</h5>
<hr>
<div class="card card-border-top-warning">
	<div class="card-body table-responsive">
		<table class="table table-stripted table-bordered card-border-top-warning">
			<thead>
				<tr class="table-dark">
					<th>Kebijakan Pusat</th>
					<th>Target Nasioanal</th>
					<th>Indikator</th>
					<th>Nilai Target Akumulatif</th>
					<th>Provinsi</th>
					<th>Kota Kabupaten</th>
					<th>Action</th>

				</tr>
			</thead>
			<tbody>
				@foreach($datas as $d)
					<tr>						
						<td>
							<p>{!!$d['pn']!!}</p>
						</td>
						<td>
							<p>{!!$d['pp']!!}</p>
							<p class="text-primary">{!!$d['kp']!!}</p>
						</td>
						<td>
							<p>{!!$d['kp']!!}</p>
						</td>
						<td>
							<p>{!!$d['target_akumulatif']!!} {!!$d['satuan_target']!!}</p>

						</td>
						<td>
							
						</td>
						<td>
							
							
						</td>

						<td >
							
						</td>
					</tr>
					
				@endforeach
			</tbody>
		</table>
	</div>
</div>

@stop