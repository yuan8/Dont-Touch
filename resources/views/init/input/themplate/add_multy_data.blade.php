<?php
    if(!isset($key)){
      $key=$tb.date('u').'_'.rand(10,1000);
    }
 ?>

<div id="{{$field_db}}-{{$key}}-them" style="display: none;">
  <div class="input-group mb-3 animated flipInX"  style="display:none;">
      <textarea  class="form-control"   rows="3" cols="80" aria-describedby="basic-addon2" placeholder="Input {{$title}}...."></textarea>
      <div class="input-group-append">
        <button class="btn btn-danger" onclick="$(this).parent().parent().remove();" type="button">Hapus</button>
      </div>
  </div>
</div>
<label for="">{{$title}}</label>
<div class="" id="container-{{$field_db}}-{{$key}}">

</div>
<button type="button" class="btn btn-warning btn-sm" id="button-tambah-{{$field_db}}-{{$key}}" name="button" style="margin-bottom: 10px;">Tambah {{$title}}</button>
<script type="text/javascript">
  var COUNT_{{$field_db}}_{{$key}}_them_COUNT=0;
  function action_button_{{$key}}_{{$field_db}}(value=''){
    var them_perkada=$('#{{$field_db}}-{{$key}}-them').html();
    COUNT_{{$field_db}}_{{$key}}_them_COUNT+=1;
   
    $('#container-{{$field_db}}-{{$key}}').append(them_perkada);
    $('#container-{{$field_db}}-{{$key}} div').css('display','flex');
    $('#container-{{$field_db}}-{{$key}} div').removeAttr('id');

    $('#container-{{$field_db}}-{{$key}} textarea').each(function(key,dom){
      var name="{{$name_field}}";
      name= name.replace('[]','['+key+']');
      $(dom).attr('name',name);
    });

    autosize($('#container-{{$field_db}}-{{$key}} textarea'));
  }
  $('#button-tambah-{{$field_db}}-{{$key}}').on('click',function(){
      action_button_{{$key}}_{{$field_db}}();
  });
</script>
