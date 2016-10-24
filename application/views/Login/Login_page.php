<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Login - Abiva</title>

		<meta name="description" content="User login page" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="<?php echo base_url();?>assets/font-awesome/4.5.0/css/font-awesome.min.css" />

		<!-- text fonts -->
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/fonts.googleapis.com.css" />

		<!-- ace styles -->
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/ace.min.css" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="assets/css/ace-part2.min.css" />
		<![endif]-->
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/ace-rtl.min.css" />

		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/sweetalert.css">
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/select2.min.css" />
		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->

		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

		<!--[if lte IE 8]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
		<![endif]-->
	</head>

	<body class="login-layout light-login">
		<div class="main-container">
			<div class="main-content">
				<div class="row">
					<div class="col-sm-10 col-sm-offset-1">
						<div class="login-container">
							<div class="center">
								<h1>
									<i class="ace-icon fa fa-book green"></i>
									<span class="red">Online</span>
									<span class="black" id="id-text2" class="grey">Bulletin Board</span>
								</h1>
								<h4 class="blue" id="id-company-text" class="blue">&copy; ABIVA Publishing House Inc.</h4>
							</div>

							<div class="space-6"></div>
							<div class="space-6"></div>

							<div class="position-relative">
								<div id="login-box" class="login-box visible widget-box no-border">
									<div class="widget-body">
										<div class="widget-main">
											<h4 class="header blue lighter bigger">
												Please Enter Your Information
											</h4>

											<div class="space-6"></div>
											<div class="space-6"></div>

											<form id="LoginForm" action="<?php echo base_url();?>Login/doLogin" method="POST">
												<fieldset>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="text" class="form-control" name="username" placeholder="Username" id="loginusername" autofocus/>
															<i class="ace-icon fa fa-user"></i>
														</span>
													</label>

													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="password" class="form-control" name="password" placeholder="Password" />
															<i class="ace-icon fa fa-lock"></i>
														</span>
													</label>

													<div class="space"></div>


														<button type="submit" value="submit" class="width-35 pull-right btn btn-sm btn-primary">
															<i class="ace-icon fa fa-key"></i>
															<span class="bigger-110" id="login_text">Login</span>
														</button>
													</div>

													<div class="space-4"></div>
												</fieldset>
											</form>

											</div><!-- /.widget-main -->

										<div class="toolbar clearfix">
											<div>
												<a href="#" data-target="#forgot-box" class="forgot-password-link">
													<i class="ace-icon fa fa-arrow-left"></i>
													I forgot my password
												</a>
											</div>

											<div>
												<a href="#" data-target="#signup-box" class="user-signup-link">
													I want to register
													<i class="ace-icon fa fa-arrow-right"></i>
												</a>
											</div>
										</div>
									</div><!-- /.widget-body -->
								</div><!-- /.login-box -->

								<div id="forgot-box" class="forgot-box widget-box no-border">
									<div class="widget-body">
										<div class="widget-main">
											<h4 class="header red lighter bigger">
												<i class="ace-icon fa fa-key"></i>
												Retrieve Password
											</h4>

											<div class="space-6"></div>
											<p>
												Enter your email and to receive instructions
											</p>

											<form>
												<fieldset>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="email" class="form-control" placeholder="Email" />
															<i class="ace-icon fa fa-envelope"></i>
														</span>
													</label>

													<div class="clearfix">
														<button type="button" class="width-35 pull-right btn btn-sm btn-danger">
															<i class="ace-icon fa fa-lightbulb-o"></i>
															<span class="bigger-110">Send Me!</span>
														</button>
													</div>
												</fieldset>
											</form>
										</div><!-- /.widget-main -->

										<div class="toolbar center">
											<a href="#" data-target="#login-box" id="backtologin" class="back-to-login-link">
												Back to login
												<i class="ace-icon fa fa-arrow-right"></i>
											</a>
										</div>
									</div><!-- /.widget-body -->
								</div><!-- /.forgot-box -->

								<div id="signup-box" class="signup-box widget-box no-border">
									<div class="widget-body">
										<div class="widget-main">
											<h4 class="header green lighter bigger">
												<i class="ace-icon fa fa-users blue"></i>
												New User Registration
											</h4>

											<div class="space-6"></div>
											<p> Enter your details to begin: </p>

											<form id="RegistrationForm" action="<?php echo base_url();?>Login/doRegister" method="POST">
												<fieldset>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="text" class="form-control" placeholder="Username" name="username" required/>
															<i class="ace-icon fa fa-user"></i>
														</span>
													</label>

													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="text" class="form-control" placeholder="First name" name="firstname" required/>
															<i class="ace-icon fa fa-user"></i>
														</span>
													</label>

													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="text" class="form-control" placeholder="Middle name" name="middlename" required/>
															<i class="ace-icon fa fa-user"></i>
														</span>
													</label>

													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="text" class="form-control" placeholder="Last name" name="lastname" required/>
															<i class="ace-icon fa fa-user"></i>
														</span>
													</label>

													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<select class="js-example-basic-single form-control" style="width:100%" name="department" required>
																<?php foreach($departments as $d): ?>
																	<option value=""></option>
																	<option value="<?=$d->department_id?>"><?=$d->department_name?></option>
																<?php endforeach; ?>
															</select>
														</span>
													</label>

													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="password" class="form-control" placeholder="Password" id="password" name="password" required/>
															<i class="ace-icon fa fa-lock"></i>
														</span>
													</label>

													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="password" class="form-control" placeholder="Repeat password" id="confirm_password" name="confirm_password" required/>
															<i class="ace-icon fa fa-retweet"></i>
														</span>
													</label>

													<div class="space-24"></div>

													<div class="clearfix">
														<button type="reset" id="resetbutton" class="width-30 pull-left btn btn-sm">
															<i class="ace-icon fa fa-refresh"></i>
															<span class="bigger-110">Reset</span>
														</button>

														<button type="submit" value="submit" class="width-65 pull-right btn btn-sm btn-success">
															<span id="register_text" class="bigger-110">Register</span>

															<i class="ace-icon fa fa-arrow-right icon-on-right"></i>
														</button>
													</div>
												</fieldset>
											</form>
										</div>

										<div class="toolbar center">
											<a href="#" data-target="#login-box" class="back-to-login-link">
												<i class="ace-icon fa fa-arrow-left"></i>
												Back to login
											</a>
										</div>
									</div><!-- /.widget-body -->
								</div><!-- /.signup-box -->
							</div><!-- /.position-relative -->


						</div>
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /.main-content -->
		</div><!-- /.main-container -->

		<!-- basic scripts -->

		<!--[if !IE]> -->
		<script src="<?php echo base_url();?>assets/js/jquery-2.1.4.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/jquery.validate.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/sweetalert.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/select2.min.js"></script>
		<!-- <![endif]-->

		<!--[if IE]>
