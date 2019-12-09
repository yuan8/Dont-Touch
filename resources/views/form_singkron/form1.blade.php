@extends('layouts.master_def')

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
<div class="col-md-12">
	<span style="width:20px; height:20px; background-color:#fbe490c2;">.</span> Mandat <span style="width:30px; height:20px; background-color:#fbe490c2;">.</span> Kegiatan
</div>
	<hr>

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
					<th>Action</th>		

					<th>Sub Urusan</th>
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
					<td class="">
						<div class="btn-group">
						<a href="{{route('fs.f1.edit',['id_link'=>$id_link,'id'=>$data->id])}}" class="btn btn-warning" >Edit</a>
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
					<td>{{$data->LinkSubUrusan->nama}}</td>
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