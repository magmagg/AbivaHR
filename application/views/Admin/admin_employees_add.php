	<div class="row">
		<div class="col-xs-12">
			<div class="col-md-6">
				<h3 class="header smaller lighter blue">
					<i class="ace-icon fa fa-user blue"></i>
					Add employee
								</h3>
			<form id="RegistrationForm" class="form-horizontal" role="form" method="POST" action="<?php echo base_url();?>Admin/submit_add_employee" method="POST">

				<div class="form-group">
					<label class="col-xs-12 col-sm-3 control-label no-padding-right"> Username </label>
					<div class="col-xs-12 col-sm-5">
						<span class="block input-icon input-icon-right">
							<input type="text" class="width-100" placeholder="Username" name="username" required/>
							<i class="ace-icon fa fa-user"></i>
						</span>
					</div>
					<div class="col-xs-12 col-sm-reset inline"></div>
				</div>

				<div class="form-group">
					<label class="col-xs-12 col-sm-3 control-label no-padding-right"> First Name </label>
					<div class="col-xs-12 col-sm-5">
						<span class="block input-icon input-icon-right">
							<input type="text" class="width-100" placeholder="First Name" name="firstname" required/>
							<i class="ace-icon fa fa-user"></i>
						</span>
					</div>
					<div class="col-xs-12 col-sm-reset inline"></div>
				</div>

				<div class="form-group">
					<label class="col-xs-12 col-sm-3 control-label no-padding-right"> Middle Name </label>
					<div class="col-xs-12 col-sm-5">
						<span class="block input-icon input-icon-right">
							<input type="text" class="width-100" placeholder="Middle Name" name="middlename" required/>
							<i class="ace-icon fa fa-user"></i>
						</span>
					</div>
					<div class="col-xs-12 col-sm-reset inline"></div>
				</div>

				<div class="form-group">
					<label class="col-xs-12 col-sm-3 control-label no-padding-right"> Last Name </label>
					<div class="col-xs-12 col-sm-5">
						<span class="block input-icon input-icon-right">
							<input type="text" class="width-100" placeholder="Last Name" name="lastname" required/>
							<i class="ace-icon fa fa-user"></i>
						</span>
					</div>
					<div class="col-xs-12 col-sm-reset inline"></div>
				</div>

				<div class="form-group">
					<label class="col-xs-12 col-sm-3 control-label no-padding-right" > Department </label>
					<div class="col-xs-12 col-sm-5">
						<select class="js-example-placeholder-single form-control" style="width:100%" name="department">
							<option></option>
							<?php foreach($departments as $d): ?>
								<option value="<?=$d->department_id?>"><?=$d->department_name?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="col-sm-5"></div>
				</div>

				<div class="form-group">
					<label class="col-xs-12 col-sm-3 control-label no-padding-right" > Department </label>
					<div class="col-xs-12 col-sm-5">
						<select class="js-example-placeholder-single1 form-control" style="width:100%" name="team">
							<option></option>
							<?php foreach($teams as $d): ?>
								<option value="<?=$d->teams_id?>"><?=$d->teams_name?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="col-sm-5"></div>
				</div>

				<div class="form-group">
					<label class="col-xs-12 col-sm-3 control-label no-padding-right"> Password </label>
					<div class="col-xs-12 col-sm-5">
						<span class="block input-icon input-icon-right">
							<input type="password" class="width-100" placeholder="Password" id="password" name="password" required/>
							<i class="ace-icon fa fa-lock"></i>
						</span>
					</div>
					<div class="col-xs-12 col-sm-reset inline"></div>
				</div>

				<div class="form-group">
					<label class="col-xs-12 col-sm-3 control-label no-padding-right"> Confirm Password </label>
					<div class="col-xs-12 col-sm-5">
						<span class="block input-icon input-icon-right">
							<input type="password" class="width-100" placeholder="Repeat password" id="confirm_password" name="confirm_password" required/>
							<i class="ace-icon fa fa-lock"></i>
						</span>
					</div>
					<div class="col-xs-12 col-sm-reset inline"></div>
				</div>


				<div class="modal-footer">
					<button type="reset" class="width-10  btn ">
						<i class="ace-icon fa fa-refresh"></i>
						<span>Reset</span>
					</button>
					&nbsp;&nbsp;
					<button type="submit" value="submit" class="width-10  btn pull-right btn-success">
						<span id="register_text">Register</span>
						<i class="ace-icon fa fa-arrow-right icon-on-right"></i>
					</button>
			</div>
		</form>
	</div>
	<div class="col-md-6">
		<h3 class="header smaller lighter blue">
		<i class="ace-icon fa fa-users blue"></i>
		Import users
	</h3>
	<form id="importform" class="form-horizontal" role="form" method="POST" action="<?php echo base_url();?>Admin/submit_import_employees" method="POST">
		<div class="form-group">
			<div class="col-xs-12">
				<input type="file" name="file" id="id-input-file-3" />
			</div>
		</div>
			<span class="help-block">*CSV Files only</span>




		<div class="modal-footer">

			&nbsp;&nbsp;
			<button type="submit" value="submit" class="width-10  btn pull-right btn-success">
				<span id="register_text">Submit</span>
				<i class="ace-icon fa fa-arrow-right icon-on-right"></i>
			</button>
	</div>
