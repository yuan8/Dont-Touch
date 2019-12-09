@extends('layouts.master_def')

@section('head_asset')

@stop
@section('content')
<a href="{{route('fs.f1.perdaerah',['id_link'=>$id_link,'q'=>$daerah['nama']])}}" class="btn btn-info btn-sm"> <i class="fa fa-arrow-left"></i> </a><small> Mandat Perdaerah </small>
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
						<th>{{$mandat->jenis==0?'MANDAT':'KEGIATAN'}}</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>{!!HP::SpliterArrayLink2($mandat->ListUu)!!}</td>
						<td>{!!HP::SpliterArrayLink2($mandat->ListPp)!!}</td>
						<td>{!!HP::SpliterArrayLink2($mandat->ListPerpres)!!}</td>
						<td>{!!HP::SpliterArrayLink2($mandat->ListPermen)!!}</td>
						<td>{!!nl2br($mandat->mandat)!!}</td>
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
					@if($mandat->jenis==0)
						<div class="form-group">
						@if($perdaperkada)
							@include('init.input.themplate.add_multy_data',['field_db'=>'a','name_field'=>'perda[]','title'=>'Perda','tb'=>'ab','value'=>$perdaperkada['perda']])
						@else
							@include('init.input.themplate.add_multy_data',['field_db'=>'a','name_field'=>'perda[]','title'=>'Perda','tb'=>'ab'])
						@endif
						</div>
					@endif
				</div>
				<div class="col-md-6">
					@if($mandat->jenis==0)

					<div class="form-group">
						@if($perdaperkada)
							@include('init.input.themplate.add_multy_data',['field_db'=>'b','name_field'=>'perkada[]','title'=>'Perkada','tb'=>'bc','value'=>$perdaperkada['perkada']])
						@else
							@include('init.input.themplate.add_multy_data',['field_db'=>'b','name_field'=>'perkada[]','title'=>'Perkada','tb'=>'bc'])
						@endif
					</div>
					@endif

				</div>
			</div>
			  <div class="row">
		      <div class="col-md-6">
		        <div class="form-group">



		          <label for="">{{$mandat->jenis==0?'Kesesuian NSPK dan Kebijakan Daerah':'Pelaksanaan Kegiatan'}}</label>
		          <div class='custom-control custom-checkbox'>
		            <input type='radio' name='kesesuaian' required value='1' class='custom-control-input' {{isset($perdaperkada)?($perdaperkada['penilaian']==1?'checked':''):''}} id='ckf1-1'>
		            <label class='custom-control-label' for='ckf1-1'>{{$mandat->jenis==0?'Sesuai':'Dilaksanakan'}}</label>
		          </div>
		          <div class='custom-control custom-checkbox'>
		            <input type='radio' name='kesesuaian' required value='0' class='custom-control-input' id='ckf1-2' {{isset($perdaperkada)?($perdaperkada['penilaian']==1?'':'checked'):'checked'}} >
		            <label class='custom-control-label' for='ckf1-2'>{{$mandat->jenis==0?'Tidak Susuai Sesuai':'Belum Dilaksanakan'}}</label>
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