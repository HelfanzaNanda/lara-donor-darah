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
            <div style="padding: 1rem">
                <div class="form-group">
                    <label>No KTP</label>
                    <input type="number" id="searchKtp" class="form-control" name="nik" placeholder="Masukan No KTP" required>
                </div>
                <button id="btnSearchKtp" class="btn btn-success btn-sm bg-green">Cari</button>
            </div>

            <form method="post" action="{{route('pendonor.store')}}" enctype="multipart/form-data" autocomplete="off">
            @csrf
                <div class="box-body">
                    <div class="form-group">
                        <label>No KTP</label>
                        <input type="text" id="ktp" readonly class="form-control" name="ktp" placeholder="Masukan No KTP">
                    </div>
                    <div class="form-group">
                        <label>Nama Pendonor</label>
                        <input type="text" readonly class="form-control" id="nama" name="nama" placeholder="Masukan Nama">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tempat Lahir</label>
                                <input type="text" readonly class="form-control" id="tmp_lahir" name="tempat_lahir" placeholder="Tegal">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tanggal Lahir</label>
                                <input type="text" class="form-control datepicker"readonly  id="tgl_lahir" name="tanggal_lahir" placeholder="dd-mm-yy">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <input type="text" id="jenis_kelamin" name="jenis_kelamin" readonly class="form-control">
                        {{-- <div class="row">
                            <div class="col-md-12">
                                <label >Jenis Kelamin</label>

                                <label>
                                    <input type="radio" readonly id="lk" name="jenis_kelamin" class="flat-red" value="laki-laki"> Laki-Laki
                                </label>
                                <label>
                                    <input type="radio" readonly id="pr" name="jenis_kelamin" class="flat-red" value="perempuan"> Perempuan
                                </label>
                            </div>
                        </div> --}}
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea name="alamat" readonly id="alamat" class="form-control" rows="3" placeholder="Jl Mangga Mengkel, No 03"></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Kabupaten</label>
                                <input type="text" class="form-control" name="kabupaten" id="kabupaten" readonly>
                                {{-- <select name="kabupaten" class="form-control">
                                    <option value="">--- Kabupaten  ---</option>
                                    @foreach ($kabupaten as $value)
                                        <option value="{{ $value->id }}">{{ $value->nama }}</option>
                                    @endforeach
                                </select> --}}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Kecamatan</label>
                                <!-- <input type="text" class="form-control" name="kecamatan" placeholder="Kecamatan Tarub"> -->
                                {{-- <select name="kecamatan" class="form-control">
                                    <option>-- Kecamatan --</option>
                                </select> --}}
                                <input type="text" class="form-control" name="kecamatan" id="kecamatan" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Kelurahan</label>
                                <input type="text" class="form-control" name="kelurahan" id="kelurahan" readonly>
                                {{-- <select name="desa" class="form-control">
                                    <option>-- Kelurahan --</option>
                                </select> --}}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Pekerjaan</label>
                        {{-- <select name="pekerjaan" class="form-control">
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
                        </select> --}}

                        <input type="text" class="form-control" name="pekerjaan" id="pekerjaan" readonly>
                    </div>
                    <div class="form-group">
                        <label>Nama Ibu Kandung</label>
                        <input type="text" class="form-control" readonly id="nama_ibu" name="nama_ibu" placeholder="Nama Ibu">
                    </div>
                    <div class="form-group">
                        <label>Status Menikah</label>
                        <input type="text" class="form-control" name="status_menikah" id="status_menikah" readonly>
                        {{-- <div class="row">
                            <div class="col-md-12">
                                <label>
                                    <input type="radio" name="status_nikah" class="felat-red" value="Menikah"> Menikah
                                </label>
                                <label>
                                    <input type="radio" name="status_nikah" class="felat-red" value="Belum Menikah"> Belum Menikah
                                </label>
                            </div>
                        </div> --}}
                    </div>
                    <div class="form-group">
                        <label>Telepon</label>
                        <input type="text" class="form-control" name="phone" id="phone">
                    </div>

                    <div class="form-group">
                        <label>Golongan Darah</label>
                        <select name="gol_dar" id="gol_dar" class="form-control">
                            <option value="0">TIDAK ADA</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="AB">AB</option>
                            <option value="O">O</option>
                        </select>
                    </div>
                    {{-- <div class="form-group">
                        <label>Rhesus</label>
                        <select name="rhesus" class="form-control" id="rhesus">
                            <option value="+">Positif (+)</option>
                            <option value="-">Negatif (-)</option>
                        </select>
                    </div> --}}
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
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

<script type="text/javascript">

const searchKtp = document.querySelector('#searchKtp');
const btnSearchKtp = document.querySelector('#btnSearchKtp');
const ktp = document.querySelector('#ktp');
const nama = document.querySelector('#nama');
const jenis_kelamin = document.querySelector('#jenis_kelamin');
const tmp_lahir = document.querySelector('#tmp_lahir');
const tgl_lahir = document.querySelector('#tgl_lahir');
const alamat = document.querySelector('#alamat');
const kabupaten = document.querySelector('#kabupaten');
const kecamatan = document.querySelector('#kecamatan');
const kelurahan = document.querySelector('#kelurahan');
const pekerjaan = document.querySelector('#pekerjaan');
const nama_ibu = document.querySelector('#nama_ibu');
const status_menikah = document.querySelector('#status_menikah');
const phone = document.querySelector('#phone');
const gol_dar = document.querySelector('#gol_dar');
const rhesus = document.querySelector('#rhesus');

btnSearchKtp.addEventListener('click', async function(){
    if(searchKtp.value == ''){
        alert('tidak boleh kosong');
    }else{
        let response = await getUser(searchKtp.value);
        let data = response.data
        if (data.content.RESPON == "Data tidak ditemukan") {
            alert('nik tidak ditemukan');
        }else{
            show(data.content[0]);
        }
    }
})

function getUser(ktp) {
    return axios.post('{{ route('pendonor.ktp') }}', {
        'nik': ktp
    })
    .then(res => res)
    .then(res => res)
}

function show(data) {
    ktp.value = data.NIK;
    nama.value = data.NAMA_LGKP;
    tmp_lahir.value = data.TMPT_LHR;
    jenis_kelamin.value = data.JENIS_KLMIN;
    tgl_lahir.value = data.TGL_LHR;
    alamat.value = data.ALAMAT;
    kabupaten.value = data.KAB_NAME;
    kecamatan.value = data.KEC_NAME
    kelurahan.value = data.KEL_NAME;
    pekerjaan.value = data.JENIS_PKRJN;
    nama_ibu.value = data.NAMA_LGKP_IBU;
    status_menikah.value = data.STATUS_KAWIN;
    gol_dar.value = data.GOL_DARAH == 'TIDAK TAHU' ? '0' : data.GOL_DARAH;


}


  $(function () {
    //Date picker
    $('.datepicker').datepicker({
        format: 'dd-mm-yyyy',
        showInputs: false,
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
