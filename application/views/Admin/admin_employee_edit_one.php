<?php foreach($employee as $e)
{
	$ID = $e->user_id;
	$fname = $e->user_firstname;
	$lname = $e->user_lastname;
	$mname = $e->user_middlename;
	$uname = $e->user_username;
	$email = $e->user_email;
	$address = $e->user_address;
	$phone = $e->user_cpnumber;
	$department = $e->department_name;
}
?>
<h3 class="header smaller lighter blue">Edit Employee</h3>

<div class="well well-lg">

	<div class="row">
		<div class="col-xs-12">
			<form class="form-horizontal" role="form" method="POST" action="<?php echo base_url();?>Admin/submit_edit_employee">
				<!-- IMPORTANT LINE OF CODE!!! -->
				<input type="hidden" name="id" value="<?php echo $ID?>">
				<!-- IMPORTANT LINE OF CODE!!! -->
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> First Name </label>

					<div class="col-sm-9">
						<input type="text" name="fname" class="col-xs-10 col-sm-5" value="<?php echo $fname?>" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Middle Name </label>

					<div class="col-sm-9">
						<input type="text" name="mname" class="col-xs-10 col-sm-5" value="<?php echo $mname?>" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Last Name </label>

					<div class="col-sm-9">
						<input type="text" name="lname" class="col-xs-10 col-sm-5" value="<?php echo $lname?>" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Username </label>

					<div class="col-sm-9">
						<input type="text" name="username" class="col-xs-10 col-sm-5" value="<?php echo $uname?>" />
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Address </label>

					<div class="col-sm-9">
						<input type="text" name="address" class="col-xs-10 col-sm-5" value="<?php echo $address?>" />
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Email </label>

					<div class="col-sm-9">
						<input type="text" name="email" class="col-xs-10 col-sm-5" value="<?php echo $email?>" />
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Phone </label>

					<div class="col-sm-9">
						<input type="text" name="phone" id="input-mask-phone" class="col-xs-10 col-sm-5" value="<?php echo $phone?>" />
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Department </label>
					<div class="col-sm-4">
						<select class="js-example-placeholder-single" style="width:100%;" name="department">
							<?php

						foreach($departments as $d)
						{
							$selected = '';
							foreach($employee as $p)
							{
								if ($d->department_id == $p->user_department)
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
					<div class="col-sm-5"></div>
				</div>

				<button type="submit" class="btn btn-white btn-primary pull-left">Submit</button>
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
	$(".input-mask-phone").mask('99999999999');
</script>




<!-- inline scripts related to this page -->
</body>

</html>
