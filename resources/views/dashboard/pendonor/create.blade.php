@extends('dashboard.layouts.app')
@section('title', 'Pendonor')

@section('content')
<div class="row">
    <div class="col-md-12">
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
        <div class="box box-info">
            <div class="box-header with-border" style="margin-left:0px;">
                <h4 style="margin-top:0px; margin-bottom:0px;"><a href="{{route('pendonor.index')}}">
                <span class="fa fa-arrow-left"></span></a> Tambah Pendonor</h4>
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
            <form method="post" action="{{route('pendonor.store')}}" enctype="multipart/form-data" autocomplete="off">
            @csrf
                <div class="box-body">
                    <div class="form-group">
                        <label>No KTP</label>
                        <input type="text" class="form-control" name="ktp" placeholder="Mulyono">
                    </div>
                    <div class="form-group">
                        <label>Nama Pendonor</label>
                        <input type="text" class="form-control" name="nama" placeholder="Mulyono">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tempat Lahir</label>
                                <input type="text" class="form-control" name="tempat_lahir" placeholder="Tegal">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tanggal Lahir</label>
                                <input type="text" class="form-control datepicker" name="tanggal_lahir" placeholder="dd-mm-yy">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <div class="row">
                            <div class="col-md-12">
                                <label>
                                    <input type="radio" name="jenis_kelamin" class="flat-red" value="laki-laki"> Laki-Laki
                                </label>
                                <label>
                                    <input type="radio" name="jenis_kelamin" class="flat-red" value="perempuan"> Perempuan
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea name="alamat" class="form-control" rows="3" placeholder="Jl Mangga Mengkel, No 03"></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Kabupaten</label>
                                <select name="kabupaten" class="form-control">
                                    <option value="">--- Kabupaten  ---</option>
                                    @foreach ($kabupaten as $value)
                                        <option value="{{ $value->id }}">{{ $value->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Kecamatan</label>
                                <!-- <input type="text" class="form-control" name="kecamatan" placeholder="Kecamatan Tarub"> -->
                                <select name="kecamatan" class="form-control">
                                    <option>-- Kecamatan --</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Desa</label>
                                <select name="desa" class="form-control">
                                    <option>-- Desa --</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Pekerjaan</label>
                        <select name="pekerjaan" class="form-control">
                            <option value="">-- Pilih Pekerjaan --</option>
                            <option value="BUMN">BUMN</option>
                            <option value="Mahasiswa">Mahasiswa</option>
                            <option value="Pedagang">Pedagang</option>
                            <option value="Pegawai Negeri">Pegawai Negeri</option>
                            <option value="Pegawai Swasta">Pegawai Swasta</option>
                            <option value="Pelajar">Pelajar</option>
                            <option value="Petani">Petani/Buruh</option>
                            <option value="POLRI">POLRI</option>
                            <option value="TNI">TNI</option>
                            <option value="Wiraswasta">Wiraswasta</option>
                            <option value="lain-lain">Lain-lain</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Nama Ibu Kandung</label>
                        <input type="text" class="form-control" name="nama_ibu" placeholder="Siti Barokah">
                    </div>
                    <div class="form-group">
                        <label>Status Menikah</label>
                        <div class="row">
                            <div class="col-md-12">
                                <label>
                                    <input type="radio" name="status_nikah" class="felat-red" value="Menikah"> Menikah
                                </label>
                                <label>
                                    <input type="radio" name="status_nikah" class="felat-red" value="Belum Menikah"> Belum Menikah
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Telepon</label>
                        <input type="text" class="form-control" name="phone" placeholder="082328321344">
                    </div>

                    <div class="form-group">
                        <label>Golongan Darah</label>
                        <select name="gol_dar" class="form-control">
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="AB">AB</option>
                            <option value="O">O</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Rhesus</label>
                        <select name="rhesus" class="form-control">
                            <option value="+">Positif (+)</option>
                            <option value="-">Negatif (-)</option>
                        </select>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="reset" class="btn btn-primary btn-sm bg-purple">Reset</button>
                    <button type="submit" class="btn btn-success btn-sm bg-green">Simpan</button>
                </div>
            </form>
          </div>
        </div>
    </div>
</div>
@endsection

@push('header')
  <!-- daterange picker -->
  <link rel="stylesheet" href="/assets/material/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="/assets/material/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <link rel="stylesheet" href="/assets/material/plugins/iCheck/all.css">  
  <link rel="stylesheet" href="/assets/material/dist/css/skins/all-md-skins.min.css">
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
<!-- Input Kecamatan -->
<script type="text/javascript">
    $(document).ready(function() {
        $('select[name="kabupaten"]').on('change', function() {
            var kabupatenID = $(this).val();
            if(kabupatenID) {
                $.ajax({
                    url: '/kabupaten/kecamatan/'+kabupatenID,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('select[name="kecamatan"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="kecamatan"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                    }
                });
            }else{
                $('select[name="kecamatan"]').empty();
            }
        });
    });

    $(document).ready(function() {
        $('select[name="kecamatan"]').on('change', function() {
            var kabupatenID = $(this).val();
            if(kabupatenID) {
                $.ajax({
                    url: '/kecamatan/desa/'+kabupatenID,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('select[name="desa"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="desa"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                    }
                });
            }else{
                $('select[name="desa"]').empty();
            }
        });
    });
</script>


<script src="/assets/material/plugins/iCheck/icheck.min.js"></script>
<script>
$('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    });

$('input[type="checkbox"].felat, input[type="radio"].felat').iCheck({
      checkboxClass: 'icheckbox_flat-blue',
      radioClass   : 'iradio_flat-blue'
    });
</script>
@endpush
