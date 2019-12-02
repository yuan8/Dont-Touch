@extends('layouts.no-auth')

@section('head_asset')

@stop
@section('content')

<div class="card mb-4">
	<div class="card-body">
		<div class="grid-menu grid-menu-xl grid-menu-3col">
    <div class="no-gutters row">
        <div class="col-sm-6 col-xl-4">
            <a href="{{route('maps')}}" class="btn-icon-vertical btn-square btn-transition btn btn-outline-link">
                <i class="pe-7s-map text-success btn-icon-wrapper btn-icon-lg mb-3"></i>
                Maps
            </a >
        </div>
        <div class="col-sm-6 col-xl-4">
            <a href="{{route('data.index')}}" class="btn-icon-vertical btn-square btn-transition btn btn-outline-link">
                <i class=" pe-7s-rocket text-info btn-icon-wrapper btn-icon-lg mb-3"> </i>
                Dashboard
            </a>
        </div>
        <div class="col-sm-6 col-xl-4">
            <a href="{{Auth::User()?url(''):route('login')}}" class="btn-icon-vertical btn-square btn-transition btn btn-outline-link">
                <i class="pe-7s-user  text-warning btn-icon-wrapper btn-icon-lg mb-3"> </i>
                @if(Auth::User())
                	{{Auth::User()->name}}
                @else
                	Login
                @endif
            </a>
        </div>


       
    </div>
</div>

	
	</div>

</div>

<div class="card  card-btm-border border-danger">
	<div class="card-body">
		<span>
		<h1 class="text-center text-danger">
		<b>{{$data}} </b>
		</h1>
		<p class="text-dark text-center"> Kegiatan</p>

			
		</span>
	</div>
</div>
@stop