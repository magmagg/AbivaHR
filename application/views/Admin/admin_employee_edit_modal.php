<!-- Modal -->
<?php foreach($employee as $e)
{
	$department = $e->department_name;
}
?>
<div class="modal fade" id="myModal_edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Edit Employee</h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" role="form" method="POST" action="<?php echo base_url();?>Admin/submit_edit_employee">
					<!-- IMPORTANT LINE OF CODE!!! -->
					<input type="hidden" name="id">
					<!-- IMPORTANT LINE OF CODE!!! -->
					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> First Name </label>

						<div class="col-sm-9">
							<input type="text" name="fname" class="col-xs-10 col-sm-5" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Middle Name </label>

						<div class="col-sm-9">
							<input type="text" name="mname" class="col-xs-10 col-sm-5" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Last Name </label>

						<div class="col-sm-9">
							<input type="text" name="lname" class="col-xs-10 col-sm-5" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Username </label>

						<div class="col-sm-9">
							<input type="text" name="uname" class="col-xs-10 col-sm-5" />
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Email </label>

						<div class="col-sm-9">
							<input type="text" name="email" class="col-xs-10 col-sm-5" />
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Department </label>
						<div class="col-sm-4">
							<select class="js-example-placeholder-single" style="width:100%;" name="department">
								<?php

						foreach($departments as $d)
						{
							$selected = '';
							foreach($employee as $p)
							{
								if ($d->department_id == $p->user_department)
								{
									$selected = 'selected';
								}
								else
								{
									//Do nothing
								}
							}
							echo "<option value=\"{$d->department_id}\" {$selected}>{$d->department_name}</option>";
						}
						?>
							</select>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Team </label>
						<div class="col-sm-4">
							<select class="js-example-placeholder-single1" style="width:100%;" name="team">
								<?php

						foreach($teams as $d)
						{
							$selected = '';
							foreach($employee as $p)
							{
								if ($d->teams_id == $p->user_teams_id_fk)
								{
									$selected = 'selected';
								}
								else
								{
									//Do nothing
								}
							}
							echo "<option value=\"{$d->teams_id}\" {$selected}>{$d->teams_name}</option>";
						}
						?>
							</select>
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
