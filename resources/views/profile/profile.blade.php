@extends('layouts.master')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card border-primary border-bottom-primary">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">My Profile</h6>
          <div class="dropdown no-arrow">
            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
              <!-- <div class="dropdown-header">Dropdown Header:</div> -->
              <a class="dropdown-item" href="#">Edit Profile</a>
              <a class="dropdown-item" href="#">Change Password</a>
            </div>
          </div>
        </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-6 ">
            <div class="form-group">
              <label for="">Nama</label>
              <h5>{{$user->name}}</h5>

            </div>
            <div class="form-group">
              <label for="">Email</label>
              <h5>{{$user->email}}</h5>
            </div>

          </div>
          <div class="col-md-6 border-left-primary">

          </div>

        </div>

      </div>

    </div>

  </div>

</div>

@stop
