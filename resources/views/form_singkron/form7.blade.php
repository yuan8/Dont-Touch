@extends('layouts.master2')

@section('head_asset')

@stop
@section('content')
<style type="text/css">
	tbody tr td p{
		font-size: 14px;
	}
</style>

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
							<p>{!!nl2br($d->prioritas_nasional)!!}</p>
						</td>
						<td>
							<p>{!!$d->program_prioritas!!}</p>
							<span class=" badge badge-primary">{!!$d->kegiatan_prioritas!!}</span>
						</td>
						<td>
							<p>{!!nl2br($d->indikator)!!}</p>
							

						</td>
						<td>
							<p>{{($d->target_akumulatif)}} {{($d->target_akumulatif_satuan)}}</p>

						</td>
						<td>
							@foreach($d->HaveSubUrusanProvinsi as $subp)
								<span class="badge badge-primary">{{ $subp->nomenklatur->programUp()['nomenklatur']}}</span> 
								<span class="badge badge-info">{{ $subp->nomenklatur->kegiatanUp()['nomenklatur']}}</span>
								<p>{{$subp->nomenklatur->nomenklatur}}</p>
							@endforeach

						</td>
						<td>
							@foreach($d->HaveSubUrusanKabKota as $subp)
								<span class="badge badge-primary">{{ $subp->nomenklatur->programUp()['nomenklatur']}}</span> 
								<span class="badge badge-info">{{ $subp->nomenklatur->kegiatanUp()['nomenklatur']}}</span>
								<p>{{$subp->nomenklatur->nomenklatur}}</p>
							@endforeach
							
						</td>

						<td >
							<a href="{{route('fs.f7.show.identifikasi.tahunan',['id_link'=>$id_link,'id'=>$d->id])}}" class="btn btn-warning btn-circle">
								<i class="fa fa-edit"></i>
							</a>
							<a href="javascript:void(0)" class="btn btn-danger btn-circle">
								<i class="fa fa-trash"></i>
							</a>
						</td>
					</tr>
					
				@endforeach
			</tbody>
		</table>
	</div>
</div>

@stop