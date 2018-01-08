<?php
if(!isset($_REQUEST['p']))
{
	header("Location: ../../../index.php?p=dashboard");
}
include($main_directory."includes/classes/dashboard.classes.php");
$server = new Server;
$x = new Demo;
?>

<div class=content-wrap>
	<div class=content-wrap>
		<div class=wrapper>
			<ol class="breadcrumb"> 
				<li> 
					<a href="javascript:;">New Generation Gaming UCP</a> 
				</li> 
				
				<li class="active">PAGE NAME</li> 
			</ol>
			<div class=row>
				<?php echo $v; ?>
				<div class='col-md-12'>
				
					<span class='label label-ea'>Executive Administrators</span><br /><br />
					
						<div class='row'><div class='col-md-3'><section class="widget bg-default"> <div class="widget-body"> <a href="javascript:;" class="pull-left mr15"> <img src="images/avatar.10d02c68.jpg" class="avatar avatar-md img-circle bordered" alt=""> </a> <div class="overflow-hidden"> <div> <b>Matt Honest</b> </div> <small class="show">honest@newgenerationgaming.net</small> <small class="show">Founding Member</small> </div> </div> </section> </div> </div>

					

					<span class='label label-danger'>Head Administrators</span><br /><br />
					
						<div class='row'><div class='col-md-3'><section class="widget bg-default"> <div class="widget-body"> <a href="javascript:;" class="pull-left mr15"> <img src="images/avatar.10d02c68.jpg" class="avatar avatar-md img-circle bordered" alt=""> </a> <div class="overflow-hidden"> <div> <b>Leroy J. Meyers</b> </div> <small class="show">honest@newgenerationgaming.net</small> <small class="show">Founding Member</small> </div> </div> </section> </div> </div>
						
					<span class='label label-senior'>Senior Administrators</span><br /><br />
					
						<div class='row'><div class='col-md-3'><section class="widget bg-default"> <div class="widget-body"> <a href="javascript:;" class="pull-left mr15"> <img src="images/avatar.10d02c68.jpg" class="avatar avatar-md img-circle bordered" alt=""> </a> <div class="overflow-hidden"> <div> <b>Matt Honest</b> </div> <small class="show">honest@newgenerationgaming.net</small> <small class="show">Founding Member</small> </div> </div> </section> </div> </div>

					<span class='label label-success'>General Administrators</span><br /><br />
					
						<div class='row'><div class='col-md-3'><section class="widget bg-default"> <div class="widget-body"> <a href="javascript:;" class="pull-left mr15"> <img src="images/avatar.10d02c68.jpg" class="avatar avatar-md img-circle bordered" alt=""> </a> <div class="overflow-hidden"> <div> <b>Matt Honest</b> </div> <small class="show">honest@newgenerationgaming.net</small> <small class="show">Founding Member</small> </div> </div> </section> </div> </div>

					<span class='label label-success'>Junior Administrators</span><br /><br />
					
						<div class='row'><div class='col-md-3'><section class="widget bg-default"> <div class="widget-body"> <a href="javascript:;" class="pull-left mr15"> <img src="images/avatar.10d02c68.jpg" class="avatar avatar-md img-circle bordered" alt=""> </a> <div class="overflow-hidden"> <div> <b>Matt Honest</b> </div> <small class="show">honest@newgenerationgaming.net</small> <small class="show">Founding Member</small> </div> </div> </section> </div> </div>
				</div>
			</div>
			

		</div>
	</div>
</div>