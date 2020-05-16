@extends('dashboard.layouts.app')
@section('title', 'Stock Darah')

@section('content')
<div class="row">
  <div class="box box-primary">
    <div class="box-header with-border" style="margin-left:0px;">
      <h4 style="margin-top:0px; margin-bottom:0px;"><a href="{{route('stock.index')}}">
        <span class="fa fa-arrow-left"></span></a> Penyesuaian Stock</h4>
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
    <div class="table-responsive">
        <form method="post" action="{{route('stock.changeupdate')}}">
            @csrf
            <span id="result"></span>
            <table class="table table-bordered table-striped" id="user_table">
                <thead>
                    <tr>
                        <th width="45%" class="text-center">Golongan Darah</th>
                        <th width="45%" class="text-center">Jumlah</th>
                        <th width="10%" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                    <tr>
                    <td colspan="2" align="right">&nbsp;</td>
                    <td>
                        <input type="submit" name="save" id="save" class="btn btn-primary" value="Save" />
                    </td>
                    </tr>
                </tfoot>
            </table>
        </form>
    </div>
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
<script>
  $(document).ready(function(){

   var count = 1;

   dynamic_field(count);

   function dynamic_field(number)
   {
    html = '<tr>';
    html += `<td>
            <select name="gol_dar[]" class="form-control">
                <option value="">-- Pilih Gologan Darah --</option>
                @foreach($stock as $st)
                <option value="{{$st->id}}">{{$st->gol_dar . ' (' . $st->rhesus . ')'}}</option>
                @endforeach
            </select></td>`;
    html += '<td><input type="text" name="qty[]" class="form-control" placeholder="45"></td>';
    if(number > 1)
    {
      html += '<td><button type="button" name="remove" id="" class="btn btn-danger btn-xs bg-red remove"><span class="fa fa-minus"> </span> Hapus</button></td></tr>';
      $('tbody').append(html);
    }
    else
    {   
      html += '<td><button type="button" name="add" id="add" class="btn btn-success btn-xs bg-green"><span class="fa fa-plus"> </span> Tambah</button></td></tr>';
      $('tbody').html(html);
    }
  }

  $(document).on('click', '#add', function(){
    count++;
    dynamic_field(count);
  });

  $(document).on('click', '.remove', function(){
    count--;
    $(this).closest("tr").remove();
  });
});
</script>

@endpush