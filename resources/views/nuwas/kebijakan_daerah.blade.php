@extends('layouts.layout_nuwas')

@section('head_asset')

@stop
@section('content')
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
					<tr class="bg " style="border-bottom: 2px solid #222;">
						<td colspan="7">{{$d['nama']}}</td>
					</tr>
					<tr class="">
						
						<th>
							Mandat / Kegiatan
						</th>
						<th>Perda</th>
						<th>Perkada</th>
						<th>Kesesuaian / Pelaksanaan</th>
						<th>Keterangan</th>


					</tr>
					<?php foreach ($d['mandat'] as $key => $value): ?>
						<tr  style="{{$value['jenis']==1?'background:#fbe490c2;':''}}">
							
							<td>
								@if($value['jenis']==1)
									-
								@else
									{!!($value['mandat'])!!}
								@endif
								
							</td>
							<td>
								@if($value['jenis']==1)
									-
								@else
									{!!HP::SpliterArrayLink(($value['perda_perkada'])?$value['perda_perkada']['perda']:'[]')!!}
								@endif
							</td>
							<td>
								@if($value['jenis']==1)
									-
								@else
									{!!HP::SpliterArrayLink(($value['perda_perkada'])?$value['perda_perkada']['perkada']:'[]')!!}
								@endif
								
							</td>
							<td>
								@if($value['jenis']==0)
									@if(($value['perda_perkada'])?$value['perda_perkada']['telah_dinilai']:0)

										@if(($value['perda_perkada'])?$value['perda_perkada']['penilaian']:0)
											<button class="btn btn-sm btn-info" disabled>Sesuai</button>
										@else
											<button class="btn btn-sm btn-danger" disabled="">Tidak Sesuai</button>

										@endif
									@else
										<button class="btn btn-sm btn-success" disabled="">Belum Dinilai</button>
									@endif

								@else

									@if(($value['perda_perkada'])?$value['perda_perkada']['telah_dinilai']:0)

										@if(($value['perda_perkada'])?$value['perda_perkada']['penilaian']:0)

											<button class="btn btn-sm btn-info" disabled="">Dilaksanakan</button>
										@else
											<button class="btn btn-sm btn-danger" disabled="">Belum Dilaksanakan</button>
										@endif
									@else
										<button class="btn btn-sm btn-danger" disabled="">Belum Dilaksanakan</button>
									@endif



								@endif
							</td>
							<td>{!!nl2br($value['perda_perkada']?$value['perda_perkada']['keterangan']:'')!!}</td>
							

						</tr>
					<?php endforeach ?>
				@endforeach
			</tbody>
		</table>

		{{$link->links()}}
	</div>
</div>

@stop