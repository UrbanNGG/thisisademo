<?php
if($server->get('permissions')->functionAccess('add_flag'))
{
?>
<div aria-hidden="true" class="modal fade bs-modal-sm_new" role="dialog" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button aria-hidden="true" class="close" data-dismiss="modal" type="button">×</button>
				<h4 class="modal-title">Add Flag to <?php echo idtoname($profile->returnInfo('id')); ?></h4>
			</div>
			<div class="modal-body">
					<div class="form-group">
						<label>Flag Text</label>
						<input type="text" class="form-control" id="flag_text" placeholder="Flag details">
					</div>
          <div class="form-group">
						<label>Type</label>

            <select class='form-control' id='type'>
              <option value=2>Admin</option>
              <option value=1 selected>Regular</option>
            </select>
					</div>

			</div>
			<div class="modal-footer">
				<button class="btn btn-default" data-dismiss="modal" type="button">Close</button> <button class="btn btn-success" data-dismiss='modal' onclick='saveFlag();'>Save</button>
			</div>
		</div>
	</div>
</div>
<?php
}
if($server->get('permissions')->functionAccess('add_punishment')) {
?>
<div aria-hidden="true" class="modal fade bs-modal-sm" role="dialog" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button aria-hidden="true" class="close" data-dismiss="modal" type="button">×</button>
				<h4 class="modal-title">Add Punishment to <?php echo idtoname($profile->returnInfo('id')); ?></h4>
			</div>
			<div class="modal-body">
					<div class="form-group">
						<label for="exampleInputEmail1">Prison Duration</label>
						<input type="text" class="form-control" id="prison" placeholder="Duration for prison in minutes">
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Administer Warning</label>
						<input type="checkbox" value='warning' id="warning" >
					</div>
					<div class="form-group">

						<label for="exampleInputEmail1">Fine</label>


						<input type="text" class='form-control' id="fine" placeholder="Amount fined from player's account">

					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Ban</label>
						<input type="text" class='form-control' id="ban" placeholder="Ban duration in days">
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Forum Complaint Link</label>
						<input type="text" class='form-control' id="link" placeholder="Link to forum complaint that warrants punishment">
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Reason</label>
						<input type="text" class='form-control' id="reason" placeholder="Punishment reason / broken rule">
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Extra Details</label>
						<textarea id='details' class='form-control' placeholder="Additional details"></textarea>
					</div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-default" data-dismiss="modal" type="button">Close</button> <button class="btn btn-success" data-dismiss='modal' onclick='savePunishment("<?php echo htmlentities($_POST['field']); ?>", "<?php echo $_SESSION['username']; ?>");' type="button">Save</button>
			</div>
		</div>
	</div>
</div>
<?php } ?>
<script>
function deleteFlag(id)
{
  $.ajax({
    method: 'POST',
    url: './includes/ajax.php',
    data: {method: 'deleteFlag', session_id: '<?php echo $_SESSION["session_id"]; ?>', flagid: id, sender: '<?php echo $_SESSION["username"]; ?>'},
    success: function(response) {
      parent.window.location.reload();
    }
  })
  $('#row'+id).hide()
}
function saveFlag()
{
  flagged = "<?php echo htmlentities($_POST['field']); ?>";
  flagger = "<?php echo $_SESSION['username'] ?>";
	$.ajax({
		method: 'POST',
		url: './includes/ajax.php',
		data: {method: 'addFlag', session_id: '<?php echo $_SESSION["session_id"]; ?>', text: $("#flag_text").val(), type: $('#type').val(),
  flagged: flagged, flagger: flagger},
		success: function(response) {
			//alert(response);

			$('#flag_text').val('');
			$('#type').val('');

			parent.window.location.reload();
		}

	})
}
function savePunishment(punished, punisher)
{
		$.ajax({
			method: 'POST',
			url: './includes/ajax.php',
			data: {method: 'addPunishment', punished: punished, punisher: punisher, prison: $('#prison').val(), warning: $('#warning').is(":checked"),
		fine: $('#fine').val(), ban: $('#ban').val(), link: $('#link').val(), reason: $('#reason').val(), details: $('#details').val(),
		session_id: '<?php echo $_SESSION["session_id"]; ?>'},
			success: function(response) {
				//alert(response);


				parent.window.location.reload();

			}

		})

}
</script>
