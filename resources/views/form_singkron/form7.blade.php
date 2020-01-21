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
					<th>Provinsi</th>
					<th>Kota Kabupaten</th>
					<th>Action</th>

				</tr>
			</thead>
			<tbody>
				@foreach($datas as $d)
					<tr>						
						<td>
							<p>
								<span class="dot lev1"></span> <b>PN</b> {{$d['pn']}} 
								<ptab class="ptab">
									<span class="dot lev2"></span><b>PP</b> {{$d['pp']}} 
									<ptab class="ptab"><span class="dot lev3"></span><b>KP</b> {{$d['kp']}} </ptab>
								</ptab>
							</p>
						</td>
						<td>

							
						</td>
						<td>
						</td>
						<td>

						</td>
						<td>
							
						
							
							
						</td>

						<td >
							
						</td>
					</tr>

					@foreach($d['target'] as $target)

						<tr>						
						<td>
							
						</td>
						<td>

							<p>
								<span class="dot lev1"></span>{!!nl2br($target['uraian'])!!} <b></b>
									<ptab class="ptab">
										<span class="dot lev2"></span><b>Target</b> {{$target['target']}} <b>{{$target['satuan']}} </b>
										<ptab class="ptab">
											<span class="dot lev3"></span><b>Lokus</b> {{$target['lokus']}}  
												<ptab class="ptab">
													<span class="dot lev1"></span><b>Pelaksana</b> {{$target['pelaksana']}}
												</ptab>
										</ptab>
									</ptab>
								</ptab>
							</p>
						</td>
						<td>
						</td>
						<td>

						</td>
						<td>
							
						
							
							
						</td>

						<td >
							
						</td>
					</tr>


					@endforeach
					
				@endforeach
			</tbody>
		</table>
	</div>
</div>

@stop