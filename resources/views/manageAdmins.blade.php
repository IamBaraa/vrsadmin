<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta content="" name="description" />
<meta content="webthemez" name="author" />
<title>Manage Admins</title>
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
    $admins = VRSAdmin\User::all();
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
                Manage Admins
            </h1>
		</div>
            <div id="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <!-- Manage Admins Table -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             Manage admins
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                    <tr>
                                        <th class="text-center">Admin ID</th>
                                        <th class="text-center">Name</th>
                                        <th class="text-center">Email</th>
                                        <th class="text-center">Current Role</th>
                                        <th class="text-center">Assign as</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($admins as $admin)
                                            <tr class="odd gradeX">
                                            <td>{{$admin->id}}</td>
                                            <td>{{$admin->name}}</td>
                                            <td>{{$admin->email}}</td>
                                            <td>{{$admin->role}}</td>
                                            {!!Form::open(['action' => ['AdminsController@updateAdminRole', $admin->id], 'method' => 'GET'])!!}
                                            @if($admin->role == 'Manager')
                                            <input name="role" value="Staff" type="hidden">
                                            {{Form::hidden('_method', 'PUT')}}
                                            <td><button type="submit" class="btn btn-primary">Staff</button></td>
                                            @else
                                            <input name="role" value="Manager" type="hidden">
                                            <td><button type="submit" class="btn btn-dark">Manager</button></td>
                                            {!!Form::close()!!}
                                            @endif
                                            <td>
                                                {!!Form::open(['action' => ['AdminsController@destroyAdmins', $admin->id], 'method' => 'GET', 'class' => 'float-right'])!!}
                                                <a href="/destroyAdmins{{$admin->id}}" onclick="return confirm('Are you sure you want to delete this admin permanently?');"><button class=" btn btn-danger">Delete</button></a>
                                                @method('delete')
                                                @csrf
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
