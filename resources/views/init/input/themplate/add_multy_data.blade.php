<?php
    if(!isset($key)){
      $key=$tb.date('u').'_'.rand(10,1000);
    }
 ?>

<div class="input-group mb-3 animated flipInX" id="{{$field_db}}-{{$key}}-them" style="display:none;">
    <textarea name="{{$name_field}}" class="form-control "  rows="3" cols="80" aria-describedby="basic-addon2" placeholder="Input {{$title}}...."></textarea>
    <div class="input-group-append">
      <button class="btn btn-danger" onclick="$(this).parent().parent().remove();" type="button">Hapus</button>
    </div>
</div>
<label for="">{{$title}}</label>
<div class="" id="container-{{$field_db}}-{{$key}}">

</div>
<button type="button" class="btn btn-primary btn-sm" id="button-tambah-{{$field_db}}-{{$key}}" name="button">Tambah {{$title}}</button>
<script type="text/javascript">
  function action_button_{{$key}}_{{$field_db}}(value=''){
    var them_perkada=$('#{{$field_db}}-{{$key}}-them').clone();
    $('#container-{{$field_db}}-{{$key}}').append(them_perkada);
    $('#container-{{$field_db}}-{{$key}} div').css('display','flex');
    $('#container-{{$field_db}}-{{$key}} div').removeAttr('id');
    autosize($('#container-{{$field_db}}-{{$key}}  textarea'));
  }
  $('#button-tambah-{{$field_db}}-{{$key}}').on('click',function(){
      action_button_{{$key}}_{{$field_db}}();
  });
</script>
