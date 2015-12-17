@extends('_layout.admin')

@section('css')
@parent
@include('includes.tinymce')
@stop

@section('content')

<form action="{{ route('simpanartikel_en') }}" method="post" enctype="multipart/form-data" files="true">
<input type="hidden" name="_token" value="{{ csrf_token() }}">

      <div class="panel panel-default">
        <div class="panel-heading">Tambah Artikel (EN)</div>
           <div class="panel-body">
              @include('errors.list')
                <div class="form-group">
                <label><h4>Kategori Artikel</h4></label>
                <br>
                <select name="kategori_id" class="form-control">
                @foreach ($kategori as $kat)
                <option value="{{ $kat->id }}">{{ $kat->nama_en }}</option>
                @endforeach
                </select>
                </div>
                <div class="form-group">
                <label> <h4>Judul Artikel</h4> </label>
                <input type="text" name="judul_artikel" class="form-control">
                </div>
                <div class="form-group">
                <label> <h4>Isi Artikel</h4> </label>
                <textarea name="isi"> </textarea>
                </div>
                <div class="form-group">
                <label><h4>Dokumen</h4></label>
                <input type="file", name="dokumen[]", multiple>
                <label>Tips: Untuk dapat langsung mengupload lebih dari 1 file, tahan tombol CTRL atau SHIFT saat memilih file.</label>
                </div>
                <div class="form-group"></div>
                <label><input class="tampilkan" onchange="tampil()" name="featured" type="checkbox" value="1"> Tampilkan gambar di slider halaman depan?</label>
                <br>
                <div id="pilihgambar" class="form-group" style="display:none">
                <input id="preview" name="gambar" type="file">
                <img id="img" src="" alt="Tidak ada gambar"/>
                <p>Preview</p> 
                <label class="btn btn-sm btn-danger" id="clear">Clear</label>
                <p>Ket: Gambar yang diupload otomatis di resize sesuai ukuran slider</p>
                </div>
                <hr>
                <button type="submit" class="btn btn-lg btn-success">Save</button>
                </form>
            </div>
        </div>
        
@stop

@section('script')
@parent

<script type="text/javascript">
$(document).ready(function(tampil){
    $('input[class="tampilkan"]').click(function(){
        if($(this).attr("value")=="1"){
            $("#pilihgambar").toggle();
        }
});
})
</script>

<script type="text/javascript">
    document.getElementById('clear').addEventListener('click', function () {
    document.getElementById('img').src = ''
    document.getElementById('preview').value = ''
    });
</script>

<script type="text/javascript">
    function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#img').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
        }
    }

    $("#preview").change(function(){
        readURL(this);
    });
</script>
@stop
