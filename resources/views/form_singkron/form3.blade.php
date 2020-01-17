@extends('layouts.master_def')

@section('head_asset')

<?php
	$info_page= HP::paginate($paginate['input'],$paginate['page'],$paginate['jdata'],$paginate['paginate']);
?>
@stop
@section('content')


<div class="d-sm-flex align-items-center justify-content-between mb-1">        
  <h5 class="mb-0 ">IDENTIFIKASI KEBIJAKAN PUSAT TAHUNAN</h5>
        <a href="{{route('fs.f3.tambah',['id_link'=>$id_link])}}" class="border-bottom-primary  d-sm-inline-block btn btn-warning" style="margin-bottom: 10px; color:#222;">Tambah Identifikasi Kebijakan</a>
</div>
<hr>
<div class="card  card-border-top-warning">
	<div class="card-header">
		<h6>{{$info_page['total']}} Data</h6>
	</div>

	<div class="card-body table-responsive">
	<table class="table table-stripted table-bordered">
	<thead>
		<tr class="table-dark">
			<th>Kebijakan Pusat</th>
			<th>RPO PN / Proyek K/L</th>
			<th class="text-center">TARGET NASIONAL</th>
			<th>Action</th>

		</tr>
	</thead>
	<tbody>
		@foreach($datas as $d)
			<tr>
				<td>
					<p>
						<span class="dot lev1"></span>{{$d['pn']}} <b>(PN)</b>
						<ptab class="ptab">
							<span class="dot lev2"></span>{{$d['pp']}} <b>(PP)</b>
							<ptab class="ptab"><span class="dot lev3"></span>{{$d['kp']}} (<b>KP)</b></ptab>
						</ptab>
					</p>
				</td>
				<td>
					@foreach($d['pro_pn'] as $propn)
						<p><span class="dot lev1"></span>{{$propn['propn']}} </p>
					@endforeach
				</td>
				<td>
					@foreach($d['target'] as $target)
						<p><span class="dot lev1"></span>{!!nl2br($target['uraian'])!!} <b></b>
							<ptab class="ptab">
								<span class="dot lev2"></span>{{$target['target']}} <b>{{$target['satuan']}} ({{$target['tahun']}})</b>
								<ptab class="ptab">
									<span class="dot lev3"></span>{{$target['lokus']}} <b>(Lokus)</b>
										<ptab class="ptab">
											<span class="dot lev1"></span>{{$target['pelaksana']}} <b>(Pelaksana)</b>
										</ptab>
								</ptab>
							</ptab>
						</ptab>
						</p>
					@endforeach
				</td>
			</tr>
		@endforeach
	</tbody>
</table>


	{!! $info_page['html'] !!}
</div>
</div>

@stop