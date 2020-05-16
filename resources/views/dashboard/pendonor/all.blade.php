@extends('dashboard.layouts.app')
@section('title', 'Data Pendonor')

@section('content')
<div class="row">
    <div class="box">
        <div class="box-header">
            <a href="{{route('pendonor.create')}}" class="btn btn-secondary bg-green btn-sm pull-left" style="margin-top: 0px; margin-bottom: 0px;">
            <i class="fa fa-plus" aria-hidden="true"></i> Tambah Pendonor</a>
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
            <table id="pendonor-table" class="table table-bordered table-striped" style="width:100%!important;">
                <thead>
                    <tr>
                    <th width="10">No</th>
                    <th width="200">Nama</th>
                    <th width="180">Tempat, Tanggal Lahir</th>
                    <th>Alamat</th>
                    <th width="120">Golongan Darah</th>
                    <th width="100">Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection


@push('header')
<link rel="stylesheet" href="/assets/material/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
@endpush

@push('footer')
<script src="/assets/material/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="/assets/material/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript"> 
    //Hapus Data
    $(document).ready(function() {
      $('#konfirmasi_hapus').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
      });
    });
  </script>
  <script>
    $(function() {
      $('#pendonor-table').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: '{!! route('pendonor.getdata') !!}',
        columns: [
            { data: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'nama', name: 'nama' },
            { data: 'ttl', name: 'ttl' },
            { data: 'alamat', name: 'alamat' },
            { data: 'goldar', name: 'goldar' },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ]
      });
    });
  </script>
@endpush
