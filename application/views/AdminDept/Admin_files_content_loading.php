<h3 class="header smaller lighter blue"><button class="btn btn-xs btn-success backbutton"><i class="ace-icon fa fa-arrow-left bigger-120"></i></button>&nbsp;<?=$foldername?></h3>
<table class="table table-striped table-bordered table-hover" id="dataTables-example2">
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
    foreach($files as $d):
    ?>

			<tr id="filesedit<?=$d->files_id?>">
				<td>
					<?=$count?>
				</td>
				<td>
					<?=$d->files_display_name?>
					<?php if($d->files_version == 1.0):?>
					<?php foreach($users as $u):?>
						<?php if($d->files_user_id_fk == $u->user_id):?>
							<?php $name = $u->user_firstname.' '.$u->user_lastname;?>
						  <p class="help-block">Uploaded by:<a href="<?php echo base_url();?>Admin/view_other_profile/<?=$u->user_id?>"> <?=$name?> </a></p>
						<?php endif;?>
					<?php endforeach;?>
					<?php else:?>
					<?php foreach($users as $u):?>
						<?php if($d->files_user_id_fk == $u->user_id):?>
							<?php $name = $u->user_firstname.' '.$u->user_lastname;?>
							<p class="help-block">Updated by:<a href="<?php echo base_url();?>Admin/view_other_profile/<?=$u->user_id?>"> <?=$name?> </a></p>
						<?php endif;?>
					<?php endforeach;?>
					<?php endif;?>

				</td>
				<td>
					<?=$d->files_version?>
				</td>
				<td>
					<?=$d->files_timestamp?>
				</td>
				<td>
					<div class="hidden-sm hidden-xs btn-group">
						<a href="<?php echo base_url();?>Admin/download_one_file/<?=$d->files_id?>" class="tooltip-info" data-rel="tooltip" title="Download">
							<button class="btn btn-xs btn-success">
								<i class="ace-icon fa fa-download bigger-120"></i>
							</button>
						</a>
						<a href="#" role="button" class="blue editmodal" data-toggle="modal" id="<?=$d->files_id?>" class="tooltip-info" data-rel="tooltip" title="Edit">
							<button class="btn btn-xs btn-info editbutton">
								<i class="ace-icon fa fa-pencil bigger-120"></i>
							</button>
						</a>
						<a href="#" onclick="foo(<?=$d->files_id?>)" class="tooltip-info" data-rel="tooltip" title="Delete">
							<button class="btn btn-xs btn-danger">
								<i class="ace-icon fa fa-trash-o bigger-120"></i>
							</button>
						</a>
<!--
						<a href="<?php echo base_url();?>Admin/view_one_file/<?=$d->files_id?>" class="tooltip-info" data-rel="tooltip" title="View">
							<button class="btn btn-xs btn-light">
								<i class="ace-icon fa fa-eye bigger-120"></i>
							</button>
						</a>
-->
						<a href="#">
              <button class="btn btn-xs btn-yellow filearchive" type="button" id="<?=$d->files_id?>" class="tooltip-info" data-rel="tooltip" title="View archive">
                <i class="ace-icon glyphicon glyphicon-list-alt bigger-120"></i>
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
										<a href="<?php echo base_url();?>Admin/download_one_file/<?=$d->files_id?>" class="tooltip-info" data-rel="tooltip" title="View">
											<span class="blue">
                      <i class="ace-icon fa fa-download bigger-120"></i>
                    </span>
										</a>
									</li>

									<li>
										<a href="#" role="button" class="blue editmodal" id="<?=$d->files_id?>" data-toggle="modal" class="tooltip-success" data-rel="tooltip" title="Edit">
											<span class="green">
                      <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                    </span>
										</a>
									</li>

									<li>
										<a href="#" onclick="foo(<?=$d->files_id?>)" class="tooltip-error" data-rel="tooltip" title="Delete">
											<span class="red">
                      <i class="ace-icon fa fa-trash-o bigger-120"></i>
                    </span>
										</a>
									</li>
<!--
									<li>
										<a href="<?php echo base_url();?>Admin/view_one_file/<?=$d->files_id?>" class="tooltip-success" data-rel="tooltip" title="View">
											<span class="light">
                      <i class="ace-icon fa fa-eye bigger-120"></i>
                    </span>
										</a>
									</li>
-->
									<li>
										<a href="#" class="tooltip-success filearchive" id="<?=$d->files_id?>" data-rel="tooltip" title="Versions">
											<span class="yellow">
                      <i class="ace-icon glyphicon glyphicon-list-alt bigger-120"></i>
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

<script type="text/javascript">
	jQuery(function($) {
		$('#myModal input[type=file]').ace_file_input({
			style: 'well',
			btn_choose: 'Drop files here or click to choose',
			btn_change: null,
			no_icon: 'ace-icon fa fa-cloud-upload',
			droppable: true,
			thumbnail: 'large',
			maxSize: 1000000000, //~1 Gb
			before_remove: function() {
				$("#filechanged").val(0);
				return true;
			}
		}).on('file.error.ace', function(event, info) {
				alert('File exceeds 1Gb');
		 });
	});
</script>
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
						url: "<?php echo base_url();?>Admin/delete_one_file/" + id,
						success: function(data) {

							$('#filesedit' + id).fadeOut('slow', function() {
								table.intro.row('#filesedit' + id).remove().draw(false);
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
			$('#spinner').show();
			e.preventDefault();
			var id = "<?php echo $departmentid;?>";
			$('#loadingdiv').fadeOut('fast', function() {
				$('#loadingdiv').empty();
				$("#loadingdiv").load('<?php echo base_url().'Admin/load_folders/'; ?>' + id,
					function() {
						$('#spinner').hide();
						$('#loadingdiv').fadeIn('slow');
						load_folders();

					});
			});
		});
	});
</script>

<script>
	var table = {};

	function load_folders() {
		table.intro = $('#dataTables-example1').DataTable({
			responsive: true
		});
	}
</script>

<script type="text/javascript">
	$(document).ready(function() {
		$(".filearchive").click(function(e) {
			e.preventDefault();
			$('#spinner').show();
			var id = $(this).attr("id");
			var departmentid = "<?php echo $departmentid;?>";
			var folderid = "<?php echo $folderid;?>";
			$('#loadingdiv').fadeOut('fast', function() {
				$('#loadingdiv').empty();
				$("#loadingdiv").load('<?php echo base_url().'Admin/load_archive/'; ?>' + id + "/" + departmentid + "/" + folderid,
					function() {
						$('#spinner').hide();
						$('#loadingdiv').fadeIn('100');
						load_archive();
					});
			});
		});
	});
</script>

<script>
	var table = {};

	function load_archive() {
		table.intro = $('#dataTables-example3').DataTable({
			responsive: true
		});
	}
</script>

<script>
	$(document).ready(function() {
		$(".editmodal").click(function(e) {
			e.preventDefault();
			var id = $(this).attr("id");
			$.ajax({
				type: 'POST',
				url: "<?php echo base_url();?>Admin/get_one_file/" + id,
				success: function(data) {
					$('#displayname').val(data.display_name);
					$('#old_file_id').val(data.id);
					$('#foldername').val("<?php echo $foldername?>");
					$('#myModal').modal('show');
				},
				dataType: "json"
			});
		});
	});

	$('#myModal').on('shown.bs.modal', function() {
		if (!ace.vars['touch']) {
			$(this).find('.chosen-container').each(function() {
				$(this).find('a:first-child').css('width', '210px');
				$(this).find('.chosen-drop').css('width', '210px');
				$(this).find('.chosen-search input').css('width', '200px');
			});
		}
	});
</script>
