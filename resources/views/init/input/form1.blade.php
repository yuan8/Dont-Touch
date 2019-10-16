@extends('layouts.master')

@section('head_asset')


@stop

@section('content')
<div class="row">
  <div class="col-md-12">
    <form class="" action="{{route('form_1.store')}}" method="post">
      @csrf
      <div class="card border-primary border-bottom-primary">
        <div class="card-header">
          <h5 class="text-center">From Input Data Kebijakan (K/L)</h5>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="">Sub Urusan</label>
                @include('init.input.themplate.add_data_master',['multiple'=>false,'field_db'=>'nama_sub_urusan','name_field'=>'f[sub_urusan]','title'=>'Sub Urusan','tb'=>'form_1_sub_urusan'])

              </div>
            </div>
          </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              @include('init.input.themplate.add_data_master',['field_db'=>'nama_uu','name_field'=>'f[uu][]','title'=>'UU','tb'=>'form_1_uu'])
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              @include('init.input.themplate.add_data_master',['field_db'=>'nama_pp','name_field'=>'f[pp][]','title'=>'PP','tb'=>'form_1_pp'])
            </div>

          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              @include('init.input.themplate.add_data_master',['field_db'=>'nama_perpres','name_field'=>'f[perpres][]','title'=>'Perpres','tb'=>'form_1_perpres'])
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              @include('init.input.themplate.add_data_master',['field_db'=>'nama_permen','name_field'=>'f[permen][]','title'=>'Permen','tb'=>'form_1_permen'])
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="">Mandat Ke Daerah</label>
              @include('init.input.themplate.add_multy_data',['field_db'=>'mandat','name_field'=>'f[mandat][]','title'=>'Mandat Ke Daerah','tb'=>'form_1_permen'])
            </div>
          </div>
        </div>
        <hr>
        <h5>Kebijakan Daerah</h5>
        <hr>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group container-perda">
              @include('init.input.themplate.add_multy_data',['field_db'=>'nama_perda','name_field'=>'f[perda][]','title'=>'Perda','tb'=>'form_1_peda'])

            </div>
          </div>
          <div class="col-md-6">

            <div class="form-group" >
              @include('init.input.themplate.add_multy_data',['field_db'=>'nama_perkada','name_field'=>'f[perkada][]','title'=>'Perkada','tb'=>'form_1_perkada'])
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="">Kesesuian NSPK dan Kebijakan Daerah</label>
              <div class='custom-control custom-checkbox'>
                <input type='radio' name='f[kesesuian]' required value='1' class='custom-control-input' checked='' id='ckf1-1'>
                <label class='custom-control-label' for='ckf1-1'>Sesuai</label>
              </div>
              <div class='custom-control custom-checkbox'>
                <input type='radio' name='f[kesesuian]' required value='0' class='custom-control-input' id='ckf1-2'>
                <label class='custom-control-label' for='ckf1-2'>Tidak Susuai Sesuai</label>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="">Keterangan</label>
              <textarea name="f[keterangan]"  class="form-control" rows="8" cols="80"></textarea>
            </div>
          </div>
        </div>

        </div>
        <div class="card-footer">
          <button type="submit" class="btn btn-primary" name="button">Submit</button>
        </div>
      </div>
    </form>

  </div>

</div>
@stop
