
<a class="dropdown-item" href="javascript:void(0)" onclick="$('#rubah_tahun_modal').appendTo('body').modal()" >
  <i class="fas fa fa-calendar fa-sm fa-fw mr-2 text-gray-400"></i>
  Rubah Tahun
</a>

<a class="dropdown-item" href="{{route('profile')}}">
  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
  Profile
</a>
<!-- <a class="dropdown-item" href="#">
  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
  Settings
</a>
<a class="dropdown-item" href="#">
  <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
  Activity Log
</a>
<div class="dropdown-divider"></div> -->
<form id='logout-form' class="" action="{{url('logout')}}" method="post">
  @csrf

</form>
<a class="dropdown-item" id="" href="#" onclick="$('#logout-form').submit()" data-toggle="modal" data-target="#logoutModal">
  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
  Logout
</a>

<div class="modal" tabindex="-1" role="dialog" id="rubah_tahun_modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
     <form action="{{route('rubah_tahun')}}" method="post">
     	@csrf
     	 <div class="modal-header">
	        <h5 class="modal-title">Rubah Tahun</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <select class="form-control" name="tahun" required="" id="modal-select-rubah-tahun">
	        	<?php for($i=(date('Y')+1);((date('Y'))-3)<=$i;$i--){ ?>
	        	<option value="{{$i}}" {{session('focus_tahun')==$i?'selected':''}}>{{$i}}</option>
	        	<?php } ?> 
	        </select>

	       <!--  <script type="text/javascript">
	        	$('#modal-select-rubah-tahun').select2();
	        </script> -->
	      </div>
	      <div class="modal-footer">
	        <button type="submit" class="btn btn-warning">Rubah</button>
	      </div>
     </form>
    </div>
  </div>
</div>
