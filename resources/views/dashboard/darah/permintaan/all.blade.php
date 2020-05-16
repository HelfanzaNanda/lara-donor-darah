@extends('dashboard.layouts.app')
@section('title', 'Permintaan Darah')

@section('content')
<div class="row">
<div class="box">
        <div class="box-header">
            <a href="#" class="btn btn-secondary bg-green btn-sm pull-left" style="margin-top: 0px; margin-bottom: 0px;"><i class="fa fa-plus" aria-hidden="true"></i> Tambah Permintaan</a>
        </div>
    </div>
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
                    <th width="100">Kode</th>
                    <th>Nama Akun</th>
                    <th>Kategori</th>
                    <th width="120">Biaya</th>
                    <th width="100">Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection