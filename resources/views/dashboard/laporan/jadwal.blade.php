@extends('dashboard.layouts.app')
@section('title', 'Laporan Jadwal')

@section('content')
<div class="row">
    <div class="box">
        <div class="box-header" style="margin-bottom:0px;">
          <h4 class="text-center" style="margin-bottom:0px;"><b>Jadwal Selesai</b></h4>
        </div>
        <div class="box-body">
            <a href="{{route('jadwal.selesai')}}" class="btn btn-primary bg-red btn-xs" target="_blank" style="margin-bottom:0px;nargin-top:0px;">Cetak</a>
            <table id="jadwal-table" class="table table-bordered table-striped" style="width:100%!important;">
                <thead>
                    <tr>
                    <th width="10">No</th>
                    <th>Nama Lokasi</th>
                    <th>Hari, Tanggal</th>
                    <th>Waktu</th>
                    <th>Alamat</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach($jadwal_selesai as $js)
                    <tr>
                    <th width="10">{{$loop->iteration}}</th>
                    <th>{{$js->nama_tempat}}</th>
                    <th>{{$js->hari}}, {{$js->tanggal}}</th>
                    <th>{{$js->jam_mulai}} - {{$js->jam_selesai}}</th>
                    <th>{{$js->alamat}}</th>
                    </tr>
                  @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="box">
    <div class="box-header" style="margin-bottom:0px;">
          <h4 class="text-center" style="margin-bottom:0px;"><b>Jadwal Batal</b></h4>
        </div>
        <div class="box-body">
            <a href="{{route('jadwal.batal')}}" class="btn btn-primary bg-red btn-xs" target="_blank" style="margin-bottom:0px;nargin-top:0px;">Cetak</a>
            <table id="jadwal-table" class="table table-bordered table-striped" style="width:100%!important;">
                <thead>
                    <tr>
                    <th width="10">No</th>
                    <th>Nama Lokasi</th>
                    <th>Hari, Tanggal</th>
                    <th>Waktu</th>
                    <th>Alamat</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach($jadwal_batal as $jb)
                    <tr>
                    <th width="10">{{$loop->iteration}}</th>
                    <th>{{$jb->nama_tempat}}</th>
                    <th>{{$jb->hari}}, {{$jb->tanggal}}</th>
                    <th>{{$jb->jam_mulai}} - {{$jb->jam_selesai}}</th>
                    <th>{{$jb->alamat}}</th>
                    </tr>
                  @endforeach
                </tbody>
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
      $('#stock-table').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: '{!! route('jadwal.getdata') !!}',
        columns: [
            { data: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'gol_dar', name: 'gol_dar' },
            { data: 'jenis_tranfusi', name: 'jenis_tranfusi' },
            { data: 'qty', name: 'qty' },
            { data: 'harga', name: 'harga' },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ]
      });
    });
  </script>
@endpush