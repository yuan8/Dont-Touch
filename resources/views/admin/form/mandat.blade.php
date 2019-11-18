@extends('layouts.master')

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="card border-primary">
			<div class="card-header">
				<h5 class="title">
					
				</h5>
				<div class="row">
					<div class="col-md-3">
						<!-- <select class="form-control">
							<option value="2019">2019</option>
							<option value="2020">2020</option>

						</select>
						<hr> -->
						<a class="nav-link active btn btn-primary btn-sm" >
						 	 Tambah Data Mandat
						</a>
					</div>
					<div class="col-md-8">
						<h5>DATA KEBIJAKAN (K/L)</h5>
					</div>
				</div>

			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-3" style="min-height:100vh; overflow-y: scroll;">
						<h6 class="text-center">List Bidang</h6>
						<hr>

						<nav class="nav flex-column">
							@foreach($bidangs as $bidang)
							<br>
						 	 <a class="nav-link active btn btn-info btn-sm" onclick="getTableData({{$bidang->id}})">
						 	 	{{$bidang->nama_bidang_urusan}}
						 	 </a>
							@endforeach
						
						</nav>
					</div>
					<div class="col-md-9">
						<div class="row">
							<div class="col-md-12">
								
								<div id="container-blog">
									
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>
<script type="text/javascript">
	function getTableData(id){
		CNDSSApi.post('form/form-data-mandat',{bidang_id:id}).then(function(response){
			$('#container-blog').html(response.data);

		});
	}

</script>

@stop