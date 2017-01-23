

<div class="hr dotted"></div>

<?php foreach($userDetails as $u):?>

<div>
	<div id="user-profile-1" class="user-profile row">
		<div class="col-xs-12 col-sm-3 center">
			<div>
				<span class="profile-picture">
													<img id="avatar" class="editable img-responsive" alt="Alex's Avatar" src="<?php echo base_url().$u->user_picture ?>" />
												</span>

				<div class="space-4"></div>

				<div class="width-80 label label-info label-xlg arrowed-in arrowed-in-right">
					<div class="inline position-relative">
						<a href="#" class="user-title-label dropdown-toggle" data-toggle="dropdown">
							<i class="ace-icon fa fa-circle light-green"></i> &nbsp;
							<span class="white">
  																<span><?php echo $u->user_firstname; ?></span>
							<span><?php echo $u->user_lastname; ?></span>
							</span>
						</a>
					</div>
				</div>
			</div>

			<div class="space-6"></div>

			<div class="profile-contact-info">
				<div class="profile-contact-links align-center">

					<a href="#" class="btn btn-link">
						<i class="ace-icon fa fa-envelope bigger-120 pink"></i> Send a message
					</a>

					<div class="profile-social-links align-center">
						<span class="btn btn-danger btn-sm popover-error" data-rel="popover" data-placement="left" data-original-title="<i class='ace-icon fa fa-google-plus red'></i> Google+" data-content="<input type='text' placeholder='Visit my Google+ account' value='<?php echo $u->user_google?>' readonly></input>">
														<i class="middle ace-icon fa fa-google-plus fa-2x "></i>
													</span>

						<span class="btn btn-primary btn-sm popover-blue" data-rel="popover" data-placement="bottom" data-original-title="<i class='ace-icon fa fa-linkedin-square blue'></i> Linkedin" data-content="<input type='text' placeholder='Visit my Linkedin account' value='<?php echo $u->user_linkedin; ?>' readonly></input>">
													<i class="middle ace-icon fa fa-linkedin-square fa-2x "></i>
												</span>

						<span class="btn btn-default btn-sm popover-default" data-rel="popover" data-placement="right" data-original-title="<i class='ace-icon fa fa-wordpress'></i> Wordpress" data-content="<input type='text' placeholder='Visit my Wordpress account' value='<?php echo $u->user_wordpress; ?>' readonly></input>">
												<i class="middle ace-icon fa fa-wordpress fa-2x "></i>
											</span>
					</div>
				</div>
			</div>




			<div class="clearfix"></div>
		</div>

		<div class="col-xs-12 col-sm-9">


			<div class="space-12"></div>

			<div class="profile-user-info profile-user-info-striped">
				<div class="profile-info-row">
					<div class="profile-info-name"> Username </div>

					<div class="profile-info-value">
						<span><?php echo $u->user_username; ?></span>
					</div>
				</div>

				<div class="profile-info-row">
					<div class="profile-info-name"> Name </div>

					<div class="profile-info-value">
						<span>
							<?php echo $u->user_firstname; ?>&nbsp;
							<?php echo $u->user_middlename; ?>&nbsp;
							<?php echo $u->user_lastname; ?>
						</span>
					</div>
				</div>

				<div class="profile-info-row">
					<div class="profile-info-name"> Employee ID </div>

					<div class="profile-info-value">
						<span><?php echo $u->user_id; ?></span>
					</div>
				</div>

				<div class="profile-info-row">
					<div class="profile-info-name"> Email Address </div>

					<div class="profile-info-value">
						<span><?php echo $u->user_email; ?></span>
					</div>
				</div>

				<div class="profile-info-row">
					<div class="profile-info-name"> Address </div>

					<div class="profile-info-value">
						<span><?php echo $u->user_address; ?></span>
					</div>
				</div>

				<div class="profile-info-row">
					<div class="profile-info-name"> Phone </div>

					<div class="profile-info-value">
						<span><?php echo $u->user_cpnumber; ?></span>
					</div>
				</div>

				<div class="profile-info-row">
					<div class="profile-info-name"> Birthday </div>

					<div class="profile-info-value">
						<span><?php echo $u->user_birthday; ?></span>
					</div>
				</div>


			</div>

			<div class="space-20"></div>

			<div class="widget-box transparent">
				<div class="widget-header widget-header-small">
					<h4 class="widget-title blue smaller">
															<i class="ace-icon fa fa-check-square-o bigger-110"></i>
															About Me
													</h4>
					<div class="well well-lg">
						<div class="widget-body">
							<div class="widget-main">
								<p>
									<?php echo $u->user_aboutme; ?>
								</p>
							</div>
						</div>

					</div>
				</div>
			</div>

