<div>
<?php
    if(!isset($key)){
      $key=$tb.date('u').'_'.rand(10,1000);
    }
 ?>

<div id="{{$field_db}}-{{$key}}-them" class="" style="display: none;">
  <div class="input-group mb-3 animated flipInX"  >
      <textarea  class="form-control"   rows="3" cols="80" aria-describedby="basic-addon2" placeholder="Input {{$title}}...."></textarea>
      <div class="input-group-append">
        <button class="btn btn-danger" onclick="$(this).parent().parent().remove();" type="button">Hapus</button>
      </div>
  </div>
</div>
<label for="">{{$title}}</label>
<div class="container-multy-data-append" id="container-{{$field_db}}-{{$key}}">
  @isset($value)
    @if(!is_array($value))
      <?php $value=json_decode($value); ?>
    @endif
    @foreach ($value as $i => $v)
       <div class="input-group mb-3 animated flipInX" >
          <textarea  class="form-control" name="{{str_replace('[]','['.$i.']',$name_field)}}"   rows="3" cols="80" aria-describedby="basic-addon2" placeholder="Input {{$title}}....">{!!nl2br($v)!!}</textarea>
          <div class="input-group-append">
            <button class="btn btn-danger" onclick="$(this).parent().parent().remove();" type="button">Hapus</button>
          </div>
      </div>
    @endforeach

  @endisset
</div>
<button type="button" class="btn btn-warning btn-sm" onclick="action_button_{{$key}}_{{$field_db}}(this,value='')" id="button-tambah-{{$field_db}}-{{$key}}" name="button" style="margin-bottom: 10px;">Tambah {{$title}}</button>

</div>
<script type="text/javascript">
  var COUNT_{{$field_db}}_{{$key}}_them_COUNT=0;
  function action_button_{{$key}}_{{$field_db}}(dom,value=''){
    var con=$(dom).parent().find('.container-multy-data-append');
    var them_perkada=$(dom).parent().find('#{{$field_db}}-{{$key}}-them').html();
    $(con).append(them_perkada);
    $(con).find('div').css('display','flex');
    $(con).find('div').removeAttr('id');
    $(con).find('textarea').each(function(key,dom){
      var name="{{$name_field}}";
      name= name.replace('[]','['+key+']');
      $(dom).attr('name',name);
    });
    autosize($(con).find('textarea'));
  }

</script>
