

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
					<?php returnProfileControls($server->get("permissions")); ?>
				</div>
			</div><br />

			<div class=row>
				<div class='col-md-12'>
          <section class="panel panel-default">
  					<header class="panel-heading">
  						<h5>Administrative Personnel</h5>
  					</header>
  					<div class="panel-body">
  					       <?php
                   if($server->get("permissions")->functionAccess("view_admin_profile"))
                   {
                     listProfiles(1337, $server->get("permissions"));
                     
                   }


                   ?>
            </div>
          </section>


        </div>
      </div>
    </div>
  </div>
</div>

<?php include("./pages/admin/personnel/personnel_js.php"); ?>
