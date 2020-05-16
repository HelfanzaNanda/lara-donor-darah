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
        <form method="post" action="{{route('informasi.create')}}">
        @csrf
            <div class="box-body">
                <div class="form-group">
                    <label>Judul</label>
                    <input type="text" class="form-control" name="title" placeholder="Masukkan Title">
                </div>
                <div class="form-group">
                    <label>Image</label>
                    <input type="file" class="form-control" name="image" placeholder="Masukkan Title">
                </div>
                <div class="form-group">
                    <label>Kategori</label>
                    <input type="text" class="form-control" name="kategori" placeholder="Password">
                </div>
                <div class="form-group">
                    <label>Konten</label>
                    <div class="box-body pad">
                        <textarea id="editor1" name="content" class="textarea" placeholder="Place some text here"
                                style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                    </div>
                </div>
            </div>
            <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
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