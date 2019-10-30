@extends('layouts.master2')

@section('head_asset')

@stop
@section('content')
<h5>INTEGRASI</h5>
<hr>
<div class="card card-border-top-warning">
	<div class="card-body">
		<table class="table">
			<thead>
				<tr>
					<td>Kebijakan Pusat</td>
					<td>Target Nasioanal</td>
					<td>Program</td>
					<td>Kegiatan</td>
					<td>Sub Kegiatan</td>
					<td>Indikator</td>
					<td>Target Akumulasi</td>

				</tr>
			</thead>
			<tbody>
				@foreach($datas as $d)
					<tr>
						<td>{!!$d->prioritas_nasional!!}</td>
						<td>
							{!!$d->program_prioritas!!}
							<br>
							{!!$d->kegiatan_prioritas!!}
						</td>

					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>

@stop