@extends('dashboard.layouts.app')
@section('title', 'Stock Darah')

@section('content')
<div class="row">
    <div class="box box-primary">
        <div class="box-header with-border" style="margin-left:0px;">
            <h4 style="margin-top:0px; margin-bottom:0px;"><a href="{{route('stock.index')}}">
            <span class="fa fa-arrow-left"></span></a> Tambah Stock</h4>
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
        <form method="post" action="{{route('stock.create')}}">
        @csrf
            <div class="box-body">
                <div class="form-group">
                    <label>Golongan Darah</label>
                    <select name="gol_dar" class="form-control">
                        <option value="">-- Pilih Gologan Darah --</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="AB">AB</option>
                        <option value="O">O</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Rhesus</label>
                    <select name="rhesus" class="form-control">
                        <option value="">-- Pilih Rhesus --</option>
                        <option value="+">Positif (+)</option>
                        <option value="-">Negatif (-)</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Jenis Tranfusi</label>
                    <!-- <input type="text" class="form-control" name="kategori" placeholder="Password"> -->
                    <select name="jenis_tranfusi" class="form-control">
                        <option value="">-- Pilih Jenis Tranfusi --</option>
                        <option value="Fresh Frozen Plasma">Fresh Frozen Plasma</option>
                        <option value="Leucodepleted">Leucodepleted</option>
                        <option value="Leucoreduced">Leucoreduced</option>
                        <option value="Packed Red Cell">Packed Red Cell</option>
                        <option value="Trombocyte Concentrate">Trombocyte Concentrate</option>
                        <option value="TC Apheresis">TC Apheresis</option>
                        <option value="Whole Blood">Whole Blood</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Jumlah</label>
                    <input type="text" class="form-control" name="qty" placeholder="300">
                </div>
                <div class="form-group">
                    <label>Harga <small>per kantong</small></label>
                    <input type="text" class="form-control" name="harga" placeholder="/kantong">
                </div>
            </div>
            <div class="box-footer">
            <button type="submit" class="btn btn-success bg-green btn-sm">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('header')
<link rel="stylesheet" href="/assets/material/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
@endpush

@push('footer')
<script src="/assets/material/ckeditor/ckeditor.js"></script>
<script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1')
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5()
  })
</script>
@endpush
