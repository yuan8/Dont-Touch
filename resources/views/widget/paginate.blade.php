

<?php 

	if(!isset($jdata)){
		$jdata=1;
	}
	if(!isset($page)){
		$page=1;
	}
	if(!isset($paginate)){
		$paginate=1;
	}

	if(!isset($input)){
		$input=[];
	}

	$left_pg=$page;
	$right_pg=$page;
	$array_left=[];

?>


<div class="btn-group">

	@if(($left_pg-5)>1)
		<?php 
			$input['page']=1;
		 ?>
		<a href="{{url()->current().('?'.http_build_query($input))}}" class="btn btn-success btn-sm">{{$input['page']}}</a>
	@endif

	@for($i=0;$i<5;$i++)
		@if($left_pg>1)
			<?php 
				$left_pg--;
			 	$input['page']=$left_pg;
			 ?>
			 <?php
			$array_left[]='<a href="'.url()->current().('?'.http_build_query($input)).'" class="btn btn-default btn-sm">'.$left_pg.'</a>';
			?>

		@endif
	@endfor

	@foreach(array_reverse($array_left) as $l)
		{!!$l!!}
	@endforeach

	<button type="button" class="btn btn-warning btn-sm" disabled >{{$page}}</button>
	@for($i=0;$i<5;$i++)
		@if(((($right_pg*$paginate)-$paginate)<$jdata))
			<?php 
				$right_pg++;

				$input['page']=$right_pg;
			 ?>
			<a href="{{url()->current().('?'.http_build_query($input))}}" class="btn btn-default btn-sm">{{$right_pg}}</a>
		@endif

	@endfor

	@if((((($page+6)*$paginate))<$jdata))
			<?php 
				$input['page']=(int) ($jdata/$paginate);
			 ?>
			<a href="{{url()->current().('?'.http_build_query($input))}}" class="btn btn-success btn-sm">{{$input['page']}}</a>
	@endif

</div>