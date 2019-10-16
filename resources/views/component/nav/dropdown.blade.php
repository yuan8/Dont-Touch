<a class="dropdown-item" href="#}">
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
