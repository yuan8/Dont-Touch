@extends('layouts.master2')

@section('head_asset')

@stop
@section('content')
<a href="{{route('fs.f6.index',['id_link'=>$id_link])}}" class="btn btn-info btn-circle"> <i class="fa fa-arrow-left"></i> </a>

<small> Data Pelaksanaan Urusan Lingkup SUPD 2 </small>
<hr>
<h5>Tambah Data Pelaksanaan Urusan Lingkup SUPD 2 Pusat</h5>
<hr>

<div class="card card-border-top-warning">
	<form action="{{route('fs.f6.pusat_update',['id_link'=>$id_link,'id'=>$data->id])}}" method="post">
		@csrf
		@method('PUT')
		<div class="card-body">
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label>Program</label>
					<select class="form-control" id="program" name="program" required="">
						@foreach($program as $p)
							<option value="{{$p->id}}" {{$data->id_sub_urusan==$p->id?'selected':''}}>{{$p->nama}}</option>
						@endforeach
					</select>

					<script type="text/javascript">
						$('#program').select2();
					</script>
				</div>

				<div class="form-group">
					<label>Indikator</label>
					<textarea style="min-height: 200px!important;" name="indikator"  required class="form-control">{!!$data->indikator!!}</textarea>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					 @include('init.input.themplate.add_multy_data',['field_db'=>'','name_field'=>'data[]','title'=>'Data','tb'=>'','value'=>$data->data])
				</div>
			</div>
		</div>
	</div>
	<div class="card-footer modal-footer">
		<button type="submit" class="btn btn-warning">Tambah</button>
	</div>
	</form>
</div>


@stop