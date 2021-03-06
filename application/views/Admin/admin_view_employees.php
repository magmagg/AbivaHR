<div class="row">
	<div class="col-l-12">
		<!-- PAGE CONTENT BEGINS -->

		<h3 class="header smaller lighter blue">Manage Employees</h3>

		<div class="well">
			<table class="table table-striped table-bordered table-hover we" id="dataTables-example">
				<thead>
					<tr>
						<th>ID</th>
						<th>Last Name</th>
						<th>First Name</th>
						<th>Middle Name</th>
						<th>Username</th>
						<th>Department</th>
						<th>Address</th>
						<th>Email</th>
						<th>Phone</th>
						<th>Edit</th>
						<th>Active</th>
						<th>Delete</th>
					</tr>
				</thead>

				<tbody>
					<?php foreach($employees as $e): ?>

					<tr id="<?=$e->user_id?>">

						<td>
							<?=$e->user_id?>
						</td>

						<td>
							<?=$e->user_lastname?>
						</td>

						<td>
							<?=$e->user_firstname?>
						</td>

						<td>
							<?=$e->user_middlename?>
						</td>

						<td>
							<?=$e->user_username?>
						</td>

						<td>
							<?=$e->department_name?>
						</td>

						<td>
							<?=$e->user_address?>
						</td>

						<td>
							<?=$e->user_email?>
						</td>

						<td>
							<?=$e->user_cpnumber?>
						</td>

						<td>
							<a href="<?php echo base_url();?>Admin/edit_one_employee/<?=$e->user_id?>">
								<button class="btn btn-block btn-white btn-info"><i class="ace-icon fa fa-pencil bigger-120"></i></button>
							</a>
						</td>
						<?php if ($e->user_active == 1):?>
						<td>
							<span class="col-sm-6">
												<label class="pull-right inline">

													<input id="id-button-borders" checked type="checkbox" class="ace ace-switch ace-switch-5" value="<?= $e->user_id;?>"/>
													<span class="lbl middle"></span>
								</label>
							</span>
							<!-- /.col -->
						</td>
						<?php else:?>
						<td>
							<span class="col-sm-6">
												<label class="pull-right inline">

													<input id="id-button-borders" type="checkbox" class="ace ace-switch ace-switch-5" value="<?= $e->user_id;?>"/>
													<span class="lbl middle"></span>
							</label>
							</span>
							<!-- /.col -->
						</td>
						<?php endif; ?>
						<td>
							<a href="#>">
									<button class="btn btn-block btn-white btn-danger" onclick="foo(<?=$e->user_id?>)"><i class="ace-icon fa fa-trash-o bigger-120"></i></button>
								</a>
						</td>

					</tr>

					<?php endforeach; ?>
				</tbody>
			</table>




		</div>
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

<script type="text/javascript">
	$(".js-example-placeholder-single").select2({
		placeholder: "Select department"
	});
</script>
<script type="text/javascript">
	$(document).ready(function() {
		var selectme = $('#select1');

		function selectall_func() {
			selectme.select2('destroy').find('option').prop('selected', 'selected').end().select2()
		}

		function selectnone_func() {
			selectme.select2('destroy').find('option').prop('selected', false).end().select2()
		}
		$("#selectall").click(selectall_func);
		$("#selectnone").click(selectnone_func);
	});
</script>

<script>
	$().ready(function() {
		// validate signup form on keyup and submit
		$("#announcement_form").validate({
			rules: {
				title: {
					required: true
				},
				content: {
					required: true
				},
				departments: {
					required: true
				}
			},
			submitHandler: function() {
				var frm = $('#announcement_form');
				$.ajax({
					type: frm.attr('method'),
					url: frm.attr('action'),
					data: frm.serialize(),
					beforeSend: function() {
						$("#post_button").html('Posting<img width="30" height="20" src="<?php echo base_url();?>assets/img/loading.gif"> ');
					},
					success: function(data) {
						var editButton = "<a href=\"<?php echo base_url();?>Admin/edit_announcement/" + data.ann_id + "\"><button class=\"btn btn-block btn-white btn-info\"><i class=\"ace-icon fa fa-pencil bigger-120\"></i></button></a>";
						var deleteButton = "<button class=\"btn btn-block btn-white btn-danger\"  onclick=\"foo(" + data.ann_id + ")\"><i class=\"ace-icon fa fa-trash-o bigger-120\"></i></button>";
						$("#post_button").html('Post');
						var MyUniqueID = data.ann_id; // this is the uniqueId.
						var rowIndex = $('#dataTables-example').dataTable().fnAddData([
							data.ann_id,
							data.ann_title,
							data.ann_content,
							data.ann_time,
							editButton,
							deleteButton
						]);
						var row = $('#dataTables-example').dataTable().fnGetNodes(rowIndex);
						$(row).attr('id', MyUniqueID);

						$('#myModal').modal('hide');
						swal({
							title: "Success!!",
							text: "Announcement posted!",
							type: "success",
							confirmButtonText: "Ok"
						});
					},
					dataType: "json"
				});
				return false;
			}
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
						url: "<?php echo base_url();?>Admin/delete_one_employee/" + id,
						success: function(data) {

							$('#' + id).fadeOut('slow', function() {
								table.intro.row('#' + id).remove().draw(false);
							});
							swal("Deleted!", "Employee has been deleted.", "success");
						}
					});
				} else {}
			});
	}
</script>

<script>
$(".ace-switch-5").change(function () {
    var value = $(this).val();
		var checked = $(this).is(":checked");
		if(checked == false)
		{
			var link =  "<?php echo base_url();?>Admin/deactivate_user/" + value;
		} else {
			var link =  "<?php echo base_url();?>Admin/activate_user/" + value;
		}
    $.ajax({
        type: "POST",
        url: link,

				/*
        data: {
            id-button-borders: value // as you are getting in php $_POST['action1']
        },
				*/
        success: function (msg) {
        }
    });
})
</script>


<!-- inline scripts related to this page -->
</body>

</html>
