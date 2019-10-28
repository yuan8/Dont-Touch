@extends('layouts.layout-map')

@section('head_asset')
<style type="text/css">
	*{
		color:#222!important;
	}
</style>

@stop
@section('content')

<div class="container" style="min-width:100vw; margin-top: 100px;">
	<div class=" d-flex justify-content-center align-items-stretch bd-highlight mb-1">
		@foreach($urusans as $urusan)
		
		<div class="p2 border-primary border-bottom-primary" style="margin:5px;max-width: 100px; background: #f1f1f1; padding:10px;  border-radius: 5px; box-shadow: 5px 5px 10px #222;  ">
			<a href="{{ route('fs.f1.index',['bidang_urusan_link'=>$urusan->id]) }}" class="text-center">
				<img src="{{asset('ass_img/research.png')}}" class="text-center" style="width:100%; margin-bottom: 10px;">
				<h6 style="border-top:2px solid #222; font-size:10px; padding-top:4px; padding-bottom: 4px;">
				<b>{{$urusan->nama}}
				</b>
				</h6>
			</a>
		</div>

		
		@endforeach
	</div>
</div>
@stop