<div class="row">
	<div class="col-m-12">
		<!-- PAGE CONTENT BEGINS -->
		<div class="slide-content col-md-12" style="transition: all 0.5s;" id="maindiv">
			<h3 class="header smaller lighter blue">Shared files</h3>
				<table class="table table-striped table-bordered table-hover" id="dataTables-example">
				<thead>
					<tr>
						<th style="width:5%">#</th>
						<th style="width:40%">File</th>
						<th style="width:5%">Department</th>
						<th style="width:5%">Version</th>
						<th style="width:15%">Timestamp</th>
						<th style="width:30%">Action</th>
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
										<p class="help-block">Updated by:<?=$name?></p>
									<?php endif;?>
								<?php endforeach;?>
								<?php endif;?>

							</td>
							<td>
								<?php foreach($departments as $dep):?>
									<?php if($dep->department_id == $d->ffolder_dept_id_fk){$departmentname = $dep->department_name;} ?>
								<?php endforeach;?>
								<?=$departmentname?>
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

									<a href="<?php echo base_url();?>Admin/view_one_file/<?=$d->files_id?>" class="tooltip-info" data-rel="tooltip" title="View">
										<button class="btn btn-xs btn-light">
											<i class="ace-icon fa fa-eye bigger-120"></i>
										</button>
									</a>

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
													<a href="<?php echo base_url();?>Admin/view_one_file/<?=$d->files_id?>" class="tooltip-success" data-rel="tooltip" title="View">
														<span class="light">
			                      <i class="ace-icon fa fa-eye bigger-120"></i>
			                    </span>
													</a>
												</li>
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
		</div>
		<!-- PAGE CONTENT ENDS -->
	</div>
	<!-- /.col -->
</div>
<!-- /.row -->
</div>
<!-- /.page-content -->
</div>
</div>
<!-- /.main-content -->

<div class="footer">
	<div class="footer-inner">
		<div class="footer-content">
			<span class="bigger-120">
  <span class="blue bolder">Ace</span> Application &copy; 2013-2014
			</span>

			&nbsp; &nbsp;
			<span class="action-buttons">
  <a href="#">
    <i class="ace-icon fa fa-twitter-square light-blue bigger-150"></i>
  </a>

  <a href="#">
    <i class="ace-icon fa fa-facebook-square text-primary bigger-150"></i>
  </a>

  <a href="#">
    <i class="ace-icon fa fa-rss-square orange bigger-150"></i>
  </a>
</span>
		</div>
	</div>
</div>

<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
	<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
</a>
</div>
<!-- /.main-container -->

<!-- basic scripts -->

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

<!-- inline scripts related to this page -->
<?=$this->session->flashdata('notify');?>

<script>
	var table = {};
	$(document).ready(function() {
		table.intro = $('#dataTables-example').DataTable({
			responsive: true
		});
	});
</script>

<script>
$( ".filearchive" ).click(function() {
	var id = this.id;
	window.open("<?php echo base_url();?>User/view_shared_archive/"+id, '_blank');
});
</script>
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
$(document).ready(function() {
  $(".editmodal").click(function(e) {
    e.preventDefault();
    var id = $(this).attr("id");
    $.ajax({
        type: 'POST',
        url: "<?php echo base_url();?>User/get_one_file/" + id,
        success: function(data) {
            $('#displayname').val(data.display_name);
            $('#old_file_id').val(data.id);
            $('#foldername').val(data.foldername);
            $('#myModal').modal('show');
        },
        dataType:"json"
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


</body>

</html>
