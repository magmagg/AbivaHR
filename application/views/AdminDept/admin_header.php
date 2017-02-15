<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Header</title>

		<meta name="description" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="<?php echo base_url();?>assets/font-awesome/4.5.0/css/font-awesome.min.css" />

		<!-- page specific plugin styles -->
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/timeline.css" />
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/lightgallery.min.css" />
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/select2.min.css"  />
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/dropzone.min.css" />
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/sweetalert.css">
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/chosen.min.css" />
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/justifiedGallery.min.css" />
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/animate.css" />
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-datepicker3.min.css" />
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/video-js.css" />
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/pnotify.custom.min.css" />

		<!-- text fonts -->
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/fonts.googleapis.com.css" />

		<!-- ace styles -->
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="<?php echo base_url();?>assets/css/ace-part2.min.css" class="ace-main-stylesheet" />
		<![endif]-->
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/ace-skins.min.css" />
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/ace-rtl.min.css" />


		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/ace-ie.min.css" />
		<![endif]-->


		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

		<!--[if lte IE 8]>
		<script  src="<?php echo base_url(); ?>assets/js/html5shiv.min.js"></script>
		<script  src="<?php echo base_url(); ?>assets/js/respond.min.js"></script>
		<![endif]-->
	</head>


		<body class="no-skin">
			<div id="navbar" class="navbar navbar-default          ace-save-state">
				<div class="navbar-container ace-save-state" id="navbar-container">
					<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
						<span class="sr-only">Toggle sidebar</span>

						<span class="icon-bar"></span>

						<span class="icon-bar"></span>

						<span class="icon-bar"></span>
					</button>

					<div class="navbar-header pull-left">
						<a href="<?php echo base_url();?>AdminDeptDept" class="navbar-brand">
							<small>
								<i class="fa fa-book"></i>
								Online Bulletin Board
							</small>
						</a>
					</div>

					<div class="navbar-buttons navbar-header pull-right" role="navigation">
						<ul class="nav ace-nav">
							<li class="light-blue dropdown-modal">
								<a data-toggle="dropdown" href="#" class="dropdown-toggle">
									<img class="nav-user-photo"  alt="Alex's Avatar" src="<?php echo base_url().$this->session->userdata['picture'];?>" />
									<span class="user-info">
										<small>Welcome,</small>
										<?php echo  $this->session->userdata['user_name']; ?>
									</span>

									<i class="ace-icon fa fa-caret-down"></i>
								</a>

								<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">

									<li>
										<a href="<?php echo base_url();?>AdminDept/user_profile">
											<i class="ace-icon fa fa-user"></i>
											Profile
										</a>
									</li>


									<li class="divider"></li>

									<li>
										<a href="<?php echo base_url();?>Login/logout">
											<i class="ace-icon fa fa-power-off"></i>
											Logout
										</a>
									</li>
								</ul>
							</li>
						</ul>
					</div>
				</div><!-- /.navbar-container -->
			</div>

			<div class="main-container ace-save-state" id="main-container">
				<script type="text/javascript">
					try{ace.settings.loadState('main-container')}catch(e){}
				</script>

				<div id="sidebar" class="sidebar                  responsive                    ace-save-state">
					<script type="text/javascript">
						try{ace.settings.loadState('sidebar')}catch(e){}
					</script>

					<div class="sidebar-shortcuts" id="sidebar-shortcuts">
						<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
								<a class="btn btn-success" href="<?php echo base_url();?>AdminDept/announcements"> <i class="ace-icon fa fa-bullhorn"></i> </a>

								<a class="btn btn-info" href="<?php echo base_url();?>Chat"> <i class="ace-icon fa fa-envelope-o"></i> </a>

								<a class="btn btn-warning" href="<?php echo base_url();?>AdminDept/upload_files"> <i class="ace-icon fa fa-file"></i> </a>

								<a class="btn btn-danger" href="<?php echo base_url();?>AdminDept/gallery"> <i class="ace-icon fa fa-picture-o"></i> </a>
						</div>

						<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
							<a class="btn btn-success" href="<?php echo base_url();?>AdminDept/announcements"> <i class="ace-icon fa fa-bullhorn"></i> </a>

							<a class="btn btn-info" href="<?php echo base_url();?>Chat"> <i class="ace-icon fa fa-envelope-o"></i> </a>

							<a class="btn btn-warning" href="<?php echo base_url();?>AdminDept/upload_files"> <i class="ace-icon fa fa-file"></i> </a>

							<a class="btn btn-danger" href="<?php echo base_url();?>AdminDept/gallery"> <i class="ace-icon fa fa-picture-o"></i> </a>
						</div>
					</div><!-- /.sidebar-shortcuts -->

					<ul class="nav nav-list">
						<li class="<?= ($active_page == 'index') ? 'active':''; ?>">
							<a href="<?php echo base_url();?>AdminDept/index">
								<i class="menu-icon fa fa-dashboard"></i>
								<span class="menu-text"> Dashboard </span>
							</a>
						</li>

						<li class="<?= ($active_page == 'user_profile') ? 'active':''; ?>">
							<a href="<?php echo base_url();?>AdminDept/user_profile">
								<i class="menu-icon fa fa-user"></i>
								<span class="menu-text"> Profile </span>
							</a>
						</li>

						<li class="<?= ($active_page == 'messages') ? 'active':''; ?>">
							<a href="<?php echo base_url();?>Chat">
								<i class="menu-icon fa fa-envelope-o"></i>
								<span class="menu-text"> Messages </span>
								<?php if($ihasunread == 1): ?>
									<span class="badge badge-transparent tooltip-error" title="Unread messages">
										<i class="ace-icon fa fa-exclamation-triangle red bigger-130"></i>
									</span>
								<?php endif;?>
							</a>
						</li>


						<li class="<?= ($active_head == 'announcements') ? 'active open':''; ?>">
							<a href="#" class="dropdown-toggle">
								<i class="menu-icon fa fa-bullhorn"></i>

								<span class="menu-text">
									Announcements

								</span>

								<b class="arrow fa fa-angle-down"></b>
							</a>

							<b class="arrow"></b>

							<ul class="submenu">
								<li class=" <?= ($active_page == 'announcements') ? 'active ':''; ?>">
									<a href="<?php echo base_url();?>AdminDept/announcements">
										<i class="menu-icon fa fa-caret-right"></i>
										Create and Manage
									</a>

									<b class="arrow"></b>
								</li>

								<li class=" <?= ($active_page == 'view_announcements_by_dept') ? 'active':''; ?>">
									<a href="<?php echo base_url();?>AdminDept/view_announcements_by_dept">
										<i class="menu-icon fa fa-caret-right"></i>
										View Announcements
									</a>

									<b class="arrow"></b>
								</li>

							</ul>
						</li>

								<b class="arrow"></b>
							</li>

							<li class="<?= ($active_head == 'files') ? 'active open':''; ?>">
								<a href="#" class="dropdown-toggle">
									<i class="menu-icon fa fa-file-o"></i>

									<span class="menu-text">
										Files

									</span>

									<b class="arrow fa fa-angle-down"></b>
								</a>

								<b class="arrow"></b>

								<ul class="submenu">
									<li class=" <?= ($active_page == 'upload_files') ? 'active ':''; ?>">
										<a href="<?php echo base_url();?>AdminDept/upload_files">
											<i class="menu-icon fa fa-caret-right"></i>
											Upload files
										</a>

										<b class="arrow"></b>
									</li>

									<li class=" <?= ($active_page == 'view_files') ? 'active':''; ?>">
										<a href="<?php echo base_url();?>AdminDept/view_files">
											<i class="menu-icon fa fa-caret-right"></i>
											View files
										</a>

										<b class="arrow"></b>
									</li>

									<li class=" <?= ($active_page == 'view_shared_files') ? 'active':''; ?>">
										<a href="<?php echo base_url();?>AdminDept/view_shared_files">
											<i class="menu-icon fa fa-caret-right"></i>
											View shared files
										</a>

										<b class="arrow"></b>
									</li>

									<li class=" <?= ($active_page == 'view_archived_files') ? 'active':''; ?>">
										<a href="<?php echo base_url();?>AdminDept/view_archived_files">
											<i class="menu-icon fa fa-caret-right"></i>
											View archived files
										</a>

										<b class="arrow"></b>
									</li>

								</ul>
							</li>

									<b class="arrow"></b>
								</li>

								<li class="<?= ($active_page == 'policies') ? 'active':''; ?>">
									<a href="<?php echo base_url();?>AdminDept/policies">
										<i class="menu-icon fa fa-newspaper-o"></i>
										<span class="menu-text"> Policies </span>
									</a>

									<b class="arrow"></b>
								</li>

									<li class="<?= ($active_head == 'employees') ? 'active open':''; ?>">
										<a href="#" class="dropdown-toggle">
											<i class="menu-icon fa fa-user-plus"></i>

											<span class="menu-text">
												Employees

											</span>

											<b class="arrow fa fa-angle-down"></b>
										</a>

										<b class="arrow"></b>

										<ul class="submenu">
											<li class=" <?= ($active_page == 'employees') ? 'active ':''; ?>">
												<a href="<?php echo base_url();?>AdminDept/employees">
													<i class="menu-icon fa fa-caret-right"></i>
													View employees
												</a>

												<b class="arrow"></b>
											</li>

											<li class=" <?= ($active_page == 'add_employees') ? 'active':''; ?>">
												<a href="<?php echo base_url();?>AdminDept/add_employees">
													<i class="menu-icon fa fa-caret-right"></i>
													Add Employees
												</a>

												<b class="arrow"></b>
											</li>

										</ul>
									</li>

						<li class="<?= ($active_head == 'gallery') ? 'active open':''; ?>">
							<a href="#" class="dropdown-toggle">
								<i class="menu-icon fa fa-picture-o"></i>

								<span class="menu-text">
									Gallery

								</span>

								<b class="arrow fa fa-angle-down"></b>
							</a>

							<b class="arrow"></b>

							<ul class="submenu">
								<li class=" <?= ($active_page == 'gallery') ? 'active':''; ?>">
									<a href="<?php echo base_url();?>AdminDept/gallery">
										<i class="menu-icon fa fa-caret-right"></i>
										Gallery
									</a>

									<b class="arrow"></b>
								</li>

								<li class=" <?= ($active_page == 'videos') ? 'active':''; ?>">
									<a href="<?php echo base_url();?>AdminDept/videos">
										<i class="menu-icon fa fa-caret-right"></i>
										Videos
									</a>

									<b class="arrow"></b>
								</li>

								<li class=" <?= ($active_page == 'upload_pictures') ? 'active':''; ?>">
									<a href="<?php echo base_url();?>AdminDept/upload_pictures">
										<i class="menu-icon fa fa-caret-right"></i>
										Upload pictures
									</a>

									<b class="arrow"></b>
								</li>

								<li class=" <?= ($active_page == 'upload_videos') ? 'active':''; ?>">
									<a href="<?php echo base_url();?>AdminDept/upload_videos">
										<i class="menu-icon fa fa-caret-right"></i>
										Upload Videos
									</a>

									<b class="arrow"></b>
								</li>

							</ul>
						</li>

					</ul><!-- /.nav-list -->

					<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
						<i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
					</div>
				</div>

				<div class="main-content">
<!-- COMMENT STARTS HERE TO NAV SEARCH -->
					<div class="main-content-inner">
						<div class="breadcrumbs ace-save-state" id="breadcrumbs">
							<ul class="breadcrumb">
								<li>
									<i class="ace-icon fa fa-home home-icon"></i>
									<a href="#"><?=str_replace('_', ' ', ucwords($active_page));?></a>
								</li>


						</div>
						<!-- /.nav-search -->

<div class="page-content">
