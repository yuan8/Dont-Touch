@extends('layouts.master2')

@section('head_asset')

@stop
@section('content')
<a href="{{route('fs.f1.perdaerah',['id_link'=>$id_link])}}" class="btn btn-info btn-circle"> <i class="fa fa-arrow-left"></i> </a><small> Mandat Perdaerah </small>
<hr>

<h5>{{$daerah['nama']}}</h5>
<div class="card card-border-top-warning" style="margin-bottom: 10px;">

			<div class="card-header">
			Mandat
		</div>
		<div class="card-body">
			<table class="table">
				<thead>
					<tr>
						<th>UU</th>
						<th>PP</th>
						<th>PERPRES</th>
						<th>PERMEN</th>
						<th>MANDAT</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>{!!HP::SpliterArrayLink($mandat->uu)!!}</td>
						<td>{!!HP::SpliterArrayLink($mandat->pp)!!}</td>
						<td>{!!HP::SpliterArrayLink($mandat->perpres)!!}</td>
						<td>{!!HP::SpliterArrayLink($mandat->permen)!!}</td>
						<td>{!!HP::SpliterArray($mandat->mandat)!!}</td>
					</tr>
				</tbody>
				
			</table>
		</div>
		</div>
		<div class="card card-border-top-warning">
			<form action="{{route('fs.f1.perda.perkada.perda.up.or.store',['id_link'=>$id_link])}}" method="post">
			@csrf
		<div class="card-body">
			<div class="row">
				<div class="col-md-6">

					<input type="hidden" name="mandat" value="{{$mandat->id}}"> 
					<input type="hidden" name="provinsi" value="{{$daerah['provinsi']}}"> 
					<input type="hidden" name="kota_kabupaten" value="{{$daerah['id_kota']}}"> 


					@if($perdaperkada)
					<input type="hidden" name="perda_perkada" value="{{$perdaperkada['id']}}">
					@endif
					<div class="form-group">
						@if($perdaperkada)
							@include('init.input.themplate.add_multy_data',['field_db'=>'a','name_field'=>'perda[]','title'=>'Perda','tb'=>'ab','value'=>$perdaperkada['perda']])
						@else
							@include('init.input.themplate.add_multy_data',['field_db'=>'a','name_field'=>'perda[]','title'=>'Perda','tb'=>'ab'])
						@endif
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						@if($perdaperkada)
							@include('init.input.themplate.add_multy_data',['field_db'=>'b','name_field'=>'perkada[]','title'=>'Perkada','tb'=>'bc','value'=>$perdaperkada['perkada']])
						@else
							@include('init.input.themplate.add_multy_data',['field_db'=>'b','name_field'=>'perkada[]','title'=>'Perkada','tb'=>'bc'])
						@endif
					</div>
				</div>
			</div>
			  <div class="row">
		      <div class="col-md-6">
		        <div class="form-group">
		          <label for="">Kesesuian NSPK dan Kebijakan Daerah</label>
		          <div class='custom-control custom-checkbox'>
		            <input type='radio' name='kesesuaian' required value='1' class='custom-control-input' checked='' id='ckf1-1'>
		            <label class='custom-control-label' for='ckf1-1'>Sesuai</label>
		          </div>
		          <div class='custom-control custom-checkbox'>
		            <input type='radio' name='kesesuaian' required value='0' class='custom-control-input' id='ckf1-2'>
		            <label class='custom-control-label' for='ckf1-2'>Tidak Susuai Sesuai</label>
		          </div>
		        </div>
		      </div>
		      <div class="col-md-6">
		        <div class="form-group">
		          <label for="">Keterangan</label>
		          <textarea name="keterangan"  class="form-control" rows="8" cols="80">{!!nl2br($perdaperkada?$perdaperkada->keterangan:'')!!}</textarea>
		        </div>
		      </div>
		    </div>
		</div>
		<div class="card-footer modal-footer">
			<button type="submit" class="btn btn-warning border-bottom-info">Submit</button>
		</div>

</form>
</div>

@stop