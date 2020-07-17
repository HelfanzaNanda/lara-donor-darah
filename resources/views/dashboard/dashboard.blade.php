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
@endsection