@extends('layouts.master')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card card-primary border-bottom-primary border-primary">
      <div class="card-header">
        <h6 class="title">Upload Data</h6>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="">Provinsi</label>
              <select class="form-control" name="p" onchange="getKabupaten(this)">
                @foreach($provincies as $provinsi)
                <option value="{{$provinsi->id_provinsi}}">{{$provinsi->nama}}</option>
                @endforeach
              </select>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="">Tahun</label>
                  <select class="form-control" name="tahun">
                    <?php $now_year=(int)date('Y');  ?>
                    <?php
                    for ($past_year=2010; $past_year <= $now_year; $past_year++) {
                    ?>
                    <option value="{{$past_year}}">{{$past_year}}</option>
                    <?php
                      }
                    ?>
                  </select>
                </div>

              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="">File Excel (.xlxs)</label>
                  <input type="file" name="file" class="form-control" accept="application/msexcel" value="">
                </div>

              </div>

            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="">Kabupaten</label>
              <select class="form-control" name="k">
              </select>
            </div>
            <div class="form-group">
              <label for="">Action</label>
              <button type="submit" class="btn btn-primary col-md-12" name="button">Submit</button>
            </div>
          </div>

        </div>
      </div>

    </div>

  </div>

</div>

<script type="text/javascript">

  function getKabupaten(dom){
    CNDSSApi.post('/daerah/kabupaten-from-provinsi-id',{id_provinsi:dom.value}).then(function(res){
        console.log(res);
    });

  }

  $('[name=p]').trigger('change');


</script>
@stop
