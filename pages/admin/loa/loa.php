

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
  						<h5>My Leave of Absence History</h5>
  					</header>
  					<div class="panel-body">
  					    <?php viewMyLOA($server->get('user_init')->_verified); ?>
            </div>

          </section>


        </div>
      </div>
			<div class=row>
				<div class='col-md-12'>
          <section class="panel panel-default">
  					<header class="panel-heading">
  						<h5>New Leave of Absence Request</h5>
  					</header>
  					<div class="panel-body">
  					    <?php newLeaveOfAbsenceForm(); ?>
            </div>
            <div class='panel-footer'>
              <button class='btn btn-primary' onclick="submitNewRequest();">Submit Request</button>
            </div>
          </section>


        </div>
      </div>
      <?php
      displayLOAModTools();
      ?>


    </div>
  </div>
</div>

<?php include("./pages/admin/loa/loa_js.php"); ?>
