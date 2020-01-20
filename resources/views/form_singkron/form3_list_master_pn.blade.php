@extends('layouts.master_def')

@section('head_asset')

@stop
@section('content')

<h5><b>Pilih Kegiatan Prioritas</b> </h5>
<hr>
	<form action="{{url()->current()}}" method="get">

<div class="row mb-4">
		<div class="col-md-12"><p class="text-center"> <b>Cari Kegiatan Prioritas</b> </p></div>
	
	<div class="col-md-3">
		<input type="text" name="pn" class="form-control" placeholder="PN" value="{{isset($_GET['pn'])?$_GET['pn']:''}}">
	</div>
	<div class="col-md-3">
		<input type="text" name="pp" class="form-control" placeholder="PP" value="{{isset($_GET['pp'])?$_GET['pp']:''}}">
	</div>
	<div class="col-md-3">
		<input type="text" name="kp" class="form-control" placeholder="KP" value="{{isset($_GET['kp'])?$_GET['kp']:''}}">
	</div>
	<button type="submit" class="btn-warning btn col-md-3"><i class="fa fa-search"></i>	</button>


</div>
	</form>


<hr>

<div class="row">

	<div class="col-md-12 table-responsive" >
		<div class="card">
			<div class="card-body">
				<table class="table">
					<thead>
						<tr>
							<th>Pilih</th>

							<th>Prioritas Nasional</th>
							<th>Progarm Prioritas</th>
							<th>Kegiatab Prioritas</th>

						</tr>
					</thead>
					<tbody>
						@foreach($data as $d)
						<?php $d= (array) $d; ?>

						<tr>
							<td>
								<a href="{{route('fs.f3.tambah',['id_urusan'=>$id_link,'id_master_pn'=>$d['id']])}}" class="btn btn-warning btn-circle">
									<i class="fa fa-pen"></i>
								</a>
							</td>

							<td>{{$d['prioritas_nasional']}} </td>
							<td>{{$d['program_prioritas']}} </td>
							<td>{{$d['kegiatan_prioritas']}} </td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
	@foreach($data as $d)
	<?php $d= (array) $d; ?>
		<!-- <a class="col-md-4  mb-4 ">
			<div class="card">
				<div class="card-body">
					<p>
						<span class="dot lev1"></span> <b>PN</b> {{$d['prioritas_nasional']}} 
						<ptab class="ptab">
							<span class="dot lev2"></span><b>PP</b> {{$d['program_prioritas']}} 
							<ptab class="ptab"><span class="dot lev3"></span><b>KP</b> {{$d['kegiatan_prioritas']}} </ptab>
						</ptab>
					</p>

				</div>
			</div>
		</a> -->
	@endforeach
</div>


@stop