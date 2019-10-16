@extends('layouts.master')

@section('head_asset')


@stop

@section('content')
<div class="row">
  <div class="col-md-12">
    <form class="" action="{{route('form_1.update',['id'=>$data['id']])}}" method="post">
      @csrf
      @method('PUT')
      <div class="card border-primary border-bottom-primary">
        <div class="card-header">
          <h5 class="text-center">Edit Sub Urusan {{$data['k_sub_urusan']}}</h5>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="">Sub Urusan</label>
                <textarea name="f[sub_urusan]" required placeholder="Berisi Satu Sub Urusan" class="form-control" rows="4" cols="80">{!! nl2br($data['k_sub_urusan']) !!}</textarea>
              </div>
            </div>
          </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="">Undang Undang</label>
              @include('init.input.themplate.add_data_master',['field_db'=>'nama_uu','name_field'=>'f[uu][]','title'=>'UU','tb'=>'form_1_uu','value_init'=>$data['list_uu']])
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              @include('init.input.themplate.add_data_master',['field_db'=>'nama_pp','name_field'=>'f[pp][]','title'=>'PP','tb'=>'form_1_pp','value_init'=>$data['list_pp']] )
            </div>

          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              @include('init.input.themplate.add_data_master',['field_db'=>'nama_perpres','name_field'=>'f[perpres][]','title'=>'Perpres','tb'=>'form_1_perpres','value_init'=>$data['list_perpres']])
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              @include('init.input.themplate.add_data_master',['field_db'=>'nama_permen','name_field'=>'f[permen][]','title'=>'Permen','tb'=>'form_1_permen','value_init'=>$data['list_permen']])
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="">Mandat Ke Daerah</label>
              <textarea name="f[mandat]" required placeholder="Berisi Satu Sub Urusan" class="form-control" rows="4" cols="80">{!! nl2br($data['k_mandat']) !!}</textarea>
            </div>
          </div>
        </div>
        <hr>
        <h5>Kebijakan Daerah</h5>
        <hr>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group container-perda">
              <label for="">Perda</label>
              <textarea name="f[perda][]" class="form-control perda"  rows="3" cols="80"></textarea>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group container-perkada">
              <label for="">Perkada</label>
              <textarea name="f[perkada][]" class="form-control perkada"  rows="3" cols="80"></textarea>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="">Kesesuian NSPK dan Kebijakan Daerah</label>
              <div class='custom-control custom-checkbox'>
                <input type='radio' name='f[kesesuian]' required value='1' class='custom-control-input' {{$data['k_kesesuaian']?'checked':''}} id='ckf1-1'>
                <label class='custom-control-label' for='ckf1-1'>Sesuai</label>
              </div>
              <div class='custom-control custom-checkbox'>
                <input type='radio' name='f[kesesuian]' required value='0' class='custom-control-input' {{$data['k_kesesuaian']?'':'checked'}} id='ckf1-2'>
                <label class='custom-control-label' for='ckf1-2'>Tidak Susuai Sesuai</label>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="">Keterangan</label>
              <textarea name="f[keterangan]"  class="form-control" rows="8" cols="80">{!! nl2br($data['k_keterangan']) !!}</textarea>
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