<?php endforeach;?>
			<!-- /.span -->
		</div>
		<!-- /.user-profile -->
	</div>

	<!-- PAGE CONTENT ENDS -->
</div>
<!-- /.col -->


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
<script src="<?php echo base_url();?>assets/js/jquery-2.1.4.min.js"></script>

<!-- <![endif]-->

<!--[if IE]>
		<script src="<?php echo base_url();?>assets/js/jquery-1.11.3.min.js"></script>
		<![endif]-->
<script type="text/javascript">
	if ('ontouchstart' in document.documentElement) document.write("<script src='<?php echo base_url();?>assets/js/jquery.mobile.custom.min.js'>" + "<" + "/script>");
</script>
<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>

<!-- page specific plugin scripts -->

<!--[if lte IE 8]>
				  <script src="<?php echo base_url();?>assets/js/excanvas.min.js"></script>
				<![endif]-->
<script src="<?php echo base_url();?>assets/js/jquery-ui.custom.min.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery.ui.touch-punch.min.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery.gritter.min.js"></script>
<script src="<?php echo base_url();?>assets/js/bootbox.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery.easypiechart.min.js"></script>
<script src="<?php echo base_url();?>assets/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery.hotkeys.index.min.js"></script>
<script src="<?php echo base_url();?>assets/js/select2.min.js"></script>
<script src="<?php echo base_url();?>assets/js/spinbox.min.js"></script>
<script src="<?php echo base_url();?>assets/js/bootstrap-editable.min.js"></script>
<script src="<?php echo base_url();?>assets/js/ace-editable.min.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery.maskedinput.min.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery.validate.min.js"></script>
<script src="<?php echo base_url();?>assets/js/sweetalert.min.js"></script>


<!-- ace scripts -->
<script src="<?php echo base_url();?>assets/js/ace-elements.min.js"></script>
<script src="<?php echo base_url();?>assets/js/ace.min.js"></script>

<!-- inline scripts related to this page
		<script>
			$().ready(function() {
				// validate signup form on keyup and submit
				$("#userprofile").validate({
					rules: {
						username: {
							required: true,
						},
						firstname: {
							required: true
						},
						middlename: {
							required: true
						},
						lastname: {
							required: true
						},
						email: {
							required: true
						}
					},
					messages: {
						username: {
							required: "This field is required",
						},
						firstname: {
							required: "This field is required",
						},
						middlename: {
							required: "This field is required",
						},
						lastname: {
							required: "This field is required",
						},
						email: {
							required: "This field is required",
						}

					},
					submitHandler: function() {
						var frm = $('#userprofile');
						$.ajax({
							type: frm.attr('method'),
							url: frm.attr('action'),
							data: frm.serialize(),
							beforeSend: function() {
								//id of button #register_text
								$("#submit_profile").html('Saving<img width="30" height="20" src="<?php echo base_url();?>assets/img/loading.gif"> ');
							},
							success: function(data) {
								$("#submit_profile").html('Save');
								if (data == 1) {
									swal({
											title: "Success!!",
											text: "Click back to login to continue!",
											type: "success",
											confirmButtonText: "Ok"
										},
										function() {
											window.location.href = "<?php echo base_url();?>Admin/user_profile";
										});
								} else {
									swal({
										title: "Error!!",
										text: "Username already taken!",
										type: "error",
										confirmButtonText: "Ok"
									});
								}
							},
							dataType: "json"
						});
						return false;
					}
				});

			});
		</script>
	-->

<script>
	$().ready(function() {
		// validate signup form on keyup and submit
		$("#change_password").validate({
			rules: {
				oldpassword: {
					required: true,
					minlength: 5
				},
				newpassword: {
					required: true,
					minlength: 5,

				},
				cpassword: {
					required: true,
					equalTo: "#newpassword"
				}
			},
			messages: {
				password: {
					required: "Please provide a password",
					minlength: "Your password must be at least 5 characters long"
				},
				newpassword: {
					required: "Please provide a password",
					minlength: "Your password must be at least 5 characters long"

				},
				cpassword: {
					required: "Please provide a password",
					equalTo: "Please enter the same password as above"
				}
			},
			submitHandler: function() {
				var frm = $('#change_password');
				$.ajax({
					type: frm.attr('method'),
					url: frm.attr('action'),
					data: frm.serialize(),
					beforeSend: function() {
						$("#submit_password").html('Saving<img width="30" height="20" src="<?php echo base_url();?>assets/img/loading.gif"> ');
					},
					success: function(data) {
						$("#submit_password").html('Save');
						if (data == 1) {

							document.getElementById("resetpassword").click();
							swal({
								title: "Success!!",
								text: "Password has been updated!",
								type: "success",
								confirmButtonText: "Ok"
							});
						} else if (data == 0) {
							swal({
								title: "Error!!",
								text: "Wrong password!",
								type: "error",
								confirmButtonText: "Ok"
							});
						} else if (data == 2) {
							swal({
								title: "Error!!",
								text: "New password cannot be the same as old password!",
								type: "error",
								confirmButtonText: "Ok"
							});
						}
					}
				});
				return false;
			}
		});

	});
