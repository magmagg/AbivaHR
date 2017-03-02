<style>
	.autocomplete-suggestions {
		border: 1px solid #999;
		background: #FFF;
		overflow: auto;
	}

	.autocomplete-suggestion {
		padding: 2px 5px;
		white-space: nowrap;
		overflow: hidden;
	}

	.autocomplete-selected {
		background: #F0F0F0;
	}

	.autocomplete-suggestions strong {
		font-weight: normal;
		color: #3399FF;
	}

	.autocomplete-group {
		padding: 2px 5px;
	}

	.autocomplete-group strong {
		display: block;
		border-bottom: 1px solid #000;
	}
</style>
<div class="row">
	<div class="col-xs-12">
		<!-- PAGE CONTENT BEGINS -->
		<h3 class="header smaller lighter blue">Upload files</h3>
		<div class="col-md-6">
			<form action="<?php echo base_url();?>User/do_Upload_files" id="my-awesome-dropzone" method="POST" enctype="multipart/form-data" class="dropzone well">
				<input type="hidden" name="maindept" value="<?php echo $this->session->userdata['department'];?>" />
				<input type="hidden" name="foldername" id="foldername" />
				<input type="hidden" name="shareddept" id="shareddept" />
				<input type="hidden" name="team" id="team" value="1" />

				<!-- DROPZONE -->
				<div id="preview-template" class="hide">
					<div class="dz-preview dz-file-preview">
						<div class="dz-image">
							<img data-dz-thumbnail="" />
						</div>

						<div class="dz-details">
							<div class="dz-size">
								<span data-dz-size=""></span>
							</div>

							<div class="dz-filename">
								<span data-dz-name=""></span>
							</div>
						</div>

						<div class="dz-progress">
							<span class="dz-upload" data-dz-uploadprogress=""></span>
						</div>

						<div class="dz-error-message">
							<span data-dz-errormessage=""></span>
						</div>

						<div class="dz-success-mark">
							<span class="fa-stack fa-lg bigger-150">
	        												<i class="fa fa-circle fa-stack-2x white"></i>

	        												<i class="fa fa-check fa-stack-1x fa-inverse green"></i>
	        											</span>
						</div>

						<div class="dz-error-mark">
							<span class="fa-stack fa-lg bigger-150">
	        												<i class="fa fa-circle fa-stack-2x white"></i>

	        												<i class="fa fa-remove fa-stack-1x fa-inverse red"></i>
	        											</span>
						</div>

					</div>
				</div>

					<span class="help-block">*Maximum of 1Gb</span>
		</div>


		<div class="col-md-6">
			<div class="form-horizontal">
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Department:</label>
					<div class="col-sm-9">
						<?php foreach($departments as $d): ?>
						<?php if($this->session->userdata['department'] == $d->department_id)
								{
									$dept = $d->department_name;
								}
							?>
						<?php endforeach; ?>
						<input readonly="" type="text" class="col-xs-10 col-sm-5" id="form-input-readonly" value="<?php echo $dept;?>" />
					</div>
				</div>



				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Folder:</label>
					<div class="col-sm-9">
						<input type="text" placeholder="Folder name" name="foldername" id="autocomplete" style="width:100%" class="col-xs-10 col-sm-5 typeahead" required/>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Team:</label>
					<div class="col-sm-9">
						<select class="chosen-select form-control" id="form-field-select-3" data-placeholder="Team" required>
							<?php foreach($teams as $d): ?>
							<option value="<?=$d->teams_id?>">
								<?=$d->teams_name?>
							</option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>

<!--
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Shared with...:</label>
					<div class="col-sm-9">
						<select class="chosen-select form-control col-xs-10 col-sm-5 tag-input-style" id="my_select_box" data-placeholder="Shared with..." multiple>
							<option value=""></option>
							<?php foreach($departments as $d): ?>
								<?php if($this->session->userdata['department'] == $d->department_id):?>
								<?php else: ?>
							<option value="<?=$d->department_id?>">
								<?=$d->department_name?>
							</option>
						<?php endif;?>
							<?php endforeach; ?>
						</select>
						<button type="button" class="btn btn-minier selectall" name="Button" value="Select all">Select all</button>
						<button type="button" class="btn btn-minier selectnone" name="Button" value="Clear">Clear</button>
					</div>
				</div>

			-->
			</div>
		</div>

		<div class="col-md-offset-3 col-md-9">
			<button class="btn btn-info pull-right" type="submit" id="submit-button">
				<i class="ace-icon fa fa-check bigger-110"></i> Submit
			</button>
		</div>
		</form>

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
<script src="<?php echo base_url(); ?>assets/js/dropzone.min.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery.validate.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/chosen.jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/js/sweetalert.min.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery.autocomplete.min.js"></script>

