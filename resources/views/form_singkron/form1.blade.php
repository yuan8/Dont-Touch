@extends('layouts.master2')

@section('head_asset')

@stop
@section('content')

<style type="text/css">
	th{
		min-width: 300px;

	}

	th h6{
		color:#fff!important;
	}

</style>
<div class="card">
	<div class="card-body table-responsive card-border-top-warning">
		<table class="table table-bordered  table-striped">
			<thead>
				
				@include('form_singkron.component.tm_f1')

			</thead>
			<tbody style="overflow-y: scroll;">
				@foreach($datas as $key=> $data)
				<tr>
					<td>
						{{$key+1}}
					</td>
					<td>{{$data['sub_urusan']}}</td>
					<td>
						@isset($data['uu'])
							<?php foreach ($data['uu'] as $key => $value): ?>
								<p>{{$value}}</p>
							<?php endforeach ?>
						@endisset

					</td>
					<td>
						@isset($data['pp'])
								<?php foreach ($data['pp'] as $key => $value): ?>
									<p>{{$value}}</p>
								<?php endforeach ?>
						@endisset

					</td>
					<td>
						@isset($data['perpres'])
							<?php foreach ($data['perpres'] as $key => $value): ?>
								<p>{{$value}}</p>
							<?php endforeach ?>
						@endisset

					</td>
					<td>
						@isset($data['permen'])
							<?php foreach ($data['permen'] as $key => $value): ?>
								<p>{{$value}}</p>
							<?php endforeach ?>
						@endisset
					</td>
					<td>
						@isset($data['mandat'])
							<?php foreach ($data['mandat'] as $key => $value): ?>
								<p>{{$value}}</p>
							<?php endforeach ?>
						@endisset
					</td>
					<td>
						@if($data['kesesuaian']==1)
							sesuai
						@else
						Tidak
						@endif
					</td>
					<td>
						@isset($data['perda'])
							<?php foreach ($data['perda'] as $key => $value): ?>
								<p>{{$value}}</p>
							<?php endforeach ?>
						@endisset
					</td>
					<td>
						@isset($data['perkada'])
							<?php foreach ($data['perkada'] as $key => $value): ?>
								<p>{{$value}}</p>
							<?php endforeach ?>
						@endisset
					</td>
					<td>
						{{$data['keterangan']}}
					</td>
					<td class="col-md-12">
						<div class="btn-group ">
							<button class="btn btn-danger" onclick="$('#modal-f1-delete-{{$key}}').appendTo('body').modal()">Hapus</button>
							<button class="btn btn-warning ">Edit</button>
						</div>

						<div class="modal" id="modal-f1-delete-{{$key}}">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-body">
											<H6 class="text-center">
												Apakah Anda Yakin Menghapus Data Ini?
											</H6>
									</div>
									<div class="modal-footer">
										
											<input type="hidden" name="key" value="{{$key}}">
											<div class="btn-group">
												<button class="btn btn-info">Batal</button>
												<form method="post" action="{{route('fs.f1.delete')}}" >
													@csrf
													@method('DELETE')
													<input type="hidden" name="key" value="{{$key}}">
												<button class="btn btn-danger">Hapuse</button>
												</form>
											</div>
									</div>
								</div>
							</div>
						</div>


						

					</td>


				</tr>

				@endforeach
			</tbody>
		</table>
	</div>
</div>

@stop