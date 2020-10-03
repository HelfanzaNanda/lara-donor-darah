@extends('dashboard.layouts.app')
@section('title', 'Dashboard')

@section('content')
<div class="row">
@foreach($goldar as $gol)
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        @if($gol->gol_dar == 'A')
        <div class="small-box bg-aqua">
        @elseif($gol->gol_dar == 'B')
        <div class="small-box bg-green">
        @elseif($gol->gol_dar == 'AB')
        <div class="small-box bg-yellow">
        @else
        <div class="small-box bg-red">
        @endif
        <div class="inner">
            <h3>{{$gol->qty}} <small style="color:#ffffff;font-size:20px;">Kantong</small></h3>

            <p>Stok Darah</p>
        </div>
        <div class="icon">
            <!-- <i class="ion">{{$gol->gol_dar.$gol->rhesus}}</i> -->
            <i class="ion" style="font-size:70px;margin-top:10px;">{{$gol->gol_dar.$gol->rhesus}}</i>
        </div>
        <!-- <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
        </div>
    </div>
@endforeach
</div>


<div class="row">
    <div class="box">
        <div class="box-body">
            <div class="col-md-12">
                <div class="col-md-6">
                    <h6 class="ml-3">grafik rumah sakit terbanyak mengambil darah</h6>
                    <div id="chart-rs"></div>
                </div>

                <div class="col-md-6">
                    <h6 class="ml-3">grafik pendonor paling banyak</h6>
                    <div id="chart-pendonor"></div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="col-md-6">
                    <h6 class="ml-3">tempat yg sering</h6>
                    <div id="chart-tempat"></div>
                </div>

                <div class="col-md-6">
                    <h6 class="ml-3">grafik kantong darah perbulan paling banyak</h6>
                    <div id="chart-darah"></div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>

    const url = '{{ config('app.url') }}';

    async function chartRs() {

        const d = await getDataRs();

        var options = {
            series: d,
            chart: {
                type: 'rangeBar',
                height: 350
            },
            plotOptions: {
                bar: {
                    horizontal: false
                }
            },
            dataLabels: {
                enabled: true
            }
        };

        var chart = new ApexCharts(document.querySelector("#chart-rs"), options);
        chart.render();
    }

    async function chartPendonor() {

        const d = await getDataPendonor();

        var options = {
            series: d,
            chart: {
                type: 'rangeBar',
                height: 350
            },
            plotOptions: {
                bar: {
                    horizontal: false
                }
            },
            dataLabels: {
                enabled: true
            }
        };

        var chart = new ApexCharts(document.querySelector("#chart-pendonor"), options);
        chart.render();
    }

    async function chartTempat() {

        const d = await getDataTempat();

        var options = {
            series: d,
            chart: {
                type: 'rangeBar',
                height: 350
            },
            plotOptions: {
                bar: {
                    horizontal: false
                }
            },
            dataLabels: {
                enabled: true
            }
        };

        var chart = new ApexCharts(document.querySelector("#chart-tempat"), options);
        chart.render();
    }

    async function chartKantongDarah() {

        const d = await getDataKantongDarah();

        var options = {
                series: d,
                chart: {
                    height: 350,
                    type: 'area'
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth'
                },
                xaxis: {
                    categories: ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'],
                },
                tooltip: {
                    x: {
                        format: 'dd/MM/yy HH:mm'
                    },
                },
            };

        var chart = new ApexCharts(document.querySelector("#chart-darah"), options);
        chart.render();
    }
      
    chartRs();
    chartPendonor();
    chartTempat();
    chartKantongDarah();
    

    function getDataRs() {
        return fetch(url+'dashboard/home/chart/rs').then(res => res.json()).then(res => res)
    }

    function getDataPendonor() {
        return fetch(url+'dashboard/home/chart/pendonor').then(res => res.json()).then(res => res)
    }

    function getDataTempat() {
        return fetch(url+'dashboard/home/chart/tempat').then(res => res.json()).then(res => res)
    }

    function getDataKantongDarah() {
        return fetch(url+'dashboard/home/chart/darah').then(res => res.json()).then(res => res)
    }
      
    
</script>
@endsection