<!-- ace scripts -->
<script src="<?php echo base_url(); ?>assets/js/ace-elements.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/ace.min.js"></script>

<!-- inline scripts related to this page -->


<script>
	$().ready(function() {
		Dropzone.options.myAwesomeDropzone = { // The camelized version of the ID of the form element
			// The configuration we've talked about above
			paramName: "file",
			autoProcessQueue: false,
			uploadMultiple: true,
			parallelUploads: 100,
			maxFiles: 100,
			addRemoveLinks: true,
			acceptedFiles: "image/*,.docx,.doc,.ppt,.pdf,.txt,.xls,.xlsx,.rar,.zip,.7z",
			previewTemplate: $('#preview-template').html(),

			thumbnailHeight: 120,
			thumbnailWidth: 120,
			maxFilesize: 10,

			//addRemoveLinks : true,
			//dictRemoveFile: 'Remove',

			dictDefaultMessage: '<span class="bigger-150 bolder"><i class="ace-icon fa fa-caret-right red"></i> Drop files</span> to upload \
				<span class="smaller-80 grey">(or click)</span> <br /> \
				<i class="upload-icon ace-icon fa fa-cloud-upload blue fa-3x"></i>',

			thumbnail: function(file, dataUrl) {
				if (file.previewElement) {
					$(file.previewElement).removeClass("dz-file-preview");
					var images = $(file.previewElement).find("[data-dz-thumbnail]").each(function() {
						var thumbnailElement = this;
						thumbnailElement.alt = file.name;
						thumbnailElement.src = dataUrl;
					});
					setTimeout(function() {
						$(file.previewElement).addClass("dz-image-preview");
					}, 1);
				}
			},

			// The setting up of the dropzone
			init: function() {



				var myDropzone = this;


				$("#submit-button").click(function(e) {

					if($.trim($('#autocomplete').val()) == '')
					{
					}
					else
					{
						var values= '';
						var i = 1;
						$('#my_select_box option:selected').each(function() {
							if(i == 1)
							{
								values += $(this).val();
							}
							else
							{
								values += ','+$(this).val();
							}
							console.log($(this).val()+i);
							i++;
							$("#shareddept").val(values);
						});
						var box1 = $('#autocomplete');
						var box2 = $('#foldername');
						box2.val(box1.val());

						e.preventDefault();
						e.stopPropagation();
						myDropzone.processQueue();
					}
				});

				// Listen to the sendingmultiple event. In this case, it's the sendingmultiple event instead
				// of the sending event because uploadMultiple is set to true.
				this.on("sendingmultiple", function() {
					// Gets triggered when the form is actually being sent.
					// Hide the success button or the complete form.
				});
				this.on("successmultiple", function(files, response) {
					swal({
						title: "Success!",
						text: "Redirecting to folders in 2 seconds",
						timer: 2000,
						imageUrl: "<?php echo base_url();?>/assets/img/loading1.gif",
						showConfirmButton: false
					});
					setTimeout(function() {
						location.href = "<?php echo base_url();?>User/view_files/";
					}, 2000);

					// Gets triggered when the files have successfully been sent.
					// Redirect user or notify of success.
					console.log(response);
				});
				this.on("errormultiple", function(files, response) {
					console.log(response);
					// Gets triggered when there was an error sending the files.
					// Maybe show form again, and notify user of error
				});
			}

		}
	});
</script>

<script>
	$(".selectall").click(function() {
		$('#my_select_box option').prop('selected', true);
		$('#my_select_box').trigger('chosen:updated');
	});
	$(".selectnone").click(function() {
		$('#my_select_box option:selected').removeAttr('selected');
		$('#my_select_box').trigger('chosen:updated');
	});
</script>
<script>
	if (!ace.vars['touch']) {
		$('.chosen-select').chosen({
			allow_single_deselect: true
		});
		//resize the chosen on window resize

		$(window)
			.off('resize.chosen')
			.on('resize.chosen', function() {
				$('.chosen-select').each(function() {
					var $this = $(this);
					$this.next().css({
						'width': $this.parent().width()
					});
				})
			}).trigger('resize.chosen');
		//resize chosen on sidebar collapse/expand
		$(document).on('settings.ace.chosen', function(e, event_name, event_val) {
			if (event_name != 'sidebar_collapsed') return;
			$('.chosen-select').each(function() {
				var $this = $(this);
				$this.next().css({
					'width': $this.parent().width()
				});
			})
		});
	}
</script>
<script>
	var folders = <?php echo json_encode($foldernew); ?>;
	var newfolders = [];
	for (var i = 0; i < folders.length; i++) {

		newfolders.push(folders[i].ffolder_name);

	}
	$('#autocomplete').autocomplete({
	lookup: newfolders
	});
</script>

<script>
	$('#form-field-select-3').on('change', function() {
		$("#team").val(this.value);

	});
</script>


</body>

</html>
