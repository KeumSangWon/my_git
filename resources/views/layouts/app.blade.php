<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Simple Sidebar - Start Bootstrap Template</title>

    <!-- Bootstrap core CSS -->
    <link href="{{asset('template/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{asset('template/css/simple-sidebar.css')}}" rel="stylesheet">

</head>

<body>

    <div id="wrapper">
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    <a href="#">
                        Start Vote
                    </a>
                </li>
                <li>
                    <a href="{{route('myIndex')}}">My Page</a>
                </li>
                <li>
                    <a href="{{route('votes.index')}}">an ongoing vote</a>
                </li>
                <li>
                    <a href="{{route('lastVotes.index')}}">a closed vote</a>
                </li>
                <li>
                    <a href="{{route('votes.create')}}">Making a Vote</a>
                </li>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->
        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <a href="#menu-toggle" class="btn btn-secondary" id="menu-toggle">Toggle Menu</a>
            </div>
            <br>
            <div class="container-fluid">
                <a href="{{route('votes.create')}}" class="btn btn-secondary" >&nbsp투표 만들기&nbsp</a>
            </div>
        </div>
        <!-- /#page-content-wrapper -->
    </div>
    <!-- /#wrapper -->
    <div class="container">
      @yield('content')
    </div>
    <!-- Bootstrap core JavaScript -->
    <script src="{{asset('template/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('template/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Menu Toggle Script -->
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>

</body>

</html>
