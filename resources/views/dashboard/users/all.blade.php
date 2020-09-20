@extends('dashboard.layouts.app')
@section('title', 'Users')

@section('content')
<div class="row">
  <!-- left column -->
  <div class="col-md-4">
    <!-- general form elements -->
    <div class="box box-primary">
      <div class="box-header with-border">
        <div class="box-title">
          <h4 style="margin-top: 0px; margin-bottom: 0px;">Tambah Users</h4>
        </div>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form method="post" action="{{ route('user.store')}}" enctype="multipart/form-data" autocomplete="off">
        <div class="box-body">
          @csrf
          <div class="form-group">
            <label >Role</label>
              <select name="role" id="seeAnotherField" class="form-control">
                <option value="">Pilih role</option>
                <option value="pmi">PMI</option>
                <option value="rs">Rumah Sakit</option>
                <option value="puskesmas">Puskesmas</option>
                <option value="klinik">Klinik</option>
                <option value="pendonor">Pendonor</option>
              </select>
          </div>
          <div class="form-group" id="namaFieldDiv">
            <label for="namaField">Nama</label>
            <input type="text" class="form-control" id="tglField" name="nama" placeholder="Nama akun">
          </div>
          <div class="form-group" id="namarsFieldDiv">
            <label for="namaField">Nama Rumah Sakit</label>
            <select name="nama_rs" class="form-control">
              <option value="" selected disabled>Pilih Rumah Sakit</option>
              <option value="RS Mitra Keluarga Tegal">RS Mitra Keluarga Tegal</option>
              <option value="RSU Kardinah Tegal</">RSU Kardinah Tegal</option>
              <option value="RSI Harapan Anda Tegal">RSI Harapan Anda Tegal</option>
            </select>
          </div>
          <div class="form-group" id="namapuskesmasFieldDiv">
            <label for="namaField">Nama Puskesmas</label>
            <select name="nama_rs" class="form-control">
              <option value="" selected disabled>Pilih Puskesmas</option>
              <option value="Puskesmas Tegal Barat">Puskesmas Tegal Barat</option>
              <option value="Puskesmas Debong Lor">Puskesmas Debong Lor</option>
              <option value="Puskesmas Tegal Timur">Puskesmas Tegal Timur</option>
              <option value="Puskesmas Slerok">Puskesmas Slerok</option>
              <option value="Puskesmas Tegal Selatan">Puskesmas Tegal Selatan</option>
              <option value="Puskesmas Bandung">Puskesmas Bandung</option>
              <option value="Puskesmas Margadana">Puskesmas Margadana</option>
              <option value="Puskesmas Kaligangsa">Puskesmas Kaligangsa</option>
            </select>
          </div>
          <div class="form-group" id="namaklinikFieldDiv">
            <label for="namaklinikField">Nama Klinik</label>
            <select name="nama_rs" class="form-control">
              <option value="" selected disabled>Pilih Klinik</option>
              <option value="BP Polres Tegal Kota">BP Polres Tegal Kota</option>
              <option value="Klinik Jala Medika Lanal Tegal">Klinik Jala Medika Lanal Tegal</option>
              <option value="Klinik Permata As-syifa (plus) ">Klinik Permata As-syifa (plus) </option>
              <option value="Klinik Perintis">Klinik Perintis</option>
              <option value="Klinik Ananda (jst) ">Klinik Ananda (jst) </option>
              <option value="Klinik Mediska PT. KAI Tegal">Klinik Mediska PT. KAI Tegal</option>
              <option value="Klinik Pratama Werkudoro">Klinik Pratama Werkudoro</option>
              <option value="Klinik Imam Syafii">Klinik Imam Syafii</option>
              <option value="Klinik KS Tubun 81">Klinik KS Tubun 81</option>
              <option value="Klinik Pratama NU Margadana">Klinik Pratama NU Margadana</option>
              <option value="BP Aisyiyah Siti Hajar">BP Aisyiyah Siti Hajar</option>
              <option value="Klinik Medicall">Klinik Medicall</option>
              <option value="Klinik As-syifa">Klinik As-syifa</option>
            </select>
          </div>
          <div class="form-group" id="namapengurusFieldDiv">
            <label for="namapengurusField">Nama Pengurus</label>
            <input type="text" class="form-control" id="namapengurusField" name="nama" placeholder="Nama akun">
          </div>
          <!-- <div class="form-group" id="namarsFieldDiv">
            <label for="namarsField">Nama Rumah Sakit</label>
            <input type="text" class="form-control" id="namarsField" name="nama_rs" placeholder="">
          </div> -->
          <div class="form-group" id="emailFieldDiv">
            <label for="emailField">Email</label>
            <input type="text" class="form-control" id="emailField" name="email" placeholder="email@email.com">
          </div>
          <div class="form-group" id="teleponFieldDiv">
            <label for="teleponField">Telepon</label>
            <input type="text" class="form-control" id="teleponField" placeholder="Masukan No Telp" name="phone">
          </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <button type="reset" class="btn btn-default bg-yellow">Batal</button>
          <button type="submit" class="btn btn-success bg-green">Simpan</button>
        </div>
        <!-- /.box-footer -->
      </form>
    </div>
  </div>
  <!--/.col (left) -->
  <!-- right column -->
  <div class="col-md-8">
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
    <div class="box box-info">
      <div class="box-header with-border">
        <div class="box-title">
          <h4 style="margin-top: 0px; margin-bottom: 0px;">Semua Users</h4>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table id="user-table" class="table table-bordered table-striped" style="width:100%!important;">
          <thead>
            <tr>
              <th width="10">No</th>
              <th width="150">Nama</th>
              <th>Kontak</th>
              <th>Rumah Sakit</th>
              <th width="50">Action</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>
  <!--/.col (right) -->

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
      $('#user-table').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: '{!! route('user.getdata') !!}',
        columns: [
        { data: 'DT_RowIndex', orderable: false, searchable: false },
        { data: 'nama', name: 'nama' },
        { data: 'kontak', name: 'kontak' },
        { data: 'nama_rs', name: 'nama_rs' },
        { data: 'action', name: 'action', orderable: false, searchable: false }
        ]
      });
    });
  </script>
