<?php
function returnProfileControls(Permissions $perms)
{
  if($perms->functionAccess('new_admin_profile'))
  {
    echo '<button class="btn btn-primary" data-toggle="modal" data-target=".bs-modal-sm_new">New Security Profile</button>';
  }
}
function returnAdminRank($rank)
{
  if($rank == 1) { return "<span class='label label-warning'>Server Moderator</span>"; }
  if($rank == 2) { return "<span class='label label-success'>Junior Administrator</span>"; }
  if($rank == 3) { return "<span class='label label-success'>General Administrator</span>"; }
  if($rank == 4) { return "<span class='label label-senior'>Senior Administrator</span>"; }
  if($rank == 1337) { return "<span class='label label-danger'>Head Administrator</span>"; }
  if($rank == 1338) { return "<span class='label label-ea'>Lead Head Administrator</span>"; }
  if($rank == 99999) { return "<span class='label label-ea'>Executive Administrator</span>"; }

}
function listProfiles($maxrank = 4, Permissions $perms)
{
  ?>
  <table class='table table-striped datatable'>
    <thead>
      <tr>
        <td>Administrator</td>
        <td>Rank</td>
        <td>Status</td>
        <td>Options</td>
      </tr>
    </thead>
    <tbody>
  <?php
  $db = $GLOBALS['odb'];
  $stmt = $db->prepare("SELECT * FROM `cp_security_profiles` WHERE `admin_rank` <= ?");
  $stmt->execute(array($maxrank));
  while($row = $stmt->fetch(PDO::FETCH_ASSOC))
  {
    ?>
    <tr>
      <td><?php echo idtoname($row['user_id']); ?></td>
      <td><?php echo returnAdminRank($row['admin_rank']); ?></td>
      <td>
        <?php
        if($row['status'] == 1) {echo "<span class='label label-success'>Active</span>"; }
        if($row['status'] == 2) {echo "<span class='label label-ea'>Retired</span>"; }
        if($row['status'] == 3) {echo "<span class='label label-primary'>Resigned</span>"; }
        if($row['status'] == 4) {echo "<span class='label label-danger'>Terminated</span>"; }
        if($row['status'] == 5) {echo "<span class='label label-warning'>Suspended</span>"; }
        if($row['status'] == 6) {echo "<span class='label label-danger'>Staff Banned</span>"; }
         ?>
      </td>
      <td><?php if($perms->functionAccess('view_admin_profile')) { echo '<button class="btn btn-primary" data-toggle="modal" data-target=".bs-modal-sm_view" onclick="viewProfile('.$row['id'].');">View Profile</button>'; } ?></td>
    </tr>
    <?php
  }
  ?>
  </tbody>
  </table>
  <?php
}
class AdministratorProfile extends User
{
  protected $user;
  public function __construct(User $user)
  {
    $this->_user = $user;
  }

}








 ?>
