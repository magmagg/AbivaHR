<div class="modal fade" id="myModal_edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Edit team name</h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" role="form" method="POST" action="<?php echo base_url();?>Admin/submit_edit_teamname">
					<!-- IMPORTANT LINE OF CODE!!! -->
					<input type="hidden" name="id">
					<!-- IMPORTANT LINE OF CODE!!! -->
					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Team name</label>

						<div class="col-sm-9">
							<input type="text" name="updatename" class="col-xs-10 col-sm-5" />
						</div>
					</div>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="submit" id="post_button" class="btn btn-primary">Save</button>
			</div>
			</form>
		</div>
	</div>
</div>
