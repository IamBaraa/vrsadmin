<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta content="" name="description" />
<meta content="webthemez" name="author" />
<title>Rental Records</title>
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
    $customers = VRSAdmin\Customer::all();
    $vehicles = VRSAdmin\Vehicle::all();
    $rental_records = VRSAdmin\RentalRecord::all();
    $profit_made = 0.0;
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
                Rental Records
            </h1>
		</div>

            <div id="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             Rental Records
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                    <tr>
                                        <th class="text-center">Record ID</th>
                                        <th class="text-center">Plate No</th>
                                        <th class="text-center">Vehicle</th>
                                        <th class="text-center">Owner Email</th>
                                        <th class="text-center">Customer Email</th>
                                        <th class="text-center">Rent Time</th>
                                        <th class="text-center">Return Time</th>
                                        <th class="text-center">Total Price</th>
                                        <th class="text-center">Profit Made (10%)</th>
                                        <th class="text-center">Profit Received</th>
                                        <th class="text-center">Change Profit Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($rental_records as $record)
                                            <tr class="odd gradeX">
                                            <td class="text-center">{{$record->id}}</td>
                                            <td>{{$record->plate_no}}</td>
                                            <td>
                                                @foreach ($vehicles as $vehicle)
                                                    @if ($vehicle->plate_no == $record->plate_no)
                                                        {{$vehicle->manufacturer}} {{$vehicle->model}} ({{$vehicle->production_year}})
                                                        <?php $owner_email = $vehicle->email; ?>
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>{{$owner_email}}</td>
                                            <td>{{$record->customer_email}}</td>
                                            <td>{{$record->rent_datetime}}</td>
                                            <td>{{$record->return_datetime}}</td>
                                            <td class="text-right">RM {{$record->total_price}}</td>
                                            <td class="text-right">RM {{$record->total_price * 0.10}}</td>
                                            <td class="text-center">{{$record->profit_received}}</td>
                                            <td class="text-center">
                                                {!!Form::open(['action' => ['AdminsController@profitReceived', $record->id], 'method' => 'GET'])!!}
                                                {{Form::hidden('_method', 'PUT')}}
                                                <input name="profitStatus" value="Yes" type="hidden">
                                                <button type="submit" class="btn btn-primary">Yes</button>
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
