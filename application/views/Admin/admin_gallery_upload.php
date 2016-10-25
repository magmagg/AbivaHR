<div class="row">
	<div class="col-xs-12">
		<style>
			#the-basics {
				position: absolute;
				top: 60px;
				left: 85px;
				width: 150px;
				height: 30px;
			}
		</style>
		<h3 class="header smaller lighter blue">Upload pictures</h3> Gallery name:
		<br>
		<br>
		<form action="<?php echo base_url();?>Admin/do_Upload_gallery" id="my-awesome-dropzone" method="POST" enctype="multipart/form-data" class="dropzone well">

			<?php if (isset($galleryname)):?>
				<div class="col-sm-9" id="the-basics">
					<input type="text" id="gallery-input" value="<?=$galleryname?>" name="gallery" class="col-xs-10 col-sm-5 typeahead" disabled/>
			</div>
			<?php else:?>
				<div class="col-sm-9" id="the-basics">
					<input type="text" id="gallery-input" placeholder="Gallery name" name="gallery" class="col-xs-10 col-sm-5 typeahead" required/>
				</div>
			<?php endif;?>

				<span class="help-block">*Maximum of 1Gb each</span>
			<div class="col-md-offset-3 col-md-9">
				<button class="btn btn-info pull-right" type="submit" id="submit-button">
					<i class="ace-icon fa fa-check bigger-110"></i> Submit
				</button>
			</div>
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
			<!-- DROPZONE END-->

			<!-- PAGE CONTENT EN-->
		</form>

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
<script src="<?php echo base_url(); ?>assets/js/dropzone.min.js"></script>
<script src="<?php echo base_url();?>assets/js/sweetalert.min.js"></script>
<script src="<?php echo base_url();?>assets/js/typeahead.jquery.js"></script>

<!-- ace scripts -->
<script src="<?php echo base_url(); ?>assets/js/ace-elements.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/ace.min.js"></script>


<script>
	Dropzone.options.myAwesomeDropzone = { // The camelized version of the ID of the form element
		// The configuration we've talked about above
		paramName: "file",
		autoProcessQueue: false,
		uploadMultiple: true,
		parallelUploads: 100,
		maxFiles: 1000,
		addRemoveLinks: true,
		acceptedFiles: "image/jpeg,image/png,image/gif",
		previewTemplate: $('#preview-template').html(),

		thumbnailHeight: 120,
		thumbnailWidth: 120,
		maxFilesize: 1000,

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

			// First change the button to actually tell Dropzone to process the queue.
			this.element.querySelector("button[type=submit]").addEventListener("click", function(e) {
				var a = document.forms["my-awesome-dropzone"]["gallery"].value;
				if (a == null || a == "") {
					console.log(a);
				} else {
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
					text: "Redirecting to album in 2 seconds",
					timer: 2000,
					imageUrl: "<?php echo base_url();?>/assets/img/loading1.gif",
					showConfirmButton: false
				});
				setTimeout(function() {
					location.href = "<?php echo base_url();?>Admin/view_gallery/" + response;
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
</script>

<script>
	var substringMatcher = function(strs) {
		return function findMatches(q, cb) {
			var matches, substringRegex;

			// an array that will be populated with substring matches
			matches = [];

			// regex used to determine if a string contains the substring `q`
			substrRegex = new RegExp(q, 'i');

			// iterate through the pool of strings and for any string that
			// contains the substring `q`, add it to the `matches` array
			$.each(strs, function(i, str) {
				if (substrRegex.test(str)) {
					matches.push(str);
				}
			});

			cb(matches);
		};
	};
	var states = <?php echo json_encode($gallerynew); ?>;

	$('#the-basics .typeahead').typeahead({
		hint: true,
		highlight: true,
		minLength: 1
	}, {
		name: 'states',
		source: substringMatcher(states)
	});
</script>
</body>

</html>
