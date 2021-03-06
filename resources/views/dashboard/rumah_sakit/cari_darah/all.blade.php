@extends('dashboard.layouts.app')
@section('title', 'Informasi')

@section('content')
<div class="row">
    <div class="box">
        <div class="box-header">
            <a href="{{route('informasi.create')}}" class="btn btn-secondary bg-green btn-sm pull-left" style="margin-top: 0px; margin-bottom: 0px;">
            <i class="fa fa-plus" aria-hidden="true"></i> Tambah Informasi</a>
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
                    <th width="100">Judul</th>
                    <th>Kategori</th>
                    <th>Kontent</th>
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
      $('#informasi-table').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: '{!! route('informasi.getdata') !!}',
        columns: [
            { data: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'title', name: 'title' },
            { data: 'kategori', name: 'kategori' },
            { data: 'content', name: 'content' },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ]
      });
    });
  </script>
@endpush