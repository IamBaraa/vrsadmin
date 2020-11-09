<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta content="" name="description" />
<meta content="webthemez" name="author" />
<title>Manage Vehicles</title>
<!-- Bootstrap Styles-->
<link href="assets/css/bootstrap.css" rel="stylesheet" />
<!-- FontAwesome Styles-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- Custom Styles-->
<link href="assets/css/custom-styles.css" rel="stylesheet" />
<!-- Google Fonts-->
<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
<!-- TABLE STYLES-->
<link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
</head>
<body>
    <?php
    $vehicles = VRSAdmin\Vehicle::all();
    ?>
<div id="wrapper">
        <nav class="navbar navbar-default top-navbar" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index"><strong> VRS Admin</strong></a>
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

        <div id="page-wrapper" >
		  <div class="header">
            <h1 class="page-header">
                Manage Vehicles
            </h1>
		</div>

            <div id="page-inner">

            <div class="row">
                <div class="col-md-12">
                    <!-- Manage Vehicles Table -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             Manage Vehicles Table
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                    <tr>
                                        <th class="text-center">Vehicle ID</th>
                                        <th class="text-center">Owner Email</th>
                                        <th class="text-center">Plate No</th>
                                        <th class="text-center">Manufacturer</th>
                                        <th class="text-center">Model</th>
                                        <th class="text-center">Production Year</th>
                                        <th class="text-center">Type</th>
                                        <th class="text-center">Price Per Hour</th>
                                        <th class="text-center">Price Per Day</th>
                                        <th class="text-center">Leasing Time</th>
                                        <th class="text-center">Profit Made</th>
                                        <th class="text-center">Availablity</th>
                                        <th class="text-center">ADs</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($vehicles as $vehicle)
                                            <tr class="odd gradeX">
                                            <td>{{$vehicle->id}}</td>
                                            <td>{{$vehicle->email}}</td>
                                            <td>{{$vehicle->plate_no}}</td>
                                            <td>{{$vehicle->manufacturer}}</td>
                                            <td>{{$vehicle->model}}</td>
                                            <td>{{$vehicle->production_year}}</td>
                                            <td>{{$vehicle->type}}</td>
                                            <td>RM {{$vehicle->price_per_hour}}</td>
                                            <td>RM {{$vehicle->price_per_day}}</td>
                                            <td>{{$vehicle->leasing_times}}</td>
                                            <td>{{$vehicle->total_profits}}</td>
                                            <td>{{$vehicle->availability}}</td>
                                            {!!Form::open(['action' => ['AdminsController@updateAds', $vehicle->id], 'method' => 'GET'])!!}
                                                @if($vehicle->ads == 'Yes')
                                                    <input name="ads" value="No" type="hidden">
                                                    {{Form::hidden('_method', 'PUT')}}
                                                    <td class="text-center"><button type="submit" class="btn btn-warning">Remove from ADs</button></td>
                                                @else
                                                    <input name="ads" value="Yes" type="hidden">
                                                    <td class="text-center"><button type="submit" class="btn btn-primary">Add to ADs</button></td>
                                            {!!Form::close()!!}
                                                @endif
                                            <td>
                                            {!!Form::open(['action' => ['AdminsController@destroy', $vehicle->id], 'method' => 'DELETE', 'class' => 'float-right'])!!}
                                                <a href="/entity/{{$vehicle->id}}/destroy" onclick="return confirm('Are you sure you want to delete this vehicle permanently?');"><button class=" btn btn-danger">Delete</button></a>
                                            {!!Form::close()!!}
                                            </td>
                                            </tr>
                                            @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="assets/js/jquery-1.10.2.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/jquery.metisMenu.js"></script>
<script src="assets/js/dataTables/jquery.dataTables.js"></script>
<script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
    <script>
        $(document).ready(function () {
            $('#dataTables-example').dataTable();
        });
</script>

<script src="assets/js/custom-scripts.js"></script>

</body>
</html>
