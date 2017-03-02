<div class="row">
							<div class="col-xs-12">
								<h3 class="header smaller lighter blue">Teams</h3>
								<!-- PAGE CONTENT BEGINS -->
								<?php foreach($teams as $t):?>
									<ul>
											<strong><?=$t->teams_name;?></strong>
											<?php foreach($employees as $e):?>
												<?php if($e->user_id == 41):?>
												<?php else:?>
												<?php if($e->user_teams_id_fk == $t->teams_id):?>
													<li>
														<?=$e->user_lastname?>, <?=$e->user_firstname?> <?=$e->user_middlename?>
													</li>
												<?php endif;?>
												<?php endif; ?>
											<?php endforeach;?>
									</ul>
								<?php endforeach;?>

								<!-- PAGE CONTENT ENDS -->
								    </div>
									</div>



							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
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
			<!-- ace scripts -->
			<script src="<?php echo base_url(); ?>assets/js/ace-elements.min.js"></script>
			<script src="<?php echo base_url(); ?>assets/js/ace.min.js"></script>

			<script src="<?php echo base_url();?>assets/js/sweetalert.min.js"></script>
			<script src="<?php echo base_url();?>assets/js/jquery.validate.min.js"></script>

			<!-- inline scripts related to this page -->

			</body>

			</html>
