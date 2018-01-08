<?php
if($server->get('permissions')->functionAccess('new_loa'))
{
  ?>
  <script>
  function submitNewRequest()
  {
    $.ajax({
      method: "POST",
      url: './includes/ajax.php',
      data: {method: 'newLeaveOfAbsence', session_id: '<?php echo $_SESSION["session_id"]; ?>', sender: '<?PHP echo $_SESSION["username"]; ?>',
      details: $("#details").val(), start_date: $("#start_date").val(), end_date: $("#end_date").val(), dept: $("#department").val(),
      ar: <?php echo $verify_admin_rank; ?>, cal: <?php echo $verify_advisor_rank; ?>},
      success: function(response) {
        parent.window.location.reload();
      }
    })
  }
  </script>

  <?php
}
if($GLOBALS['server']->get('permissions')->functionAccess('loa_mod'))
{
  ?>
  <div aria-hidden="true" class="modal fade bs-modal-sm_view" role="dialog" tabindex="-1">
  	<div class="modal-dialog">
  		<div class="modal-content">
  			<div class="modal-header">
  				<button aria-hidden="true" class="close" data-dismiss="modal" type="button">×</button>
  				<h4 class="modal-title">View Leave of Absence Request</h4>
  			</div>
  			<div class="modal-body" id='request_info'>




  			</div>
  			<div class="modal-footer">
  				<button class="btn btn-default" data-dismiss="modal" type="button">Close</button>

  			</div>
  		</div>
  	</div>
  </div>
  <script>
  function viewRequest(id)
  {
    $.ajax({
      method: "POST",
      url: './includes/ajax.php',
      data: {method: 'viewLeaveAbsence', session_id: '<?php echo $_SESSION["session_id"]; ?>', sender: '<?PHP echo $_SESSION["username"]; ?>',
      id: id},
      success: function(response) {
        $("#request_info").html(response);
        //parent.window.location.reload();
      }
    })
  }
  function acceptRequest(id)
  {
    $.ajax({
      method: "POST",
      url: './includes/ajax.php',
      data: {method: 'acceptLeaveAbsence', session_id: '<?php echo $_SESSION["session_id"]; ?>', sender: '<?PHP echo $_SESSION["username"]; ?>',
      id: id},
      success: function(response) {
        //$("#request_info").html(response);
        parent.window.location.reload();
      }
    })
  }
  function denyRequest(id)
  {
    $.ajax({
      method: "POST",
      url: './includes/ajax.php',
      data: {method: 'denyLeaveAbsence', session_id: '<?php echo $_SESSION["session_id"]; ?>', sender: '<?PHP echo $_SESSION["username"]; ?>',
      id: id},
      success: function(response) {
        //$("#request_info").html(response);
        parent.window.location.reload();
      }
    })
  }
  </script>
  <?php
}




?>
