<style>
.place {background-color: #336699; }
.place:hover, .place.gray
{
	background-color: #DADFE1;
	text-decoration:line-through;
}
#result_location span {
    display: none;
}
</style>

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->

								<div class="row">
									<div class="col-xs-12">
										<!-- PAGE CONTENT BEGINS -->
										<div class="col-xs-8">
											<div class="widget-box">
											<div class="widget-body">
												<div class="widget-main padding-4">
													<div class="tab-content padding-8">
														<form action="<?php echo base_url();?>Admin/submit_todolist" method="POST">
															<div id="task-tab" class="tab-pane active">
																<h4 class="smaller lighter green">
								    																<i class="ace-icon fa fa-list"></i>
								    																My To Do List
								    															</h4>

																<ul class="item-orange clearfix">
																	<label class="inline">
																		<input type="text" name="title" class="ace" />
																		<span class="lbl"> Add task</span>
																	</label>

																	<div class="pull-right easy-pie-chart percentage" data-size="30" data-color="#ECCB71" data-percent="42">
																		<button class="btn btn-info" type="submit" id="submit-button">Add </button>
																	</div>
																</ul>
														</form>

														<?php foreach($todolist as $l): ?>
															<?php if($l->todo_isfinished == 0):		?>

														<ul id="tasks" class="item-list">
															<li class="item-red clearfix place" id="todo<?=$l->todo_id?>">
																<label class="inline">
																	<div id="result_location" class="todo<?=$l->todo_id?>">
																	<div class="lbl" id="toggle<?=$l->todo_id?>"> <?=$l->todo_title?>
																		<span class="label label-success arrowed">Finished</span>
																	</div>

																</div>
																</label>


																<div class="pull-right action-buttons">
																	<button class="btn btn-xs btn-danger" type="button" onclick="foo(<?=$l->todo_id?>)"><i class="ace-icon fa fa-trash-o bigger-120"></i></button>

																	<span class="vbar"></span>

																	</div>
															</li>

														</ul>
													<?php else: ?>
														<ul id="tasks" class="item-list">
															<li class="item-red clearfix place finished" id="todo<?=$l->todo_id?>">
																<label class="inline">
																	<div id="result_location" class="todo<?=$l->todo_id?>">
																	<div class="lbl" id="toggle<?=$l->todo_id?>"> <?=$l->todo_title?>
																		<span class="label label-success arrowed">Finished</span>
																	</div>

																</div>
																</label>


																<div class="pull-right action-buttons">
																	<button class="btn btn-xs btn-danger" type="button" onclick="foo(<?=$l->todo_id?>)"><i class="ace-icon fa fa-trash-o bigger-120"></i></button>

																	<span class="vbar"></span>

																	</div>
															</li>

														</ul>
													<?php endif ?>
														<?php endforeach; ?>
														</div>
													</div>
												</div>
											</div>
								    </div>
									</div>

										<div class="row">
																	<div class="col-sm-4">
																		<div class="widget-box">
																			<div class="widget-header widget-header-flat">
																				<h4 class="widget-title smaller">
																					<i class="ace-icon fa fa-quote-left smaller-80"></i>
																					BlockQuote & Address
																				</h4>
																			</div>

																			<div class="widget-body">
																				<div class="widget-main">
																					<div class="row">
																						<div class="col-xs-12">
																							<blockquote class="pull-right">
																								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>

																								<small>
																									Someone famous
																									<cite title="Source Title">Source Title</cite>
																								</small>
																							</blockquote>
																						</div>
																					</div>

																					<div class="row">
																						<div class="col-xs-12">
																							<blockquote>
																								<p class="lighter line-height-125">
																									Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.
																								</p>

																								<small>
																									Someone famous
																									<cite title="Source Title">Source Title</cite>
																								</small>
																							</blockquote>
																						</div>
																					</div>

																					<hr />
																					<address>
																						<strong>Twitter, Inc.</strong>

																						<br />
																						795 Folsom Ave, Suite 600
																						<br />
																						San Francisco, CA 94107
																						<br />
																						<abbr title="Phone">P:</abbr>
																						(123) 456-7890
																					</address>

																					<address>
																						<strong>Full Name</strong>

																						<br />
																						<a href="mailto:#">first.last@example.com</a>
																					</address>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
									
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
							<span class="blue bolder">Ace</span>
							Application &copy; 2013-2014
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
		</div><!-- /.main-container -->

		<!-- basic scripts -->

		<!--[if !IE]> -->
		<script src="<?php echo base_url(); ?>assets/js/jquery-2.1.4.min.js"></script>

		<!-- <![endif]-->

		<!--[if IE]>
<script src="<?php echo base_url(); ?>assets/js/jquery-1.11.3.min.js"></script>
<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>

		<!-- page specific plugin scripts -->
		<script src="<?php echo base_url(); ?>assets/js/pnotify.custom.min.js"></script>
		<!-- ace scripts -->
		<script src="<?php echo base_url(); ?>assets/js/ace-elements.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace.min.js"></script>

		<!-- inline scripts related to this page -->
		<script>
		$( document ).ready(function() {
					 $($(".finished")).toggleClass("gray");
					 $.each($('.finished'), function() {
				 $("."+this.id+" span").toggle();
		 });
		});
		</script>
		<script>
		$(".place").click(function () {
		var id = $(this).attr("id");


			   $(this).toggleClass("gray");
			  $("."+id+" span").toggle();
				var value = id.substring('todo'.length);
				var link =  "<?php echo base_url();?>Admin/process_todo/" + value;
				$.ajax({
						type: "POST",
						url: link,
						success: function (msg)
						{

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
								url: "<?php echo base_url();?>Admin/delete_one_todo/" + id,
								success: function(data) {

									$('#todo' + id).fadeOut('slow', function() {
										$("#todo" + id).remove();
									});
									swal("Deleted!", "Item has been deleted.", "success");
								}
							});
						} else {}
					});
			}
		</script>
		<?=$this->session->flashdata('notify');?>
	</body>
</html>
