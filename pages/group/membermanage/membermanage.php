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
  						<h5>Group Roster</h5>
  					</header>

  					<div class="panel-body">
              <strong><span style='color: red'>***Note***</span> This list only allows you to edit members who are currently OFFLINE.</strong><br /><br />
  					    <?php viewGroupRosterLeader($verify_group_id);
                ?>
            </div>

          </section>


        </div>
      </div>



    </div>
  </div>
</div>
