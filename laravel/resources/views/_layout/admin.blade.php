<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Website Administrator</title>
@section('css')
    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="{{ asset('/css/extra/metisMenu.min.css') }}" rel="stylesheet">

    <!-- SweetAlert CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/extra/sweetalert.css') }}">

    <!-- Custom CSS -->
    <link href="{{ asset('/css/sb-admin2.css') }}" rel="stylesheet">

@show

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-static-top" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                @section('welcome')
                <a class="navbar-brand" href="{{ url()}}">Welcome, {{ Auth::user()->username }}</a>
                @show
            </div>
            <!-- /.navbar-header -->
            <ul class="nav navbar-top-links navbar-right">
                 <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="glyphicon glyphicon-cog"></i> Setting <i class="caret"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="{{ route('ubahpassword') }}"><i class="glyphicon glyphicon-edit"></i> Ubah Password</a>
                        </li>
                        <li>
                        <a class="confirm" href="{{ url('auth/logout') }}"><span class="glyphicon glyphicon-off"></span> Logout</a>
                        </li>
                    </ul>

                <li>                
                <li>
                    <a href="{{ route('admin-homepage') }}"><i class="glyphicon glyphicon-home"></i> Back to homepage </a>
                </li>
            </ul>
            <!-- /.navbar-top-links -->
            @section('sidemenu')
            <div class="navbar-inverse sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <form method="post" action="{{ route('adminsearch') }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" name="search" placeholder="Search...">
                                <span class="input-group-btn">
                                    <button id="search-btn" class="btn btn-default" type="submit">
                                        <span class="glyphicon glyphicon-search"></span>
                                    </button>
                                </span>
                                </form>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a @unless (Request::is('admin')) id ="dashboard-inactive" @endunless
                            href="{{ route('dashboard') }}"><span class="glyphicon glyphicon-dashboard"></span> Dashboard</a>
                        </li>
                        <li>
                            <a href="#"><span class="glyphicon glyphicon-user"></span> User</a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{ route('admin-user') }}">Daftar User</a>
                                </li>
                                <li>
                                    <a href="{{ route('admin-role') }}">Role</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><span class="glyphicon glyphicon-th-large"></span> Profil</a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{ route('admin-profil_id') }}">Daftar Profil (ID)</a>
                                </li>
                                <li>
                                    <a href="{{ route('admin-profil_en') }}">Daftar Profil (EN)</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="{{ route('admin-kategori') }}"><span class="glyphicon glyphicon-tasks"></span> Kategori Artikel</a>
                        </li>
                        <li>
                            <a href="#"><span class="glyphicon glyphicon-list-alt"></span> Artikel</a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{ route('admin-artikel_id') }}">Daftar Artikel (ID)</a>
                                </li>
                                <li>
                                    <a href="{{ route('admin-artikel_en') }}">Daftar Artikel (EN)</a>
                                </li>
                            </ul>
                        </li>
                        
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            @show
            <!-- /.navbar-static-side -->
        </nav>
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-12">
                    @yield('content')
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

@section('script')
    <!-- jQuery -->
    <script src="{{ asset('/js/jquery.min.js') }}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset('/js/bootstrap.min.js') }}"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="{{ asset('/js/extra/metisMenu.min.js') }}"></script>

    <!-- Custom Theme JavaScript -->
    <script src="{{ asset('/js/sb-admin2.js') }}"></script>

    <!-- Sweet Alert JS -->
    <script src="{{ asset('/js/extra/sweetalert.min.js') }}"></script>

    <script type="text/javascript">
    $("#side-menu").metisMenu({
    doubleTapToGo: true
    });
    </script>

    <script>
    $('a.confirm').click(function(e) {
    e.preventDefault(); // Prevent the href from redirecting directly
    var linkURL = $(this).attr("href");
    warnBeforeRedirect(linkURL);
    });

    function warnBeforeRedirect(linkURL) {
    swal({
      title: "Apakah anda yakin ingin Logout?", 
      type: "error",
      showCancelButton: true
    }, function() {
      // Redirect the user
      window.location.href = linkURL;
    });
    }
    </script>
@show


</body>

</html>
