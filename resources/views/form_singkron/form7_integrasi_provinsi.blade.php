@extends('layouts.master2')

@section('head_asset')

@stop
@section('content')
<a href="{{route('fs.f7.index',['id_link'=>$id_link])}}" class="btn btn-info btn-sm btn-circle"> <i class="fa fa-arrow-left"></i> </a>
<small> Integrasi</small>
<hr>
<h5>INTEGRASI PROVINSI</h5> 
<hr>

<form action="{{url()->current()}}" method="get">
	<div class="input-group mb-3">
  		<input type="text" class="form-control" placeholder="Search.." name="q" value="{{isset($_GET['q'])?$_GET['q']:''}}" aria-label="" aria-describedby="basic-addon2">
		  <div class="input-group-append">
		    <a type="submit" class="btn btn-warning">
		    	<i class="fa fa-search"></i>
		    </a>
		  </div>
	</div>
</form>

<div class="card table-responsive">
	<div class="card-body">
		<table class="table table-bordered table-striped">
			<tbody>
				@foreach($datas as $d)
				<tr class=>
					<td colspan="5" class="" >
						<b>{{$d['p_nama']}}</b>
					</td>
					<td>
						
					</td>
				</tr>
				<tr class="">
					<th class="bg bg-nas">Kebijakan Pusat</th>
					<th class="bg bg-nas">
						Target Nasional
					</th >
					<th class="bg bg-provinsi">Nomenklatur</th>
					<th class="bg bg-provinsi">Indikator</th>

					<th class="bg bg-provinsi">Nilai Target Daerah</th>
					<th class="bg bg-">Action</th>
				</tr>
				<?php foreach ($d['kebijakan_tahunan'] as  $i): ?>
					<tr>
						<td>
							<p><span class="dot lev1"></span>{{$i['pn']}} <b>(PN)</b>
								<ptab class="ptab">
									<span class="dot lev2"></span>{{$i['pp']}} <b>(PP)</b>
									<ptab class="ptab"><span class="dot lev3"></span>{{$i['kp']}} (<b>KP)</b></ptab>
								</ptab>
							</p>
						</td>
						<td></td>
						<td colspan="4"></td>
						
					</tr>
					@foreach($i['target_pusat'] as $t)
					<tr>
						<td>
							
						</td>
						<td>
							{{$t['target_pusat']}}
						</td>
						<td colspan="3"></td>
						<td>
							<a href="{{route('fs.f7.identifikasi.integrasi_provinsi_tambah',['id_link'=>$id_link,'kode_daerah'=>$d['p_id'],'id_target_pusat'=>$t['id_target_pusat']])}}" class="btn btn-warning btn-sm">
								<i class="fa fa-plus"></i>
							</a>
						</td>
					</tr>
					@foreach($t['target_daerah'] as $td)
					<tr>
						<td colspan="2"></td>
						
						<td class="border-provinsi">
							<p><span class="dot lev1"></span>{{$td['p']}} <b>(P)</b>
								<ptab class="ptab">
									<span class="dot lev2"></span>{{$td['k']}} <b>(K)</b>
									<ptab class="ptab"><span class="dot lev3"></span>{{$td['sub_k']}} <b>(SK)</b></ptab>
								</ptab>
							</p>
						</td>
						<td class="border-provinsi"></td>

						<td class="border-provinsi">{{$td['target_daerah']}}</td>
						<td class="btn-group">
							<a href="" class="btn btn-warning btn-sm">
								<i class="fa fa-edit"></i>
							</a>
							<button class="btn btn-danger btn-sm">
							<i class="fa fa-trash"></i></button>
						</td>
					</tr>
					@endforeach
					@endforeach					
				<?php endforeach ?>
				@endforeach
			</tbody>
		</table>

		{{$data_paginate->links()}}
	</div>
</div>
@stop