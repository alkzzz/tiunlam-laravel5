<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Website Title</title>
	@section('css')
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	@show
	<!-- Fonts -->
	<link href='http://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
@section('menu')
	<nav class="navbar navbar-inverse">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#menu-navbar">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="{{ url('/') }}">Laravel</a>
			</div>

			<div class="collapse navbar-collapse" id="menu-navbar">
				<ul class="nav navbar-nav">
					@if (Auth::guest())
					<li>
					<a href="{{ route('home') }}">{{ trans('menu.home') }}</a></li>
					@else
					<li>
					<a href="{{ route('admin-homepage') }}">{{ trans('menu.home') }}</a></li>
					@endif
					<li class="dropdown">
					<a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ trans('menu.profil') }} <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							@if (App::getLocale()=='id')
							@foreach($daftarprofil as $profil)
				            <li><a href="{{ route('showprofil_id', $profil->slug) }}">{{ $profil->judul_profil }}</a></li>
				            @endforeach
				            @else
				            @foreach($aboutlist as $about)
				            <li><a href="{{ route('showprofil_en', $about->slug) }}">{{ $about->judul_profil }}</a></li>
				            @endforeach
				            @endif
						</ul>
					</li> 
					<li class="dropdown">
					<a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ trans('menu.berita') }} <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							@if (App::getLocale()=='id')
							@foreach($kategori_artikel as $artikel)
				            <li><a href="{{ route('daftar_kategori', $artikel->slug_id) }}">{{ $artikel->nama_id }}</a></li>
				            @endforeach
				            @else
				            @foreach($kategori_artikel as $articles)
				            <li><a href="{{ route('daftar_kategori', $articles->slug_en) }}">{{ $articles->nama_en }}</a></li>
				            @endforeach
				            @endif
						</ul>
					</li>
				</ul>

				<ul class="nav navbar-nav navbar-right">
					@if (Auth::guest())
						<li><a href="{{ url('auth/login') }}">Login</a></li>
					@elseif (Entrust::hasRole('dosen'))
						<li>
							<a href="{{ route('dosen-home') }}">Halaman Dosen</a></li>
						</li>
					@else
						<li>
							<a href="{{ route('dashboard') }}">Halaman Admin</a></li>
						</li>
					@endif
					@if (App::getLocale()=='id')
						@if (Auth::check())
							<li><a id="bahasa" href="{{ url('en/home') }}">
						@else
							<li><a id="bahasa" href="{{ url('en') }}">
						@endif
					<img src="{{ asset('img/english.png') }}"></a></li>
					@else
						@if(Auth::check())
							<li><a id="bahasa" href="{{ url('id/home') }}">
						@else
							<li><a id="bahasa" href="{{ url('id') }}">
						@endif						
					<img src="{{ asset('img/indonesia.png') }}"></a></li>
					@endif
					@if (Auth::guest())
					<form class="navbar-form navbar-right" role="search" method="post" action="{{ route('search') }}">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
				    <div class="form-group">
				      <input type="text" class="form-control" name="search" placeholder="Search">
				    </div>
				      <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
				  	</form>
				  	@endif
				</ul>
			</div>
		</div>
	</nav>
		<div class="container-fluid">
		<div class="row">
			<div class="col-md-offset-2 col-md-8">
				@yield('slider')
			</div>
				
		</div>
	</div>
	@show

	@yield('content')

@section('script')
	<script src="{{ asset('js/jquery.min.js') }}"></script>
	<script src="{{ asset('js/bootstrap.min.js') }}"></script>
@show

</body>
</html>
