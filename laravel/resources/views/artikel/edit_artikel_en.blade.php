@extends('_layout.admin')

@section('css')
@parent
@include('includes.tinymce')
@stop

@section('content')

{{ Session::put('id_artikel', $artikel->id) }}

      <div class="panel panel-default">
        <div class="panel-heading">Edit Artikel (EN)</div>
           <div class="panel-body">
              @include('errors.list')
              <form action="{{ route('updateartikel_en', $artikel->slug) }}" method="post" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="_method" value="patch">
                <div class="form-group">
                <label><h4>Kategori Artikel</h4></label>
                <br>
                <select name="kategori_id" class="form-control">
                <option value="{{ $artikel->kategori->id }}">{{ $artikel->kategori->nama_en }}</option>
                @foreach ($kategori as $kat)
                <option value="{{ $kat->id }}">{{ $kat->nama_en }}</option>
                @endforeach
                </select>
                </div>
                <div class="form-group">
                <label> <h4>Judul Artikel</h4> </label>
                <input type="text" name="judul_artikel" class="form-control" value="{{ $artikel->judul_artikel }}">
                </div>
                <div class="form-group">
                <label> <h4>Isi Artikel</h4> </label>
                <textarea name="isi"> {{ $artikel->isi }} </textarea>
                </div>
                <label> <h4>Dokumen</h4> </label>
                <br>
                @if (count($artikel->document))
                @foreach ($artikel->document as $dokumen)
                <a href="{{ asset($dokumen->link_dokumen) }}">{{ $dokumen->nama_dokumen }}</a> 
                <br>
                @endforeach
                @else
                <h5>Tidak ada dokumen</h5>
                @endif
                <br>
                <a class="btn btn-sm btn-primary" href="{{ route('editdokumen_en') }}">Edit Dokumen</a>
                <hr>
                <div class="form-group"></div>
                <label><input id="tampilkan" onchange="tampil()" name="featured" type="checkbox" value="1"  
                    @if($artikel->featured) checked @endif> Tampilkan gambar di slider halaman depan?</label>
                <br>
                <div id="pilihgambar" class="form-group" @if($artikel->featured==false) style="display:none" @endif>
                <div class="gambar" style="float: left; display: inline-block; margin-right:50px">
                 @if ($artikel->gambar)
                 <p>Gambar saat ini: </p>
                 @else
                 <p>Tidak ada gambar.</p>
                 @endif
                 <a href="{{ asset($artikel->gambar) }}"><img id="current_pic" src="{{ asset($artikel->gambar) }}" style="width:150px; height:75px"></a>
                 <input type="hidden" id="gambar_saat_ini" name="gambar_saat_ini" value="{{ $artikel->gambar }}">
                 </div>
                <div style="display:inline-block">
                <input id="preview" name="gambar" type="file">
                <img id="img" src="" alt="Tidak ada gambar" style="margin-top:9px; width:150px; height:75px" />
                <p>Preview</p> 
                </div>
                <br>
                <label class="btn btn-sm btn-danger" id="clear">Clear</label>
                <p>Ket: Gambar yang diupload otomatis di resize sesuai ukuran slider</p>
                </div>
                <hr>
                <input type="submit" class="btn btn-lg btn-success" value="Update">
            
            </form>
            </div>
        </div>

@stop

@section('script')
@parent

<script type="text/javascript">
$(document).ready(function(){
    $("#tampilkan").click(function(){
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
    document.getElementById('current_pic').src = ''
    document.getElementById('gambar_saat_ini').value = ''
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
