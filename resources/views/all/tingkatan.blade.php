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

<div class="row">
	<div class="col-md-12 cn-btn-back" id="btn-back"></div>
</div>
<div class="row">
	<div class="col-md-3">
		<div class="card mb-4">
			<div class="card-body listing-menu" style="max-height: 80vh; overflow-y:scroll;">
				<ul class="todo-list-wrapper list-group list-group-flush">
					<?php foreach ($data_head['data'] as $key => $value): ?>
						  <li href="#"onclick="get_chart(this,'d');" data-toggle="collapse" dt="{{$key}}" data-target="#mn-{{$key}}" class="list-group-item list-group-item-action border-btm-card border-primary" style="font-size: 10px;">
							<span class="badge badge-pill badge-primary">d</span> 

						    {{$value['nama']}}
						  </li>
						<div id="mn-{{$key}}" class="collapse drop-menu" >
							<ul class="todo-list-wrapper list-group list-group-flush">
								<?php foreach ($value['urusan'] as $k => $d): ?>
										<li href="#" onclick="get_chart(this,'bu')" data-toggle="collapse" dt="{{$key}}|urusan|{{$k}}" data-target="#mn-{{$key}}-{{$k}}" class="list-group-item list-group-item-action border-btm-card border-success " style="font-size: 10px;">
											 <span class="badge badge-pill badge-success">bu</span> 
										    {{$d['nama']}}
										  </li>
										  <div id="mn-{{$key}}-{{$k}}" class="collapse drop-menu" >
												<ul class="todo-list-wrapper list-group list-group-flush">
													<?php foreach ($d['sub_urusan'] as $s => $sb): ?>
															<li href="#" onclick="get_chart(this,'sb')" dt="{{$key}}|urusan|{{$k}}|sub_urusan|{{$s}}" data-toggle="collapse" data-target="#mn-{{$key}}-{{$k}}-{{$s}}" class="list-group-item list-group-item-action  border-btm-card border-warning" style="font-size: 10px;">
															   <span class="badge badge-pill badge-warning">sb</span> {{$sb['nama']}}
															  </li>

															   <div id="mn-{{$key}}-{{$k}}-{{$s}}" class="collapse drop-menu" >
																<ul class="todo-list-wrapper list-group list-group-flush">
																	<?php foreach ($sb['program'] as $p => $pr): ?>
																			<?php $pi=str_replace('.','_',(string)$p); 
																			?>
																			<li href="#" onclick="get_chart(this,'p')" dt="{{$key}}|urusan|{{$k}}|sub_urusan|{{$s}}|program|{{$p}}"  class="list-group-item list-group-item-action  " style="font-size: 10px; margin-bottom:0px;">
																			    <span class="badge badge-pill badge-info">p</span>
																			    {{$pr['nama']}}
																			  </li>
																			  
																	<?php endforeach ?>	
																</ul>
															</div>


															  
													<?php endforeach ?>	
												</ul>
											</div>
								<?php endforeach ?>	
							</ul>
						</div>
					<?php endforeach ?>
				</ul>



			</div>

		</div>
			<div class=" cn-btn-back " id="btn-back"></div>
		
	</div>
	<div class="col-md-9" id="d">
		<div class="row" id="container-builder">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body text-center " style="min-height: 80vh; padding-top: 20vh;">
						<i class="align-middle  pe-7s-graph1 text-warning" style="font-size: 200px"></i>
						<h5><b>Chart</b></h5>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
</div>
<div class="row">
	<div class="col-md-12 mb-4">

		<div id="chart" class="chart-cn"></div>
	</div>
</div>