<script src="assets/js/jquery-1.11.3.min.js"></script>
<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='<?php echo base_url();?>assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>

		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			jQuery(function($) {
			 $(document).on('click', '.toolbar a[data-target]', function(e) {
				e.preventDefault();
				var target = $(this).data('target');
				$('.widget-box.visible').removeClass('visible');//hide others
				$(target).addClass('visible');//show target
			 });
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
					minlength: "Your password must be at least 5 characters long"
				},
				confirm_password: {
					required: "Please provide a password",
					minlength: "Your password must be at least 5 characters long",
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
								    document.getElementById("resetbutton").click();
								    document.getElementById("backtologin").click();
										document.getElementById("loginusername").focus();
									swal({   title: "Success!!",   text: "Registered successfully!",   type: "success",   confirmButtonText: "Ok" });
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

	<script>
	$().ready(function() {
		// validate signup form on keyup and submit
		$("#LoginForm").validate({
			rules: {
				username: {
					required: true
				},
				password: {
					required: true
				}
			},
			messages: {
				username: {
					required: "Please provide a username"
				},
				password: {
					required: "Please provide a password"
				}
			},
			submitHandler: function()
			{
				var frm = $('#LoginForm');
				$.ajax({
						type: frm.attr('method'),
						url: frm.attr('action'),
						data: frm.serialize(),
						beforeSend: function()
						{
							$("#login_text").html('<img width="30" height="20" src="<?php echo base_url();?>assets/img/myloading.gif"> ');
						},
						success: function (data)
						{
							console.log(data.success);
								$("#login_text").html('Login');
								if(data.success == 1)
								{
										swal({   title: "Success!",   text: "Redirecting in 2 seconds",   timer: 2000,   imageUrl: "<?php echo base_url();?>/assets/img/loading1.gif",    showConfirmButton: false });
										setTimeout(function(){ location.href = "<?php echo base_url();?>Admin/"; }, 2000);
								}
								else if(data.success == 2)
								{
										swal({   title: "Success!",   text: "Redirecting in 2 seconds",   timer: 2000,   imageUrl: "<?php echo base_url();?>/assets/img/loading1.gif",    showConfirmButton: false });
										setTimeout(function(){ location.href = "<?php echo base_url();?>User"; }, 2000);
								}
								else if(data == 3)
								{
										swal({   title: "Error!!",   text: "Wrong password",   type: "error",   confirmButtonText: "Ok" });
								}
								else if(data == 0)
								{
										swal({   title: "Error!!",   text: "User not found",   type: "error",   confirmButtonText: "Ok" });
								}
						},
						dataType:"json"
				});
				return false;
			}
		});

	});
	</script>

	<script type="text/javascript">
	$(document).ready(function() {
	  $(".js-example-basic-single").select2({
			placeholder:"Select department"
		});
	});
	</script>

	</body>
</html>
