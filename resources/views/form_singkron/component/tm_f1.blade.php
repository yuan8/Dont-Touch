<?php
  if(!isset($key)){
    $key=rand(5000,9000);
  }
?>

<form action="{{route('fs.form1.store')}}" method="post" id="fm-1">
  @csrf
  <tr class="table-dark" style="">
  <th style="min-width:50px!important;"></th>
  
  <th id="f_uu">
    
    <div id="ip_uu_tambahan"></div>
    @include('init.input.themplate.add_data_master',['field_db'=>'nama_uu','name_field'=>'f[uu][]','title'=>'UU','tb'=>'form_1_uu'])
  </th>
  <th>
  
    <div id="ip_pp_tambahan"></div>
     @include('init.input.themplate.add_data_master',['field_db'=>'nama_pp','name_field'=>'f[pp][]','title'=>'PP','tb'=>'form_1_pp'])
  
  </th>
  <th>
  
    <div id="ip_perpres_tambahan"></div>
    @include('init.input.themplate.add_data_master',['field_db'=>'nama_perpres','name_field'=>'f[perpres][]','title'=>'Perpres','tb'=>'form_1_perpres'])
  </th>
  <th>
 
    <div id="ip_permen_tambahan"></div>
    @include('init.input.themplate.add_data_master',['field_db'=>'nama_permen','name_field'=>'f[permen][]','title'=>'Permen','tb'=>'form_1_permen'])
  </th>
  <th>
    <div id="ip_mandat_tambahan"></div>
    @include('init.input.themplate.add_data_master',['field_db'=>'mandat','name_field'=>'f[mandat][]','title'=>'Mandat Ke Daerah','tb'=>'form_1_permen'])
  </th>
  <th>
    <h6>Kesesuaian</h6>
     <div class='custom-control custom-checkbox'>
      <input type='radio' name='f[kesesuaian]' value='1' class='custom-control-input' checked='' id='ckf1-1-{{$key}}'>
      <label class='custom-control-label' for='ckf1-1-{{$key}}'>Sesuai</label>
    </div>
    <div class='custom-control custom-checkbox'>
      <input type='radio' name='f[kesesuaian]' value='0' class='custom-control-input' id='ckf1-2-{{$key}}'>
      <label class='custom-control-label' for='ckf1-2-{{$key}}'>Tidak Susuai Sesuai</label>
    </div>
  </th>
  <th>
    
    <div id="ip_perda_tambahan"></div>

    @include('init.input.themplate.add_data_master',['field_db'=>'mandat','name_field'=>'f[mandat][]','title'=>'Mandat Ke Daerah','tb'=>'form_1_permen'])
  </th>
  <th>
  
    <div id="ip_perkada_tambahan"></div>

     @include('init.input.themplate.add_data_master',['field_db'=>'mandat','name_field'=>'f[mandat][]','title'=>'Mandat Ke Daerah','tb'=>'form_1_permen'])
  </th>
  <th>
    <div class="form-group">
          <label>Keterangan</label>
          <textarea style="margin-top:10px;" name='f[keterangan]' class='col-md-12 form-control ip_keterangan' placeholder='Satu Data Inputan' style='overflow: hidden; overflow-wrap: break-word; resize: none; height: 47px;'></textarea>
      
    </div>
  </th>
  
  <th>
    <div class="form-group">
          <label>Action</label>
          <button class="btn btn-warning col-md-12" type="submit">Tambah</button>
    </div>
   </th>
  
  
</tr>
<tr class="text-center">
  <th>1</th>
  <th>2</th>  
  <th>3</th>  
  <th>4</th>  
  <th>5</th>  
  <th>6</th>  
  <th>7</th>  
  <th>8</th>  
  <th>9</th>  
  <th>10</th>  
  <th>11</th>  
  <th>12</th>  

</tr>



</form>