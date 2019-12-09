@extends('layouts.master_def')

@section('head_asset')

@stop
@section('content')
<a href="{{route('fs.f2.index',['id_link'=>$id_link])}}" class="btn btn-info btn-sm"> <i class="fa fa-arrow-left"></i> </a><small> Indetifikasi Kebijakan Pusat 5 tahunan </small>
<hr>

<h5>TAMBAH INDENTIFIKASI KEBIJAKAN PUSAT 5 TAHUNAN</h5>
<div class="card card-border-top-warning">
	<form action="" method="post">
		@csrf

	<div class="card-body">
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label>Sub Urusan</label>
					<select class="form-control" name="sub_urusan" required="">
						@foreach($sub_urusans as $sub)
							<option value="{{$sub->id}}">{{$sub->nama}}</option>
						@endforeach
					</select>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				  @include('init.input.themplate.add_multy_data',['field_db'=>'','name_field'=>'kondisi_saat_ini[]','title'=>'Kondisi Saat Ini','tb'=>''])
			</div>
			<div class="col-md-4">
				  @include('init.input.themplate.add_multy_data',['field_db'=>'','name_field'=>'isu_strategis[]','title'=>'Isu Strategis','tb'=>''])
			</div>

			<div class="col-md-4">
				  @include('init.input.themplate.add_multy_data',['field_db'=>'','name_field'=>'arah_kebijakan[]','title'=>'Arah Kebijakan','tb'=>''])
			</div>		
		</div>

		<div class="row">
			<div class="col-md-4">
				  @include('init.input.themplate.add_multy_data',['field_db'=>'','name_field'=>'sasaran[]','title'=>'Sasaran/Indikator','tb'=>''])
			</div>

			<div class="col-md-4">
				  @include('init.input.themplate.add_multy_data',['field_db'=>'','name_field'=>'target[]','title'=>'Target','tb'=>''])
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
					      <input type='radio' name='kewenangan_pusat' value='1' class='custom-control-input'  id='ckf1-1'>
					      <label class='custom-control-label' for='ckf1-1'>Berwenang</label>
					</div>
					<div class='custom-control custom-checkbox'>
					      <input type='radio' name='kewenangan_pusat' value='0' class='custom-control-input' checked='' id='ckf1-2'>
					      <label class='custom-control-label' for='ckf1-2'>Tidak Berwenang</label>
					</div>
					   
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label>Kewenangan Provinsi</label>
					<hr>
					<div class='custom-control custom-checkbox'>
					      <input type='radio' name='kewenangan_provinsi' value='1' class='custom-control-input'  id='ckf1-3'>
					      <label class='custom-control-label' for='ckf1-3'>Berwenang</label>
					</div>
					<div class='custom-control custom-checkbox'>
					      <input type='radio' name='kewenangan_provinsi' value='0' class='custom-control-input' checked='' id='ckf1-4'>
					      <label class='custom-control-label' for='ckf1-4'>Tidak Berwenang</label>
					</div>
					   
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label>Kewenangan Kota/Kab</label>
					<hr>
					<div class='custom-control custom-checkbox'>
					      <input type='radio' name='kewenangan_kota_kabupaten' value='1' class='custom-control-input'  id='ckf1-5'>
					      <label class='custom-control-label' for='ckf1-5'>Berwenang</label>
					</div>
					<div class='custom-control custom-checkbox'>
					      <input type='radio' name='kewenangan_kota_kabupaten' value='0' class='custom-control-input' checked='' id='ckf1-6'>
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
					<textarea class="form-control" name="keterangan"></textarea>
				</div>
			</div>
		</div>
	</div>
	<div class="card-footer modal-footer">
		<button class="btn btn-warning border-bottom-info">Tambah</button>
	</div>
	</form>
</div>



@stop