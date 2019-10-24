@extends('layouts.master2')

@section('head_asset')

@stop
@section('content')

<a href="{{route('fs.f1.perda.perkada.perdaerah',['id_link'=>$id_link,'provinsi'=>$data_daerah['provinsi'],'kotakab'=>$data_daerah['kotakab']]) }}" class="btn btn-info btn-circle"> <i class="fa fa-arrow-left"></i> </a><small> Perda Perkada | {{$daerah['nama']}} </small>
<hr>
<div class="d-sm-flex align-items-center justify-content-between mb-1">        
  <h5 class="mb-0 ">Tambah Perda Perkada | <small style="color:#36b9cc">{{$daerah['nama']}}</small></h5>
       
</div>
<div class="card card-border-top-warning">
	<form action="" method="post">
		@csrf

			<div class="card-body">
		<div class="row">
			<div class="col-md-3">
				<div class="form-group">
					<label>Mandat</label>
					<select class="form-control" required=""  onchange="
	getmandat(this)" id="sub_urusan" name="sub_urusan">
						@foreach($sub_urusans as $sub)
							<option value="{{$sub->id}}">
								{{$sub->nama}}
							</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label>Mandat</label>
					<select class="form-control" required="" name="mandat" id="mandat">
						@foreach($mandats as $mandat)
							<option value="{{$mandat->id}}">
								<?php
								foreach (json_decode($mandat->mandat) as $key => $value) {
								?>
									<p>{!!$value!!}</p>

								<?php
								}

								?>

							</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label>Tahun</label>
					<input type="hidden" name="kotakab" value="{{$data_daerah['kotakab']}}">
					<input type="hidden" name="provinsi" value="{{$data_daerah['provinsi']}}">
					<input type="hidden" name="urusan" value="{{$id_link}}">

					<select class="form-control" id="tahun" require name="tahun">
						<?php
							for($i=(date('Y')-6);$i<(date('Y')+6);$i++){
						?>
						<option value="{{$i}}">{{$i}}</option>

						<?php 
							}
						?>
					</select>
					<script type="text/javascript">
						$('#tahun').select2();
					</script>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					  @include('init.input.themplate.add_multy_data',['field_db'=>'','name_field'=>'perda[]','title'=>'Perda','tb'=>'perda'])
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					  @include('init.input.themplate.add_multy_data',['field_db'=>'','name_field'=>'perkada[]','title'=>'Perkada','tb'=>'perkada'])
				</div>
			</div>
		</div>
	</div>
	<div class="card-footer modal-footer">
		<button class="btn btn-warning border-bottom-info">Tambah</button>
	</div>
	</form>
</div>


<script type="text/javascript">
	
	$('#sub_urusan').select2();


		function getmandat(dom){
		var val=$(dom).val();
		console.log(val);
		var data={
			sub_urusan:val
		}

		CNDSSApi.post('/form/get-list-mandat',data).then(function(res){
			
			$('#mandat').html('');
			$('#mandat').val('');
			var dm='';
			for(var i=0;i<res.data.length;i++){

				dm+='<option value="'+res.data[i].id+'">';
				var data=JSON.parse((res.data[i].mandat));
				for(var m=0;m<data.length;m++){
					dm+='<label>'+(m+1)+'.'+data[m]+' <br>\r\n </label>';
				}


				dm+='</option>';
			}

			$('#mandat').html(dm);
			$('#mandat').select2();

		});
	}

	getmandat($('#sub_urusan'));
</script>

@stop