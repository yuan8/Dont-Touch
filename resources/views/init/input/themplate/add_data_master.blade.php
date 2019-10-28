<?php
  $id_key=rand(0,100).'t_'.date('s_u');
 ?>
 <div class="d-sm-flex align-items-center justify-content-between mb-1">        
  <h6 class="mb-0 ">{{$title}}</h6>
         <button type="button" style="margin-top:10px;color:#222" onclick="$('#modal-{{$tb}}-{{$id_key}}').appendTo('body').modal()"  class="btn btn-warning btn-sm d-sm-inline-block border-dark" style="color:#222" name="button">+</button> 
</div>
 <select class="form-control" id="f-select-{{$tb}}-{{$id_key}}" {{isset($multiple)?($multiple==false?'':'multiple'):'multiple'}}    name="{{$name_field}}"  placeholder="Berisi Lebih Dari Atau Satu">
   @isset($value_init)
    @foreach($value_init as $val)
      <option value="{{$val['id']}}" selected >{{$val[$field_db]}}</option>
    @endforeach

   @endisset
 </select>

<div class="modal fade" id="modal-{{$tb}}-{{$id_key}}">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
          <h6 class="modal-title">Tambah {{$title}} Manual</h6>
      </div>
      <div class="modal-body">

        <textarea name="" id="modal-data-{{$tb}}-{{$id_key}}"  class="form-control" rows="8" cols="80" placeholder="Masukan {{$title}} Baru.."></textarea>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-warning btn-sm" id="modal_data_button_send_{{$tb}}_{{$id_key}}" name="button">Tambah</button>
      </div>
    </div>
  </div>
</div>

  <script type="text/javascript">
  $(document).ready(function(){
    $('#modal_data_button_send_{{$tb}}_{{$id_key}}').on('click',function(){
        var data=$('#modal-data-{{$tb}}-{{$id_key}}').val();
        if(data!=''){
          CNDSSApi.post('form/add-data-master',{data:data,tb:'{{$tb}}',field:'{{$field_db}}'}).then(function(response){
            var data_return=response.data;
            if(data_return.code==200){
                $('.modal').modal("hide");
                var last_value=$('#f-select-{{$tb}}-{{$id_key}}').val();
                last_value.push(2);
                $('#f-select-{{$tb}}-{{$id_key}}').val(last_value).change();
                $('#f-select-{{$tb}}-{{$id_key}}').val('');
                $('#f-select-{{$tb}}-{{$id_key}}').html('');

                Swal.fire({
                  type: 'success',
                  title: 'success',
                  text: data_return.message,
                  timer: 1500
                });
            }else{
              Swal.fire({
                type: 'error',
                title: 'error',
                text: data_return.message,
                timer: 1500
              });
            }
          });
        }else{
          Swal.fire({
            type: 'error',
            title: 'error',
            text: 'Data Kosong',
            timer: 1500
          });
        }
      });

      $('#f-select-{{$tb}}-{{$id_key}}').select2({
        ajax:{
          url:'{{url('api/form/get-data-list-from-tb')}}',
          method:'post',
          headers: {
              "Authorization" : "Bearer {{(Auth::User())?Auth::User()->api_token:''}}",
          },
          data: function (params) {
           var queryParameters = {
             nama: params.term,
             tb:'{{$tb}}',
             field:'{{$field_db}}'
           }
           return queryParameters;
         },
         processResults: function (data) {
            return {
              results: data
            };
        },


      },
        placeholder: 'Cari {{$title}}',
        minimumInputLength: 0,
      });

    });


  </script>
