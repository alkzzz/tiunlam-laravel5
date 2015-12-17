@extends('_layout.admin')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading">Edit Dokumen "{{ $artikel->judul_artikel }}"</div>
      <div class="panel-body">
        @include('errors.list')
        <div id="customdok" class="form-group">
                <ul class="nav nav-tabs">
                    <li><a href="#tambah" data-toggle="tab">Tambah Dokumen</a></li>
                    <li><a href="#delete" data-toggle="tab">Delete Dokumen</a></li>
                </ul>
                <div class="tab-content">
                   <div class="tab-pane fade in active" id="tambah">
                      <form action="{{ route('simpandokumen_id') }}" method="post" enctype="multipart/form-data" files="true">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <input type="hidden" name="id_artikel" value="">
                      <label>Tips: Untuk dapat langsung mengupload lebih dari 1 file, tahan tombol CTRL atau SHIFT saat memilih file.</label>
                      <input type="file" name="dokumen[]" multiple>
                      <br>
                      <input type="submit" class="btn btn-sm btn-primary" value="Tambah">
                      </form>
                   </div>
                    <div class="tab-pane fade in" id="delete">
                    <form action="{{ route('deletedokumen_id') }}" method="post">
                      <input type="hidden" name="_method" value="delete">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      @foreach ($artikel->dokumen as $dokumen)
                        <br>
                        <input type="checkbox" name="checklist_dokumen[]" value="{{ $dokumen->id }}"> {{ $dokumen->nama_dokumen }}
                      @endforeach
                      <br>
                      <br>
                      <input type="submit" class="btn btn-sm btn-danger" value="Delete">
                    </form>
                   </div>
                </div>
          </div>
          <hr>
          <a class="btn btn-default" href="{{ route('editartikel_id', $artikel->slug) }}">Kembali</a>
	</div>
</div>
@stop

@section('script')
@parent
<script type="text/javascript">
$(document).ready(function(tampil){
    $("#editdok").click(function(){
        if($(this).attr("value")=="1"){
            $("#customdok").toggle();
        }
});
})
</script>
@stop