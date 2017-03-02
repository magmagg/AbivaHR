<div class="row">
	<div class="col-xs-12">
		<!-- PAGE CONTENT BEGINS -->
		<h3 class="header smaller lighter blue">
			<i class="ace-icon fa fa-users blue"></i>
			Grant Admin
				</h3>
			<table style="width:100%" class="table table-striped table-bordered table-hover we" id="dataTables-example">
				<thead>
					<tr>
						<th>ID</th>
						<th>Name</th>
						<th>Username</th>
						<th>Team</th>
						<th>Admin</th>
					</tr>
				</thead>

				<tbody>
					<?php foreach($employees as $e): ?>
						<?php if($e->user_id == 41):?>
						<?php else: ?>

					<tr id="<?=$e->user_id?>">

						<td>
							<?=$e->user_id?>
						</td>

						<td>
							<?=$e->user_lastname?> , <?=$e->user_firstname?> <?=$e->user_middlename?>
						</td>


						<td>
							<?=$e->user_username?>
						</td>


						<td>
							<?php foreach($teams as $t): ?>
								<?php if($t->teams_id == $e->user_teams_id_fk):?>
							<?=$t->teams_name?>
								<?php endif;?>
							<?php endforeach;?>
						</td>


						<?php if ($e->user_isadmin == 2):?>
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


					</tr>
<?php endif;?>
					<?php endforeach; ?>
				</tbody>
			</table>
		<!-- PAGE CONTENT ENDS -->
	</div><!-- /.col -->
</div><!-- /.row -->
</div><!-- /.page-content -->
</div>
</div><!-- /.main-content -->

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
<script src="<?php echo base_url(); ?>assets/js/pnotify.custom.min.js"></script>
<!-- DataTables JavaScript -->
<script src="<?php echo base_url(); ?>assets/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bower_components/datatables-responsive/js/dataTables.responsive.js"></script>

<script src="<?php echo base_url(); ?>assets/js/select2.full.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/pnotify.custom.min.js"></script>

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
$(".ace-switch-5").change(function () {
    var value = $(this).val();
		var checked = $(this).is(":checked");
		if(checked == false)
		{
			var link =  "<?php echo base_url();?>Admin/deactivate_admin/" + value;
		} else {
			var link =  "<?php echo base_url();?>Admin/activate_admin/" + value;
		}
    $.ajax({
        type: "POST",
        url: link,
        success: function (data)
        {
					if(data == 1)
					{
						new PNotify({
						title: 'Activate',
						text: 'Admin access granted',
						type: 'success'
					});
					}
					else if(data == 0)
					{
						new PNotify({
						title: 'Deactivate',
						text: 'Admin acccess revoked',
						type: 'error'
					});
					}
        }
    });
})
</script>



<!-- inline scripts related to this page -->
<?=$this->session->flashdata('notify');?>
</body>

</html>
