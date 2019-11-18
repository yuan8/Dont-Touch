@extends('layouts.master2')

@section('head_asset')

@stop
@section('content')
<a href="{{route('fs.f2.index',['id_link'=>$id_link])}}" class="btn btn-info btn-circle"> <i class="fa fa-arrow-left"></i> </a><small> Indetifikasi Kebijakan Pusat 5 tahunan </small>
<hr>

<h5>TAMBAH INDENTIFIKASI KEBIJAKAN PUSAT 5 TAHUNAN</h5>
<div class="card card-border-top-warning">
	<form action="{{route('fs.f2.update',['id_link'=>$id_link,'id'=>$data->id])}}" method="post">
		@csrf
		@method('put')

	<div class="card-body">
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label>Sub Urusan</label>
					<select class="form-control" name="sub_urusan" required="">
						@foreach($sub_urusans as $sub)
							<option value="{{$sub->id}}" {{$sub->id==$data->id_sub_urusan?'selected':''}} >{{$sub->nama}}</option>
						@endforeach
					</select>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				  @include('init.input.themplate.add_multy_data',['field_db'=>'','name_field'=>'kondisi_saat_ini[]','title'=>'Kondisi Saat Ini','tb'=>'','value'=>$data->kondisi_saat_ini])
			</div>
			<div class="col-md-4">
				  @include('init.input.themplate.add_multy_data',['field_db'=>'','name_field'=>'isu_strategis[]','title'=>'Isu Strategis','tb'=>'','value'=>$data->isu_strategis])
			</div>

			<div class="col-md-4">
				  @include('init.input.themplate.add_multy_data',['field_db'=>'','name_field'=>'arah_kebijakan[]','title'=>'Arah Kebijakan','tb'=>''
				  ,'value'=>$data->arah_kebijakan])
			</div>		
		</div>

		<div class="row">
			<div class="col-md-4">
				  @include('init.input.themplate.add_multy_data',['field_db'=>'','name_field'=>'sasaran[]','title'=>'Sasaran/Indikator','tb'=>''
				  ,'value'=>$data->sasaran])
			</div>

			<div class="col-md-4">

				  @include('init.input.themplate.add_multy_data',['field_db'=>'','name_field'=>'target[]','title'=>'Target','tb'=>''
				  ,'value'=>$data->target])
			</div>		
		</div>
		<div class="row">
			<div class="col-md-12">
				<hr class="card-border-top-warning">
				<h6 class="text-center">Kewenangan</h6>
				<hr>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label>Kewenangan Pusat</label>
					<hr>
					<div class='custom-control custom-checkbox'>
					      <input type='radio' name='kewenangan_pusat' {{$data->kewenangan_pusat?'checked':''}} value='1' class='custom-control-input'  id='ckf1-1'>
					      <label class='custom-control-label' for='ckf1-1'>Berwenang</label>
					</div>
					<div class='custom-control custom-checkbox'>
					      <input type='radio' name='kewenangan_pusat' {{$data->kewenangan_pusat?'':'checked'}} value='0' class='custom-control-input'  id='ckf1-2'>
					      <label class='custom-control-label' for='ckf1-2'>Tidak Berwenang</label>
					</div>
					   
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label>Kewenangan Provinsi</label>
					<hr>
					<div class='custom-control custom-checkbox'>
					      <input type='radio' name='kewenangan_provinsi' {{$data->kewenangan_provinsi?'checked':''}} value='1' class='custom-control-input'  id='ckf1-3'>
					      <label class='custom-control-label' for='ckf1-3'>Berwenang</label>
					</div>
					<div class='custom-control custom-checkbox'>
					      <input type='radio' name='kewenangan_provinsi' {{$data->kewenangan_provinsi?'':'checked'}} value='0' class='custom-control-input'  id='ckf1-4'>
					      <label class='custom-control-label' for='ckf1-4'>Tidak Berwenang</label>
					</div>
					   
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label>Kewenangan Kota/Kab</label>
					<hr>
					<div class='custom-control custom-checkbox'>
					      <input type='radio' name='kewenangan_kota_kabupaten' {{$data->kewenangan_kota_kabupaten?'checked':''}} value='1' class='custom-control-input'  id='ckf1-5'>
					      <label class='custom-control-label' for='ckf1-5'>Berwenang</label>
					</div>
					<div class='custom-control custom-checkbox'>
					      <input type='radio' name='kewenangan_kota_kabupaten' {{$data->kewenangan_kota_kabupaten?'':'checked'}} value='0' class='custom-control-input'  id='ckf1-6'>
					      <label class='custom-control-label' for='ckf1-6'>Tidak Berwenang</label>
					</div>
					   
				</div>
			</div>
				
		</div>
		<div class="row">
			<div class="col-md-12">
				<hr class="card-border-top-warning">
				<div class="form-group">
					<label>Keterangan</label>
					<textarea class="form-control" name="keterangan">{!!nl2br($data->keterangan)!!}</textarea>
				</div>
			</div>
		</div>
	</div>
	<div class="card-footer modal-footer">
		<button class="btn btn-warning border-bottom-info">Update</button>
	</div>
	</form>
</div>



@stop