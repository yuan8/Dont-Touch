@extends('layouts.no-auth')

@section('head_asset')

@stop
@section('content')

<div class="row">
	<div class="col-md-2">
		 <form id="form">
		 	
		 <ul class="list-group" id="list_positif" style="min-height: 100px; background-color: #f1f1f1;">
          		<li class="list-group-item bg bg-primary text-white">Filter</li>
          		  
          		  <b class="text-center" style="margin-top: 2px; padding-bottom: 2px; margin-bottom: 0px; border-bottom: 1px solid #222">Drop Area</b>
        	</ul>
		 </form>

        <ul class="list-group" id="" >
          <li class="list-group-item bg bg-primary text-white">
          	<button  id="btn" class="btn btn-warning col-md-12">Submit</button>
          </li>
        </ul>
          
          
       

        <ul class="list-group mt-4"  style="min-height: 100px; background-color: #f1f1f1;">
          <li class="list-group-item bg bg-danger text-white">Tidak Digunakan</li>
          <b class="text-center" style="margin-top: 2px; padding-bottom: 2px; margin-bottom: 0px; border-bottom: 1px solid #222">Drag Area</b>
          <div id="list_negatif">
          	<li class="list-group-item tr bidang ">Bidang
          	<input type="hidden"  name="map[]" value="Bidang|key_bidang|DB_id_urusan">
          </li>
          <li class="list-group-item tr sub_bidang">Sub Bidang
          	<input type="hidden" name="map[]" value="Sub Urusan|key_sub_bidang|DB_id_sub_urusan">
          </li>
        
          <li class="list-group-item tr daerah">Daerah
          	<input type="hidden" name="map[]" value="Daerah|key_daerah|DB_kode_daerah">

          </li>
         
          <li class="list-group-item tr program">Program
          	<input type="hidden" name="map[]" value="Program|key_proram|DB_kode_program">
          </li>


          </div>
          
        </ul>
	</div>


	<div class="col-md-10" >
		<div class="row">
			<div class="col-md-3 col"  id="btn_back"></div>
			<div class="col-md-9 col">
				<div class="card">
					<div class="card-body">
						<input type="radio" class="type-chart" name="by" value="nspk"> <span>NSPK</span>
						<input type="radio" class="type-chart" name="by" value="spm"> <span>SPM</span>
						<input type="radio" class="type-chart" name="by" value="pn"> <span>PN</span>
						<input type="radio" class="type-chart" name="by" value="sdgs"> <span>SDGS</span>
						<input type="radio" class="type-chart" name="by" checked="" value="semua"> <span>Semua</span>
						<!-- <input type="radio" class="type-chart" name="by" value="kegiatan_pendukung_lain"> <span>Kegiatan Pendukung Lain</span> -->

					</div>
				</div>


			</div>
		</div>
		<div class="row">
			<div class="col-md-12" id="container-builder-data">
				<div class="card" style="margin-top: 10px;">
					<div class="card-body text-center " style="min-height: 80vh; padding-top: 20vh;">
						<i class="align-middle fa-chart-area fas text-info" style="font-size: 200px"></i>
						<h5><b>Chart</b></h5>
					</div>
				</div>
			</div>
		</div>
		
	</div>	
</div>

<script type="text/javascript">
	
 Sortable.create(list_positif, {
  animation: 100,
  group: 'list-1',
  draggable: '.tr',
  handle: '.tr',
  sort: true,
  filter: '.sortable-disabled',
  chosenClass: 'active'
});


 Sortable.create(list_negatif, {
  	group: 'list-1',
	  handle: '.tr'
});


$('#btn').on('click',function(){

	var data=$( "#form" ).serializeArray();
	$('#btn_back').html('');
	$('#container-builder-data').html('');


		var val='';

	$('.type-chart').each(function(k,d){
			if($(d).prop('checked')){
				val=$(d).val();
			}
	});

	$('#chart').html('');
		$('#container-builder-data').html('<div class="card" style="margin-top:10px;"><div class="card-body text-center " style="min-height: 80vh; padding-top: 20vh;"><i class="align-middle fa fa-spinner mb-4 fa-spin fa-fw margin-bottom fas text-danger" style="font-size: 100px"></i><h5><b>Loading Data {{$tahun}} ....</b></h5></div></div>');




	CNDSSApi.post('/dynamic',{data:data,type:val,tahun:{{$tahun}}}).then(function(res){
		$('#container-builder-data').html(res.data);
	});

});


	$('.type-chart').on('change',function(){
		var val='';
		var dm_tr='';

		$('.type-chart').each(function(k,d){
			if($(d).prop('checked')){
				val=$(d).val();
			}
		});

		switch(val){

			case 'nspk':
				  
				 dm_tr= '<li class="list-group-item tr nspk">NSPK<input type="hidden" name="map[]" value="NSPK|key_nspk|DB_id_mandat"></li>';
			break;


			case 'spm':
				  
				 dm_tr= '<li class="list-group-item tr spm">SPM<input type="hidden" name="map[]" value="SPM|key_spm|DB_id_spm"></li>';

			break;

			case 'pn':
				  
				 dm_tr= '<li class="list-group-item tr pn">PN<input type="hidden" name="map[]" value="PN|key_pn|DB_id_pn"></li>';
			break;


			case 'sdgs':
				  
				 dm_tr= '<li class="list-group-item tr sdgs">SDGS<input type="hidden" name="map[]" value="SDGS|key_sdgs|DB_id_sdgs"></li>';

			break;


			// case 'kegiatan_pendukung_lain':
				  
			// 	 dm_tr= '<li class="list-group-item tr sdgs">SDGS<input type="hidden" name="map[]" value="Kegiatan Pendukung Lain|kegiatan_pendukung_lain|"></li>';

			// break;
			default:

				$('#list_negatif .nspk,#list_negatif .spm,#list_negatif .pn,#list_negatif .sdgs,#list_negatif .kegiatan_pendukung_lain').remove();

				$('#list_positif .nspk,#list_positif .spm,#list_positif .pn,#list_positif .sdgs,#list_positif .kegiatan_pendukung_lain').remove();


			break;
		}
		$('#list_negatif .nspk,#list_negatif .spm,#list_negatif .pn,#list_negatif .sdgs,#list_negatif .kegiatan_pendukung_lain').remove();

		$('#list_positif .nspk,#list_positif .spm,#list_positif .pn,#list_positif .sdgs,#list_positif .kegiatan_pendukung_lain').remove();

		$('#list_negatif ').append(dm_tr);


	});

	@if(isset($_GET['init']))

		switch('{{$_GET['init']}}'){
			case 'bidang':
			clon=$('#list_negatif .bidang').clone();
			$('#list_negatif .bidang').remove();

			$('#list_positif').append(clon);	
			break;

			case 'daerah': 
				 clon=$('#list_negatif .daerah').clone();
				$('#list_negatif .daerah').remove();

				 $('#list_positif').append(clon);	

			break; 

		}


		if(clon!=''){
			setTimeout(function(){
				$('#btn').click();
			},1000);
		}



	@endif

</script>

@stop


