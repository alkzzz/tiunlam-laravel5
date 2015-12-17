@extends('_layout.base')

@section('menu')
@stop

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default panel-login">
				<div class="panel-heading">Login</div>
				<div class="panel-body">

				@include('errors.list')

					@section('form')
					<form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/login') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label">Username</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="username" value="{{ old('username') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Password</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<div class="checkbox">
									<label>
										<input type="checkbox" name="remember"> Remember Me
									</label>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-default">Login</button>
								<a class="btn btn-default" href="{{ url() }}">Kembali</a>
								<a class="btn btn-default" href="{{ url('/password/email') }}">Lupa Password?</a>
							</div>
						</div>
					</form>
					@show
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