<script>
$("#seeAnotherField").change(function() {
  if ($(this).val() == "pmi") {
    $('#namapengurusFieldDiv').show();
    $('#namapengurusField').removeAttr('required');
    $('#namapengurusField').removeAttr('data-error');
    $('#namarsFieldDiv').hide();
    $('#namarsField').removeAttr('required');
    $('#namarsField').removeAttr('data-error');
    $('#namaklinikFieldDiv').hide();
    $('#namaklinikField').removeAttr('required');
    $('#namaklinikField').removeAttr('data-error');
    $('#namapuskesmasFieldDiv').hide();
    $('#namapuskesmasField').removeAttr('required');
    $('#namapuskesmasField').removeAttr('data-error');
    $('#emailFieldDiv').show();
    $('#emailField').removeAttr('required');
    $('#emailField').removeAttr('data-error');
    $('#teleponFieldDiv').show();
    $('#teleponField').removeAttr('required');
    $('#teleponField').removeAttr('data-error');
  }else if($(this).val() == 'rs') {
    $('#namaFieldDiv').hide();
    $('#namaField').removeAttr('required');
    $('#namaField').removeAttr('data-error');
    $('#namapengurusFieldDiv').show();
    $('#namapengurusField').removeAttr('required');
    $('#namapengurusField').removeAttr('data-error');
    $('#namarsFieldDiv').show();
    $('#namarsField').removeAttr('required');
    $('#namarsField').removeAttr('data-error');
    $('#namaklinikFieldDiv').hide();
    $('#namaklinikField').removeAttr('required');
    $('#namaklinikField').removeAttr('data-error');
    $('#namapuskesmasFieldDiv').hide();
    $('#namapuskesmasField').removeAttr('required');
    $('#namapuskesmasField').removeAttr('data-error');
    $('#emailFieldDiv').show();
    $('#emailField').removeAttr('required');
    $('#emailField').removeAttr('data-error');
    $('#teleponFieldDiv').show();
    $('#teleponField').removeAttr('required');
    $('#teleponField').removeAttr('data-error');
  }else if($(this).val() == 'puskesmas') {
    $('#namaFieldDiv').hide();
    $('#namaField').removeAttr('required');
    $('#namaField').removeAttr('data-error');
    $('#namapengurusFieldDiv').show();
    $('#namapengurusField').removeAttr('required');
    $('#namapengurusField').removeAttr('data-error');
    $('#namapuskesmasFieldDiv').show();
    $('#namapuskesmasField').removeAttr('required');
    $('#namapuskesmasField').removeAttr('data-error');
    $('#namaklinikFieldDiv').hide();
    $('#namaklinikField').removeAttr('required');
    $('#namaklinikField').removeAttr('data-error');
    $('#namarsFieldDiv').hide();
    $('#namarsField').removeAttr('required');
    $('#namarsField').removeAttr('data-error');
    $('#emailFieldDiv').show();
    $('#emailField').removeAttr('required');
    $('#emailField').removeAttr('data-error');
    $('#teleponFieldDiv').show();
    $('#teleponField').removeAttr('required');
    $('#teleponField').removeAttr('data-error');
  }else if($(this).val() == 'klinik') {
    $('#namaFieldDiv').hide();
    $('#namaField').removeAttr('required');
    $('#namaField').removeAttr('data-error');
    $('#namapengurusFieldDiv').show();
    $('#namapengurusField').removeAttr('required');
    $('#namapengurusField').removeAttr('data-error');
    $('#namaklinikFieldDiv').show();
    $('#namaklinikField').removeAttr('required');
    $('#namaklinikField').removeAttr('data-error');
    $('#namarsFieldDiv').hide();
    $('#namarsField').removeAttr('required');
    $('#namarsField').removeAttr('data-error');
    $('#namapuskesmasFieldDiv').hide();
    $('#namapuskesmasField').removeAttr('required');
    $('#namapuskesmasField').removeAttr('data-error');
    $('#emailFieldDiv').show();
    $('#emailField').removeAttr('required');
    $('#emailField').removeAttr('data-error');
    $('#teleponFieldDiv').show();
    $('#teleponField').removeAttr('required');
    $('#teleponField').removeAttr('data-error');
  }else if($(this).val() == 'pendonor') {
    $('#namaFieldDiv').show();
    $('#namaField').removeAttr('required');
    $('#namaField').removeAttr('data-error');
    $('#namapengurusFieldDiv').hide();
    $('#namapengurusField').removeAttr('required');
    $('#namapengurusField').removeAttr('data-error');
    $('#namarsFieldDiv').hide();
    $('#namarsField').removeAttr('required');
    $('#namarsField').removeAttr('data-error');
    $('#namaklinikFieldDiv').hide();
    $('#namaklinikField').removeAttr('required');
    $('#namaklinikField').removeAttr('data-error');
    $('#namapuskesmasFieldDiv').hide();
    $('#namapuskesmasField').removeAttr('required');
    $('#namapuskesmasField').removeAttr('data-error');
    $('#emailFieldDiv').show();
    $('#emailField').removeAttr('required');
    $('#emailField').removeAttr('data-error');
    $('#teleponFieldDiv').show();
    $('#teleponField').removeAttr('required');
    $('#teleponField').removeAttr('data-error');
  }else{
    $('#namaFieldDiv').hide();
    $('#namaField').removeAttr('required');
    $('#namaField').removeAttr('data-error');
    $('#namapengurusFieldDiv').hide();
    $('#namapengurusField').removeAttr('required');
    $('#namapengurusField').removeAttr('data-error');
    $('#namarsFieldDiv').hide();
    $('#namarsField').removeAttr('required');
    $('#namarsField').removeAttr('data-error');
    $('#namaklinikFieldDiv').hide();
    $('#namaklinikField').removeAttr('required');
    $('#namaklinikField').removeAttr('data-error');
    $('#namapuskesmasFieldDiv').hide();
    $('#namapuskesmasField').removeAttr('required');
    $('#namapuskesmasField').removeAttr('data-error');
    $('#emailFieldDiv').hide();
    $('#emailField').removeAttr('required');
    $('#emailField').removeAttr('data-error');
    $('#teleponFieldDiv').hide();
    $('#teleponField').removeAttr('required');
    $('#teleponField').removeAttr('data-error');
  }
});
$("#seeAnotherField").trigger("change");
</script>
@endpush
