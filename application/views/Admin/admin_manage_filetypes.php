<div class="row">
	<div class="col-l-12">
		<!-- PAGE CONTENT BEGINS -->

		<h3 class="header smaller lighter blue"><a href="#myModal_add" data-toggle="modal"><button class="btn btn-sm btn-success pull-right">Add File Type</button></a>
Manage File Types</h3>

		<table class="table table-striped table-bordered table-hover we" id="dataTables-example">
			<thead>
				<tr>
					<th>#</th>
					<th>File Type</th>
					<th>Action</th>
				</tr>
			</thead>

			<tbody>
				<?php $count = 1;?>
				<?php foreach($filetypes as $t): ?>

				<tr id="<?=$t->accepted_files_id?>">
					<td>
						<?=$count;?>
					</td>


					<td>
						<?=$t->accepted_files?>
					</td>

					<td>

						<div class="hidden-sm hidden-xs btn-group">

							<a href="#myModal_edit" data-toggle="modal" data-updateid="<?=$t->accepted_files_id?>" data-updatename="<?=$t->accepted_files?>" class="tooltip-info" data-rel="tooltip" title="Edit">
								<button class="btn btn-xs btn-info editbutton">
										<i class="ace-icon fa fa-pencil bigger-120"></i>
									</button>
							</a>

							<a href="#" onclick="foo(<?=$t->accepted_files_id?>)" class="tooltip-info" data-rel="tooltip" title="Delete">
								<button class="btn btn-xs btn-danger">
										<i class="ace-icon fa fa-trash-o bigger-120"></i>
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
											<a href="#myModal_edit" data-toggle="modal" data-updateid="<?=$t->accepted_files_id?>" data-updatename="<?=$t->accepted_files?>" class="tooltip-info" data-rel="tooltip" title="Edit">
												<span class="green">
		                      <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
		                    </span>
											</a>
										</li>

										<li>
											<a href="#" onclick="foo(<?=$t->accepted_files_id?>)" class="tooltip-error" data-rel="tooltip" title="Delete">
												<span class="red">
		                      <i class="ace-icon fa fa-trash-o bigger-120"></i>
		                    </span>
											</a>
										</li>

									</ul>
								</div>
							</div>
						</center>


					</td>

				</tr>
				<?php $count++;?>
				<?php endforeach; ?>
			</tbody>
		</table>

		<!-- /#wrapper -->



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
<script src="<?php echo base_url(); ?>assets/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
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
				text: "You will not be able to recover this record!",
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
						url: "<?php echo base_url();?>Admin/delete_one_filetype/" + id,
						success: function(data) {

							$('#' + id).fadeOut('slow', function() {
								table.intro.row('#' + id).remove().draw(false);
							});
							swal("Deleted!", "Team deleted.", "success");
						}
					});
				} else {}
			});
	}
</script>

<script>
  $('#myModal_edit').on('show.bs.modal', function(e)
{
    //get data-id attribute of the clicked element
    var updateid = $(e.relatedTarget).data('updateid');
    var updatename = $(e.relatedTarget).data('updatename');
    //populate the textbox
    $(e.currentTarget).find('input[name="id"]').val(updateid);
    $(e.currentTarget).find('input[name="updatename"]').val(updatename);
});
</script>


<!-- inline scripts related to this page -->
</body>

</html>
