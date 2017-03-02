<div class="row">
	<div class="col-m-12">
		<!-- PAGE CONTENT BEGINS -->
		<div class="slide-content col-md-12" style="transition: all 0.5s;" id="maindiv">
		<h3 class="header smaller lighter blue">Folders</h3>
			<table class="table table-striped table-bordered table-hover" id="dataTables-example">
				<thead>
					<tr>
						<th style="width:5%">#</th>
						<th style="width:65%">Folder</th>
						<th style="width:30%">Action</th>
					</tr>
				</thead>

				<tbody>
					<?php
					$count = 1;
					foreach($folders as $d):
					?>
						<tr>
							<td>
								<?=$count;?>
							</td>
							<td>
								<?=$d->ffolder_name?>
								<p class="help-block">Team:
									 <?php foreach($teams as $t):?>
										 <?php if($d->ffolder_teams_id_fk == $t->teams_id): ?>
											 <?= $t->teams_name; ?>
										 <?php endif;?>
									 <?php endforeach;?>
								</p>
							</td>
							<td>
							<center><button class="btn btn-white btn-info filesclick" id="<?=$d->ffolder_id?>"><i class="ace-icon fa fa-folder bigger-130"></i></button></center>
							</td>
						</tr>
						<?php $count++; ?>
						<?php endforeach; ?>
						<?php if(isset($generic)): ?>
							<?php foreach($generic as $d): ?>
								<tr>
									<td>
										<?=$count;?>
									</td>
									<td>
										<?=$d->ffolder_name?>
										<p class="help-block">Team: Generic</p>
									</td>
									<td>
									<center><button class="btn btn-white btn-info filesclick" id="<?=$d->ffolder_id?>"><i class="ace-icon fa fa-folder bigger-130"></i></button></center>
									</td>
								</tr>
								<?php $count++; ?>
							<?php endforeach;?>
						<?php endif; ?>
				</tbody>
			</table>
		</div>
		<div id="spinner" class="col-md-7">
			<center> <img width="150" height="150" src="<?php echo base_url();?>assets/img/myloading.gif"> </center>

		</div>
		<div id="loadingdiv"></div>
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
<script>
	var table = {};
	$(document).ready(function() {
		table.intro = $('#dataTables-example').DataTable({
			responsive: true
		});
	});
</script>

<script type="text/javascript">
	$(document).ready(function() {
		$('#spinner').hide();
		var count = 0;
		$(".filesclick").click(function(e) {
			var folderid = $(this).attr('id');
			if(count == 0)
			{
				$(".slide-content").toggleClass("col-md-12 col-md-5");
				$('#loadingdiv').addClass('col-md-7');
				$('#spinner').delay(500).show(0);
				count++;
			}
			setTimeout(function() { animate_div(folderid); }, 300);
			function animate_div(folderid)
			{
				e.preventDefault();
					$('#loadingdiv').fadeOut('fast', function() {
		        $('#loadingdiv').empty();
						$("#loadingdiv").load('<?php echo base_url().'AdminDept/load_files/'; ?>' + folderid,
						function() {
							$('#spinner').hide();
							$('#loadingdiv').fadeIn('slow');
							load_files();
						});
					});
			}

		});
	});
</script>
<script>
	var table = {};
function load_files(){
		table.intro = $('#dataTables-example2').DataTable({
			responsive: true
		});
	}
</script>

</body>

</html>
