@extends('layouts.master2')

@section('head_asset')

@stop
@section('content')

	<div class="card card-border-top-warning ">
		<div class="card-body ">
			<table class="table table-bordered  table-striped">
				<thead>
					<tr class="table-dark">
						<th colspan="8">Kewenagan</th>
					</tr>
					<tr class="table-dark">
						<th>No</th>
						<th>Program</th>
						<th colspan="2">Pusat</th>
						<th colspan="2">Provinsi</th>
						<th colspan="2">Kabupaten</th>
					</tr>
					<tr class="table-dark">
						<th></th>
						<th></th>
						<th>Indikator</th>
						<th>Data</th>

						<th>Indikator</th>
						<th>Data</th>
						
						<th>Indikator</th>
						<th>Data</th>
					
					</tr>
				</thead>
				<tbody>
					@foreach($kewenangans as $key=> $kewenangan)
						<tr>
							<td>{{$key+1}}</td>
							<td>{{$kewenangan->nama_program}}</td>
							<td>{!! nl2br($kewenangan->kewenangan_pusat)!!}</td>
							<td></td>
							<td>{!! nl2br($kewenangan->kewenangan_provinsi)!!}</td>
							<td></td>
							<td>{!! nl2br($kewenangan->kewenangan_kota_kab)!!}</td>
							<td></td>


						</tr>
					@endforeach
				</tbody>
			</table>

		</div>
	</div>


@stop