<?php
if($server->get('permissions')->functionAccess('new_admin_profile'))
{
  ?>
<div aria-hidden="true" class="modal fade bs-modal-sm_new" role="dialog" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button aria-hidden="true" class="close" data-dismiss="modal" type="button">×</button>
				<h4 class="modal-title">New Administrator Profile</h4>
			</div>
			<div class="modal-body">
          <div class="form-group">
            <label>Name</label>
            <input type="text" class="form-control" id="name" placeholder="Full Username (John_Smith)">
          </div>
          <div class="form-group">
						<label>Admin Level</label>
						<input type="text" class="form-control" id="admin_rank" placeholder="Admin Rank">
					</div>
          <div class="form-group">
						<label>Forum Name</label>
						<input type="text" class="form-control" id="forum_name" placeholder="Forum Username">
					</div>
          <div class="form-group">
						<label>Teamspeak ClientID</label>
						<input type="text" class="form-control" id="teamspeak_id" placeholder="Teamspeak Client ID">
					</div>
          <div class="form-group">
						<label>Recommending Admin</label>
						<input type="text" class="form-control" id="rec_admin" placeholder="Recommending Administrator">
					</div>
          <div class="form-group">
						<label>Past Name(s)</label>
						<textarea class="form-control" id="past_names" placeholder="Past RP Names"></textarea>
					</div>
          <div class="form-group">
						<label>Email Address(es)</label>
						<textarea class="form-control" id="emails" placeholder="Email Address(es)"></textarea>
					</div>
          <div class="form-group">
						<label>Messenger Handle(s)</label>
						<textarea class="form-control" id="handles" placeholder="Skype, Discord, etc"></textarea>
					</div>

          <div class="form-group">
						<label>Security Orientation Date</label>
						<input type="text" class="form-control datepicker" id="orientation" placeholder="MM/DD/YYYY">
					</div>



			</div>
			<div class="modal-footer">
				<button class="btn btn-default" data-dismiss="modal" type="button">Close</button> <button class="btn btn-success" data-dismiss='modal' onclick='saveProfile();'>Save</button>
			</div>
		</div>
	</div>
</div>

<script>
function saveProfile() {

  $.ajax({
    method: 'POST',
    url: './includes/ajax.php',
    data: {method: 'addSecurityProfile', session_id: '<?php echo $_SESSION["session_id"]; ?>', sender: '<?PHP echo $_SESSION["username"]; ?>',
  name: $("#name").val(), forum_name: $("#forum_name").val(), teamspeak_id: $("#teamspeak_id").val(), rec_admin: $("#rec_admin").val(),
past_names: $("#past_names").val(), emails: $("#emails").val(), handles: $("#handles").val(), orientation: $("#orientation").val(), admin_rank: $("#admin_rank").val()},
    success: function(response) {
      //alert(response);
      parent.window.location.reload();
    }
  })
}
</script>
<?php }
if($server->get("permissions")->functionAccess('view_admin_profile'))
{
  ?>
<div aria-hidden="true" class="modal fade bs-modal-sm_view" role="dialog" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button aria-hidden="true" class="close" data-dismiss="modal" type="button">×</button>
				<h4 class="modal-title">View Administrator Profile</h4>
			</div>
			<div class="modal-body" id='profile_info'>




			</div>
			<div class="modal-footer">
				<button class="btn btn-default" data-dismiss="modal" type="button">Close</button>
        <?php
        if($server->get('permissions')->functionAccess('update_admin_profile'))
        {
          ?>
          <button class="btn btn-success" data-dismiss="modal" type="button" onclick="updateProfile();">Update</button>
          <?php
        }
         ?>
			</div>
		</div>
	</div>
</div>

<script>
function viewProfile(id) {

  $.ajax({
    method: 'POST',
    url: './includes/ajax.php',
    data: {method: 'viewSecurityProfile', session_id: '<?php echo $_SESSION["session_id"]; ?>', sender: '<?PHP echo $_SESSION["username"]; ?>',
    id: id, admin_rank: '<?PHP echo $verify_admin_rank; ?>'},
    success: function(response) {
      $('#profile_info').html(response);

    }
  })
}
</script>
<?php } ?>

<?php
if($server->get('permissions')->functionAccess('update_admin_profile'))
{
  ?>
  <script>
  function updateProfile() {

    id = $("#supplement").val();
    $.ajax({
      method: 'POST',
      url: './includes/ajax.php',
      data: {method: 'updateProfile', session_id: '<?php echo $_SESSION["session_id"]; ?>', sender: '<?PHP echo $_SESSION["username"]; ?>',
      id: id, status: $('#status').val(), ar: $("#arank").val()},
      success: function(response) {
        //alert(response);
        parent.window.location.reload();
      }
    })
  }
  </script>
  <?php
} ?>
