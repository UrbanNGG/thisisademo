<?php

$p = 'login';
include("./includes/init.php");

if(isset($_SESSION['session_id']) && isset($_SESSION['username']))
{
  header("Location: ./index.php?p=dashboard");
}


$username = !empty($_POST['username']) ? htmlentities($_POST['username']) : '';
$password = !empty($_POST['password']) ? htmlentities($_POST['password']) : '';
$button = !empty($_POST['btn-login']) ? htmlentities($_POST['btn-login']) : '';

if($username && $password && $button)
{
  $login_user = new User($odb, $username);
  if($login_user->login($password)) {
    $x = new Session($odb, $username);
    if($x->session_exists)
    {
      $x->destroy_session();
      $x->new_session();
      header("Location: ./index.php?p=dashboard");
    }
    else {
      $x->new_session();
      header("Location: ./index.php?p=dashboard");

    }
  }


}
else if($button && (empty($username) || empty($password)))
{
	header("Location: ./login.php?error=1");
}

?>
<!DOCTYPE html>


<html class="signup no-js">
<!-- Mirrored from sublime.nyasha.me/admin/signup.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 30 Dec 2017 19:53:48 GMT -->
<head>
	<meta charset="utf-8">
	<meta content="Flat, Clean, Responsive, application admin template built with bootstrap 3" name="description">
	<meta content="width=device-width,user-scalable=no,initial-scale=1,maximum-scale=1" name="viewport">
	<title>New Generation Gaming</title>
	<script src="../cdn-cgi/apps/head/OD5ndB08NwL1oUgIYmaZ8k2oR2M.js">
	</script>
	<link href="styles/app.min.1f20ae203.css" rel="stylesheet"><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	<script src="vendor/modernizr.js">
	</script>
</head>
<body class="bg-info">
	<div class="center-wrapper">
		<div class="center-content">
			<div class="row no-m">
				<div class="col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
					<section class="panel bg-white no-b">
						<ul class="switcher-dash-action">
							<li class="active">
								<a class="selected" href="login.php">Sign in <?PHp echo $pee; ?></a>
							</li>

						</ul>
						<div class="p15">
							<form action="./login.php" method='POST' role="form">
								<?php
								if($error == "1")
								{
									?>
									<div class="alert alert-danger">
										<strong>Error!</strong>&nbsp;Please enter both a username AND a password.
									</div>
									<?php
								}
								if($error == "2")
								{
									?>
									<div class="alert alert-danger">
										<strong>Error!</strong>&nbsp;Incorrect username and/or password.
									</div>
									<?php
								}
								if($error == "3")
								{
									?>
									<div class="alert alert-danger">
										<strong>Error!</strong>&nbsp;This account is banned. Please submit a ban appeal on our forums.
									</div>
									<?php
								}
								if($error == "4")
								{
									?>
									<div class="alert alert-danger">
										<strong>Error!</strong>&nbsp;The UCP is unavailable while you are logged into the SA-MP server. Please logout and try again.
									</div>
									<?php
								}
								?>
								<input autofocus="" name='username' class="form-control input-lg mb25" placeholder="Username">

								<input class="form-control input-lg mb25" name='password' placeholder="Password" type="password">


								<input class="btn btn-primary btn-lg btn-block" name='btn-login' type="submit" value='Sign In'></button>
							</form>
						</div>
					</section>
					<p class="text-center">Copyright &copy; <span class="mr5" id="year"></span> <span>New Generation Gaming, LLC</span></p>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
	var el = document.getElementById("year"),
	     year = (new Date().getFullYear());
	   el.innerHTML = year;
	</script>
</body>
</html>
<script src=scripts/app.min.55aed08e.js></script>
<script src=scripts/offscreen.9fb063df.js></script>
<script src=scripts/main.eadad6ab.js></script>

<script src="vendor/chosen_v1.4.0/chosen.jquery.min.js">
<?php


?>
