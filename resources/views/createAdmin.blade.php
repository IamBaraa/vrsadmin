<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta content="" name="description" />
    <meta content="webthemez" name="author" />
    <title>VRS Admin</title>
    <!-- Bootstrap Styles-->
    <link href="../assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FontAwesome Styles-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Morris Chart Styles-->
    <link href="../assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <!-- Custom Styles-->
    <link href="../assets/css/custom-styles.css" rel="stylesheet" />
    <!-- Google Fonts-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <link rel="stylesheet" href="a../ssets/js/Lightweight-Chart/cssCharts.css">
</head>

<body>
    <div id="wrapper">
        <nav class="navbar navbar-default top-navbar" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index"><strong>VRS Admin</strong></a>
            </div>

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                </li>
            </ul>
        </nav>

        <nav class="navbar-default navbar-side" role="navigation">
                <div class="sidebar-collapse">

                    <ul class="nav" id="main-menu">

                        @if(Auth::user()->role == 'Manager')
                        <li>
                            <a href="/index"><i class="fa fa-dashboard"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="/manageUsers"><i class="fa fa-user"></i>Manage Users</a>
                        </li>
                        <li>
                            <a href="/manageVehicles"><i class="fa fa-car"></i>Manage Vehicles</a>
                        </li>
                        <li>
                            <a href="/rentalRecords"><i class="fa fa-money"></i>Rental Records</a>
                        </li>
                        <li>
                            <a href="/create"><i class="fa fa-desktop"></i>Create New Admins</a>
                        </li>
                        <li>
                            <a href="/manageAdmins"><i class="fa fa-male"></i>Manage Admins</a>
                        </li>

                        @else

                        <li>
                            <a href="/index"><i class="fa fa-dashboard"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="/manageUsers"><i class="fa fa-user"></i>Manage Users</a>
                        </li>
                        <li>
                            <a href="/manageVehicles"><i class="fa fa-car"></i>Manage Vehicles</a>
                        </li>
                        <li>
                            <a href="/rentalRecords"><i class="fa fa-money"></i>Rental Records</a>
                        </li>
                        @endif

                    </ul>
                </div>
            </nav>

		<div id="page-wrapper">
		    <div class="header">
                <h1 class="page-header">
                    Create New Admins
                </h1>
            </div>

            <div id="page-inner">
                <div class="container-fluid">
                        <div class="row">
                            <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">

                    {!! Form::open(['action' => 'AdminsController@store', 'method' => 'POST'])!!}
                        <div class="row">
                            <div class="form-group col-md-12">
                                {{Form::label('name', 'Name')}}
                                {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Name'])}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                {{Form::label('email', 'Email')}}
                                {{Form::text('email', '', ['class' => 'form-control', 'placeholder' => 'Email'])}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                {{Form::label('role', 'Role')}}<br>
                                <label class="radio-inline">
                                <input type="radio" id="smt-fld-1-2" name="role" value="Staff" checked>Staff</label><br>
                                <label class="radio-inline">
                                <input type="radio" id="smt-fld-1-3" name="role" value="Manager">Manager</label>
                            </div>
                        </div>
                        <div class="row">
                                <div class="form-group col-md-12">
                                    {{Form::label('password', 'Password')}}
                                    {{Form::password('password',array('placeholder'=>'Password','class' => 'form-control')) }}
                                </div>
                        </div><br>
                            {{Form::submit('Create' , ['class' => 'btn btn-dark'])}}

                    {!! Form::close() !!}

                        </div>
                    </div>
                </div><br><br>
                      @if (count($errors) > 0)
                      <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br>
                        <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                        </ul>
                      </div>
                      @endif
            </div>
        </div>
    </div>
</div>

<script src="../assets/js/jquery-1.10.2.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
<script src="../assets/js/jquery.metisMenu.js"></script>
<script src="../assets/js/morris/raphael-2.1.0.min.js"></script>
<script src="../assets/js/morris/morris.js"></script>
<script src="../assets/js/easypiechart.js"></script>
<script src="../assets/js/easypiechart-data.js"></script>
<script src="../assets/js/Lightweight-Chart/jquery.chart.js"></script>
<script src="../assets/js/custom-scripts.js"></script>

<!-- Chart Js -->
<script type="text/javascript" src="../assets/js/Chart.min.js"></script>
<script type="text/javascript" src="../assets/js/chartjs.js"></script>

</body>
</html>
