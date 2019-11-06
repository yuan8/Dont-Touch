@extends('layouts.master2')

@section('head_asset')

@stop
@section('content')
<hr>
<h5>INTEGRASI PROVINSI</h5> 
<hr>

<form action="{{url()->current()}}" method="get">
	<div class="input-group mb-3">
  <input type="text" class="form-control" placeholder="Search.." name="q" value="{{isset($_GET['q'])?$_GET['q']:''}}" aria-label="" aria-describedby="basic-addon2">
  <div class="input-group-append">
    <button type="submit" class="btn btn-warning">Search</button>
  </div>
</div>
</form>

<div class="card">
	<div class="card-body">
		<table class="table table-bordered table-striped">
			<tbody>
				@foreach($provinsis as $d)
				<tr class="border-top-primary">
					<td colspan="6" class="text-primary" >{{$d['nama']}}</td>
					<td >
						
					</td>
				</tr>
				<tr class="table-dark">
					<th>Kebijakan Pusat</th>
					<th>
						Target Nasional
					</th>
					<th>Indikator</th>
					<th>Nomenklatur</th>

					<th>Nilai Target Akumulatif</th>
					<th>Nilai Target Daerah</th>
					<th>Action</th>
				</tr>
				<?php foreach ($d['data'] as $key => $i): ?>
					<tr>
						<td>
							{{$i['indetifikasi_kebijakan_tahunan']['prioritas_nasional']}}</td>
						<td>{{$i['indetifikasi_kebijakan_tahunan']['kegiatan_prioritas']}}</td>
						<td>{{$i['indetifikasi_kebijakan_tahunan']['indikator']}}</td>
						
						<td>
							<p>{{$i['nomenklatur']['program_detail']['nomenklatur']}}</p>
							<p style="margin-left: 20px;">{{$i['nomenklatur']['kegiatan_detail']['nomenklatur']}}</p>
							<p style="margin-left: 40px;">{{$i['nomenklatur']['nomenklatur']}}</p>


						</td>
						<td>{{$i['indetifikasi_kebijakan_tahunan']['target_akumulatif']}} {{$i['indetifikasi_kebijakan_tahunan']['target_akumulatif_satuan']}}</td>

						<td>
							{{$i['target_daerah']}} {{$i['indetifikasi_kebijakan_tahunan']['target_akumulatif_satuan']}}
						</td>
						<td>
							<button type="button" class="btn btn-warning btn-circle" onclick="$('#modal-integrasi-{{$d['id_provinsi']}}').appendTo('body').modal()">
								<i class="fa fa-edit"></i>
							</button>
						</td>

						<div class="modal fade " id="modal-integrasi-{{$d['id_provinsi']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						  <div class="modal-dialog" role="document">
						    <div class="modal-content border-top-primary">
						    	<form action="{{route('fs.f7.store_integrasi_target_provinsi',['id_link'=>$id_link,'id'=>$i['id']])}}" method="post">
						    			@csrf
						    			<input type="hidden"  name="kode_daerah" value="{{$d['id_provinsi']}}">
						    			<input type="hidden" name="id_integrasi" value="{{$i['id']}}">

						    		  <div class="modal-header">
								        <h5 class="modal-title" id="exampleModalLabel">{{$d['nama']}}</h5>
								        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
								          <span aria-hidden="true">&times;</span>
								        </button>
								      </div>
								      <div class="modal-body">
								        <div class="form-group">
								        	
								        	<p class="text-primary">{{$i['nomenklatur']['nomenklatur']}}</p>
								        	<hr>
								        	<label>Traget Daerah</label>
								        	<div class="input-group mb-3">
											  <input type="number" class="form-control" value="" name="target_daerah" required="" aria-describedby="basic-addon2">
											  <div class="input-group-append">
											    <span class="input-group-text" id="basic-addon2">
											    	{{$i['indetifikasi_kebijakan_tahunan']['target_akumulatif_satuan']}}
											    </span>
											  </div>
											</div>
								        </div>
								      </div>
								      <div class="modal-footer">
								       <!--  <button type="button" class="btn btn-secondary" data-dismiss="modal">
								        	<i class="fa fa-close"></i>
								        </button> -->
								        <button type="submit"  class="btn btn-warning">
								        	<i class="fa fa-check"></i>
								        </button>
								      </div>
						    	</form>
						    </div>
						  </div>
						</div>

					</tr>					
				<?php endforeach ?>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@stop