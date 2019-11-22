@extends('errors.layout')

@section('contain')
	<div id="notfound">
		<div class="notfound">
			<div class="notfound-404">
				<div></div>
				<h1>403</h1>
			</div>
			<h2>Tidak Memiliki Akses Terhadap Data Ini </h2>
			<!-- <p>The page you are looking for might have been removed had its name changed or is temporarily unavailable.</p> -->
			<a href="{{route('fs.index')}}">Home</a>
		</div>
	</div>
@stop
