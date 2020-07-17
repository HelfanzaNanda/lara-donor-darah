@extends('dashboard.layouts.app')
@section('title', 'Informasi')

@section('content')
<div class="row">
    <div class="box box-primary">
        <div class="box-header with-border" style="margin-left:0px;">
            <h4 style="margin-top:0px; margin-bottom:0px;"><a href="{{route('informasi.index')}}">
            <span class="fa fa-arrow-left"></span></a> Tambah Informasi</h4>
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
        <form method="post" action="{{route('informasi.create')}}"  enctype="multipart/form-data">
        @csrf
            <div class="box-body">
                <div class="form-group">
                    <label>Judul</label>
                    <input type="text" class="form-control" name="title" placeholder="Masukkan Title">
                </div>
                <div class="form-group">
                    <div id="image-preview" style="width:200px;">
                        <label for="image-upload" id="image-label" style="color:#f0f0f0;">Choose File</label>
                        <input type="file" name="foto" id="image-upload" />
                    </div>
                </div>
                <div class="form-group">
                    <label>Kategori</label>
                    <select name="kategori" class="form-control" required>
                        <option value="">Pilih Kategori</option>
                        <option value="informasi">Informasi</option>
                        <option value="berita">Berita</option>
                    </select>
                    <!-- <input type="text" class="form-control" name="kategori" placeholder="Ka"> -->
                </div>
                <div class="form-group">
                    <label>Konten</label>
                    <textarea id="editor1" name="content" class="textarea" placeholder="Place some text here"
                                style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                    <!-- <div class="box-body pad">
                    </div> -->
                </div>
            </div>
            <div class="box-footer">
            <button type="submit" class="btn btn-success bg-green">Simpan</button>
            <a href="{{url()->previous()}}" class="btn btn-danger bg-red">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection

@push('header')
<link rel="stylesheet" href="/assets/material/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

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