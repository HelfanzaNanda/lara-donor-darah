@extends('dashboard.layouts.app')
@section('title', 'Laporan RUmah Sakit')

@section('content')
<div class="row">
    {{-- <div class="box">
        <div class="box-header">
            <form action="{{ route('laporan.rs.search') }}" method="POST">
                @csrf
                <div class="form-group pull-left" style="margin-top: 0px; width:100px; margin-right:10px;">
                    <select name="month" class="form-control" id="select-month">
                        <option>Pilih Bulan</option>                        
                        @foreach ($months as $key => $month)
                            <option value="{{ $key+1 }}"{{ $numberMonth == $key+1 ? 'selected' : '' }}>{{ $month }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-success btn-sm bg-green pull-left" data-toggle="modal" data-target="#import"> <span class="fa fa-search"> </span> Cari</button>
            </form>
            <form action="{{ route('laporan.rs.pdf') }}" method="POST">
                @csrf
                <input type="hidden" name="month" id="input-month" value="{{ $numberMonth }}">
                <button type="submit" class="btn btn-success btn-sm bg-blue pull-left"> <span class="fa fa-print"> </span> Print</button>
            </form>
           
        </div>
    </div> --}}
    <div class="box">
        <div class="box-header">
            <h4 class="text-center"><b>Report Rumah Sakit</b></h4>
            <a href="{{ route('laporan.rs.pdf', $user->id) }}" class="btn btn-success btn-sm bg-blue">
                PDF
            </a>
        </div>
        <div class="box-body">
            <table class="table mb-4" style="width:100%!important;" >
                <th>
                    <tr>
                        <th style="width: 20%">Nama Rumah Sakit</th>
                        <th>: {{ $user->nama_rs }}</th>
                    </tr>
                </th>
            </table>
            <table id="example1" class="table table-bordered table-striped" style="width:100%!important;">
                <thead>
                    <tr>
                        <th width="10">No</th>
                        <th>Nama Tempat</th>
                        <th>Hari</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Jam Mulai</th>
                        <th>Jam Selesai</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($user->schedulles as $schedulle)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $schedulle->nama_tempat }}</td>
                        <td>{{ $schedulle->hari }}</td>
                        <td>{{ $schedulle->tanggal }}</td>
                        <td>{{ $schedulle->status }}</td>
                        <td>{{ $schedulle->jam_mulai }}</td>
                        <td>{{ $schedulle->jam_selesai }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

@section('script')
    <script>
        const selectMonth = document.querySelector('#select-month');
        const inputMonth = document.querySelector('#input-month');

        selectMonth.addEventListener('change', function(){
            inputMonth.value = this.value;
        });
    </script>
@endsection