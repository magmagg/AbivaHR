<?php foreach($announcement as $p)
{
	$ID = $p->ann_id;
	$Title = $p->ann_title;
	$Content = $p->ann_content;
	$Time = $p->ann_timestamp;
}
?>
<h3 class="header smaller lighter blue">Edit Announcement</h3>

<div class="well well-lg">

	<div class="row">
		<div class="col-xs-12">
			<form class="form-horizontal" role="form" method="POST" action="<?php echo base_url();?>AdminDept/edit_one_announce">
				<!-- IMPORTANT LINE OF CODE!!! -->
				<input type="hidden" name="id" value="<?php echo $ID?>">
				<!-- IMPORTANT LINE OF CODE!!! -->
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Title </label>

					<div class="col-sm-9">
						<input type="text" name="title" placeholder="Title" class="col-xs-10 col-sm-5" value="<?php echo $Title?>" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Content </label>

					<div class="col-sm-9">
						<textarea type="text" name="content" class="form-control" id="form-field-8"><?php echo $Content?></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Departments </label>
					<div class="col-sm-9">
						<select class="js-example-placeholder-single" style="width:100%;" name="departments[]" id="mulselect" multiple="multiple">
							<?php

						foreach($departments as $d)
						{
							$selected = '';
							foreach($announcement as $a)
							{
								if ($d->department_id == $a->ann_department_fk)
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
				<button type="submit" class="btn btn-primary pull-right">Post</button>
		</div>
		<!-- /.col -->
	</div>
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
<!-- ace scripts -->
<script src="<?php echo base_url(); ?>assets/js/ace-elements.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/ace.min.js"></script>

<script src="<?php echo base_url(); ?>assets/js/select2.full.min.js"></script>


<script type="text/javascript">
	$(".js-example-placeholder-single").select2({
		placeholder: "Select department"
	});
</script>


<!-- inline scripts related to this page -->
</body>

</html>
