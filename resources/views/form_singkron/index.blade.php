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
	<div class="row">
		@foreach($urusans as $urusan)

		<div class="col-md-3">
			<h5 style="border-top:5px solid #222; border-bottom:5px solid #222; padding-top:4px; padding-bottom: 4px;">
				<b>{{$urusan->nama_bidang_urusan}}
				</b>
			</h5>
		</div>

		@endforeach
	</div>
</div>
@stop