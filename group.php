<?php

$p = $_REQUEST['p'];
// init will be made into a dynamic class loading script, for now, things are a bit unorganized
include("./includes/init.php");
include("./includes/verify.php");




?>
<!DOCTYPE html>
<html class="no-js">
<!-- Mirrored from sublime.nyasha.me/admin/blank.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 30 Dec 2017 19:53:55 GMT -->
<head>
	<meta charset="utf-8">
	<meta content="Flat, Clean, Responsive, application admin template built with bootstrap 3" name="description">
	<meta content="width=device-width,user-scalable=no,initial-scale=1,maximum-scale=1" name="viewport">
	<title><?php echo $server->get('page')->pageTitle().' | '.$server->get('core')->setting('site_name'); ?></title>
	<script src="../cdn-cgi/apps/head/OD5ndB08NwL1oUgIYmaZ8k2oR2M.js">
	</script>
	<link href="vendor/x-editable/dist/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet">
	<link href="vendor/x-editable/dist/inputs-ext/address/address.css" rel="stylesheet">
	<link href="vendor/x-editable/dist/inputs-ext/typeaheadjs/lib/typeahead.js-bootstrap.css" rel="stylesheet">
	<link href="vendor/select2/dist/css/select2.css" rel="stylesheet">
	<link href="vendor/chosen_v1.4.0/chosen.min.css" rel="stylesheet">

	<link href="vendor/datatables/media/css/jquery.dataTables.css" rel="stylesheet">
	<link href="styles/app.min.1f20ae203.css" rel="stylesheet"><!--[if lt IE 9]>
                        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
                        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
                        <![endif]-->

	<script src="vendor/modernizr.js">
	</script>
</head>
<body>
	<div class="app">
		<header class="header header-fixed navbar">
			<div class="brand">
				<a class="ti-menu off-left visible-xs" data-move="ltr" data-toggle="offscreen" href="javascript:;"></a> <a class="navbar-brand" href="index-2.html"><img alt="" src="images/logo.3d0092b4.png"> <span class="heading-font"><?php echo $server->get('core')->setting('header_title'); ?></span></a>
			</div>
			<ul class="nav navbar-nav">
				<li class="hidden-xs">
					<a class="toggle-sidebar" href="javascript:;"><i class="ti-menu"></i></a>
				</li>

			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown hidden-xs">
					<a data-toggle="dropdown" href="javascript:;"><i class="ti-more-alt"></i></a>
					<ul class="dropdown-menu animated zoomIn">
						<li class="dropdown-header">Quick Links</li>
						<li>
							<a href="javascript:;">Start New Campaign</a>
						</li>
						<li>
							<a href="javascript:;">Review Campaigns</a>
						</li>
						<li class="divider"></li>
						<li>
							<a href="javascript:;">Settings</a>
						</li>
						<li>
							<a href="javascript:;">Wish List</a>
						</li>
						<li>
							<a href="javascript:;">Purchases History</a>
						</li>
						<li class="divider"></li>
						<li>
							<a href="javascript:;">Activity Log</a>
						</li>
						<li>
							<a href="javascript:;">Settings</a>
						</li>
						<li>
							<a href="javascript:;">System Reports</a>
						</li>
						<li class="divider"></li>
						<li>
							<a href="javascript:;">Help</a>
						</li>
						<li>
							<a href="javascript:;">Report a Problem</a>
						</li>
					</ul>
				</li>
				<li class="notifications dropdown">
					<a data-toggle="dropdown" href="javascript:;"><i class="ti-bell"></i>
					<div class="badge badge-top bg-danger animated flash">
						<span>3</span>
					</div></a>
					<div class="dropdown-menu animated fadeInLeft">
						<div class="panel panel-default no-m">
							<div class="panel-heading small">
								<b>Notifications</b>
							</div>
							<ul class="list-group">
								<li class="list-group-item">
									<a href="javascript:;"><span class="pull-left mt5 mr15"><img alt="" class="avatar avatar-sm img-circle" src="images/face4.167061d0.jpg"></span>
									<div class="m-body">
										<div>
											<small><b>CRYSTAL BROWN</b></small> <span class="label label-danger pull-right">ASSIGN AGENT</span>
										</div><span>Opened a support query</span> <span class="time small">2 mins ago</span>
									</div></a>
								</li>
								<li class="list-group-item">
									<a href="javascript:;">
									<div class="pull-left mt5 mr15">
										<div class="circle-icon bg-danger">
											<i class="ti-download"></i>
										</div>
									</div>
									<div class="m-body">
										<span>Upload Progress</span>
										<div class="progress progress-xs mt5 mb5">
											<div aria-valuemax="100" aria-valuemin="0" aria-valuenow="40" class="progress-bar" role="progressbar" style="width: 40%"></div>
										</div><span class="time small">Submited 23 mins ago</span>
									</div></a>
								</li>
								<li class="list-group-item">
									<a href="javascript:;"><span class="pull-left mt5 mr15"><img alt="" class="avatar avatar-sm img-circle" src="images/face3.576d23e2.jpg"></span>
									<div class="m-body">
										<em>Status Update:</em> <span>All servers now online</span> <span class="time small">5 days ago</span>
									</div></a>
								</li>
							</ul>
							<div class="panel-footer">
								<a href="javascript:;">See all notifications</a>
							</div>
						</div>
					</div>
				</li>
				<li class="off-right">
					<a data-toggle="dropdown" href="javascript:;"><img alt="user" class="header-avatar img-circle" src="images/avatar.10d02c68.jpg" title="user"> <span class="hidden-xs ml10"><?php echo $_SESSION['username']; ?></span> <i class="ti-angle-down ti-caret hidden-xs"></i></a>
					<ul class="dropdown-menu animated fadeInRight">
						<li>
							<a href="javascript:;">Settings</a>
						</li>
						<li>
							<a href="javascript:;">Upgrade</a>
						</li>
						<li>
							<a href="javascript:;">
							<div class="badge bg-danger pull-right">
								3
							</div><span>Notifications</span></a>
						</li>
						<li>
							<a href="javascript:;">Help</a>
						</li>
						<li>
							<a href='./logout.php'>Logout</a>
						</li>
					</ul>
				</li>
			</ul>
		</header>
		<section class="layout">
			<?php include("./header_group.php"); ?>
			<section class="main-content">
				<?php
					/* Main Content Starts Here */

					// Need to add a way to verify page url chars
					$p_url = "./pages/group/".$p."/".$p.".php";
					if(file_exists($p_url))
					{
						//include("./includes/classes/dashboard.classes.php");
						include($p_url);
					}
					else
					{

						$p_url = "./pages/group/".$default_template."/".$default_template.".php";
						//echo $p_url;
						include($p_url);
					}
					/* Main Content Ends Here */

				?>

				<a class="exit-offscreen"></a>
			</section>
		</section>
	</div>
	<script src="scripts/app.min.55aed08e.js">
	</script>
	<script src="scripts/offscreen.9fb063df.js">
	</script>
	<script src="scripts/main.eadad6ab.js">
	</script>
	<script src="vendor/chosen_v1.4.0/chosen.jquery.min.js">
	</script>
	<script src="vendor/datatables/media/js/jquery.dataTables.js">
	</script>

	<script src="scripts/bootstrap-datatables.bda62c83.js">
	</script>
	<script src="scripts/datatables.34cf72d5.js">
	</script>
	<script src="scripts/x-editable.0c0355de.js">
	</script>
	<script src="vendor/x-editable/dist/bootstrap3-editable/js/bootstrap-editable.js">
	</script>


</body>
</html>
