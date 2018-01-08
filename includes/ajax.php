<?php
$p = 'ajax';
include("./init.php");
$method = htmlentities($_POST['method']);
$session_id = htmlentities($_POST['session_id']);
if(!isset($_SESSION['query_cooldown']))
{
  $_SESSION['query_cooldown'] = 0;
}
if($_SESSION['query_cooldown'] <= time())
{
  $timeout = true;
}
if($method == "acceptLeaveAbsence" && $timeout)
{
  $sender = htmlentities($_POST['sender']);
  $sender_obj = new User($odb, $sender);
  $sender_permissions = new Permissions($sender_obj);
  $sess = new Session($odb, $sender);
  $id = htmlentities($_POST['id']);
  $_SESSION['query_cooldown'] = strtotime("2 Seconds");
  if($sess->sessionKeyMatch($session_id))
  {
    if($sender_permissions->functionAccess('loa_mod'))
    {
      $stmt = $odb->prepare("UPDATE `cp_loa` SET `status`=1 WHERE `id`=?");
      $stmt->execute(array($id));
    }
  }
}
if($method == "denyLeaveAbsence" && $timeout)
{
  $sender = htmlentities($_POST['sender']);
  $sender_obj = new User($odb, $sender);
  $sender_permissions = new Permissions($sender_obj);
  $sess = new Session($odb, $sender);
  $id = htmlentities($_POST['id']);
  $_SESSION['query_cooldown'] = strtotime("2 Seconds");
  if($sess->sessionKeyMatch($session_id))
  {
    if($sender_permissions->functionAccess('loa_mod'))
    {
      $stmt = $odb->prepare("UPDATE `cp_loa` SET `status`=2 WHERE `id`=?");
      $stmt->execute(array($id));
    }
  }
}
if($method == 'viewLeaveAbsence' && $timeout)
{
  $sender = htmlentities($_POST['sender']);
  $sender_obj = new User($odb, $sender);
  $sender_permissions = new Permissions($sender_obj);
  $sess = new Session($odb, $sender);
  $id = htmlentities($_POST['id']);
  $_SESSION['query_cooldown'] = strtotime("2 Seconds");
  if($sess->sessionKeyMatch($session_id))
  {
    if($sender_permissions->functionAccess('loa_mod'))
    {
      $stmt = $odb->prepare("SELECT * FROM `cp_loa` WHERE `id`=? LIMIT 1");
      $stmt->execute(array($id));
      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      ?>

      <div class="form-group">
        <label>Details</label>
        <textarea disabled class="form-control"><?php echo $row["details"]; ?></textarea>
      </div>
      <div class="form-group">
      <?php  if($row['status'] == 0) { echo "<button data-dismiss='modal' onclick='acceptRequest(".$row['id'].");' class='btn btn-success'>Approve</button>"; }
        if($row['status'] == 0) { echo " <button data-dismiss='modal' onclick='denyRequest(".$row['id'].");' class='btn btn-danger'>Deny</button>"; } ?>
      </div>






    <?php
    }
  }
}
if($method == "newLeaveOfAbsence" && $timeout)
{
  $sender = htmlentities($_POST['sender']);
  $sender_obj = new User($odb, $sender);
  $sender_permissions = new Permissions($sender_obj);
  $sess = new Session($odb, $sender);
  $_SESSION['query_cooldown'] = strtotime("10 Seconds");

  if($sess->sessionKeyMatch($session_id))
  {
    if($sender_permissions->functionAccess('new_loa'))
    {
        $admin_level = htmlentities($_POST['ar']);
        $advisor_level = htmlentities($_POST['cal']);
        $dept = htmlentities($_POST['dept']);
        $details = htmlentities($_POST['details']);
        $start = htmlentities($_POST['start_date']);
        $end = htmlentities($_POST['end_date']);
        if($dept > 0 && $dept < 6 && $details && $start && $end)
        {
          $stmt = $odb->prepare("INSERT INTO `cp_loa` VALUES(NULL, ?, ?, ?, ?, CURDATE(), ?, ?, ?, ?, ?)");
          $stmt->execute(array($sender_obj->_verified, $admin_level, $advisor_level, $dept, $start, $end, $details, 0, -1));
        }

    }
  }
}
if($method == "updateProfile" && $timeout)
{
  $sender = htmlentities($_POST['sender']);
  $sender_obj = new User($odb, $sender);
  $sender_permissions = new Permissions($sender_obj);
  $sess = new Session($odb, $sender);
  $_SESSION['query_cooldown'] = strtotime("8 Seconds");

  if($sess->sessionKeyMatch($session_id))
  {
    if($sender_permissions->functionAccess('update_admin_profile'))
    {
      $id = htmlentities($_POST['id']);
      $rank = htmlentities($_POST['ar']);
      $status = htmlentities($_POST['status']);
      $stmt = $odb->prepare("UPDATE `cp_security_profiles` SET `admin_rank`=?, `status`=? WHERE `id`=?");
      $stmt->execute(array($rank, $status, $id));
      echo "Successfully Updated";
    }
  }
}
if($method == 'viewSecurityProfile' && $timeout)
{
  $sender = htmlentities($_POST['sender']);
  $sender_obj = new User($odb, $sender);
  $sender_permissions = new Permissions($sender_obj);
  $sess = new Session($odb, $sender);
  $id = htmlentities($_POST['id']);
  $arank = htmlentities($_POST['admin_rank']);
  $_SESSION['query_cooldown'] = strtotime("2 Seconds");
  if($sess->sessionKeyMatch($session_id))
  {

    if($sender_permissions->functionAccess('view_admin_profile'))
    {
      $stmt = $odb->prepare("SELECT * FROM `cp_security_profiles` WHERE `id`=? LIMIT 1");
      $stmt->execute(array($id));
      $query_run = true;




    }
    if($sender_permissions->functionAccess('view_admin_profile_restricted'))
    {
      $stmt = $odb->prepare("SELECT * FROM `cp_security_profiles` WHERE `id`=? AND `admin_rank` <= ? LIMIT 1");
      $stmt->execute(array($id, $arank));
      $query_run = true;

    }
    if(!$query_run)
    {
      echo "Invalid Permisisons";
      return false;
    }
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    ?>
    <input type='hidden' id='supplement' value='<?php echo $row["id"]; ?>'></input>
    <div class="form-group">
      <label>Name</label>
      <input type="text" class="form-control" disabled value='<?php echo idtoname($row["user_id"]); ?>'>
    </div>
    <?php
    if($sender_permissions->functionAccess('update_admin_profile'))
    {
      ?>
      <div class="form-group">
        <label>Admin Level</label>
        <input type="text" id='arank' class="form-control" value='<?php echo $row['admin_rank']; ?>'>
      </div>
      <div class="form-group">
        <label>Status</label>
        <select class='form-control' id='status'>
          <option <?php if($row['status'] == 1) { echo 'selected';} ?> value=1>Active</option>
          <option <?php if($row['status'] == 2) { echo 'selected';} ?> value=2>Retired</option>
          <option <?php if($row['status'] == 3) { echo 'selected';} ?> value=3>Resigned</option>
          <option <?php if($row['status'] == 4) { echo 'selected';} ?> value=4>Terminated</option>
          <option <?php if($row['status'] == 5) { echo 'selected';} ?> value=5>Suspended</option>
          <option <?php if($row['status'] == 6) { echo 'selected';} ?> value=6>Staff Banned</option>
        </select>
      </div>
      <?php

    }
    ?>
    <div class="form-group">
      <label>Forum Name</label>
      <input type="text" class="form-control" disabled value='<?php echo $row['forum_name']; ?>'>
    </div>
    <div class="form-group">
      <label>Teamspeak Client ID</label>
      <textarea class="form-control" disabled><?php echo $row['teamspeak_name']; ?></textarea>
    </div>
    <div class="form-group">
      <label>Recommendations</label>
      <textarea class="form-control" disabled><?php echo $row['recommending_admin']; ?></textarea>
    </div>
    <div class="form-group">
      <label>Previous Name(s)</label>
      <textarea class="form-control" disabled><?php echo $row['rp_names']; ?></textarea>
    </div>
    <div class="form-group">
      <label>Email(s)</label>
      <textarea class="form-control" disabled><?php echo $row['email_addresses']; ?></textarea>
    </div>
    <div class="form-group">
      <label>Messenger Handles</label>
      <textarea class="form-control" disabled><?php echo $row['messenger_handles']; ?></textarea>
    </div>
    <div class="form-group">
      <label>Security Orientation Date</label>
      <input type="text" class="form-control" disabled value='<?php echo $row['security_orientation']; ?>'>
    </div>





    <?php
  }
}
if($method == "addSecurityProfile" && $timeout)
{

  $sender = htmlentities($_POST['sender']);
  $name = htmlentities($_POST['name']);
  $forum_name = htmlentities($_POST['forum_name']);
  $teamspeak_id = htmlentities($_POST['teamspeak_id']);
  $rec_admin = htmlentities($_POST['rec_admin']);
  $past_names = htmlentities($_POST['past_names']);
  $emails = htmlentities($_POST['emails']);
  $handles = htmlentities($_POST['handles']);
  $orientation = htmlentities($_POST['orientation']);
  $sender_obj = new User($odb, $sender);
  $sender_permissions = new Permissions($sender_obj);
  $subject_obj = new User($odb, $name);
  $admin_rank = htmlentities($_POST['admin_rank']);
  $_SESSION['query_cooldown'] = strtotime("10 Seconds");
  if(!$sender_permissions->functionAccess('new_admin_profile'))
  {

    return false;
  }
  $sess = new Session($odb, $sender);
  if($sess->sessionKeyMatch($session_id))
  {

    if($forum_name && $admin_rank && $teamspeak_id && $rec_admin && $past_names && $emails && $handles && $orientation)
    {
      $stmt = $odb->prepare("INSERT INTO `cp_security_profiles` VALUES(NULL, ?, ?, 1, ?, ?, ?, ?, ?, ?, ?, CURDATE())");
      $stmt->execute(array($subject_obj->_verified, $admin_rank, $forum_name, $teamspeak_id, $rec_admin, $past_names, $emails, $handles, $orientation));
      //echo $subject_obj->_verified;
      echo "Security Profile Successfully Added";
    }
  }

}
if($method == "deleteFlag" && $timeout)
{
  $sender = htmlentities($_POST['sender']);
  $sender_obj = new User($odb, $sender);
  $sender_permissions = new Permissions($sender_obj);
  if(!$sender_permissions->functionAccess("delete_flag"))
  {
    return false;
  }
  $sess = new Session($odb, $sender);
  if($sess->sessionKeyMatch($session_id))
  {
    $flagid = htmlentities($_POST['flagid']);
    $stmt = $odb->prepare("DELETE FROM `flags` WHERE `fid`=?");
    $stmt->execute(array($flagid));
  }
}
if($method == "addFlag" && $timeout)
{

  $flagger = htmlentities($_POST['flagger']);

  if(empty($flagger))
  {
    return false;
  }
  $flagger_obj = new User($odb, $flagger);
  $flagger_permissions = new Permissions($flagger_obj);
  if(!$flagger_permissions->functionAccess("add_flag"))
  {
    return false;
  }
  $sess = new Session($odb, $flagger);
  if($sess->sessionKeyMatch($session_id))
  {

    $flagged = htmlentities($_POST['flagged']);
    $flagged_object = new User($odb, $flagged);


    $type = htmlentities($_POST['type']);
    $text = htmlentities($_POST['text']);
    if(!empty($type) && !empty($text) && !empty($flagged))
    {
      $stmt = $odb->prepare("INSERT INTO `flags` VALUES(NULL, ?, NOW(), ?, ?, ?)");
      $stmt->execute(array($flagged_object->_verified, $flagger, $text, $type));
      echo "Flag Successfully Added to User";
    }

  }
}
if($method == "addPunishment" && $timeout)
{

  $punisher = htmlentities($_POST['punisher']);
  $sess = new Session($odb, $punisher);
  $_SESSION['query_cooldown'] = strtotime("10 Seconds");
  if($sess->sessionKeyMatch($session_id))
  {

    $punished = htmlentities($_POST['punished']);
    $punisher_object = new User($odb, $punisher);
    $punished_object = new User($odb, $punished);
    $punisher_permissions = new Permissions($punisher_object);
    if(!$punisher_permissions->permissionCheck("cp_admin") && !$punisher_permissions->permissionCheck("C_ALL"))
    {

      return false;
    }
    $prison = htmlentities($_POST['prison']);
    $warning = htmlentities($_POST['warning']);
    $fine = htmlentities($_POST['fine']);
    $ban = htmlentities($_POST['ban']);
    $link = htmlentities($_POST['link']);
    $reason = htmlentities($_POST['reason']);
    $details = htmlentities($_POST['details']);
    $punishment = new Punishment($punished_object, $punisher_object, $link);
    if(!empty($prison))
    {
      $punishment->jail($prison, $reason, $details);
    }
    if($warning == "true")
    {

      $punishment->warn($reason, $details);
    }
    if(!empty($fine))
    {

      $punishment->fine($fine, $reason, $details);
    }
    if(!empty($ban))
    {
      $punishment->ban($ban, $reason, $details);
    }

    $punishment->execute();
    echo "Punishment Added To Database";


  }


}

 ?>
