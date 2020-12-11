@extends('dashboard.layouts.app')
@section('title', 'Laporan Darah')

@section('content')
<div class="row">
    <div class="box">
        <div class="box-header">
        <!-- Horizontal Form -->
        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>    
        <strong>{{ $message }}</strong>
        </div>Q
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
        <h4 class="text-center"><b>Darah Masuk</b></h4>
        </div>
        <div class="box-body">
        <a href="{{route('darah.lapmasuk')}}" class="btn btn-primary bg-red btn-xs" target="_blank" style="margin-bottom:0px;nargin-top:0px;">Cetak</a>
            <table id="stock-table" class="table table-bordered table-striped" style="width:100%!important;">
                <thead>
                    <tr>
                    <th width="10">No</th>
                    <th width="150">Golongan Darah</th>
                    <th>Jenis Tranfusi</th>
                    <th>Jumlah</th>
                    </tr>
                </thead>
            </table>
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
        <h4 class="text-center"><b>Darah Keluar</b></h4>
        </div>
        <div class="box-body">
        <a href="{{route('darah.lapkeluar')}}" class="btn btn-primary bg-red btn-xs" target="_blank" style="margin-bottom:0px;nargin-top:0px;">Cetak</a>
            <table id="example1" class="table table-bordered table-striped" style="width:100%!important;">
                <thead>
                    <tr>
                    <th width="10">No</th>
                    <th>Golongan Darah</th>
                    <th>Jenis Tranfusi</th>
                    <th>Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($lapDarah as $ld)
                    <tr>
                    <th>{{$loop->iteration}}</th>
                    <th>{{$ld->darah->gol_dar}}({{$ld->darah->rhesus}})</th>
                    <th>{{$ld->darah->jenis_tranfusi}}</th>
                    <th>{{$ld->goldar}}</th>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


<div class="modal fade" id="konfirmasi_hapus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
     <div class="modal-content">
      <div class="modal-body text-center">
       <b>Anda yakin ingin menghapus Permanen data ini ?</b>
       <br><br>
       <a class="btn btn-danger btn-ok"> Hapus</a><button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
     </div>
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
        ajax: '{!! route('stock.getdata') !!}',
        columns: [
            { data: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'gol_dar', name: 'gol_dar' },
            { data: 'jenis_tranfusi', name: 'jenis_tranfusi' },
            { data: 'qty', name: 'qty' }
        ]
      });
    });
  </script>
  
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
@endpush