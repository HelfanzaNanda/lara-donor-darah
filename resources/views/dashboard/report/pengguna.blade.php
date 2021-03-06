@extends('dashboard.layouts.app')
@section('title', 'Pengguna')

@section('content')
<div class="row">

    <div class="box">
        <div class="box-header">
            <!-- Button trigger modal -->
            {{-- <button type="button" class="d-inline btn btn-primary btn-sm bg-warning" data-toggle="modal" data-target="#filter-modal">
                Filter
            </button> --}}
            <form action="{{ route('laporan.pengguna.search') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-1">
                        <input type="time" name="time" id="time" class="form-control">
                    </div>
                    <div class="col-md-2">
                        <select name="month" class="form-control" id="select-month">
                            <option selected disabled>Pilih Bulan</option>
                            @foreach ($months as $key => $month)
                                <option value="{{ $key+1 }}"{{ $numberMonth == $key+1 ? 'selected' : '' }}>{{ $month }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select name="year" id="year" class="form-control">
                            <option selected disabled>Pilih Tahun</option>
                            @foreach ($years as $year)
                                <option value="{{ $year }}" {{ $year == $yearSelected ? 'selected' : '' }}>{{ $year }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select name="place" id="place" class="form-control">
                            <option selected disabled>Pilih Tempat</option>
                            @foreach ($places as $place)
                            <option value="{{ $place->id }}">{{ $place->nama_tempat }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-1" style="margin-top: 1%">
                        <button type="submit" class="btn btn-success btn-sm bg-green pull-left" data-toggle="modal" data-target="#import"> <span class="fa fa-search"> </span> Cari</button>
                    </div>
                </div>
            </form>
            <form action="{{ route('laporan.pengguna.pdf') }}" method="POST">
                @csrf
                <input type="hidden" name="month" id="input-month" value="{{ $numberMonth }}">
                <button type="submit" class="btn btn-success btn-sm bg-blue pull-left"> <span class="fa fa-print"> </span> Print</button>
            </form>
        </div>
    </div>
    <div class="box">
        <div class="box-header">
        <h4 class="text-center"><b>Report Rumah Sakit</b></h4>
        </div>
        <div class="box-body">
            <table id="example1" class="table table-bordered table-striped" style="width:100%!important;">
                <thead>
                    <tr>
                        <th width="10">No</th>
                        <th>Nama Pasien</th>
                        <th>Goldar</th>
                        <th>Rhesus</th>
                        <th>Status Donor</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datas as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data->nama }}</td>
                        <td>{{ $data->gol_dar }}</td>
                        <td>{{ $data->rhesus }}</td>
                        <td>{{ $data->status_donor }}</td>
                        <td>{{ \Carbon\Carbon::parse($data->created_at)->format('d m Y') }}</td>
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
