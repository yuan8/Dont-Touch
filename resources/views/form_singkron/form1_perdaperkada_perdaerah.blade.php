@extends('layouts.master2')

@section('head_asset')

@stop
@section('content')
<a href="{{route('fs.f1.index',['id_link'=>$id_link])}}" class="btn btn-info btn-circle"> <i class="fa fa-arrow-left"></i> </a><small> Mandat </small>
<hr>

<div class="d-sm-flex align-items-center justify-content-between mb-1">        
  	<h5 class="mb-0 ">Perda Perkada | <small style="color:#36b9cc">{{$daerah['nama']}}</small></h5>

    <a href="{{route('fs.f1.perda.perkada.perdaerah.tambah',['id_link'=>$id_link,'provinsi'=>$data_daerah['provinsi'],'kotakab'=>$data_daerah['kotakab']])}}" class="border-bottom-primary  d-sm-inline-block btn btn-warning" style="margin-bottom: 10px; color:#222;">Tambah Perda Perkada</a>
</div>
<h5 class="text-center"></h5>

<div class="card card-border-top-warning">
	<div class="card-body">
		<table class="table table-bordered  table-striped">
			<thead>
				<tr class="table-dark card-border-top-warning">
					<th>
						Sub Urusan
					</th>
					<th>
						Mandat
					</th>
					<th>Perda</th>
					<th>Perkada</th>
				</tr>
			</thead>
			<tbody>
				@foreach($data as $d)
					<tr>
						<td>{{$d->LinkMandat->LinkSubUrusan->nama}}</td>
						<td>{!!HP::SpliterArray($d->LinkMandat->mandat)!!}</td>
						<td>{!!HP::SpliterArray($d->perda)!!}</td>
						<td>{!!HP::SpliterArray($d->perkada)!!}</td>
						


					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>

@stop