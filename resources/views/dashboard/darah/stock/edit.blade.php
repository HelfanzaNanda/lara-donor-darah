@extends('dashboard.layouts.app')
@section('title', 'Stock Darah')

@section('content')
<div class="row">
    <div class="box box-primary">
        <div class="box-header with-border" style="margin-left:0px;">
            <h4 style="margin-top:0px; margin-bottom:0px;"><a href="{{route('stock.index')}}">
            <span class="fa fa-arrow-left"></span></a> Edit Stock</h4>
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
        <form method="post" action="{{route('stock.update', $stok->id)}}">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
            <div class="box-body">
                <div class="form-group">
                    <label>Golongan Darah</label>
                    <select name="gol_dar" class="form-control" disabled="true">
                        <option value="">-- Pilih Gologan Darah --</option>
                        <option value="A" {{ $stok->gol_dar == "A" ? 'selected' : ''}}>A</option>
                        <option value="B" {{ $stok->gol_dar == "B" ? 'selected' : ''}}>B</option>
                        <option value="AB" {{ $stok->gol_dar == "AB" ? 'selected' : ''}}>AB</option>
                        <option value="O" {{ $stok->gol_dar == "O" ? 'selected' : ''}}>O</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Rhesus</label>
                    <select name="rhesus" class="form-control" disabled="true">
                        <option value="">-- Pilih Rhesus --</option>
                        <option value="+" {{ $stok->rhesus == "+" ? 'selected' : ''}}>Positif (+)</option>
                        <option value="-" {{ $stok->rhesus == "-" ? 'selected' : ''}}>Negatif (-)</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Jenis Tranfusi</label>
                    <!-- <input type="text" class="form-control" name="kategori" placeholder="Password"> -->
                    <select name="jenis_tranfusi" class="form-control">
                        <option value="">-- Pilih Jenis Tranfusi --</option>
                        <option value="Fresh Frozen Plasma" {{ $stok->jenis_tranfusi == "Fresh Frozen Plasma" ? 'selected' : ''}}>Fresh Frozen Plasma</option>
                        <option value="Leucodepleted" {{ $stok->jenis_tranfusi == "Leucodepleted" ? 'selected' : ''}}>Leucodepleted</option>
                        <option value="Leucoreduced" {{ $stok->jenis_tranfusi == "Leucoreduced" ? 'selected' : ''}}>Leucoreduced</option>
                        <option value="Packed Red Cell" {{ $stok->jenis_tranfusi == "Packed Red Cell" ? 'selected' : ''}}>Packed Red Cell</option>
                        <option value="Trombocyte Concentrate" {{ $stok->jenis_tranfusi == "Trombocyte Concentrate" ? 'selected' : ''}}>Trombocyte Concentrate</option>
                        <option value="TC Apheresis" {{ $stok->jenis_tranfusi == "TC Apheresis" ? 'selected' : ''}}>TC Apheresis</option>
                        <option value="Whole Blood" {{ $stok->jenis_tranfusi == "Whole Blood" ? 'selected' : ''}}>Whole Blood</option>
                    </select>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Stok</label>
                            <input type="text" class="form-control" name="qty_old" placeholder="50" value="{{$stok->qty}}">
                            <h8 class="text-red">*Note: Jumlah stok saat ini</h8>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Opsi</label>
                            <select name="opsi" class="form-control" require>
                                <option value="penambahan">Penambahan</option>
                                <option value="pengurangan">Pengurangan</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Jumlah</label>
                            <input type="text" class="form-control" name="qty_new" placeholder="50" require>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Harga <small>per kantong</small></label>
                            <input type="text" class="form-control" name="harga" value="{{$stok->harga}}" placeholder="100000 /kantong">
                        </div>
                    </div>
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