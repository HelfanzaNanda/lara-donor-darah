@extends('dashboard.layouts.app')
@section('title', 'Pesan Darah')

@section('content')
<div class="row">
    <div class="box">
        <div class="box-header" style="margin-top:0px;margin-bottom:0px;">
            <h4><a href="#" class="text-black"><span class="fa fa-arrow-left"> </span>  <b>Checkout</b>  {{$stock->gol_dar.' ('.$stock->rhesus.') '. $stock->jenis_tranfusi}}</a></h4>
        </div>
        @if ($errors->any())
        <div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div>
        @endif
        <div class="box-body" style="margin-top:0px;">
            <form action="{{route('order.storecheckout')}}" method="post">
                @csrf
                <input type="text" name='darah_id' value="{{$stock->id}}" hidden="true">
                <div class="form-group" style="margin-top:0px;">
                    <label>Nama Pasien</label>
                    <input type="text" class="form-control" name="nama_pasien" placeholder="Nama Pasien">
                </div>
                <div class="form-group" style="margin-top:0px;">
                    <label>Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-control">
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
                <div class="form-group" style="margin-top:0px;">
                    <label>Ruangan</label>
                    <input type="text" class="form-control" name="ruangan" placeholder="Ruangan">
                </div>
                <div class="form-group" style="margin-top:0px;">
                    <label>Diagnosa</label>
                    <input type="text" class="form-control" name="diagnosa" placeholder="Diagnosa">
                </div>
                <div class="row" style="margin-top:0px;">
                    <div class="col-md-2">
                        <div class="form-group" style="margin-top:0px;">
                            <label>Golongan Darah</label>
                            <input type="text" class="form-control" name="gol_dar" placeholder="Golongan Darah" value="{{$stock->gol_dar}}" readonly>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-group" style="margin-top:0px;">
                            <label>Rhesus</label>
                            <input type="text" class="form-control" name="rhesus" placeholder="Golongan Darah" value="{{$stock->rhesus}}" readonly>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group" style="margin-top:0px;">
                            <label>Jenis Darah</label>
                            <input type="text" class="form-control" name="jenis_darah" placeholder="Jenis Darah" value="{{$stock->jenis_tranfusi}}" readonly>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group" style="margin-top:0px;">
                            <label>Stok Darah</label>
                            <input type="text" class="form-control" name="qty" placeholder="Stok Darah" value="{{$stock->qty}}" readonly>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group" style="margin-top:0px;">
                            <label>Harga</label>
                            <input type="text" class="form-control" name="harga" placeholder="Harga Darah" value="{{$stock->harga}}" readonly>
                        </div>
                    </div>
                </div>
                <div class="form-group" style="margin-top:0px;">
                    <label>Jumlah</label>
                    <input type="text" name="jumlah" class="form-control" placeholder="Jumlah">
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group" style="margin-top:0px;">
                            <label>Tempat</label>
                            <input type="text" name="tempat" class="form-control" placeholder="Tempat">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group" style="margin-top:0px;">
                            <label>Tanggal</label>
                            <input type="text" name="tanggal" class="form-control datepicker" placeholder="Tanggal">
                        </div>
                    </div>
                </div>
                <div class="form-group" style="margin-top:0px;">
                    <label>Nama Dokter</label>
                    <input type="text" name="nama_dokter" class="form-control" placeholder="Dokter Kariadi">
                </div>
                <div class="box-footer">
                <button type="submit" class="btn btn-success bg-green btn-sm">Pesan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection


@push('header')
<link rel="stylesheet" href="/assets/material/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
<link rel="stylesheet" href="/assets/material/bower_components/bootstrap-daterangepicker/daterangepicker.css">
@endpush

@push('footer')
<script src="/assets/material/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="/assets/material/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript">
  $(function () {
    //Date picker
    $('.datepicker').datepicker({
        format: 'dd-mm-yyyy',
        showInputs: false,
        todayHighlight:'TRUE',
        startDate: '-0d',
        autoclose: true,
    });
  })
</script>
@endpush