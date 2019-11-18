<?php
  if(!isset($key)){
    $key=rand(5000,9000);
  }
?>
<tr>
  <td>
    <textarea required='' type='text' class='col-md-12 form-control' placeholder='Satu Data Inputan' name='f[{{$key}}][sub_urusan]' style='overflow: hidden; overflow-wrap: break-word; resize: none; height: 47px;'></textarea>
  </td>
  <td id="f_uu">
    <button type="button" onclick="$('#f_uu').append($($('.ip_uu')[0]).clone());" class="btn btn-primary btn-xs col-md-12" name="button">+</button>

    <textarea style="margin-top:10px;" name='f[{{$key}}][uu]' class='col-md-12 form-control ip_uu' placeholder='Satu Data Inputan' style='overflow: hidden; overflow-wrap: break-word; resize: none; height: 47px;'></textarea>
  </td>
  <td>
    <textarea name='f[{{$key}}][pp]' class='col-md-12 form-control' placeholder='Satu Data Inputan' style='overflow: hidden; overflow-wrap: break-word; resize: none; height: 47px;'></textarea>
  </td>
  <td>
    <textarea name='f[{{$key}}][perpres]' class='col-md-12 form-control' placeholder='Satu Data Inputan' style='overflow: hidden; overflow-wrap: break-word; resize: none; height: 47px;'></textarea>
  </td>
  <td>
    <textarea name='f[{{$key}}][permen]' class='col-md-12 form-control' placeholder='Satu Data Inputan' style='overflow: hidden; overflow-wrap: break-word; resize: none; height: 47px;'></textarea>
  </td>
  <td>
    <textarea name='f[{{$key}}][mandat_kedaerah]' class='col-md-12 form-control' placeholder='Satu Data Inputan' style='overflow: hidden; overflow-wrap: break-word; resize: none; height: 47px;'></textarea>
  </td>
  <td>
    <textarea name='f[{{$key}}][perda]' class='col-md-12 form-control' placeholder='Satu Data Inputan' style='overflow: hidden; overflow-wrap: break-word; resize: none; height: 47px;'></textarea>
  </td>
  <td>
    <textarea name='f[{{$key}}][perkada]' class='col-md-12 form-control' placeholder='Satu Data Inputan' style='overflow: hidden; overflow-wrap: break-word; resize: none; height: 47px;'>
    </textarea>
  </td>
  <td>
    <div class='custom-control custom-checkbox'>
      <input type='radio' name='f[{{$key}}][kesesuian]' value='1' class='custom-control-input' checked='' id='ckf1-1-{{$key}}'>
      <label class='custom-control-label' for='ckf1-1-{{$key}}'>Sesuai</label>
    </div>
    <div class='custom-control custom-checkbox'>
      <input type='radio' name='f[{{$key}}][kesesuian]' value='0' class='custom-control-input' id='ckf1-2-{{$key}}'>
      <label class='custom-control-label' for='ckf1-2-{{$key}}'>Tidak Susuai Sesuai</label>
    </div>
  </td>
  <td>
    <textarea name='f[{{$key}}][keterangan]' class='col-md-12 form-control' placeholder='Satu Data Inputan' style='overflow: hidden; overflow-wrap: break-word; resize: none; height: 47px;'></textarea>
  </td>
</tr>
