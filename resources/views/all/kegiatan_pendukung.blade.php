@extends('layouts.no-auth')

@section('head_asset')

@stop
@section('content')

<style type="text/css">
	.drop-menu{
		width:calc(100% - 20px);
		margin-left: 20px;
	}
	.br-primary{
		border-left: 1px solid blue!Important;
	}
	.br-warning{
		border-left: 1px solid yellow!Important;
	}

	.br-success{
		border-left: 1px solid green!Important;
	}
	.listing-menu .drop-menu{
		margin-top: 3px;
	}
</style>
<style type="text/css">
	 .app-theme-white.app-container{
            background-color:#bd9010ba;
            /*background-color: #c2c8cc;*/
        }
	   body{
            background-image: url('{{asset('ass_img/giphy.gif')}}')!important;
             /*background-size: auto auto;*/
        }
</style>

<div class="row mb-4 justify-content-start">
   
   
    <div class="col  btn-group">
		<div class="col-5" id="btn_back"></div>

     	<button class="btn btn-primary col-3" onclick="getdata('nspk');">NSPK</button>
		<button class="btn btn-primary col-3" onclick="getdata('spm');">SPM</button>
		<button class="btn btn-primary col-3" onclick="getdata('pn');">PN</button>
		<button class="btn btn-primary col-3" onclick="getdata('sdgs');">SDGS</button>
    </div>
  </div>

<div class="row">
	<div class="col-md-12 ">
		

	</div>
	<div class="col-md-12 mb-4 text-center" >
		<h5 class="text-uppercase text-center">
			<b class="text-white"  id="title-content"></b>
		</h5>
	</div>
	<div class="col-md-12" id="d">
		<div class="row" id="container-builder">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body text-center " style="min-height: 80vh; padding-top: 20vh;">
						<i class="align-middle fa-chart-area fas text-info" style="font-size: 200px"></i>
						<h5><b>Chart</b></h5>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-12 mb-4">
		<div id="chart" class="chart-cn"></div>
	</div>
</div>
<div class="row">
	
</div>



