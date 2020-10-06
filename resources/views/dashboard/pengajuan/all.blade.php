@extends('dashboard.layouts.app')
@section('title', 'Pengajuan')

@section('content')
<div class="row">
    <div class="box">
        <div class="box-header">
        <!-- Horizontal Form -->
        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>    
        <strong>{{ $message }}</strong>
        </div>
        @endif
        @if ($message = Session::get('message'))
        <div class="alert alert-warning alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>    
        <strong>{{ $message }}</strong>
        </div>
        @endif
        @if ($message = Session::get('error'))
        <div class="alert alert-danger alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>    
        <strong>{{ $message }}</strong>
        </div>
        @endif
        </div>
        <div class="box-body">
            <table id="informasi-table" class="table table-bordered table-striped" style="width:100%!important;">
                <thead>
                    <tr>
                    <th width="10">No</th>
                    <th width="200">Nama Tempat</th>
                    <th>Hari/Tanggal</th>
                    <th width="150">Waktu</th>
                    <th width="250">Alamat</th>
                    <th width="200">Penanggung Jawab</th>
                    <th>Status</th>
                    <th width="60">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pengajuan as $p)
                    <tr>
                        <th width="10">{{$loop->iteration}}</th>
                        <th width="200">{{$p->nama_tempat}}</th>
                        <th>{{$p->hari}}, {{$p->tanggal}}</th>
                        <th width="150">{{$p->jam_mulai}} - {{$p->jam_selesai}}</th>
                        <th width="250">{{$p->alamat}}</th>
                        <th width="200">{{$p->penanggung_jawab}}</th>
                        @if ($p->status == 'diterima')
                            <th> <span class="badge badge-success">{{$p->status}}</span></th>
                        @elseif ($p->status == 'pending')
                            <th> <span class="badge badge-warning">{{$p->status}}</span></th>
                        @else
                            <th> <span class="badge badge-danger">{{$p->status}}</span></th>
                        @endif
                        <th width="60"><a href="{{route('pengajuan.edit',$p->id)}}" class="btn btn-primary bg-blue btn-xs"><span class="fa fa-pencil"></span> Edit</a></th>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection