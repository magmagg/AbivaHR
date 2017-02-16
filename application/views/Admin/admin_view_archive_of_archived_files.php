<h3 class="header smaller lighter blue">Archive</h3>
<table class="table table-striped table-bordered table-hover" id="dataTables-example2">
	<thead>
		<tr>
			<th>#</th>
			<th>File</th>
			<th>Version</th>
			<th>Timestamp</th>
			<th>Action</th>
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
					<div class="btn-group">
						<a href="<?php echo base_url();?>Admin/download_one_archive_of_archive/<?=$d->archive_id?>" class="tooltip-info" data-rel="tooltip" title="Download">
							<button class="btn btn-xs btn-success">
								<i class="ace-icon fa fa-download bigger-120"></i>
							</button>
						</a>
						<!--
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
					-->
					</div>

				</td>
			</tr>
			<?php $count++; ?>
			<?php endforeach; ?>
	</tbody>
</table>
<!--[if !IE]> -->
<script src="<?php echo base_url(); ?>assets/js/jquery-2.1.4.min.js"></script>

<!-- <![endif]-->

<!--[if IE]>
<script src="<?php echo base_url(); ?>assets/js/jquery-1.11.3.min.js"></script>
<![endif]-->
<script type="text/javascript">
	if ('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>" + "<" + "/script>");
</script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>

<!-- page specific plugin scripts -->
<script src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/sweetalert.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/pnotify.custom.min.js"></script>

<!-- ace scripts -->
<script src="<?php echo base_url(); ?>assets/js/ace-elements.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/ace.min.js"></script>

<script>
	var table = {};
		table.intro = $('#dataTables-example2').DataTable({
			responsive: true
		});

</script>