</script>

<script>
	$("document").ready(function() {

		$("#picture").change(function() {
			$("#check").val(1);
		});
	});
</script>

<script>
	jQuery(function($) {

		$('[data-rel=tooltip]').tooltip();
		$('[data-rel=popover]').popover({
			html: true
		});
	});
</script>

<script type="text/javascript">
	jQuery(function($) {
		//editables on first profile page
		$.fn.editable.defaults.mode = 'inline';
		$.fn.editableform.loading = "<div class='editableform-loading'><i class='ace-icon fa fa-spinner fa-spin fa-2x light-blue'></i></div>";
		$.fn.editableform.buttons = '<button type="submit" class="btn btn-info editable-submit"><i class="ace-icon fa fa-check"></i></button>' +
			'<button type="button" class="btn editable-cancel"><i class="ace-icon fa fa-times"></i></button>';
		//editables
		//text editable
		$('#sadifhiasdfhasdjfknadskfjasdfkjhas')
			.editable({
				type: 'text',
				name: 'username'
			});
		//select2 editable
		var countries = [];
		$.each({
			"CA": "Canada",
			"IN": "India",
			"NL": "Netherlands",
			"TR": "Turkey",
			"US": "United States"
		}, function(k, v) {
			countries.push({
				id: k,
				text: v
			});
		});
		var cities = [];
		cities["CA"] = [];
		$.each(["Toronto", "Ottawa", "Calgary", "Vancouver"], function(k, v) {
			cities["CA"].push({
				id: v,
				text: v
			});
		});
		cities["IN"] = [];
		$.each(["Delhi", "Mumbai", "Bangalore"], function(k, v) {
			cities["IN"].push({
				id: v,
				text: v
			});
		});
		cities["NL"] = [];
		$.each(["Amsterdam", "Rotterdam", "The Hague"], function(k, v) {
			cities["NL"].push({
				id: v,
				text: v
			});
		});
		cities["TR"] = [];
		$.each(["Ankara", "Istanbul", "Izmir"], function(k, v) {
			cities["TR"].push({
				id: v,
				text: v
			});
		});
		cities["US"] = [];
		$.each(["New York", "Miami", "Los Angeles", "Chicago", "Wysconsin"], function(k, v) {
			cities["US"].push({
				id: v,
				text: v
			});
		});
		var currentValue = "NL";
		$('#country').editable({
			type: 'select2',
			value: 'NL',
			//onblur:'ignore',
			source: countries,
			select2: {
				'width': 140
			},
			success: function(response, newValue) {
				if (currentValue == newValue) return;
				currentValue = newValue;
				var new_source = (!newValue || newValue == "") ? [] : cities[newValue];
				//the destroy method is causing errors in x-editable v1.4.6+
				//it worked fine in v1.4.5
				/**
				$('#city').editable('destroy').editable({
					type: 'select2',
					source: new_source
				}).editable('setValue', null);
				*/
				//so we remove it altogether and create a new element
				var city = $('#city').removeAttr('id').get(0);
				$(city).clone().attr('id', 'city').text('Select City').editable({
					type: 'select2',
					value: null,
					//onblur:'ignore',
					source: new_source,
					select2: {
						'width': 140
					}
				}).insertAfter(city); //insert it after previous instance
				$(city).remove(); //remove previous instance
			}
		});
		$('#city').editable({
			type: 'select2',
			value: 'Amsterdam',
			//onblur:'ignore',
			source: cities[currentValue],
			select2: {
				'width': 140
			}
		});
		//custom date editable
		$('#signup').editable({
			type: 'adate',
			date: {
				//datepicker plugin options
				format: 'yyyy/mm/dd',
				viewformat: 'yyyy/mm/dd',
				weekStart: 1
					//,nativeUI: true//if true and browser support input[type=date], native browser control will be used
					//,format: 'yyyy-mm-dd',
					//viewformat: 'yyyy-mm-dd'
			}
		})
		$('#age').editable({
			type: 'spinner',
			name: 'age',
			spinner: {
				min: 16,
				max: 99,
				step: 1,
				on_sides: true
					//,nativeUI: true//if true and browser support input[type=number], native browser control will be used
			}
		});
		$('#login').editable({
			type: 'slider',
			name: 'login',
			slider: {
				min: 1,
				max: 50,
				width: 100
					//,nativeUI: true//if true and browser support input[type=range], native browser control will be used
			},
			success: function(response, newValue) {
				if (parseInt(newValue) == 1)
					$(this).html(newValue + " hour ago");
				else $(this).html(newValue + " hours ago");
			}
		});
		$('#about').editable({
			mode: 'inline',
			type: 'wysiwyg',
			name: 'about',
			wysiwyg: {
				//css : {'max-width':'300px'}
			},
			success: function(response, newValue) {}
		});
		// *** editable avatar *** //
		try { //ie8 throws some harmless exceptions, so let's catch'em
			//first let's add a fake appendChild method for Image element for browsers that have a problem with this
			//because editable plugin calls appendChild, and it causes errors on IE at unpredicted points
			try {
				document.createElement('IMG').appendChild(document.createElement('B'));
			} catch (e) {
				Image.prototype.appendChild = function(el) {}
			}
			var last_gritter
			$('#avatar').editable({
				type: 'image',
				name: 'avatar',
				value: null,
				//onblur: 'ignore',  //don't reset or hide editable onblur?!
				image: {
					//specify ace file input plugin's options here
					btn_choose: 'Change Avatar',
					droppable: true,
					maxSize: 110000, //~100Kb
					//and a few extra ones here
					name: 'avatar', //put the field name here as well, will be used inside the custom plugin
					on_error: function(error_type) { //on_error function will be called when the selected file has a problem
						if (last_gritter) $.gritter.remove(last_gritter);
						if (error_type == 1) { //file format error
							last_gritter = $.gritter.add({
								title: 'File is not an image!',
								text: 'Please choose a jpg|gif|png image!',
								class_name: 'gritter-error gritter-center'
							});
						} else if (error_type == 2) { //file size rror
							last_gritter = $.gritter.add({
								title: 'File too big!',
								text: 'Image size should not exceed 100Kb!',
								class_name: 'gritter-error gritter-center'
							});
						} else { //other error
						}
					},
					on_success: function() {
						$.gritter.removeAll();
					}
				},
				url: function(params) {
					// ***UPDATE AVATAR HERE*** //
					//for a working upload example you can replace the contents of this function with
					//examples/profile-avatar-update.js
					var deferred = new $.Deferred
					var value = $('#avatar').next().find('input[type=hidden]:eq(0)').val();
					if (!value || value.length == 0) {
						deferred.resolve();
						return deferred.promise();
					}
					//dummy upload
					setTimeout(function() {
						if ("FileReader" in window) {
							//for browsers that have a thumbnail of selected image
							var thumb = $('#avatar').next().find('img').data('thumb');
							if (thumb) $('#avatar').get(0).src = thumb;
						}
						deferred.resolve({
							'status': 'OK'
						});
						if (last_gritter) $.gritter.remove(last_gritter);
						last_gritter = $.gritter.add({
							title: 'Avatar Updated!',
							text: 'Uploading to server can be easily implemented. A working example is included with the template.',
							class_name: 'gritter-info gritter-center'
						});
					}, parseInt(Math.random() * 800 + 800))
					return deferred.promise();
					// ***END OF UPDATE AVATAR HERE*** //
				},
				success: function(response, newValue) {}
			})
		} catch (e) {}
		/**
		//let's display edit mode by default?
		var blank_image = true;//somehow you determine if image is initially blank or not, or you just want to display file input at first
		if(blank_image) {
			$('#avatar').editable('show').on('hidden', function(e, reason) {
				if(reason == 'onblur') {
					$('#avatar').editable('show');
					return;
				}
				$('#avatar').off('hidden');
			})
		}
		*/
		//another option is using modals
		$('#avatar2').on('click', function() {
			var modal =
				'<div class="modal fade">\
							  <div class="modal-dialog">\
							   <div class="modal-content">\
								<div class="modal-header">\
									<button type="button" class="close" data-dismiss="modal">&times;</button>\
										<h4 class="blue">Change Avatar</h4>\
								</div>\
								\
								<form class="no-margin">\
								 <div class="modal-body">\
									<div class="space-4"></div>\
									<div style="width:75%;margin-left:12%;"><input type="file" name="file-input" /></div>\
								 </div>\
								\
								 <div class="modal-footer center">\
									<button type="submit" class="btn btn-sm btn-success"><i class="ace-icon fa fa-check"></i> Submit</button>\
									<button type="button" class="btn btn-sm" data-dismiss="modal"><i class="ace-icon fa fa-times"></i> Cancel</button>\
								 </div>\
								</form>\
							  </div>\
							 </div>\
							</div>';
			var modal = $(modal);
			modal.modal("show").on("hidden", function() {
				modal.remove();
			});
			var working = false;
			var form = modal.find('form:eq(0)');
			var file = form.find('input[type=file]').eq(0);
			file.ace_file_input({
				style: 'well',
				btn_choose: 'Click to choose new avatar',
				btn_change: null,
				no_icon: 'ace-icon fa fa-picture-o',
				thumbnail: 'small',
				before_remove: function() {
					//don't remove/reset files while being uploaded
					return !working;
				},
				allowExt: ['jpg', 'jpeg', 'png', 'gif'],
				allowMime: ['image/jpg', 'image/jpeg', 'image/png', 'image/gif']
			});
			form.on('submit', function() {
				if (!file.data('')) return false;
				file.ace_file_input('disable');
				form.find('button').attr('disabled', 'disabled');
				form.find('.modal-body').append("<div class='center'><i class='ace-icon fa fa-spinner fa-spin bigger-150 orange'></i></div>");
				var deferred = new $.Deferred;
				working = true;
				deferred.done(function() {
					form.find('button').removeAttr('disabled');
					form.find('input[type=file]').ace_file_input('enable');
					form.find('.modal-body > :last-child').remove();
					modal.modal("hide");
					var thumb = file.next().find('img').data('thumb');
					if (thumb) $('#avatar2').get(0).src = thumb;
					working = false;
				});
				setTimeout(function() {
					deferred.resolve();
				}, parseInt(Math.random() * 800 + 800));
				return false;
			});
		});
		//////////////////////////////
		$('#profile-feed-1').ace_scroll({
			height: '250px',
			mouseWheelLock: true,
			alwaysVisible: true
		});
		$('a[ data-original-title]').tooltip();
		$('.easy-pie-chart.percentage').each(function() {
			var barColor = $(this).data('color') || '#555';
			var trackColor = '#E2E2E2';
			var size = parseInt($(this).data('size')) || 72;
			$(this).easyPieChart({
				barColor: barColor,
				trackColor: trackColor,
				scaleColor: false,
				lineCap: 'butt',
				lineWidth: parseInt(size / 10),
				animate: false,
				size: size
			}).css('color', barColor);
		});
		///////////////////////////////////////////
		//right & left position
		//show the user info on right or left depending on its position
		$('#user-profile-2 .memberdiv').on('mouseenter touchstart', function() {
			var $this = $(this);
			var $parent = $this.closest('.tab-pane');
			var off1 = $parent.offset();
			var w1 = $parent.width();
			var off2 = $this.offset();
			var w2 = $this.width();
			var place = 'left';
			if (parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2)) place = 'right';
			$this.find('.popover').removeClass('right left').addClass(place);
		}).on('click', function(e) {
			e.preventDefault();
		});
		///////////////////////////////////////////
		$('#user-profile-3')
			.find('input[type=file]').ace_file_input({
				style: 'well',
				btn_choose: 'Change avatar',
				btn_change: null,
				no_icon: 'ace-icon fa fa-picture-o',
				thumbnail: 'large',
				droppable: true,
				allowExt: ['jpg', 'jpeg', 'png', 'gif'],
				allowMime: ['image/jpg', 'image/jpeg', 'image/png', 'image/gif']
			})
			.end().find('button[type=reset]').on(ace.click_event, function() {
				$('#user-profile-3 input[type=file]').ace_file_input('reset_input');
			})
			.end().find('.date-picker').datepicker().next().on(ace.click_event, function() {
				$(this).prev().focus();
			})
		$('.input-mask-phone').mask('99999999999');
		$('#user-profile-3').find('input[type=file]').ace_file_input('show_file_list', [{
			type: 'image',
			name: $('#avatar').attr('src')
		}]);
		////////////////////
		//change profile
		$('[data-toggle="buttons"] .btn').on('click', function(e) {
			var target = $(this).find('input[type=radio]');
			var which = parseInt(target.val());
			$('.user-profile').parent().addClass('hide');
			$('#user-profile-' + which).parent().removeClass('hide');
		});
		/////////////////////////////////////
		$(document).one('ajaxloadstart.page', function(e) {
			//in ajax mode, remove remaining elements before leaving page
			try {
				$('.editable').editable('destroy');
			} catch (e) {}
			$('[class*=select2]').remove();
		});
	});
</script>
</body>

</html>
