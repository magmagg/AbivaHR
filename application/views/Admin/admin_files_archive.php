<h3 class="header smaller lighter blue"><button class="btn btn-xs btn-success backbutton"><i class="ace-icon fa fa-arrow-left bigger-120"></i></button>&nbsp;Archive</h3>
<table class="table table-striped table-bordered table-hover" id="dataTables-example3">
	<thead>
		<tr>
			<th style="width:5%">#</th>
			<th style="width:40%">File</th>
			<th style="width:5%">Version</th>
			<th style="width:15%">Timestamp</th>
			<th style="width:35%">Action</th>
		</tr>
	</thead>
	<tbody>
		<?php
    $count = 1;
    foreach($archive as $d):
    ?>

			<tr id="filesarchive<?=$d->archive_id?>">
				<td>
					<?=$count?>
				</td>
				<td>
					<?=$d->archive_display_name?>
					<?php if($d->archive_version == 1.0):?>
					<?php foreach($users as $u):?>
						<?php if($d->archive_user_id_fk == $u->user_id):?>
							<?php $name = $u->user_firstname.' '.$u->user_lastname;?>
							<p class="help-block">Uploaded by:<a href="<?php echo base_url();?>Admin/view_other_profile/<?=$u->user_id?>"> <?=$name?> </a></p>
						<?php endif;?>
					<?php endforeach;?>
					<?php else:?>
					<?php foreach($users as $u):?>
						<?php if($d->archive_user_id_fk == $u->user_id):?>
							<?php $name = $u->user_firstname.' '.$u->user_lastname;?>
							<p class="help-block">Updated by:<a href="<?php echo base_url();?>Admin/view_other_profile/<?=$u->user_id?>"> <?=$name?> </a></p>
						<?php endif;?>
					<?php endforeach;?>
					<?php endif;?>
				</td>
				<td>
					<?=$d->archive_version?>
				</td>
				<td>
					<?=$d->archive_timestamp?>
				</td>
				<td>
					<div class="hidden-sm hidden-xs btn-group">
						<a href="<?php echo base_url();?>Admin/download_one_file_archive/<?=$d->archive_id?>" class="tooltip-info" data-rel="tooltip" title="Download">
							<button class="btn btn-xs btn-success">
								<i class="ace-icon fa fa-download bigger-120"></i>
							</button>
						</a>
						<a href="#" onclick="foo(<?=$d->archive_id?>)" class="tooltip-info" data-rel="tooltip" title="Delete">
							<button class="btn btn-xs btn-danger">
								<i class="ace-icon fa fa-trash-o bigger-120"></i>
							</button>
						</a>

						<a href="<?php echo base_url();?>Admin/view_one_file/<?=$d->archive_id?>" class="tooltip-info" data-rel="tooltip" title="View">
							<button class="btn btn-xs btn-light">
								<i class="ace-icon fa fa-eye bigger-120"></i>
							</button>
						</a>
					</div>
					<center>
						<div class="hidden-md hidden-lg">
							<div class="inline pos-rel">
								<button class="btn btn-minier btn-primary dropdown-toggle" data-toggle="dropdown" data-position="auto">
									<i class="ace-icon fa fa-cog icon-only bigger-110"></i>
								</button>

								<ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
									<li>
										<a href="<?php echo base_url();?>Admin/download_one_file_archive/<?=$d->archive_id?>" class="tooltip-info" data-rel="tooltip" title="View">
											<span class="blue">
                      <i class="ace-icon fa fa-download bigger-120"></i>
                    </span>
										</a>
									</li>

									<li>
										<a href="#" onclick="foo(<?=$d->archive_id?>)" class="tooltip-error" data-rel="tooltip" title="Delete">
											<span class="red">
                      <i class="ace-icon fa fa-trash-o bigger-120"></i>
                    </span>
										</a>
									</li>

									<li>
										<a href="<?php echo base_url();?>Admin/view_one_file/<?=$d->archive_id?>" class="tooltip-success" data-rel="tooltip" title="View">
											<span class="light">
                      <i class="ace-icon fa fa-eye bigger-120"></i>
                    </span>
										</a>
									</li>

								</ul>
							</div>
						</div>
					</center>

				</td>
			</tr>
			<?php $count++; ?>
			<?php endforeach; ?>
	</tbody>
</table>


<script>
	function foo(id) {
		swal({
				title: "Are you sure?",
				text: "You will not be able to recover this file!",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Yes, delete it!",
				closeOnConfirm: false
			},
			function(isConfirm) {
				if (isConfirm) {
					$.ajax({
						type: 'POST',
						url: "<?php echo base_url();?>Admin/delete_one_file_archive/" + id,
						success: function(data) {

							$('#filesarchive' + id).fadeOut('slow', function() {
								table.intro.row('#' + id).remove().draw(false);
							});
							swal("Deleted!", "Your file has been deleted.", "success");
						}
					});
				} else {}
			});
	}
</script>

<script type="text/javascript">
	$(document).ready(function() {
		$(".backbutton").click(function(e) {
			e.preventDefault();
			$('#spinner').show();
			var folderid = "<?php echo $folderid ?>";
			var departmentid = "<?php echo $departmentid ?>";
			$('#loadingdiv').fadeOut('fast', function() {
				$('#loadingdiv').empty();
				$("#loadingdiv").load('<?php echo base_url().'Admin/load_files/'; ?>' + folderid + "/" + departmentid,
					function() {
						$('#spinner').hide();
						$('#loadingdiv').fadeIn('slow');
						load_files();
					});
			});
		});
	});
</script>

<script>
	var table = {};

	function load_files() {
		table.intro = $('#dataTables-example2').DataTable({
			responsive: true
		});
	}
</script>
