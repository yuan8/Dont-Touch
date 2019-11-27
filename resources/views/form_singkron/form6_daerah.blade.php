@extends('layouts.master2')

@section('head_asset')

@stop
@section('content')
<a href="{{route('fs.f6.index',['id_link'=>$id_link])}}" class="btn btn-info btn-sm"> <i class="fa fa-arrow-left"></i> </a>

<small> Data Pelaksanaan Urusan Lingkup SUPD 2 </small>
<hr>
<h5>Data Pelaksanaan Urusan Lingkup SUPD 2 Daerah</h5>
<hr>

<form action="{{url()->current()}}" method="get">
	<div class="input-group mb-3">
  <input type="text" class="form-control" placeholder="Search.." name="q" value="{{isset($_GET['q'])?$_GET['q']:''}}" aria-label="" aria-describedby="basic-addon2">
  <div class="input-group-append">
    <button type="submit" class="btn btn-warning">Search</button>
  </div>
</div>
	
</form>

<div class="card crad-border-top-warning">
	<div class="card-body">
		<table class="table table-bordered ">
			<tbody>
				<?php $id_sub_last=''; ?>
				@foreach($datas as $d)
					<tr class="border-bottom-warning">
						<th colspan="4">{{$d['nama']}}</th>
					</tr>
							
					@foreach($d['have_program'] as $key=> $p )
						<tr>
							<td>
								@if($p['id']!=$id_sub_last)
									<a href="{{route('fs.f6.show_program_daerah',['id_link'=>$id_link,'id_daerah'=>$d['id'],'id_program'=>$p['id']])}}" class="btn btn-warning btn-circle">
										<i class="fa fa-edit"></i>
									</a>
								@endif
							</td>
							<td colspan="3" class="">
								@if($p['id']!=$id_sub_last)
									{{$p['nama']}}
								@endif
							</td>
						</tr>
						<tr class="table">
							<td></td>
						<th class="border-bottom-warning">Indikator</th>
						<th class="border-bottom-warning">Data</th>

						</tr>
						
						<?php $id_sub_last=$p['id']; ?>
						@foreach($p['have_data'] as $dt)
							<tr>
								<td></td>
								<td>{{$dt['indikator']}}</td>
								<td>{!!HP::SpliterArray($dt['data'])!!}</td>
							</tr>

						@endforeach

					@endforeach
					

				@endforeach
				
			</tbody>
		</table>

		{{$model->links()}}
	</div>
</div>


@stop