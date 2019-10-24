@extends('layouts.master2')

@section('head_asset')

@stop
@section('content')

<style type="text/css">
	th{
		min-width: 300px;

	}

	th h6{
		color:#fff!important;
	}

</style>
<h5>IDENTIFIKASI KEBIJAKAN (K/L)</h5>
<hr>

@include('form_singkron.component.menu_f1')

 <div class="d-sm-flex align-items-center justify-content-between mb-1">        
  <h5 class="mb-0 ">Mandat</h5>
        <a href="{{route('fs.f1.tambah',['id_link'=>$id_link])}}" class="border-bottom-primary  d-sm-inline-block btn btn-warning" style="margin-bottom: 10px; color:#222;">Tambah Mandat</a>
</div>

<div class="card">
	<div class="card-body table-responsive card-border-top-warning">
		<table class="table table-bordered  table-striped">
			<thead>
				<tr class="table-dark card-border-top-warning">
					<th>Sub Urusan</th>
					<th>Undang Undang</th>
					<th>Peraturan Pemerintah</th>
					<th>Peraturan Presiden</th>
					<th>Permen</th>
					<th>Mandat</th>		
					<th>Action</th>		
				</tr>

			</thead>
			<tbody style="overflow-y: scroll;">
				@foreach($datas as $key=> $data)
				<tr>
					<td>{{$data['id_sub_urusan']}}</td>
					<td>
						@isset($data->uu)
							@foreach(json_decode($data->uu) as $val)
								<a href="javascript:void(0)" onclick="SearchingSatuData('{{$val}}')" >{{$val}}</a>
							@endforeach
						@endisset
					</td>
					<td>
						@isset($data->pp)
							@foreach(json_decode($data->pp) as $val)
								<a href="javascript:void(0)" onclick="SearchingSatuData('{{$val}}')" >{{$val}}</a>
							@endforeach
						@endisset
					</td>
					<td>
						@isset($data->perpres)
							@foreach(json_decode($data->perpres) as $val)
								<a href="javascript:void(0)" onclick="SearchingSatuData('{{$val}}')" >{{$val}}</a>
							@endforeach
						@endisset
					</td>
					<td>
						@isset($data->permen)
							@foreach(json_decode($data->permen) as $val)
								<a href="javascript:void(0)" onclick="SearchingSatuData('{{$val}}')" >{{$val}}</a>
							@endforeach
						@endisset
					</td>
					<td>
							@isset($data->mandat)
								@foreach(json_decode($data->mandat) as $val)
									<a href="javascript:void(0)" onclick="SearchingSatuData('{{$val}}')" >{{$val}}</a>
								@endforeach
							@endisset
					</td>

					<td class="">
						<div class="btn-group">
						<a href="" class="btn btn-warning" >Edit</a>
							<button class="btn btn-danger" onclick="$('#modal-delete-{{$data->id}}').appendTo('body').modal()" >Delete</button>
						</div>
						<div class="modal fade" id='modal-delete-{{$data->id}}' tabindex="-1" role="dialog">
						  <div class="modal-dialog" role="document">
						    <div class="modal-content">
						      <div class="modal-header">
						        <h5 class="modal-title">Konfirmasi Penghapusan</h5>
						        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						          <span aria-hidden="true">&times;</span>
						        </button>
						      </div>
						      <div class="modal-body">
						        <p>Apakah Anda Yakin Menhapus Data Ini</p>
						      </div>
						      <div class="modal-footer">
						      	<form action="{{route('fs.f1.delete',['id_link'=>$id_link])}}" method="post">
						      		@csrf
						      		@method('delete')
						        	<input type="hidden"  name="id" value="{{$data->id}}">
						        	<button type="submit" class="btn btn-danger">Delete</button>

						      	</form>
						        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						      </div>
						    </div>
						  </div>
						</div>

							
					</td>
				
				</tr>

				@endforeach
			</tbody>
		</table>
	</div>
</div>

@stop