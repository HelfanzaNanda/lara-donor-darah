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
                <span class="fa fa-arrow-left"></span></a> Detail Pendonor</h4>
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
            <form method="post" action="{{route('pendonor.butuhdarah')}}" enctype="multipart/form-data" autocomplete="off">
            @csrf
                <div class="box-body">
                    <div class="form-group">
                        <label>No KTP</label>
                        <input type="hidden" name="id_pendonor" value="{{$pendonor->id}}">
                        <input type="text" class="form-control" name="ktp" placeholder="Mulyono" value="{{$pendonor->ktp}}" readonly="true">
                    </div>
                    <div class="form-group">
                        <label>Nama Pendonor</label>
                        <input type="text" class="form-control" name="nama" placeholder="Mulyono" value="{{$pendonor->nama}}" readonly="true">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tempat Lahir</label>
                                <input type="text" class="form-control" name="tempat_lahir" placeholder="Tegal" value="{{$pendonor->tempat_lahir}}" readonly="true">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tanggal Lahir</label>
                                <input type="text" class="form-control datepicker" name="tanggal_lahir" placeholder="dd-mm-yy" value="{{$pendonor->tanggal_lahir}}" readonly="true">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <div class="row">
                            <div class="col-md-12">
                                <label>
                                    <input type="radio" name="jenis_kelamin" class="flat-red" value="laki-laki" {{ $pendonor->jenis_kelamin == 'laki-laki' ? 'checked' : ''}} readonly="true"> Laki-Laki
                                </label>
                                <label>
                                    <input type="radio" name="jenis_kelamin" class="flat-red" value="perempuan" {{ $pendonor->jenis_kelamin == 'perempuan' ? 'checked' : ''}} readonly="true"> Perempuan
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea name="alamat" class="form-control" rows="3" placeholder="Jl Mangga Mengkel, No 03" readonly="true">{{$pendonor->alamat}}</textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Kabupaten</label>
                                <select name="kabupaten" class="form-control" disabled>
                                    <option value="">--- Kabupaten  ---</option>
                                    @foreach ($kabupaten as $value)
                                        <option value="{{ $value->id }}" {{ $pendonor->kabupaten == $value->id ? 'selected' : ''}}>{{ $value->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Kecamatan</label>
                                <!-- <input type="text" class="form-control" name="kecamatan" placeholder="Kecamatan Tarub"> -->
                                <select name="kecamatan" class="form-control" disabled>
                                    <option>-- Kecamatan --</option>
                                    @foreach($kecamatan as $value)
                                        <option value="{{ $value->id}}" {{$pendonor->kecamatan == $value->id ? 'selected' : ''}}>{{$value->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Desa</label>
                                <select name="desa" class="form-control" disabled>
                                    <option>-- Desa --</option>
                                    @foreach($desa as $value)
                                        <option value="{{ $value->id}}" {{$pendonor->desa == $value->id ? 'selected' : ''}}>{{$value->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Pekerjaan</label>
                        <select name="pekerjaan" class="form-control" disabled>
                            <option value="" disabled>-- Pilih Pekerjaan --</option>
                            <option value="BUMN" {{$pendonor->pekerjaan == "BUMN" ? 'selected' : ''}}>BUMN</option>
                            <option value="Mahasiswa" {{$pendonor->pekerjaan == "Mahasiswa" ? 'selected' : ''}}>Mahasiswa</option>
                            <option value="Pedagang" {{$pendonor->pekerjaan == "Pedagang" ? 'selected' : ''}}>Pedagang</option>
                            <option value="Pegawai Negeri" {{$pendonor->pekerjaan == "Pegawai Negeri" ? 'selected' : ''}}>Pegawai Negeri</option>
                            <option value="Pegawai Swasta" {{$pendonor->pekerjaan == "Pegawai Swasta" ? 'selected' : ''}}>Pegawai Swasta</option>
                            <option value="Pelajar" {{$pendonor->pekerjaan == "Pelajar" ? 'selected' : ''}}>Pelajar</option>
                            <option value="Petani" {{$pendonor->pekerjaan == "Petani" ? 'selected' : ''}}>Petani/Buruh</option>
                            <option value="POLRI" {{$pendonor->pekerjaan == "POLRI" ? 'selected' : ''}}>POLRI</option>
                            <option value="TNI" {{$pendonor->pekerjaan == "TNI" ? 'selected' : ''}}>TNI</option>
                            <option value="Wiraswasta" {{$pendonor->pekerjaan == "Wiraswasta" ? 'selected' : ''}}>Wiraswasta</option>
                            <option value="lain-lain" {{$pendonor->pekerjaan == "lain-lain" ? 'selected' : ''}}>Lain-lain</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Nama Ibu Kandung</label>
                        <input type="text" class="form-control" name="nama_ibu" placeholder="Siti Barokah" value="{{$pendonor->nama_ibu}}"  readonly="true">
                    </div>
                    <div class="form-group">
                        <label>Status Menikah</label>
                        <div class="row">
                            <div class="col-md-12">
                                <label>
                                    <input type="radio" name="status_nikah" class="felat-red" value="Menikah" {{$pendonor->status_nikah == "Menikah" ? 'checked' : ''}}  readonly="true"> Menikah
                                </label>
                                <label>
                                    <input type="radio" name="status_nikah" class="felat-red" value="Belum Menikah" {{$pendonor->status_nikah == "Belum Menikah" ? 'checked' : ''}}  readonly="true"> Belum Menikah
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Telepon</label>
                        <input type="text" class="form-control" name="phone" placeholder="082328321344" value="{{$pendonor->phone}}" readonly="true">
                    </div>

                    <div class="form-group">
                        <label>Golongan Darah</label>
                        <select name="gol_dar" class="form-control" disabled>
                            <option value="A" {{$pendonor->gol_dar == "A" ? 'selected' : ''}}>A</option>
                            <option value="B" {{$pendonor->gol_dar == "B" ? 'selected' : ''}}>B</option>
                            <option value="AB" {{$pendonor->gol_dar == "AB" ? 'selected' : ''}}>AB</option>
                            <option value="O" {{$pendonor->gol_dar == "O" ? 'selected' : ''}}>O</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Rhesus</label>
                        <select name="rhesus" class="form-control" disabled>
                            <option value="+" {{$pendonor->rhesus == "+" ? 'selected' : ''}}>Positif (+)</option>
                            <option value="-" {{$pendonor->rhesus == "-" ? 'selected' : ''}}>Negatif (-)</option>
                        </select>
                    </div>
                    @if($pendonor->user_id != null)
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control" name="email" value="{{$pendonor->getUser->email}}" readonly="true">
                    </div>
                    @endif
                </div>
                <div class="box-footer">
                    @if($pendonor->user_id != null)
                    <button type="submit" class="btn btn-success btn-sm bg-green">Kirim Notifikasi</button>
                    @endif
                    <a href="{{url()->previous()}}" class="btn btn-success btn-sm bg-danger">Kembali</a>
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
