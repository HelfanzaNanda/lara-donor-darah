@extends('dashboard.layouts.app')
@section('title', 'Pesan Darah')

@section('content')
<div class="row">
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
    <form action="{{route('order.updateCheckout',$order->id)}}" method="post"  enctype="multipart/form-data">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <div class="col-md-8">
            <div class="box box-info">
                <div class="box-header with-border" style="margin-left:0px;">
                    <h4 style="margin-top:0px; margin-bottom:0px;"><a href="{{route('order.all')}}"><span class="fa fa-arrow-left"></span></a> Detail</h4>
                </div>
                <div class="box-body">
                    <input type="text" name="permintaan_id" value="{{$order->id}}" hidden="true">
                    <input type="text" name='darah_id' value="{{$order->darah_id}}" hidden="true">
                    <div class="form-group" style="margin-top:5px;margin-bottom:0px;">
                        <label for="" style="margin-top:0px;margin-bottom:0px;">Nama Pasien</label>
                        <input type="text" class="form-control" name="nama_pasien" style="margin-top:0px;margin-bottom:0px;" value="{{$order->nama_pasien}}" readonly="true">
                    </div>
                    <div class="form-group" style="margin-top:0px;margin-bottom:0px;">
                        <label for="" style="margin-top:0px;margin-bottom:0px;">Jenis Kelamin</label>
                        <input type="text" class="form-control" name="jenis_kelamin" style="margin-top:0px;margin-bottom:0px;" value="{{$order->jenis_kelamin}}" readonly="true">
                    </div>
                    <div class="form-group" style="margin-top:5px;margin-bottom:0px;">
                        <label for="" style="margin-top:0px;margin-bottom:0px;">Ruangan</label>
                        <input type="text" class="form-control" name="ruangan" style="margin-top:0px;margin-bottom:0px;" value="{{$order->ruangan}}" readonly="true">
                    </div>
                    <div class="form-group" style="margin-top:0px;margin-bottom:0px;">
                        <label for="" style="margin-top:0px;margin-bottom:0px;">Diagnosa</label>
                        <input type="text" class="form-control" name="diagnosa" style="margin-top:0px;margin-bottom:0px;" value="{{$order->diagnosa}}" readonly="true">
                    </div>
                    <div class="form-group" style="margin-top:5px;margin-bottom:0px;">
                        <label for="" style="margin-top:0px;margin-bottom:0px;">Golongan Darah</label>
                        <input type="text" class="form-control" name="gol_dar" style="margin-top:0px;margin-bottom:0px;" value="{{$order->darah->gol_dar.'('.$order->darah->rhesus.')'}}" readonly="true">
                    </div>
                    <div class="form-group" style="margin-top:0px;margin-bottom:0px;">
                        <label for="" style="margin-top:0px;margin-bottom:0px;">Jenis Darah</label>
                        <input type="text" class="form-control" name="jenis_tranfusi" style="margin-top:0px;margin-bottom:0px;" value="{{$order->darah->jenis_tranfusi}}" readonly="true">
                    </div>
                    <div class="form-group" style="margin-top:0px;margin-bottom:0px;">
                        <label for="" style="margin-top:0px;margin-bottom:0px;">Jumlah Darah</label>
                        <input type="text" class="form-control" name="jumlah" style="margin-top:0px;margin-bottom:0px;" value="{{$order->jumlah}}" readonly="true">
                    </div>
                    <div class="form-group" style="margin-top:0px;margin-bottom:0px;">
                        <label for="" style="margin-top:0px;margin-bottom:0px;">Harga Darah</label>
                        <input type="text" class="form-control" name="harga" style="margin-top:0px;margin-bottom:0px;" value="{{$order->harga}}" readonly="true">
                    </div>
                    <div class="form-group" style="margin-top:5px;margin-bottom:0px;">
                        <label for="" style="margin-top:0px;margin-bottom:0px;">Tempat</label>
                        <input type="text" class="form-control" name="tempat" style="margin-top:0px;margin-bottom:0px;" value="{{$order->tempat}}" readonly="true">
                    </div>
                    <div class="form-group" style="margin-top:0px;margin-bottom:0px;">
                        <label for="" style="margin-top:0px;margin-bottom:0px;">Tanggal Pakai</label>
                        <input type="text" class="form-control" name="tanggal" style="margin-top:0px;margin-bottom:0px;" value="{{$order->tanggal}}" readonly="true">
                    </div>
                    <div class="form-group" style="margin-top:0px;margin-bottom:0px;">
                        <label for="" style="margin-top:0px;margin-bottom:0px;">Nama Dokter</label>
                        <input type="text" class="form-control" name="nama_dokter" style="margin-top:0px;margin-bottom:0px;" value="{{$order->nama_dokter}}" readonly="true">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="box box-info">
                    <div class="box-header with-border" style="margin-left:0px;">
                        <h4 style="margin-top:0px; margin-bottom:0px;">Status</h4>
                    </div>
                    <div class="box-body">
                        <div class="form-group" style="margin-top:5px;margin-bottom:0px;">
                            <label for="" style="margin-top:0px;margin-bottom:0px;">Status order</label>
                            <select name="status_order" class="form-control" {{auth()->user()->role == "rs" ? 'disabled' : ''}}>
                                <option value="pending" {{$order->status_permintaan == "pending" ? 'selected':''}}>Pending</option>
                                <option value="process" {{$order->status_permintaan == "process" ? 'selected':''}}>Process</option>
                                <option value="success" {{$order->status_permintaan == "success" ? 'selected':''}}>Success</option>
                                <option value="cancel" {{$order->status_permintaan == "cancel" ? 'selected':''}}>Cancel</option>
                            </select>
                        </div>
                        <div class="form-group" style="margin-top:0px;margin-bottom:0px;">
                            <label for="" style="margin-top:0px;margin-bottom:0px;">Status Pengiriman</label>
                            <select name="status_pengiriman" class="form-control" disabled>
                                <option value="belum dikirim" {{$order->status_pengiriman == "belum dikirim" ? 'selected':''}}>Belum Dikirim</option>
                                <option value="sudah dikirim" {{$order->status_pengiriman == "sudah dikirim" ? 'selected':''}}>Sudah Dikirim</option>
                            </select>
                        </div>
                        @if($order->status_pengiriman == "sudah dikirim")
                        <div class="form-group" style="margin-top:0px;margin-bottom:0px;">
                            <label for="" style="margin-top:0px;margin-bottom:0px;">Status Penerimaan</label>
                            <select name="status_penerima" class="form-control">
                                <option value="">Pilih Status </option>
                                <option value="belum diterima" {{$order->status_penerima == "belum diterima" ? 'selected':''}}>Belum Diterima</option>
                                <option value="sudah diterima" {{$order->status_penerima == "sudah diterima" ? 'selected':''}}>Sudah Diterima</option>
                            </select>
                        </div>
                        @endif
                    </div>
                </div>
                @if($pembayaran != NULL )
                    @if($order->status_permintaan == "process" || $order->status_permintaan == "success" )
                    <div class="box box-info">
                        <div class="box-header with-border" style="margin-left:0px;">
                            <h4 style="margin-top:0px; margin-bottom:0px;">Detail Pembayaran</h4>
                        </div>
                        <div class="box-body">
                            <div class="form-group" style="margin-top:0px;margin-bottom:0px;">
                                <label for="">Total Pembayaran</label>
                                <input type="text" name="total_pembayaran" class="form-control" readonly="true" value="{{$pembayaran->total_pembayaran}}">
                            </div>
                            <input type="text" name="id_pembayaran" readonly="true" value="{{$pembayaran->id}}" hidden="true">
                            <div class="form-group" style="margin-top:0px;margin-bottom:0px;">
                                <label for="" style="margin-top:0px;margin-bottom:0px;">Status Pembayaran</label>
                                <select name="status_pembayaran" class="form-control">
                                    <option value="">Pilih Status Pembayaran</option>
                                    <option value="belum dibayar" {{$order->status_pembayaran == "belum dibayar" ? 'selected' : ''}}>Belum Dibayar</option>
                                    <option value="sudah dibayar" {{$order->status_pembayaran == "sudah dibayar" ? 'selected' : ''}}>Sudah Dibayar</option>
                                </select>
                            </div>
                            <div class="form-group" style="margin-top:0px;margin-bottom:0px;">
                                <label for="" style="margin-top:0px;margin-bottom:0px;">Tanggal Pembayaran</label>
                                <input type="text" name="tanggal_pembayaran" class="form-control datepicker" value="{{$pembayaran->tanggal_pembayaran}}">
                            </div>
                            <div class="form-group" style="margin-top:0px;margin-bottom:0px;">
                                <label for="">Tipe Pembayaran</label>
                                <input name="tipe_pembayaran" class="form-control" value="{{$pembayaran->tipe_pembayaran}}" readonly="true"/>
                            </div>

                            <div class="row">
                                <div class="col-md-12" style="margin-top:0px;">
                                    <label for="">Bukti Pembayaran</label>
                                    <div id="image-preview" style="background-image: url(/uploads/{{$pembayaran->bukti_pembayaran }});background-size: cover;background-position: center center;">
                                        <label for="image-upload" id="image-label" style="color:#f0f0f0;">Choose File</label>
                                        <input type="file" name="bukti_pembayaran" id="image-upload" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                @else
                    @if($order->status_permintaan == "process" || $order->status_permintaan == "success" )
                    <div class="box box-info">
                        <div class="box-header with-border" style="margin-left:0px;">
                            <h4 style="margin-top:0px; margin-bottom:0px;">Detail Pembayaran</h4>
                        </div>
                        <div class="box-body">
                            <div class="form-group" style="margin-top:0px;margin-bottom:0px;">
                                <label for="">Total Pembayaran</label>
                                @php
                                $total = $order->jumlah * $order->harga
                                @endphp
                                <input type="text" name="total_pembayaran" class="form-control" readonly="true" value="{{$total}}">
                            </div>
                            <div class="form-group" style="margin-top:0px;margin-bottom:0px;">
                                <label for="" style="margin-top:0px;margin-bottom:0px;">Status Pembayaran</label>
                                <select name="status_pembayaran" class="form-control">
                                    <option value="">Pilih Status Pembayaran</option>
                                    <option value="belum dibayar">Belum Dibayar</option>
                                    <option value="sudah dibayar">Sudah Dibayar</option>
                                </select>
                            </div>
                            <div class="form-group" style="margin-top:0px;margin-bottom:0px;">
                                <label for="" style="margin-top:0px;margin-bottom:0px;">Tanggal Pembayaran</label>
                                <input type="text" name="tanggal_pembayaran" class="form-control datepicker">
                            </div>
                            <div class="form-group" style="margin-top:0px;margin-bottom:0px;">
                                <label for="">Tipe Pembayaran</label>
                                <input name="tipe_pembayaran" class="form-control" value="Transfer" readonly="true"/>
                            </div>
                            <div class="row">
                                <div class="col-md-12" style="margin-top:0px;">
                                    <label for="">Bukti Pembayaran</label>
                                    <div id="image-preview">
                                        <label for="image-upload" id="image-label" style="color:#f0f0f0;">Choose File</label>
                                        <input type="file" name="bukti_pembayaran" id="image-upload" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                @endif
                <div class="box box-info">
                    <div class="box-body">
                        <a href="{{route('order.all')}}" class="btn btn-warning btn-sm bg-red" style="width:175px;">Cancel</a>
                        <button type="submit" class="btn btn-success btn-sm bg-green" style="width:175px;">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection


@push('header')
<style>
    /** Image preview */
#image-preview {
    width: 100%;
    height: 160px;
    position: relative;
    overflow: hidden;
    background-color: #e6ecf3;
    color: #4a5152;
    border: 2px dashed #ccc;
    border-radius: 2px;
}
#image-preview input {
    line-height: 150px;
    font-size: 18px;
    position: absolute;
    opacity: 0;
    z-index: 10;
}
#image-preview label {
    position: absolute;
    z-index: 5;
    opacity: 0.8;
    cursor: pointer;
    background-color: #bdc3c7;
    width: 110px;
    height: 40px;
    font-size: 12px;
    line-height: 3.4em;
    text-transform: uppercase;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    margin: auto;
    text-align: center;
}
</style>
<link rel="stylesheet" href="/assets/material/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
<link rel="stylesheet" href="/assets/material/bower_components/bootstrap-daterangepicker/daterangepicker.css">
@endpush

@push('footer')
<script type="text/javascript" src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
<script type="text/javascript" src="/js/jquery.uploadPreview.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $.uploadPreview({
        input_field: "#image-upload",
        preview_box: "#image-preview",
        label_field: "#image-label"
    });
});
</script>
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