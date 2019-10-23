
<div class="d-sm-flex align-items-center justify-content-between mb-4">				
	<h6 class="mb-0 text-gray-800">DATA KEBIJAKAN (K/L) <br>{{$bidang->nama_bidang_urusan}}</h6>
            
    <a onclick="getFromMandat({{$bidang->id}})" class="d-sm-inline-block btn btn-sm btn-primary " style="color:#fff"><i class="fas fa-plus fa-sm"></i> Tambah Mandat</a>
</div>

<div class="card border-primary border-bottom-primary">
	<div class="card-body table-responsive">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>UU</th>
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
				<tbody>
					@foreach($mandats as $mandat)
						<tr>
							<td>
								<?php 
									$uus=json_decode($mandat->uu,true);
								?>
								@foreach($uus as $uu)
								
								@endforeach
							</td>
							<td>
								
							</td>
							<td>
								
							</td>
						</tr>
					@endforeach
				</tbody>
			</thead>
		</table>
	</div>
</div>

<script>

function getFromMandat(id){
		CNDSSApi.post('form/form-input-mandat',{bidang_id:id}).then(function(response){
			$('#container-blog').html(response.data);

		});
	}

</script>