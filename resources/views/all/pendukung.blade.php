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
<div class="row">
	<div class="col-md-12 mb-4">
		<div id="chart" class="chart-cn"></div>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<div class="card mb-4">
			<div class="card-body listing-menu" style="max-height: 80vh; overflow-y:scroll;">
				<ul class="todo-list-wrapper list-group list-group-flush">
					<?php foreach ($data_head['data'] as $key => $value): ?>
						  <li href="#"onclick="get_chart(this,'t');" data-toggle="collapse" dt="{{$key}}" data-target="#mn-{{$key}}" class="list-group-item list-group-item-action border-btm-card border-primary" style="font-size: 10px;">
							<span class="badge badge-pill badge-primary">t</span> 

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
													<?php foreach ($d['daerah'] as $s => $sb): ?>
															<li href="#" onclick="get_chart(this,'d')" dt="{{$key}}|urusan|{{$k}}|daerah|{{$s}}" data-toggle="collapse" data-target="#mn-{{$key}}-{{$k}}-{{$s}}" class="list-group-item list-group-item-action  border-btm-card border-warning" style="font-size: 10px;">
															   <span class="badge badge-pill badge-warning">d</span> {{$sb['nama']}}
															  </li>

															   <div id="mn-{{$key}}-{{$k}}-{{$s}}" class="collapse drop-menu" >
																<ul class="todo-list-wrapper list-group list-group-flush">
																	<?php foreach ($sb['program'] as $p => $pr): ?>
																			<?php $pi=str_replace('.','_',(string)$p); 
																			?>
																			<li href="#" onclick="get_chart(this,'p')" dt="{{$key}}|urusan|{{$k}}|daerah|{{$s}}|program|{{$p}}"  class="list-group-item list-group-item-action  " style="font-size: 10px; margin-bottom:0px;">
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
	</div>
	<div class="col-md-9" id="d">
		<div class="row" id="container-builder">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body text-center " style="min-height: 80vh; padding-top: 20vh;">
						<i class="align-middle fa-chart-area fas text-info" style="font-size: 200px"></i>
						<h5><b>NUWAS Chart</b></h5>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>



<script type="text/javascript">

	var data=<?php echo json_encode($data_head['data']); ?>;

	function get_chart(dom,tag){

		var key=$(dom).attr('dt');
		key=key.split('|');


		var d=[];

		if(tag=='t'){
			d=data[key[0]];
		}
		if(tag=='bu'){
			d=data[key[0]][key[1]][key[2]];
		}

		if(tag=='d'){
			d=data[key[0]][key[1]][key[2]][key[3]][key[4]];
		}

		if(tag=='p'){
			d=data[key[0]][key[1]][key[2]][key[3]][key[4]][key[5]][key[6]];
		}

		console.log(key);

		var dm_card='';
		var d_category=[];
		var d_data=[];

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

					for(m in d[i][k]){
						if(m=='nama'){
							d_category.push(d[i][k]['nama']);
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
		        type: 'column'
		    },
		    title: {
		        text: ''

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
		            text: 'JUMLAH'
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
			"kode_daerah":(""+key[4]).toString(),
			"kode_program":""+(key[6]).toString(),

			}

			data_send[key[0]]=true;



			$.post('{{route("api.all.get_kegiatan_tagging",['tahun'=>$tahun])}}',data_send,function(res){
				

				var dm='<div class="col-md-12"><div class="card mb-4"><div class="card-body"><h6><b><span class="badge badge-pill badge-warning">K</span> Detail Kegiatan</b></h6></div></div></div>';

				for(i in res){
					console.log(res);

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
</script>

@stop