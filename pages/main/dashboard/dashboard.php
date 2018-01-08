<?php
if(!isset($_REQUEST['p']))
{
	header("Location: ../../../index.php?p=dashboard");
}
$pageName = "Dashboard";
$server->set('user_inventory', new Inventory($server->get("user_init")));
$server->set('group', new Group($odb, $server->get('user_inventory')->returnInventory('Member')));

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

			<div class=row>
				<div class='col-md-12'>
					<section class="panel panel-default">
					<header class="panel-heading">
						<h5>Account Overview</h5>
					</header>
					<div class="panel-body">

						<table class='table table-striped no-m'>
							<tr>
								<td><b>Email:</b> <?php echo $server->get('user_inventory')->returnInventory('Email') ? $server->get('user_inventory')->returnInventory('Email') : 'N/A'; ?></td>
								<td><b>Last Active:</b> <?php echo $server->get('user_inventory')->returnInventory('LastLogin'); ?></td>
								<td><b>Last Logged IP:</b> <?php echo $server->get('user_inventory')->returnInventory('IP'); ?></td>
								<td><b>Report Mutes:</b> <?php echo $server->get('user_inventory')->returnInventory('ReportMutedTotal'); ?></td>
							</tr>
							<tr>
								<td><b>Group:</b> <?php echo $server->get('group')->Info()['Name'] ? $server->get('group')->Info()['Name'] : 'N/A'; ?></td>
								<td><b>Rank:</b> <?php echo $server->get('group')->Ranks()['Rank'.$server->get('user_inventory')->returnInventory('Rank')] ? $server->get('group')->Ranks()['Rank'.$server->get('user_inventory')->returnInventory('Rank')] : 'N/A'; ?></td>
								<td><b>Division:</b> <?php echo $server->get('group')->Divisions()['Div'.$server->get('user_inventory')->returnInventory('Division')] ? $server->get('group')->Divisions()['Div'.$server->get('user_inventory')->returnInventory('Division')] : 'N/A'; ?></td>
								<td><b>Report Mutes:</b> X.X.X.X</td>
							</tr>
						</table>
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
						<h5>Character Stats</h5>
					</header>
					<div class="panel-body">

						<table class='table table-striped no-m'>
							<tr>
								<td><b>Level:</b> <?php echo $server->get('user_inventory')->returnInventory('Level'); ?></td>
								<td><b>Playing Hours:</b> <?php echo $server->get('user_inventory')->returnInventory('ConnectedTime'); ?></td>
								<td><b>Age:</b> <?php echo $server->get('user_inventory')->returnInventory('Age'); ?></td>
								<td><b>Gender:</b> <?php echo $server->get('user_inventory')->returnInventory('Gender'); ?></td>
							</tr>
							<tr>
								<td><b>Total Wealth:</b> $<?php echo number_format($server->get('user_inventory')->returnInventory('Bank') + $server->get('user_inventory')->returnInventory('Money')); ?></td>
								<td><b>Money (On-Hand):</b> $<?php echo number_format($server->get('user_inventory')->returnInventory('Money')); ?></td>
								<td><b>Money (Bank):</b> $<?php echo number_format($server->get('user_inventory')->returnInventory('Bank')); ?></td>
								<td><b>Materials:</b> <?php echo $server->get('user_inventory')->returnInventory('Materials'); ?></td>
							</tr>
							<tr>
								<td><b>Crack:</b> <?php echo $server->get('user_inventory')->returnInventory('Crack'); ?></td>
								<td><b>Pot:</b> <?php echo $server->get('user_inventory')->returnInventory('Pot'); ?></td>
								<td><b>Meth:</b> <?php echo $server->get('user_inventory')->returnInventory('Meth'); ?></td>
								<td><b>Radio Frequency:</b> #<?php echo $server->get('user_inventory')->returnInventory('RadioFreq'); ?></td>
							</tr>
							<tr>
								<td><b>VIP Rank:</b> XX</td>
								<td><b>Crimes:</b> XX</td>
								<td><b>Arrests:</b> XX</td>
								<td><b>Weapon Restriction:</b> <a href='#' id='peen' data-type="select" data-pk="1" data-url="./includes/ajax.php" data-title="Enter username">ff</a></td>
							</tr>
							<tr>
								<td><b>Warnings:</b> XX</td>
								<td><b>Newbie Mutes:</b> XX</td>
								<td><b>Advertisement Mutes:</b> XX</td>
								<td><b>Report Mutes:</b> XX</td>
							</tr>

						</table>
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
						<h5>Owned Vehicles</h5>
					</header>
					<div class="panel-body">
						<?php echo showVehicles($server->get('user_profile')->returnInfo('id')); ?>

					</div>

					</section>

					<?php


					?>
				</div>
			</div>


		</div>
	</div>
</div>
