<?php

function returnAdvisorRank($rank)
{
  if($rank == 1) { return "<span class='label label-primary'>Community Helper</span>"; }
  if($rank == 2) { return "<span class='label label-primary'>Community Advisor</span>"; }
  if($rank == 3) { return "<span class='label label-primary'>Senior Community Advisor</span>"; }
  if($rank == 4) { return "<span class='label label-primary'>Chief Community Advisor</span>"; }

}
function displayAllLOA($togalloff = 0)
{
  $db = $GLOBALS['odb'];
  if($togalloff) {
    $stmt = $db->query("SELECT * FROM `cp_loa` WHERE `status`=0");
  }
  if(!$togalloff) {
    $stmt = $db->query("SELECT * FROM `cp_loa` ORDER BY `status` ASC");
  }

  ?>
  <table class='table table-striped datatable'>
    <thead>
      <tr>
        <td>Name</td>
        <td>Date Filed</td>
        <td>Staff Rank</td>
        <td>Department</td>
        <td>Status</td>
        <td>Reviewed By</td>
        <td>Time Frame</td>
        <td>Actions</td>
      </tr>
    </thead>
    <tbody>
  <?php
  while($row = $stmt->fetch(PDO::FETCH_ASSOC))
  {
    ?>
    <tr>
      <td><?php echo idtoname($row['staff_id']); ?></td>
      <td><?php echo $row['date_filed']; ?></td>
      <td>
        <?php
        if($row['admin_rank'] >= 2 && $row['advisor_rank'] == 0) {echo returnAdminRank($row['admin_rank']); }
        if($row['admin_rank'] == 0 && $row['advisor_rank'] > 0) {echo returnAdvisorRank($row['advisor_rank']); }


         ?>
      </td>
      <td>
        <?php
        if($row['secondary_task'] == 1) {echo "General Duties"; }
        if($row['secondary_task'] == 2) {echo "Game Affairs"; }
        if($row['secondary_task'] == 3) {echo "Public Relations"; }
        if($row['secondary_task'] == 4) {echo "Information Technology"; }
        if($row['secondary_task'] == 5) {echo "Admin Personnel"; }


         ?>
      </td>
      <td>
        <?php
        if($row['status'] == 0) {echo "<span class='label label-warning'>Pending</span>"; }
        if($row['status'] == 1) {echo "<span class='label label-success'>Accepted</span>"; }
        if($row['status'] == 2) {echo "<span class='label label-danger'>Denied</span>"; }

         ?>
      </td>
      <td><?php echo idtoname($row['modified_by']) ? idtoname($row['modified_by']) : "N/A"; ?></td>
      <td>Starting: <?php echo $row['date_start']." Ending: ".$row['date_end']; ?></td>
      <td>
        <button class='btn btn-primary' data-toggle="modal" data-target=".bs-modal-sm_view" onclick='viewRequest(<?php echo $row["id"]; ?>);'>View</button>

      </td>
    </tr>
    <?php
  }
  ?>
  </tbody>
  </table>
  <?php
}
function displayLOAModTools()
{
  if($GLOBALS['server']->get('permissions')->functionAccess('loa_mod'))
  {

  ?>
  <div class=row>
    <div class='col-md-12'>
      <section class="panel panel-default">
        <header class="panel-heading">
          <h5>Leave of Absence Requests</h5>
        </header>
        <div class="panel-body">

            <div id='display'><?php displayAllLOA(); ?></div>
        </div>

      </section>


    </div>
  </div>
  <?php
  }
}
function viewMyLOA($id)
{
  $db = $GLOBALS['odb'];
  $stmt = $db->prepare("SELECT * FROM `cp_loa` WHERE `staff_id`=?");
  $stmt->execute(array($id));
  ?>
  <table class='table table-striped datatable'>
    <thead>
      <tr>
        <td>Date Filed</td>
        <td>Status</td>
        <td>Reviewed By</td>
        <td>Time Frame</td>
      </tr>
    </thead>
    <tbody>
  <?php
  while($row = $stmt->fetch(PDO::FETCH_ASSOC))
  {
    ?>
    <tr>
      <td><?php echo $row['date_filed']; ?></td>
      <td>
        <?php
        if($row['status'] == 0) {echo "<span class='label label-warning'>Pending</span>"; }
        if($row['status'] == 1) {echo "<span class='label label-success'>Accepted</span>"; }
        if($row['status'] == 2) {echo "<span class='label label-danger'>Denied</span>"; }

         ?>
      </td>
      <td><?php echo idtoname($row['modified_by']) ? idtoname($row['modified_by']) : "N/A"; ?></td>
      <td>Starting: <?php echo $row['date_start']." Ending: ".$row['date_end']; ?></td>
    </tr>
    <?php
  }
  ?>
  </tbody>
  </table>
  <?php
}
function newLeaveOfAbsenceForm()
{
  ?>
  <div class="form-group">
    <label>Department</label>
    <select class='form-control' id='department'>
      <option value='1'>General Administrative Duties (No Department)</option>
      <option value='2'>Department of Game Affairs</option>
      <option value='3'>Department of Public Relations</option>
      <option value='4'>Department of Information Technology</option>
      <option value='5'>Department of Administrative Personnel</option>
    </select>
  </div>
  <div class="form-group">
    <label>Details</label>
    <textarea class="form-control" id="details" placeholder="Explain why you're requesting a leave of absence."></textarea>
  </div>
  <div class="form-group">
    <label>Leave Start Date</label>
    <input type="text" class="form-control datepicker" id="start_date" placeholder="MM/DD/YYYY">
  </div>
  <div class="form-group">
    <label>Leave Return Date</label>
    <input type="text" class="form-control datepicker" id="end_date" placeholder="MM/DD/YYYY">
  </div>

  <?php




}









?>
