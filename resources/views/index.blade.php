<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    {{-- <meta name="viewport" content="width=device-width, initial-scale=1.0" /> --}}
	<meta content="" name="description" />
    <meta content="webthemez" name="author" />
    <title>VRS Admin</title>
    <!-- Bootstrap Styles-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FontAwesome Styles-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Morris Chart Styles-->
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <!-- Custom Styles-->
    <link href="assets/css/custom-styles.css" rel="stylesheet" />
    <!-- Google Fonts-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <link rel="stylesheet" href="assets/js/Lightweight-Chart/cssCharts.css">

    <!-- Charts -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
    google.charts.load('current', {
        packages: ['corechart']
    });
</script>
</head>

<body>
    <?php
    use VRSAdmin\Vehicle;
    $vehicles = VRSAdmin\Vehicle::all();
    $customers = VRSAdmin\Customer::all();
    $rentalRecords = VRSAdmin\RentalRecord::all();
    $activeVehicles = Vehicle::where('availability', '!=', 'Deleted')->get();
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
                    Dashboard <small>Welcome {{Auth::user()->name}}</small>
                </h1>
            </div>

            <div id="page-inner">
                <div class="row">
                    <div class="col-md-3 col-sm-12 col-xs-12">
                    <div class="board">
                        <div class="panel panel-primary">
                        <div class="number">
                            <h3>
                                <h3>{{count($activeVehicles)}}</h3>
                                <small>Active <br> Vehicels</small>
                            </h3>
                        </div>
                        <div class="icon">
                            <i class="fa fa-car fa-5x red"></i>
                        </div>
                        </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-12 col-xs-12">
                        <div class="board">
                            <div class="panel panel-primary">
                            <div class="number">
                                <h3>
                                    <h3>{{count($customers)}}</h3>
                                    <small>Number of <br> Users</small>
                                </h3>
                            </div>
                            <div class="icon">
                               <i class="fa fa-user fa-5x blue"></i>
                            </div>
                            </div>
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-12 col-xs-12">
                        <div class="board">
                            <div class="panel panel-primary">
                            <div class="number">

                            <?php
                                $rents = 0;
                                foreach ($vehicles as $vehicle)
                                    $rents += $vehicle->leasing_times
                                ?>
                                <h3>{{$rents}}</h3>
                                <small>Successful <br> Rents</small>
                            </div>

                            <div class="icon">
                               <i class="fa fa-handshake-o fa-6x green"></i>
                            </div>
                            </div>
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-12 col-xs-12">
                        <div class="board">
                            <div class="panel panel-primary">
                            <div class="number">
                                    <?php
                                    $totalProfits = 0;
                                    foreach ($rentalRecords as $rentalRecord){
                                    if ($rentalRecord->profit_received == "Yes"){
                                        $totalProfits += $rentalRecord->profit;
                                        }
                                    }
                                    ?>
                                <h3>
                                    <h3>RM: <?php echo intval($totalProfits)?></h3><br>
                                    <small>Total Profits</small>
                                </h3>
                            </div>
                            <div class="icon">
                               <i class="fa fa-money fa-5x yellow"></i>
                            </div>
                            </div>
                            </div>
                        </div>
                    </div>

		<div class="row">
			<div class="col-xs-6 col-md-3">
				<div class="panel panel-default">
					<div class="panel-body easypiechart-panel">
                        <h4>Available Vehicles</h4>
                        <?php
                        $available = Vehicle::where('availability', '=', 'Available')->get();
                        $availableCount = $available->count();

                        $percentageOfAvailabeV = ($availableCount / count($vehicles) * 100)
                        ?>
						<div class="easypiechart" id="easypiechart-blue" data-percent="{{$percentageOfAvailabeV}}"><span class="percent"><?php echo intval($percentageOfAvailabeV) ?>%</span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-6 col-md-3">
				<div class="panel panel-default">
					<div class="panel-body easypiechart-panel">
                        <h4>Unavailable Vehicles</h4>
                        <?php
                        $unavailable = Vehicle::where('availability', '=', 'Unavailable')->get();
                        $unavailableCount = $unavailable->count();

                        $percentageOfUnavailabeV = ($unavailableCount / count($vehicles) * 100)
                        ?>
						<div class="easypiechart" id="easypiechart-orange" data-percent="{{$percentageOfUnavailabeV}}" ><span class="percent"><?php echo intval($percentageOfUnavailabeV) ?>%</span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-6 col-md-3">
				<div class="panel panel-default">
					<div class="panel-body easypiechart-panel">
                        <h4>Leased Vehicles</h4>
                        <?php
                        $leased = Vehicle::where('availability', '=', 'Leased')->get();
                        $leasedCount = $leased->count();

                        $percentageOfLeasedV = ($leasedCount / count($vehicles) * 100)
                        ?>
						<div class="easypiechart" id="easypiechart-teal" data-percent="{{$percentageOfLeasedV}}" ><span class="percent"><?php echo intval($percentageOfLeasedV) ?>%</span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-6 col-md-3">
				<div class="panel panel-default">
					<div class="panel-body easypiechart-panel">
                        <h4>Deleted Vehicles</h4>
                        <?php
                        $deleted = Vehicle::where('availability', '=', 'Deleted')->get();
                        $deletedCount = $deleted->count();

                        $percentageOfDeletedV = ($deletedCount / count($vehicles) * 100)
                        ?>
						<div class="easypiechart" id="easypiechart-red" data-percent="{{$percentageOfDeletedV}}" ><span class="percent"><?php echo intval($percentageOfDeletedV) ?>%</span>
						</div>
					</div>
				</div>
			</div>
        </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Users
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                <th>User ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Matric</th>
                                <th>Phone No</th>
                                <th>Address</th>
                                <th>No of vehicles</th>
                                <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($customers as $customer)
                                <tr>
                                <td>{{$customer->id}}</td>
                                <td>{{$customer->name}}</td>
                                <td>{{$customer->email}}</td>
                                <td>{{$customer->matric}}</td>
                                <td>{{$customer->phone_no}}</td>
                                <td>{{$customer->address}}</td>
                                <td>{{$customer->no_of_vehicles}}</td>
                                <td>{{$customer->status}}</td>
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
<script src="assets/js/morris/raphael-2.1.0.min.js"></script>
<script src="assets/js/morris/morris.js"></script>
<script src="assets/js/easypiechart.js"></script>
<script src="assets/js/easypiechart-data.js"></script>
<script src="assets/js/Lightweight-Chart/jquery.chart.js"></script>
<script src="assets/js/custom-scripts.js"></script>

<!-- Chart Js -->
<script type="text/javascript" src="assets/js/Chart.min.js"></script>
<script type="text/javascript" src="assets/js/chartjs.js"></script>

</body>
</html>
