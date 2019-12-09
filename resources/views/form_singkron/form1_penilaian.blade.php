@extends('layouts.master_def')

@section('head_asset')

@stop
@section('content')
<a href="{{route('fs.f1.index',['id_link'=>$id_link])}}" class="btn btn-info btn-sm"> <i class="fa fa-arrow-left"></i> </a><small> Mandat </small>
<hr>

<h5>Penilaian Mandat Daerah</h5>
<div class="card card-border-top-warning">
	<div class="card-body table-responsive">
		<table class="table table-bordered  table-striped">
			<thead>
				<tr class="table-dark card-border-top-warning">
					<th>
						Sub Urusan
					</th>
					<th>
						Undang Undang
					</th>
					<th>PP</th>
					<th>Perpres</th>
					<th>Permen</th>
					<th>Mandat</th>
					<th>Perda</th>
					<th>Perkada</th>
					<th>Kesesuaian</th>
					<th>Keterangan</th>
					<th>Action</th>





				</tr>
			</thead>
			<tbody style="overflow: scroll;">
				@foreach($datas as $d)
					<tr class="bg bg-warning">
						<td>{{$d->LinkSubUrusan->nama}}</td>
						<td>{!!HP::SpliterArrayLink($d->uu)!!}</td>
						<td>{!!HP::SpliterArrayLink($d->pp)!!}</td>
						<td>{!!HP::SpliterArrayLink($d->perpres)!!}</td>
						<td>{!!HP::SpliterArrayLink($d->permen)!!}</td>
						<td>{!!HP::SpliterArray($d->mandat)!!}</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>

					</tr>
					@foreach($d->HavePerdaPerkada as $pr)
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td>
								{{$pr->LabelDaerah?$pr->LabelDaerah->nama:''}}
								<hr>
								{!!HP::SpliterArrayLink($pr->perda)!!}
								
							</td>
							<td>
								{{$pr->LabelDaerah?$pr->LabelDaerah->nama:''}}
								<hr>

								{!!HP::SpliterArrayLink($pr->perkada)!!}
							</td>
							<td>
								@if($pr->telah_dinilai)
									@if($pr->kesesuaian)
										<button class="btn btn-sm btn-info">Sesuai</button>
									@else
										<button class="btn btn-sm btn-danger">Tidak Sesuai</button>

									@endif

								@else
									<button class="btn btn-sm btn-success">Belum Dinilai</button>

								@endif


							</td>
							<td>
								{!!nl2br($pr->keterangan)!!}
							</td>
							<td>
								<a href="#" class="btn btn-warning btn-sm" >Penilaian</a>
							</td>




						</tr>			
					@endforeach
				@endforeach
			</tbody>
		</table>
	</div>
</div>

@stop