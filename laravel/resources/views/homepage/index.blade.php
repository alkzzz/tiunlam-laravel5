@extends('_layout.base')

@section('css')
@parent
<link rel="stylesheet" href="{{ asset('css/extra/nivo-slider.css') }}" type="text/css" />
<link rel="stylesheet" href="{{ asset('css/extra/dark/dark.css') }}" type="text/css" />
@stop

@section('slider')
<div class="slider-wrapper theme-dark">
<div id="slider" class="nivoSlider">
  @if (App::getLocale()=='id')
  @foreach ($featured_id as $artikel)
    <a href="{{ route('tampil_artikel', [$artikel->kategori->slug_id, $artikel->slug]) }}"><img src="{{ asset($artikel->gambar) }}" alt="" title="#{{ $artikel->slug }}" /></a>
  @endforeach
</div>
  @foreach ($featured_id as $artikel)
    <div id="{{ $artikel->slug }}" class="nivo-html-caption">
        <a href="{{ route('tampil_artikel', [$artikel->kategori->slug_id, $artikel->slug]) }}"><h4>{{ $artikel->judul_artikel }}</h4></a>
        {!! str_limit($artikel->isi, 20) !!} <a href="{{ route('tampil_artikel', [$artikel->kategori->slug_id, $artikel->slug]) }}">Selengkapnya</a>   
    </div>
  @endforeach
  @else
  @foreach ($featured_en as $artikel)
    <a href="{{ route('tampil_artikel', [$artikel->kategori->slug_en, $artikel->slug]) }}"><img src="{{ asset($artikel->gambar) }}" alt="" title="#{{ $artikel->slug }}" /></a>
  @endforeach
</div>
  @foreach ($featured_en as $artikel)
    <div id="{{ $artikel->slug }}" class="nivo-html-caption">
        <a href="{{ route('tampil_artikel', [$artikel->kategori->slug_en, $artikel->slug]) }}"><h4>{{ $artikel->judul_artikel }}</h4></a>
        {!! str_limit($artikel->isi, 20) !!} <a href="{{ route('tampil_artikel', [$artikel->kategori->slug_en, $artikel->slug]) }}">Read more</a>   
    </div>
  @endforeach
@endif
</div>
@stop

@section('content')
<h1>Home</h1>
@stop

@section('script')
@parent
<script src="{{ asset('js/extra/jquery.nivo.slider.pack.js') }}" type="text/javascript"></script>
<script type="text/javascript">
$(window).load(function() {
    $('#slider').nivoSlider();
});
</script>
<script type="text/javascript">
  $('#slider').nivoSlider({
    animSpeed: 1000,      
    pauseTime: 4000,    
    startSlide: 0,          
});
</script>
@stop