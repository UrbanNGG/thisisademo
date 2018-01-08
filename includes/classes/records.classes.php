<?php
function showRecordsButtons()
{
  $server = $GLOBALS['server'];
  if($server->get('permissions')->functionAccess('add_punishment'))
  {
    ?>
    <button class="btn btn-primary" id='punishment_button' data-toggle="modal" data-target=".bs-modal-sm">Add Punishment</button>
    <?php
  }
  if($server->get('permissions')->functionAccess('add_flag'))
  {
    ?>
    <button class="btn btn-primary" id='flag_button' data-toggle="modal" data-target=".bs-modal-sm_new">Add Flag</button>
    <?php
  }
}
function showPlayerFlags($id)
{

  if($id)
  {
    ?>
    <table class='table table-striped no-m'>
      <thead>
        <tr>
          <td>Flag ID</td>
          <td>Added By</td>
          <td>Date Added</td>
          <td>Flag Type</td>
          <td>Flag Details</td>
          <td>Flag Actions</td>

        </tr>
      </thead>
      <tbody>
        <?php
        $db = $GLOBALS['odb'];
        $stmt = $db->prepare("SELECT * FROM `flags` WHERE `id`=?");
        $stmt->execute(array($id));
        while($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
          $row_key = '#row'.$row['fid'];
          ?>

            <tr id='row<?php echo $row["fid"]; ?>'>
              <td><?php echo $row['fid']; ?></td>
              <td><?php echo $row['issuer']; ?></td>
              <td><?php echo $row['time']; ?></td>
              <td><?php if($row['type'] == 1) { echo "Regular"; } if($row['type'] == 2) { echo "Admin"; } ?></td>
              <td><a href='#' onclick=''><?php echo $row['flag']; ?></a></td>
              <td>
                <?php
                if($GLOBALS['server']->get('permissions')->functionAccess('delete_flag')) {
                 ?>
                <button class='btn btn-danger' onclick="deleteFlag(<?php echo $row['fid']; ?>);">Delete Flag</button>
              <?php } ?>
              </td>
            </tr>

          <?php
        }
        ?>
      </tbody>
    </table>
    <?php
  }
}
function showPunishmentRecords($id)
{

  if($id)
  {
    ?>
    <table class='table table-striped no-m'>
      <thead>
        <tr>
          <td>Date Added</td>
          <td>Added By</td>
          <td>Status</td>
          <td>Punishment</td>
          <td>Reason</td>
          <td>Other Details</td>
          <td>Forum Thread</td>
          <td>Issued By</td>
          <td>Date Issued</td>
        </tr>
      </thead>
      <tbody>
    <?php
    $db = $GLOBALS['odb'];
    $stmt = $db->prepare("SELECT * FROM `cp_punishment` WHERE `player_id`=?");
    $stmt->execute(array($id));
    while($row = $stmt->fetch(PDO::FETCH_ASSOC))
    {
      $punishment = '';
      if($row['prison'])
      {
        $punishment .= 'Prison ';
      }
      if($row['warn'])
      {
        $punishment .= 'Warning ';
      }
      if($row['fine'])
      {
        $punishment .= 'Fine ';
      }
      if($row['ban'])
      {
        $punishment .= 'Ban ';
      }
      if($row['wep_restrict'])
      {
        $punishment .= 'Wep. Restriction ';
      }
      ?>

        <tr>
          <td><?php echo $row['date_added']; ?></td>
          <td><?php echo idtoname($row['addedby_id']); ?></td>
          <td><?php echo $row['status'] ? "ISSUED" : "NOT ISSUED"; ?></td>
          <td>
            <?php
              echo $punishment;
             ?>
          </td>
          <td><a href='#' onclick="alert('<?php echo $row['reason']; ?>');">VIEW</a></td>
          <td><a href='#' onclick="alert('<?php echo $row['other_punish']; ?>');">VIEW</a></td>
          <td><a href='<?php echo $row['link'] ?>'>COMPLAINT LINK</a></td>
          <td><?php echo idtoname($row['issuedby_id']); ?></td>
          <td><?php echo $row['date_issued']; ?></td>
        </tr>


      <?php

    }

    ?>
  </tbody>
</table><?php
  }
}

 ?>
