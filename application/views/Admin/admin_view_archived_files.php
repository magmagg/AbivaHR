<div class="row">
<div class="col-xs-12">
  <!-- PAGE CONTENT BEGINS -->
  <!-- Button trigger modal -->
  <h3 class="header smaller lighter blue">Archive</h3>

  <table class="table table-striped table-bordered table-hover" id="dataTables-example">
  	<thead>
  		<tr>
  			<th>#</th>
  			<th>File</th>
  			<th>Version</th>
        <th>Department</th>
        <th>Folder</th>
  			<th>Timestamp</th>
  			<th>Action</th>
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
  						<?php if($d->files_deletedby == $u->user_id):?>
  							<?php $name = $u->user_firstname.' '.$u->user_lastname;?>
  						  <p class="help-block">Uploaded by:<a href="<?php echo base_url();?>Admin/view_other_profile/<?=$u->user_id?>"> <?=$name?> </a></p>
  						<?php endif;?>
  					<?php endforeach;?>
  					<?php else:?>
  					<?php foreach($users as $u):?>
  						<?php if($d->files_deletedby == $u->user_id):?>
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
            <?php foreach($departments as $de): ?>
              <?php if($d->files_department == $de->department_id):?>
                  <?=$de->department_name?>
              <?php endif;?>
            <?php endforeach; ?>
          </td>
          <td>
            <?=$d->files_foldername?>
          </td>
  				<td>
  					<?=$d->files_timestamp?>
  				</td>
  				<td>
  					<div class="hidden-sm hidden-xs btn-group">
  						<a href="<?php echo base_url();?>Admin/download_one_archive/<?=$d->files_id?>" class="tooltip-info" data-rel="tooltip" title="Download">
  							<button class="btn btn-xs btn-success">
  								<i class="ace-icon fa fa-download bigger-120"></i>
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
  										<a href="<?php echo base_url();?>Admin/download_one_archive/<?=$d->files_id?>" class="tooltip-info" data-rel="tooltip" title="View">
  											<span class="blue">
                        <i class="ace-icon fa fa-download bigger-120"></i>
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
<!-- DataTables JavaScript -->
<script src="<?php echo base_url(); ?>assets/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bower_components/datatables-responsive/js/dataTables.responsive.js"></script>

<script src="<?php echo base_url(); ?>assets/js/select2.full.min.js"></script>

<script src="<?php echo base_url();?>assets/js/sweetalert.min.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery.validate.min.js"></script>
<!-- ace scripts -->
<script src="<?php echo base_url(); ?>assets/js/ace-elements.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/ace.min.js"></script>

<script>
var table = {};
$(document).ready(function() {
  table.intro = $('#dataTables-example').DataTable({
    responsive: true
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
						url: "<?php echo base_url();?>Admin/delete_permanently/" + id,
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
		$(".filearchive").click(function(e) {
			e.preventDefault();
			var id = $(this).attr("id");
window.open("<?=base_url();?>Admin/view_archive_of_archived_files/"+id, "", "width=750,height=500");
		});
	});
</script>


<!-- inline scripts related to this page -->
</body>

</html>
