<?php
if(!isset($_REQUEST['p']))
{
	header("Location: ../../../index.php?p=dashboard");
}

$pageName = "Dashboard";
$search_user = new User($odb, htmlentities($_POST['field']));

$profile = new Profile($search_user);
$inventory = new Inventory($search_user);
$search_group = new Group($odb, $inventory->returnInventory('Member'));

if(!$profile->returnInfo('Online') && $search_user->_verified && $server->get('session')->sessionKeyMatch( htmlentities($_POST['v']) ))
{


?>
<div class=content-wrap>
	<div class=content-wrap>
		<div class=wrapper>
			<ol class="breadcrumb">
				<li>
					<a href="javascript:;">New Generation Gaming UCP</a>
				</li>

				<li class="active"><?php echo $server->get('page')->pageTitle(); ?></li>
			</ol>
			<div class='row'>
				<div class='col-md-3'>
					<?php showRecordsButtons(); ?>
				</div>
			</div><br />
			<?php showStats($search_user, $profile, $inventory, $search_group); ?>
			<div class=row>
				<div class='col-md-12'>
					<section class="panel panel-default">
					<header class="panel-heading">
						<h5>Owned Vehicles</h5>
					</header>
					<div class="panel-body">
						<?php echo showVehicles($profile->returnInfo('id')); ?>

					</div>

					</section>

					<?php


					?>
				</div>
			</div>
			<div class=row>
				<div class='col-md-12'>
					<section class="panel panel-default">
					<header class="panel-heading">
						<h5>Player Flags</h5>
					</header>
					<div class="panel-body">
						<?php showPlayerFlags($profile->returnInfo('id')); ?>

					</div>

					</section>
				</div>
			</div>
			<div class=row>
				<div class='col-md-12'>
					<section class="panel panel-default">
					<header class="panel-heading">
						<h5>Punishments</h5>
					</header>
					<div class="panel-body">
						<?php showPunishmentRecords($profile->returnInfo('id')); ?>

					</div>

					</section>
				</div>
			</div>



		</div>
	</div>
</div>

<?php
}
include("./pages/admin/records/records_js.php");
?>
