@extends('dashboard.layouts.app')
@section('title', 'Permintaan Darah')

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
    <form method="post" action="{{route('permintaan.update',$permintaan->id)}}">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <div class="col-md-8">
            <div class="box box-info">
                <div class="box-header with-border" style="margin-left:0px;">
                    <h4 style="margin-top:0px; margin-bottom:0px;"><a href="{{route('permintaan.index')}}"><span class="fa fa-arrow-left"></span></a> Detail</h4>
                </div>
                <div class="box-body">
                    <div class="form-group" style="margin-top:5px;margin-bottom:0px;">
                        <label for="" style="margin-top:0px;margin-bottom:0px;">Nama Pasien</label>
                        <input type="text" class="form-control" name="nama_produk" style="margin-top:0px;margin-bottom:0px;" value="{{$permintaan->nama_pasien}}" readonly="true">
                    </div>
                    <div class="form-group" style="margin-top:0px;margin-bottom:0px;">
                        <label for="" style="margin-top:0px;margin-bottom:0px;">Jenis Kelamin</label>
                        <input type="text" class="form-control" name="harga" style="margin-top:0px;margin-bottom:0px;" value="{{$permintaan->jenis_kelamin}}" readonly="true">
                    </div>
                    <div class="form-group" style="margin-top:5px;margin-bottom:0px;">
                        <label for="" style="margin-top:0px;margin-bottom:0px;">Ruangan</label>
                        <input type="text" class="form-control" name="nama_produk" style="margin-top:0px;margin-bottom:0px;" value="{{$permintaan->ruangan}}" readonly="true">
                    </div>
                    <div class="form-group" style="margin-top:0px;margin-bottom:0px;">
                        <label for="" style="margin-top:0px;margin-bottom:0px;">Diagnosa</label>
                        <input type="text" class="form-control" name="harga" style="margin-top:0px;margin-bottom:0px;" value="{{$permintaan->diagnosa}}" readonly="true">
                    </div>
                    <div class="form-group" style="margin-top:5px;margin-bottom:0px;">
                        <label for="" style="margin-top:0px;margin-bottom:0px;">Golongan Darah</label>
                        <input type="text" class="form-control" name="nama_produk" style="margin-top:0px;margin-bottom:0px;" value="{{$permintaan->darah->gol_dar.'('.$permintaan->darah->rhesus.')'}}" readonly="true">
                    </div>
                    <div class="form-group" style="margin-top:0px;margin-bottom:0px;">
                        <label for="" style="margin-top:0px;margin-bottom:0px;">Jenis Darah</label>
                        <input type="text" class="form-control" name="harga" style="margin-top:0px;margin-bottom:0px;" value="{{$permintaan->darah->jenis_tranfusi}}" readonly="true">
                    </div>
                    <div class="form-group" style="margin-top:0px;margin-bottom:0px;">
                        <label for="" style="margin-top:0px;margin-bottom:0px;">Jumlah Darah</label>
                        <input type="text" class="form-control" name="harga" style="margin-top:0px;margin-bottom:0px;" value="{{$permintaan->jumlah}}" readonly="true">
                    </div>
                    <div class="form-group" style="margin-top:5px;margin-bottom:0px;">
                        <label for="" style="margin-top:0px;margin-bottom:0px;">Tempat</label>
                        <input type="text" class="form-control" name="nama_produk" style="margin-top:0px;margin-bottom:0px;" value="{{$permintaan->tempat}}" readonly="true">
                    </div>
                    <div class="form-group" style="margin-top:0px;margin-bottom:0px;">
                        <label for="" style="margin-top:0px;margin-bottom:0px;">Tanggal Pakai</label>
                        <input type="text" class="form-control" name="harga" style="margin-top:0px;margin-bottom:0px;" value="{{$permintaan->tanggal}}" readonly="true">
                    </div>
                    <div class="form-group" style="margin-top:0px;margin-bottom:0px;">
                        <label for="" style="margin-top:0px;margin-bottom:0px;">Nama Dokter</label>
                        <input type="text" class="form-control" name="harga" style="margin-top:0px;margin-bottom:0px;" value="{{$permintaan->nama_dokter}}" readonly="true">
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
                            <label for="" style="margin-top:0px;margin-bottom:0px;">Status Permintaan</label>
                            <select name="status_permintaan" class="form-control">
                                <option value="">Pilih Status Permintaan</option>
                                <option value="pending" {{$permintaan->status_permintaan == "pending" ? 'selected':''}}>Pending</option>
                                <option value="process" {{$permintaan->status_permintaan == "process" ? 'selected':''}}>Process</option>
                                <option value="success" disabled {{$permintaan->status_permintaan == "success" ? 'selected':''}}>Success</option>
                                <option value="cancel" {{$permintaan->status_permintaan == "cancel" ? 'selected':''}}>Cancel</option>
                            </select>
                        </div>
                        <!-- <div class="form-group" style="margin-top:0px;margin-bottom:0px;">
                            <label for="" style="margin-top:0px;margin-bottom:0px;">Status Pembayaran</label>
                            <select name="status_pembayaran" class="form-control" disabled>
                                <option value="belum dibayar">Belum Dibayar</option>
                                <option value="sudah dibayar">Sudah Dibayar</option>
                            </select>
                        </div> -->
                        <div class="form-group" style="margin-top:0px;margin-bottom:0px;">
                            <label for="" style="margin-top:0px;margin-bottom:0px;">Status Pengiriman</label>
                            <select name="status_pengiriman" class="form-control" {{$permintaan->status_pembayaran != "sudah dibayar" ? 'disabled' : ''}}>
                                <option value="">Pilih Status Pengiriman</option>
                                <option value="sudah dikirim">Sudah Dikirim</option>
                                <option value="belum dikirim">Belum Dikirim</option>
                            </select>
                        </div>
                    </div>
                </div>
                @if($permintaan->status_pembayaran == "sudah dibayar")
                <div class="box box-info">
                    <div class="box-body">
                    <div class="form-group" style="margin-top:0px;margin-bottom:0px;">
                            <label for="">Total Pembayaran</label>
                            <input type="text" name="total_pembayaran" class="form-control" readonly="true" value="{{$pembayaran->total_pembayaran}}" readonly="true">
                        </div>
                        <div class="form-group" style="margin-top:0px;margin-bottom:0px;">
                            <label for="" style="margin-top:0px;margin-bottom:0px;">Status Pembayaran</label>
                            <select name="status_pembayaran" class="form-control" {{auth()->user()->role == 'pmi' ? 'disabled':'' }}>
                                <option value="belum dibayar">Belum Dibayar</option>
                                <option value="sudah dibayar">Sudah Dibayar</option>
                            </select>
                        </div>
                        <div class="form-group" style="margin-top:0px;margin-bottom:0px;">
                            <label for="" style="margin-top:0px;margin-bottom:0px;">Tanggal Pembayaran</label>
                            <input type="text" name="tanggal_pembayaran" class="form-control datepicker" value="{{$pembayaran->tanggal_pembayaran}}" readonly="true">
                        </div>
                        <div class="form-group" style="margin-top:0px;margin-bottom:0px;">
                            <label for="">Tipe Pembayaran</label>
                            <input name="tipe_pembayaran" class="form-control" value="{{$pembayaran->tipe_pembayaran}}" readonly="true"/>
                        </div>
                        <div class="row">
                            <div class="col-md-5" style="margin-top:0px;">
                                <label for="">Bukti Pembayaran</label>
                                    <img src="{{url('/uploads/'.$pembayaran->bukti_pembayaran)}}" style="width:350px;border:1px solid black;">
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                <div class="box box-info">
                    <div class="box-body">
                        <a href="{{route('permintaan.index')}}" class="btn btn-warning btn-sm bg-red" style="width:175px;">Cancel</a>
                        <button type="submit" class="btn btn-success btn-sm bg-green" style="width:175px;">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection


@push('header')

@endpush

@push('footer')


@endpush