<script type="text/javascript">

	var data=<?php echo json_encode($data_head['data']); ?>;

	function get_chart(dom,tag){

		var key=$(dom).attr('dt');
		key=key.split('|');

		var map_array='';

		var d=[];

		if(tag=='d'){
			d=data[key[0]];
			map_array=''+key[0];
		}
		if(tag=='bu'){
			d=data[key[0]][key[1]][key[2]];
			map_array=''+key[0]+'|'+key[1]+'|'+key[2];

		}

		if(tag=='sb'){
			d=data[key[0]][key[1]][key[2]][key[3]][key[4]];
			map_array=''+key[0]+'|'+key[1]+'|'+key[2]+'|'+key[3]+'|'+key[4];

		}

		if(tag=='p'){
			d=data[key[0]][key[1]][key[2]][key[3]][key[4]][key[5]][key[6]];
			map_array=''+key[0]+'|'+key[1]+'|'+key[2]+'|'+key[3]+'|'+key[4]+'|'+key[5]+'|'+key[6];

		}

		var map_array_chart=[];


		var dm_card='';
		var d_category=[];
		var d_data=[];
		var title_chart=(''+' '+d['nama']).toUpperCase();
		var sub_title_chart='';

		var map=(map_array).split('|');

		(map.pop());
		var data_container=data;
		map.pop();
		var map_ar='';
		for(var i in map ){
			if(map[i]!=undefined){
				data_container=data_container[map[i]];
				
				if(map[(parseInt(i)+1)]==undefined){
					map_ar+=map[i];
				}else{
					map_ar+=map[i]+'|';

				}
			}
		}

		var name=' '+data_container['nama'];
		if(map_ar!=''){
			var dm='<button class="btn btn-warning mb-4	" onclick="backmap(this)" dt="'+map_ar+'"><i class="fa fa-arrow-left text-white"></i> '+name+'</button>';
			$('.cn-btn-back').html(dm);
		}else{
			$('.cn-btn-back').html('');

		}



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
				 		sub_title_chart= ((i).replace(/_/g,' ')).toUpperCase() + ' (Jumlah)';


					for(m in d[i][k]){


						if(m=='nama'){
							d_category.push(d[i][k]['nama']);
							map_array_chart.push(map_array+'|'+i+'|'+k);
						}

						if(typeof d[i][k][m]=='number'){
							if(d_data[m]==undefined){
							d_data[m]=[];
							}

							d_data[m].push(d[i][k][m]);

							}
					}

				}


			}

		

		}



		var data_chart=[];
			for(var i in d_data){
				data_chart.push({

					'name':i.replace(/_/g,' '),
					'data':d_data[i]
				});
		}


		Highcharts.chart('chart', {
		    chart: {
		        type: 'column',
		        events:{
		        	click:function(e){

		        			var l=parseInt(Math.round(e.xAxis[0].value));
		        			if(l<0){
		        				l=0;
		        			}

		        			var g=(map_array_chart[l]);

		        			


		        			
		        			if($('li[dt="'+g+'"]').html()!=undefined){
		        				$('li[dt="'+g+'"]').click();
		        			}
		        			

	            			console.log(name);
	            			console.log(map_ar);

		            			
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
		        crosshair: true
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
		            }
		        }
		    },
		    series:data_chart
		});

			$('#container-builder').html(dm_card);

		if((tag=='p')){
			$('#chart').html('');
			var data_send={
			"id_urusan":parseInt(key[2]),
			"id_sub_urusan":parseInt(key[4]),
			"kode_daerah":(""+key[0]).toString(),
			"kode_program":""+(key[6]).toString()
			}


			$.post('{{route("api.all.get_kegiatan",['tahun'=>$tahun])}}',data_send,function(res){
				var dm='<div class="col-md-12"><div class="card mb-4"><div class="card-body"><h6><b><span class="badge badge-pill badge-warning">K</span> Detail Kegiatan</b></h6></div></div></div>';
				for(i in res){
					dm+='<div class="col-md-4"><div class="card mb-4"><div class="card-body"><p>'+res[i].nama+'</p>';

					if(res[i]['indikator'].length > 0){

						dm+='<ul class="list-group"><li class="list-group-item active">Indikator</li>';

						for(p in res[i]['indikator'] ){
							 dm+='<li class="list-group-item">'+res[i]['indikator'][p]['indikator']+'</li>';
						}
						dm+='</ul>';


					}
  

					dm+='</div></div></div>';
				}

				$('#container-builder').append(dm);

			});



		}
				





		

	}

	function backmap(dom){
		var dt=$(dom).attr('dt');
	
		if($('li[dt="'+dt+'"]').html()!=undefined){
			$('li[dt="'+dt+'"]').click();
		}
	}
</script>

@stop