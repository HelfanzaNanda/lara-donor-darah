@extends('dashboard.layouts.app')
@section('title', 'Jadwal')

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
                <h4 style="margin-top:0px; margin-bottom:0px;"><a href="{{route('jadwal.index')}}"><span class="fa fa-arrow-left"></span></a> Tambah Jadwal</h4>
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
            <form method="post" action="{{route('jadwal.store')}}" enctype="multipart/form-data">
            @csrf
                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-3" style="margin-top: 0px;">
                            <div class="form-group" style="margin-top:0px;">
                                <label style="margin-bottom:10px;">Foto Lokasi</label>
                                <div id="image-preview">
                                    <label for="image-upload" id="image-label" style="color:#f0f0f0;">Pilih File</label>
                                    <input type="file" name="foto" id="image-upload" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" style="margin-top:0px;">
                        <label>Nama Lokasi</label>
                        <input type="text" class="form-control" name="nama_tempat" placeholder="Masukan Tempat">
                    </div>
                    {{-- <div class="form-group" style="margin-top:10px;">
                        <label>Hari</label>
                        <select name="hari" class="form-control">
                            <option value="">Pilih Hari</option>
                            <option value="Senin">Senin</option>
                            <option value="Selasa">Selasa</option>
                            <option value="Rabu">Rabu</option>
                            <option value="Kamis">Kamis</option>
                            <option value="Jumat">Jum'at</option>
                            <option value="Sabtu">Sabtu</option>
                            <option value="Minggu">Minggu</option>
                        </select>
                    </div> --}}
                    <div class="form-group" style="margin-top:0px;">
                        <label>Tanggal</label>
                        <input type="text" class="form-control datepicker" name="tanggal" readonly style="cursor: pointer;">
                    </div> 
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group" style="margin-top:0px;">
                                <label>Jam Mulai</label>
                                <input type="text" class="form-control timepicker" name="jam_mulai"
                                readonly style="cursor: pointer;" placeholder="08:00">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group" style="margin-top:0px;">
                                <label>Jam Selesai</label>
                                <input type="text" class="form-control timepicker" name="jam_selesai" 
                                readonly style="cursor: pointer;" placeholder="04:00">
                            </div>
                        </div>

                    </div>
                    <div class="form-group" style="margin-top:0px;">
                        <label>Alamat</label>
                        <textarea class="form-control" rows="3" name="alamat" placeholder="Jalan Mawar Merah No 69"></textarea>
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
<link rel="stylesheet" href="/assets/material/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">

<style>
    /** Image preview */
#image-preview {
    width: 100%;
    height: 160px;
    position: relative;
    overflow: hidden;
    background-color: #e6ecf3;
    color: #4a5152;
    border: 2px dashed #ccc;
    border-radius: 2px;
}
#image-preview input {
    line-height: 150px;
    font-size: 18px;
    position: absolute;
    opacity: 0;
    z-index: 10;
}
#image-preview label {
    position: absolute;
    z-index: 5;
    opacity: 0.8;
    cursor: pointer;
    background-color: #bdc3c7;
    width: 110px;
    height: 40px;
    font-size: 12px;
    line-height: 3.4em;
    text-transform: uppercase;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    margin: auto;
    text-align: center;
}
</style>

  <!-- daterange picker -->
  <link rel="stylesheet" href="/assets/material/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="/assets/material/plugins/iCheck/all.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="/assets/material/bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
  <!-- Bootstrap time Picker -->
  {{-- <link rel="stylesheet" href="/assets/material/plugins/timepicker/bootstrap-timepicker.min.css"> --}}
@endpush

@push('footer')
<script type="text/javascript" src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
<script type="text/javascript" src="/js/jquery.uploadPreview.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $.uploadPreview({
        input_field: "#image-upload",
        preview_box: "#image-preview",
        label_field: "#image-label"
    });
});
</script>

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


<!-- date-range-picker -->
<script src="/assets/material/bower_components/moment/min/moment.min.js"></script>
<script src="/assets/material/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
{{-- <script src="/assets/material/plugins/timepicker/bootstrap-timepicker.min.js"></script> --}}

<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>


<script>
  $(function () {
    //Timepicker
//     $('.timepicker').timepicker({
//       showInputs: false, 
//       disabledTimeIntervals: [
//       [moment().hour(0).minutes(0), moment().hour(8).minutes(30)],
//       [moment().hour(20).minutes(30), moment().hour(24).minutes(0)]
//    ]
//     })

    
  })

    $('.timepicker').timepicker({
        timeFormat: 'h:mm p',
        interval: 30,
        dynamic: true,
        dropdown: true,
        scrollbar: true,
        minTime: '8:00am',
        maxTime: '4:00pm',
    });
</script>
@endpush
