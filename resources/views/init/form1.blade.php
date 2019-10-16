<h5 class="text-center"></h5>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h5 mb-0 text-gray-800">Data Kebijakan (K/L)</h1>
    <a href="{{route('admin.form1')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah Data</a>
</div>
<hr>
<input type="text" id="search_dtb_f1" class="form-control" name="" placeholder="Search" value="">

<hr>

<div class="" >
  <table class="table table-bordered tb-input" id="table-form-1">
    <thead>
      <tr>
        <th rowspan="2">Sub Urusan</th>
        <th colspan="4">NSPK</th>
        <th rowspan="2">Mandat Ke Daerah</th>
        <th colspan="2">Kebijakan Daerah</th>
        <th rowspan="2">Kesesuian NSPK dan Kebijakan Daerah</th>
        <th rowspan="2">Keterangan</th>
        <th rowspan="2">Action</th>
      </tr>
      <tr>
        <th>
          UU
        </th>
        <th>
          PP
        </th>
        <th>
          PERPRESS
        </th>
        <th>
          PERMEN
        </th>

        <th>
          PERDA
        </th>
        <th>
          PERKADA
        </th>
      </tr>
    </thead>
    <tbody id='container_tr_f1'>

    </tbody>
  </table>

</div>

<script type="text/javascript">
$(document).ready( function () {
  var dtb_f1=$('#table-form-1').DataTable({
      processing: true,
      "ordering": false,
      "info":true,
      "serverSide": true,
      "scrollX": true,
      "scrollY": false,
      order: [[2, 'desc']],
      ajax:{
         url:'{{route('api.get.data.form1')}}',
         type:'POST',
         beforeSend: function (request) {
              request.setRequestHeader("Authorization","{{(Auth::User())?'Bearer '.Auth::User()->api_token:''}}");
        },
      },
      columns: [
              {
                "data":"k_sub_urusan",
                "name":"k_sub_urusan",
                "searchable":true,
              },
              {
                  "targets": 1,
                  "data":"nama_uu",
                  "name":"listUu.nama_uu",
                  "render": function ( data, type, row, meta ) {
                      if(data.length > 0){
                        var list='';
                        for (var i in data) {
                          list+=data[i]+'<br><br>';
                        }
                        return list;
                      }else{
                        return '';
                      }
                    }
              },
              {
                  "targets": 2,
                  "data":"nama_pp",
                  "name":"listPp.nama_pp",
                  "render": function ( data, type, row, meta ) {
                      if(data.length > 0){
                        var list='';
                        for (var i in data) {
                          list+=data[i]+'<br><br>';
                        }
                        return list;
                      }else{
                        return '';
                      }
                    }
              },
              {
                  "targets": 3,
                  "data":"nama_perpres",
                  "name":"listPerpres.nama_perpres",
                  "render": function ( data, type, row, meta ) {
                      if(data.length > 0){
                        var list='';
                        for (var i in data) {
                          list+=data[i]+'<br><br>';
                        }
                        return list;
                      }else{
                        return '';
                      }
                    }
              },
              {
                  "targets": 4,
                  "data":"nama_permen",
                  "name":"listPermen.nama_permen",
                  "render": function ( data, type, row, meta ) {
                      if(data.length > 0){
                        var list='';
                        for (var i in data) {
                          list+=data[i]+'<br><br>';
                        }
                        return list;
                      }else{
                        return '';
                      }
                    }
              },
              { "data": "k_mandat" },
              {
                  "data":"nama_perda",
                  "name":"listPerda.nama_perda",
                  "render": function ( data, type, row, meta ) {
                      if(data.length > 0){
                        var list='';
                        for (var i in data) {
                          list+=data[i]+'<br><br>';
                        }
                        return list;
                      }else{
                        return '';
                      }
                    }
              },
              {
                  "data":"nama_perkada",
                  "name":"listPerkada.nama_perkada",
                  "render": function ( data, type, row, meta ) {
                      if(data.length > 0){
                        var list='';
                        for (var i in data) {
                          list+=data[i]+'<br><br>';
                        }
                        return list;
                      }else{
                        return '';
                      }
                    }
              },
              {
                  "targets": 7,
                  "data": "k_kesesuaian",
                  "render": function ( data, type, row, meta ) {
                      if(data){
                        return '<span class="badge badge-success">Sesuai</span>';

                      }else{
                        return '<span class="badge badge-danger">Tidak Sesuai</span>';
                      }
                    }
              },
              { "data": "k_keterangan" },
              {
                "data":"action_button",
                "render": function ( data, type, row, meta ) {
                  var button ='';
                  for (var i in data) {
                    if (data[i].tag=='view') {
                      if(data[i].href!=''){
                        button+='<a href="'+data[i].href+'" class="btn btn-primary btn-sm btn-circle"><i class="fa fa-eye"></i></a>';
                      }
                    }else if (data[i].tag=='edit') {
                      if(data[i].href!=''){
                          button+='<a href="'+data[i].href+'" class="btn btn-warning btn-sm btn-circle"><i class="fa fa-edit"></i></a>';
                      }


                    }
                  }
                  return button;

                }

             },

        ],
        order: [[3, 'desc']]


  });
  $('#search_dtb_f1').on( 'keyup', function () {
    dtb_f1.search( this.value ).draw();
  } );
  $('#table-form-1_filter').css('display','none');
});

</script>
