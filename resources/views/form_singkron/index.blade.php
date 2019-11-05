@extends('layouts.layout-map')

@section('head_asset')
<style type="text/css">
	*{
		color:#222!important;
	}
</style>

@stop
@section('content')

<div class="container" style="min-width:100vw; min-height: calc(100vh - 200px); margin-top: 100px;">

	<div class="row justify-content-center" >
		<div class="col-md-6">
				<div class=" row ">
		@foreach($urusans as $urusan)
		
		<div class="col-2" style="margin-bottom: 15px;">
			<div class="col-12 border-bottom-primary" style="background: #f1f1f1; padding:10px;  border-radius: 5px; height: 100%;  box-shadow: 5px 5px 10px #222;  ">
					<a href="{{ route('fs.f1.index',['bidang_urusan_link'=>$urusan->id]) }}" class="text-center">
				<img src="{{asset('ass_img/research.png')}}" class="text-center" style="width:100%; margin-bottom: 10px;">
				<h6 style="border-top:2px solid #222; font-size:10px; padding-top:4px; padding-bottom: 4px;">
				<b>{{$urusan->nama}}
				</b>
				</h6>
			</a>
			</div>
		</div>

		
		@endforeach
	</div>
		</div>
	</div>



</div>
    @include('component.ubah_tahun')

@stop