</form>
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

<script type="text/javascript">
	$(".js-example-placeholder-single").select2({
		placeholder: "Select department"
	});
</script>

<script type="text/javascript">
	$(".js-example-placeholder-single1").select2({
		placeholder: "Select Team"
	});
</script>

<script>
$('#id-input-file-3').ace_file_input({
	style: 'well',
	btn_choose: 'Drop files here or click to choose',
	btn_change: null,
	no_icon: 'ace-icon fa fa-cloud-upload',
	droppable: true,
	thumbnail: 'small',
	allowExt:  ['csv']
	,
	preview_error : function(filename, error_code) {
		//name of the file that failed
		//error_code values
		//1 = 'FILE_LOAD_FAILED',
		//2 = 'IMAGE_LOAD_FAILED',
		//3 = 'THUMBNAIL_FAILED'
		//alert(error_code);
	}

}).on('change', function(){
	//console.log($(this).data('ace_input_files'));
	//console.log($(this).data('ace_input_method'));
});

</script>

<script>
var frm = $('#importform');
frm.submit(function (ev) {


	var fd = new FormData();//empty FormData object
	$.each(frm.serializeArray(), function(i, item) {
	  //add form fields one by one to our FormData
	  fd.append(item.name, item.value);
	});
	frm.find('input[type=file]').each(function(){
	  //for fields with "multiple" file support
	  //field name should be something like `myfile[]`

	  var files = $(this).data('ace_input_files');
	  if(files && files.length > 0) {
	     for(var f = 0; f < files.length; f++) {
	       fd.append('file', files[f]);
	    }
	  }
	});
console.log(fd);

		$.ajax({
				url: frm.attr('action'),
				data: fd,
				type: frm.attr('method'),
        processData: false,  // tell jQuery not to process the data
        contentType: false,  // tell jQuery not to set contentType
				success: function (data) {
					var mydata = JSON.parse(data);
					if(mydata == 1)
					{
						swal({
										title: "Success!",
										text: "Redirecting to employees in 2 seconds",
										timer: 2000,
										imageUrl: "<?php echo base_url();?>/assets/img/loading1.gif",
										showConfirmButton: false
									});
									setTimeout(function() {
										location.href = "<?php echo base_url();?>Admin/employees/";
									}, 2000);

					}
					}

		});
		ev.preventDefault();
	});
</script>

<script>
$().ready(function() {
	// validate signup form on keyup and submit
	$("#RegistrationForm").validate({
		rules: {
			password: {
				required: true,
				minlength: 5
			},
			confirm_password: {
				required: true,
				minlength: 5,
				equalTo: "#password"
			}
		},
		messages: {
			password: {
				required: "Please provide a password",
				minlength: "The password must be at least 5 characters long"
			},
			confirm_password: {
				required: "Please provide a password",
				minlength: "The password must be at least 5 characters long",
				equalTo: "Please enter the same password as above"
			}
		},
		submitHandler: function()
		{
			var frm = $('#RegistrationForm');
			$.ajax({
					type: frm.attr('method'),
					url: frm.attr('action'),
					data: frm.serialize(),
					beforeSend: function()
					{
						$("#register_text").html('Registering<img width="30" height="20" src="<?php echo base_url();?>assets/img/loading.gif"> ');
					},
					success: function (data)
					{
							$("#register_text").html('Register');
							if(data == 1)
							{
								swal({
									title: "Success!!",
									text: "Employee registered!",
									type: "success",
									confirmButtonText: "Ok"
								},
								function() {
									window.location.href = "<?php echo base_url();?>Admin/employees";
								});
							}
							else
							{
									swal({   title: "Error!!",   text: "Username already taken!",   type: "error",   confirmButtonText: "Ok" });
							}
					}
			});
			return false;
		}
	});

});
</script>


<!-- inline scripts related to this page -->
</body>

</html>
