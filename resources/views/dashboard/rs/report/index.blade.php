@extends('dashboard.layouts.app')
@section('title', 'Laporan')

@section('content')
<div class="row">
    <div class="box">
        <div class="box-header">
            <form action="{{ route('report.search') }}" method="POST">
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
            <form action="{{ route('report.pdf') }}" method="POST">
                @csrf
                <input type="hidden" name="month" id="input-month" value="{{ $numberMonth }}">
                <button type="submit" class="btn btn-success btn-sm bg-blue pull-left"> <span class="fa fa-print"> </span> Print</button>
            </form>
        </div>
    </div> 
    <div class="box">
        <div class="box-body">
            <table id="cari-table" class="table table-bordered table-striped" style="width:100%!important;">
                <thead>
                    <tr>
                        <th width="10">No</th>
                        <th>Nama Pasien</th>
                        <th>Diagnosa</th>
                        <th>Nama Dokter</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datas as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data->nama_pasien }}</td>
                        <td>{{ $data->diagnosa }}</td>
                        <td>{{ $data->nama_dokter }}</td>
                        <td>{{ $data->tanggal }}</td>
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