<script type="text/javascript">


	var data=[];


	function getdata(tag){
		$('#chart').html('');
		$('#container-builder').html('<div class="col-md-12"><div class="card"><div class="card-body text-center " style="min-height: 80vh; padding-top: 20vh;"><i class="align-middle fa fa-spinner mb-4 fa-spin fa-fw margin-bottom fas text-danger" style="font-size: 100px"></i><h5><b>Loading Data {{$tahun}} ....</b></h5></div></div></div>')
		$('#title-content').html(tag);

		CNDSSApi.post('kegiatan_pendukung/'+tag+'/{{$tahun}}').then(function(res){
			data=res.data;
			get_chart(null,null,tag);
		});

	}


	function get_chart(dom,l,key_stories){
		if(dom==null){
			d=data;

		}else{
			d=dom;

		}
		var tag=d.type;

		if(d['call_id_2']!=undefined){

		    var map=d.call_id_2.split(',');
		    var id=map.join(',');
		    map.pop();
		    var data_container=data;
			if(map.length > 0){
		    	map.pop();

				data_container=data[key_stories];
			}
			for(var i in map ){
				if(data_container[map[i]]!=undefined){
					data_container= data_container[map[i]];
				}
			}
		    

		  	 var  dm_btn_back='<button key_s="'+key_stories+'" class="btn text-capitalize btn-circle btn-warning col-12" call_id="'+map.join(',')+'" onclick="backmap(this)" tag="'+data_container.type+'">  <i class="fa fa-arrow-left text-white"></i> ' + (data_container.type +' '+ data_container.nama).toUpperCase()+' </button>';

		   $('#btn_back').html(dm_btn_back);

		}else{
			$('#btn_back').html('');
		}

		

		var dm_card='';
		var d_category=[];
		var d_data=[];
		var d_call_id=[];
		var title_chart='';
		var sub_title_chart='';

		title_chart=(d['type']+' '+d['nama']).toUpperCase();
		var d_option_category=[];

		
		for(var i in d ){

			if(typeof d[i]=='number'){

				if(dm_card==""){
						dm_card+="<div class='col-md-12'><div class='card mb-4'><div class='card-body text-capitalize'><h6><b> <span class='badge badge-pill badge-primary'>"+tag+"</span> "+d['nama']+"</b><h6></p></div></div></div>";
				}
				if(typeof d[i]=='number'){
					var name=i.replace(/_/g,' ');

					dm_card+="<div class='col-md-4'><div class='card mb-4'><div class='card-body text-capitalize'><h6>"+name+"</h6><p class='text-danger'>"+d[i].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")+"</p></div></div></div>";

				}	
			}




			if(typeof d[i]=='object'){

				
				for(k in d[i]){
				 sub_title_chart= d[i][k].type + ' (Jumlah)';


					for(m in d[i][k]){

						if(m=='nama'){
							d_category.push(d[i][k]['nama']);
							d_option_category.push({
								'type':d[i][k].type,
								'call_id':d[i][k].call_id_2,
								'category':d[i][k]['nama']
							});
						}

						if(typeof d[i][k][m]=='number'){
							if(d_data[m]==undefined){
								d_data[m]=[];
								d_call_id[m]='';
							}

							d_data[m].push({'type_tag':d[i][k].type,'call_id':d[i][k].call_id_2,'y':d[i][k][m]});
						}
					}

				}


			}

		

		}





		var data_chart=[];
		for(var i in d_data){
			data_chart.push({

				'name':i.replace(/_/g,' '),
				'data':d_data[i],
				'd_call_id':d_call_id[i]
			});

		}



		
		if((['program','Program']).includes(tag)){
			$('#chart').html('');

			var data_send=dom.where; 	

			



			$.post('{{route("api.all.get_kegiatan_tagging",['tahun'=>$tahun])}}',data_send,function(res){
				

				var dm='<div class="col-md-12"><div class="card min-h-100 mb-4"><div class="card-body"><h6><b><span class="badge badge-pill badge-warning">K</span> Detail Kegiatan</b></h6></div></div></div>';

				for(i in res){

					var tag='';
					dm+='<div class="col-md-4"><div class="card mb-4"><div class="card-body"><p>'+res[i].nama+'</p>';
					
					if(res[i].nspk){
						tag+='<span class="badge badge-pill badge-warning">nspk</span>';
					}

					if(res[i].spm){
						tag+='<span class="badge badge-pill badge-warning">spm</span>';
					}

					if(res[i].pn){
						tag+='<span class="badge badge-pill badge-warning">pn</span>';
					}

					if(res[i].sdgs){
						tag+='<span class="badge badge-pill badge-warning">sdgs</span>';						
					}

					dm+=tag;

					if(res[i]['indikator'].length > 0){

						dm+='<ul class="list-group mb-4" style="margin-top:10px;"><li class="list-group-item active">Indikator</li>';
						for(p in res[i]['indikator'] ){
							 dm+='<li class="list-group-item">'+res[i]['indikator'][p]['indikator']+'</li>';
						}
						dm+='</ul>';


					}
  

					dm+='</div></div></div>';
				}

				$('#container-builder').append(dm);

			});



		}else{
			Highcharts.chart('chart', {
		    chart: {
		        type: 'column',
		        events:{
		        	click:function(e){

		        			var l=parseInt(Math.round(e.xAxis[0].value));
		        			if(l<0){
		        				l=0;
		        			}

		        			var d=(d_option_category[l]);

		        			// console.log(d_option_category);
		        			// // console.log((e.xAxis[0].value));
		        			// console.log(l);
		        			// // console.log(d);
		        			// console.log(e);
		        			// console.log(this);


		        			var map=d.call_id.split(',');

	            			var data_container=data[key_stories];

	            			for(var i in map ){
	            				if(map[i]!=undefined){
	            				data_container=data_container[map[i]];

	            				}
	            			}

		            			
		            		get_chart(data_container,d.type_tag,key_stories);
		        	}
		        }
		    },
		    title: {
		        text: title_chart

		    },
		    subtitle: {
		        text: 'SUMBER DATA RKPD'
		    },
		    xAxis: {

		        categories:d_category,
		        crosshair: true,
		        options:d_option_category
		    },
		    yAxis: {
		        min: 0,
		        title: {
		            text: sub_title_chart
		        }
		    },
		    tooltip: {
		        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
		        pointFormatter:function(){
		          var val=(this.y).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
		          return '<tr><td style="color:{series.color};padding:0">'+this.series.name+' </td>' +
		            '<td style="padding:0"><b>: '+val+'</b></td></tr>'
		        },

		        footerFormat: '</table>',
		        shared: true,
		        crosshairs: true,
		        useHTML: true
		    },
		    plotOptions: {
		        column: {
		            pointPadding: 0.2,
		            borderWidth: 0
		        },
		         series: {
		            borderWidth: 0,
		            dataLabels: {
		                enabled: true,
		                formatter: function(){
		            	  var val=(this.y).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
		                  return val;                }
		            },
		            point:{
		            	events:{
		            		click:function(){
		            			var map=this.call_id.split(',');

		            			var data_container=data[key_stories];

		            			for(var i in map ){
		            				if(map[i]!=undefined){
		            				data_container=data_container[map[i]];

		            				}
		            			}

		            			
		            			get_chart(data_container,this.type_tag,key_stories);



		            		}
		            	}
		            }
		        }
		    },
		    series:data_chart
	
		},
		 );





	
			$('#container-builder').html(dm_card);
		}

					
	}


	function backmap(dom){
		var dom=$(dom);

		var key_stories=dom.attr('key_s');
		var map=dom.attr('call_id').split(',');
		var data_container=data[key_stories];

		for(var i in map ){
			if(map[i]!=undefined){
			data_container=data_container[map[i]];

			}
		}

		get_chart(data_container,'null',key_stories);


	}


</script>

<style type="text/css">
	.min-h-100.m-4{
		min-height: calc(100% - 20px);
	}
</style>
@stop