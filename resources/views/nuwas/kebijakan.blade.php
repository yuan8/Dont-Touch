

@extends('layouts.layout_nuwas')

@section('head_asset')

@stop
@section('content')
<h5>Profile Kebijakan</h5>
<hr>

<div class="card">
	<div class="card-body table-responsive card-border-top-warning">
		<table class="table table-bordered  table-striped">
			<thead>
				<tr class=" card-border-top-warning">

					<th>Undang Undang</th>
					<th>Peraturan Pemerintah</th>
					<th>Peraturan Presiden</th>
					<th>Permen</th>
					<th>Mandat</th>		
				</tr>

			</thead>
			<tbody style="overflow-y: scroll;">
				@foreach($datas as $key=> $data)
				<tr style="{{$data['jenis']==1?'background:#fbe490c2;':''}}">
					
					
					<td>
						{!!HP::SpliterArrayLink2($data->ListUu)!!}
					</td>
					<td>
						{!!HP::SpliterArrayLink2($data->ListPp)!!}
					</td>
					<td>
						{!!HP::SpliterArrayLink2($data->ListPerpres)!!}
						
					</td>
					<td>
						{!!HP::SpliterArrayLink2($data->ListPermen)!!}
					
					</td>
					<td>
						{!!($data->mandat)!!}
							
					</td>

					
				
				</tr>

				@endforeach
			</tbody>
		</table>
		{{$datas->links()}}
	</div>
</div>

@stop