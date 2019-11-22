@extends('layouts.master2')

@section('head_asset')

@stop
@section('content')
<h5>PROGRAM KEGIATAN LINGKUP SUPD II</h5>
<hr>

<div class="form-group">
	<form action="{{url()->current()}}" method="get">
		<div class="row">
		<div class="col-md-3">
			<label>Daerah</label>
			<input type="text" class="form-control" name="daerah" value="{{isset($_GET['daerah'])?$_GET['daerah']:''}}">
		</div>
		
		<div class="col-md-4">
			<label>Program</label>
			<input type="text" class="form-control" name="program" value="{{isset($_GET['program'])?$_GET['program']:''}}">
		</div>
		<div class="col-md-3">
			<label>Kegiatan</label>
			<input type="text" class="form-control" name="kegiatan" value="{{isset($_GET['kegiatan'])?$_GET['kegiatan']:''}}">
		</div>
		<div class="col-md-2">
			<label>Action</label>
			<br>
			<button type="submit" class="btn btn-warning col-md-12">
				<i class="fa fa-search"></i>
			</button>
		</div>
	</div>
	</form>
</div>

<div class="card card-border-top-warning">
	<div class="card-body table-responsive">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th rowspan="2" colspan="5">
						Jenis
					</th>
					<th rowspan="3">Daerah</th>
					<th rowspan="3">Program</th>
					<th rowspan="3">Kegiatan</th>
					<th rowspan="3">Indikator</th>
					<th rowspan="3">Angaran</th>
					<th colspan="2">Target</th>
					<th rowspan="3">OPD Pelaksana</th>
				</tr>
			
				<tr>
				
					
					<th>Awal Perencanaan</th>
					<th>Ahir Perencanaan</th>
				</tr>
				<tr>
					<th>NSPK</th>
					<th>SPM</th>
					<th>PN</th>
					<th>SDGS</th>
					<th>Action</th>
					
					<th>Tahun {{session('focus_tahun')}}</th>
					<th>Tahun {{session('focus_tahun')+1}}</th>
				</tr>
			</thead>
			<tbody>
				@foreach($datas as $d)
				<tr>
					<form action="{{route('fs.f5.update_jenis_kegiatan',['id_link'=>$id_link,'id'=>$d->ID])}}" method="post">
						@csrf

						<td>
							<div class="custom-control custom-switch">
							  <input type="checkbox" class="custom-control-input" id="switch1-{{$d->ID}}"  {{$d->NSPK==1?'checked':''}} name="nspk">
							  <label class="custom-control-label" for="switch1-{{$d->ID}}">NSPK</label>
							</div>
							
						</td>
						<td>
							<div class="custom-control custom-switch">
							  <input type="checkbox" class="custom-control-input" id="switch2-{{$d->ID}}"  {{$d->SPM==1?'checked':''}} name="spm">
							  <label class="custom-control-label" for="switch2-{{$d->ID}}">SPM</label>
							</div>
						</td>
						<td>
							<div class="custom-control custom-switch">
							  <input type="checkbox" class="custom-control-input" id="switch3-{{$d->ID}}"  {{$d->PN==1?'checked':''}} name="pn">
							  <label class="custom-control-label" for="switch3-{{$d->ID}}">PN</label>
							</div>
						</td>
						<td>
							<div class="custom-control custom-switch">
							  <input type="checkbox" class="custom-control-input" id="switch4-{{$d->ID}}"  {{$d->SDGS==1?'checked':''}} name="sdgs">
							  <label class="custom-control-label" for="switch4-{{$d->ID}}">SDGS</label>
							</div>
						</td>
						<td>
							<button type="submit" class="btn btn-warning btn-sm">
								<i class="fa fa-check"></i>
							</button>
						</td>

					</form>
					<td>{{$d->nama}}</td>
					<td>{{$d->nama_program}}</td>
					<td>{{$d->kegiatan}}</td>
					<td>{{$d->indikator}}</td>
					<td>{{$d->anggaran}}</td>
					<td>{{$d->target2020}} {{$d->satuan}}</td>
					<td>{{$d->target2021}} {{$d->satuan}}</td>
					<td>{!!nl2br($d->skpd) !!}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		{{$datas->links()}}
	</div>
</div>


@stop