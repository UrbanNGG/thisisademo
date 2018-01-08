<?php
function viewGroupRosterLeader($id)
{
  $db = $GLOBALS['odb'];
  $group = new Group($db, $id);
  $stmt = $db->prepare("SELECT `Username`, `Division`, `LastLogin`, `Rank` FROM `accounts` WHERE `Member`=? AND `Online`=0 ORDER BY `Rank` DESC");
  $stmt->execute(array($id));
  $granks = $group->Ranks();
  $gdivs = $group->Divisions();
  ?>
  <table class='table table-striped datatable'>
    <thead>
      <tr>
        <td>Name</td>
        <td>Rank</td>
        <td>Division</td>
        <td>Last Active</td>
        <td>Tools</td>
      </tr>
    </thead>
    <tbody>
      <?php
      while($row = $stmt->fetch(PDO::FETCH_ASSOC))
      {
        ?>
        <tr>
          <td><?php echo $row['Username']; ?></td>
          <td><?php echo $granks['Rank'.$row['Rank']]; ?></td>
          <td><?php echo $gdivs['Div'.$row['Division']]; ?></td>
          <td><?php echo $row['LastLogin']; ?></td>
          <td>Promote, Demote, Kick</td>
        </tr>
        <?php
      }
      ?>
    </tbody>
  </table>
  <?php
}
function viewGroupRoster($id)
{
  $db = $GLOBALS['odb'];
  $group = new Group($db, $id);
  $stmt = $db->prepare("SELECT `Username`, `Division`, `Online`, `LastLogin`, `Rank` FROM `accounts` WHERE `Member`=? ORDER BY `Rank` DESC");
  $stmt->execute(array($id));
  $granks = $group->Ranks();
  $gdivs = $group->Divisions();
  ?>
  <table class='table table-striped datatable'>
    <thead>
      <tr>
        <td>Name</td>
        <td>Rank</td>
        <td>Divison</td>
        <td>Last Active</td>
        <td>Online</td>
      </tr>
    </thead>
    <tbody>
      <?php
      while($row = $stmt->fetch(PDO::FETCH_ASSOC))
      {
        ?>
        <tr>
          <td><?php echo $row['Username']; ?></td>
          <td><?php echo $granks['Rank'.$row['Rank']]; ?></td>
          <td><?php echo $gdivs['Div'.$row['Division']]; ?></td>
          <td><?php echo $row['LastLogin']; ?></td>
          <td><?php echo $row['Online'] ? "<span class='label label-success'>Online</span>" : "<span class='label label-danger'>Offline</span>" ?></td>
        </tr>
        <?php
      }
      ?>
    </tbody>
  </table>
  <?php
}


?>
