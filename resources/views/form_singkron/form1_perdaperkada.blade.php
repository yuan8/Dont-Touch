@extends('layouts.master2')

@section('head_asset')

@stop
@section('content')
<a href="{{route('fs.f1.index',['id_link'=>$id_link])}}" class="btn btn-info btn-circle"> <i class="fa fa-arrow-left"></i> </a><small> Mandat </small>
<hr>


<form action="{{route('fs.f1.perda.perkada.filter',['id_link'=>$id_link])}}" method="post">
	@csrf
 <div class="d-sm-flex align-items-center justify-content-between mb-1">        
  	<h5 class="mb-0 ">Perda Perkada</h5>
    <button class="border-bottom-primary  d-sm-inline-block btn btn-warning" style="margin-bottom: 10px; color:#222;">Filter Daerah</button>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="card card-border-top-warning">
			<div class="card-header">
				<h5 class="text-center">Filter Daerah</h5>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>Provinsi</label>
							<select class="form-control" onchange="getKota(this)" required="" name="provinsi" id="provinsi">
								@foreach($provinsis as $provinsi)
									<option value="{{$provinsi->id_provinsi}}">{{$provinsi->nama}}</option>
								@endforeach
							</select>

							<script type="text/javascript">
								$('#provinsi').select2();
							</script>
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<label>Kota Kabupaten</label>
							<select class="form-control" name="kotakab" id="kotakab">
								<option value="0">-- Khusus Provinsi --</option>
							</select>

							<script type="text/javascript">
								$('#kotakab').select2();
							</script>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


</form>


<script type="text/javascript">
	
	function getKota(dom){
		var val=$(dom).val();
		console.log(val);
		var data={
			id_provinsi:val
		}

		CNDSSApi.post('/daerah/kabupaten-from-provinsi-id',data).then(function(res){
			
			$('#kotakab').html('');
			$('#kotakab').val('');
			var dm='';
			for(var i=0;i<res.data.length;i++){
				dm+='<option value="'+res.data[i].id_kota+'">'+res.data[i].nama+'</option>';
			}

			$('#kotakab').html(dm);
			$('#kotakab').select2();

		});
	}

	getKota($('#provinsi'));
</script>


@stop