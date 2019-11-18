@extends('layouts.master')

@section('head_asset')
<style media="screen">
  .table-responsive table{
    min-width: 100%;
    max-height: auto;
    overflow-x: scroll;
  }
  .tb-input th, .tb-input td{
    min-width: 200px!important;
    min-height: 120px!important;
  }
  .tb-input{

    font-size: 11px;
  }
  .tb-input .form-control{
    font-size: 11px;
  }

</style>
<link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" charset="utf-8"></script>
@stop
@section('content')

<div class="row">
  <div class="col-md-12">
    <div class="card border-primary border-bottom-primary">
      <div class="card-header">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#f1" role="tab" aria-controls="home" aria-selected="true">Form I</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#f2" role="tab" aria-controls="profile" aria-selected="false">From II</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#f3" role="tab" aria-controls="contact" aria-selected="false">Form III</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#f3" role="tab" aria-controls="contact" aria-selected="false">Form IV</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#f3" role="tab" aria-controls="contact" aria-selected="false">Form V</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#f3" role="tab" aria-controls="contact" aria-selected="false">Form VI</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#f3" role="tab" aria-controls="contact" aria-selected="false">Form VII</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#f3" role="tab" aria-controls="contact" aria-selected="false">Form VIII</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#f3" role="tab" aria-controls="contact" aria-selected="false">Form IX</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#f3" role="tab" aria-controls="contact" aria-selected="false">Form X</a>
          </li>

        </ul>
      </div>
      <div class="card-body">
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="f1" role="tabpanel" aria-labelledby="home-tab">
              @include('init.form1')
            </div>
            <div class="tab-pane fade" id="f2" role="tabpanel" aria-labelledby="profile-tab">...</div>
            <div class="tab-pane fade" id="f3" role="tabpanel" aria-labelledby="contact-tab">...</div>
          </div>
      </div>

    </div>

  </div>

</div>

@stop
