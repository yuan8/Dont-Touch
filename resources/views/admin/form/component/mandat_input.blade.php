<div class="d-sm-flex align-items-center justify-content-between mb-4">				
	<h6 class="mb-0 text-gray-800">Mandat Kedaerah {{$bidang->nama_bidang_urusan}}</h6>
            
    
</div>

<nav>
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
   
    <a class="nav-item nav-link active " id="nab-tab-uu" data-toggle="tab" href="#nav-uu" role="tab" aria-controls="nav-uu" aria-selected="true">UU</a>
   
    <a class="nav-item nav-link" id="nab-tab-pp" data-toggle="tab" href="#nav-pp" role="tab" aria-controls="nav-pp" aria-selected="false">PP</a>
   
    <a class="nav-item nav-link" id="nab-tab-perpres" data-toggle="tab" href="#nav-perpres" role="tab" aria-controls="nav-perpres" aria-selected="false">Perpres</a>

    <a class="nav-item nav-link" id="nab-tab-permen" data-toggle="tab" href="#nav-permen" role="tab" aria-controls="nav-permen" aria-selected="false">Permen</a>

    <a class="nav-item nav-link" id="nab-tab-permen" data-toggle="tab" href="#nav-permen" role="tab" aria-controls="nav-permen" aria-selected="false">Mandat</a>

    <a class="nav-item nav-link" id="nab-tab-perdaperkada"" data-toggle="tab" href="#nav-perdaperkada"" role="tab" aria-controls="nav-perdaperkada"" aria-selected="false">Perda & Perkada</a>

  </div>
</nav>
<div class="tab-content" id="">

  <div  class="tab-pane fade show active" id="nav-uu" role="tabpanel" aria-labelledby="nab-tab-uu">
  	 @include('init.input.themplate.add_data_master',['field_db'=>'nama_uu','name_field'=>'f[uu][]','title'=>'','tb'=>'form_1_uu'])
  </div>

  <div class="tab-pane fade show active" id="nav-pp" role="tabpanel" aria-labelledby="nab-tab-pp">

  	 @include('init.input.themplate.add_data_master',['field_db'=>'nama_pp','name_field'=>'f[pp][]','title'=>'','tb'=>'form_1_pp'])
  
  </div>

  <div class="tab-pane fade show active" id="nav-perpres" role="tabpanel" aria-labelledby="nab-tab-perpres">
  	 @include('init.input.themplate.add_data_master',['field_db'=>'nama_perpres','name_field'=>'f[perpres][]','title'=>'','tb'=>'form_1_perpres'])
  </div>

  <div class="tab-pane fade show active" id="nav-permen" role="tabpanel" aria-labelledby="nab-tab-permen">
  	 @include('init.input.themplate.add_data_master',['field_db'=>'nama_permen','name_field'=>'f[permen][]','title'=>'Permen','tb'=>'form_1_permen'])
  </div>

   <div class="tab-pane fade how active" id="nav-mandat" role="tabpanel" aria-labelledby="nab-tab-mandat">
  	
  </div>

  <div class="tab-pane fade how active" id="nav-perdaperkada" role="tabpanel" aria-labelledby="nab-tab-perdaperkada"">
  	
  </div>

  <script type="text/javascript">
  	$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {		
		autosize($('#'+$(e.target).attr('aria-controls')+' textarea'));
	});

	setTimeout(function(){
		$('.tab-pane').removeClass('show');
	},300);

  </script>
</div>


