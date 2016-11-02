<style>
.thumbnail {
    width: 320px;
    height: 240px;
}

.image {
    width: 100%;
    height: 100%;
}

.image img {
    -webkit-transition: all 0.5s ease; /* Safari and Chrome */
    -moz-transition: all 0.5s ease; /* Firefox */
    -ms-transition: all 0.5s ease; /* IE 9 */
    -o-transition: all 0.5s ease; /* Opera */
    transition: all 0.5s ease;
}

.image:hover img {
    -webkit-transform:scale(1.25); /* Safari and Chrome */
    -moz-transform:scale(1.25); /* Firefox */
    -ms-transform:scale(1.25); /* IE 9 */
    -o-transform:scale(1.25); /* Opera */
     transform:scale(1.25);

     	opacity: .7;
     	-o-transition-duration: 1s;
     	-moz-transition-duration: 1s;
     	-webkit-transition: -webkit-transform 1s;
     	-webkit-box-shadow: 0px 0px 4px #000;
     	-moz-box-shadow: 0px 0px 4px #000;
     	box-shadow: 0px 0px 4px #000;
}

.lg-backdrop.in {
    opacity: 0.85;
}
.fixed-size.lg-outer .lg-inner {
  background-color: #000000;
}
.fixed-size.lg-outer .lg-sub-html {
  position: absolute;
  text-align: left;
}
.fixed-size.lg-outer .lg-toolbar {
  background-color: transparent;
  height: 0;
}
.fixed-size.lg-outer .lg-toolbar .lg-icon {
  color: #FFF;
}
.fixed-size.lg-outer .lg-img-wrap {
  padding: 12px;
}
</style>

<div class="row">
	<div class="col-xs-12">
		<h3 class="header smaller lighter blue"><?=$galleryname?><a href="<?php echo base_url();?>User/upload_pictures/<?=$galleryid?>"><button class="btn btn-sm btn-success pull-right">Add pictures</button></a>
</h3>
		<div>

			<div id="demo-gallery mrb50">
				<div id="thumbnials-without-animation" class="list-unstyled fixed-size">
					<?php foreach($gallery as $g): ?>
					<?php
					$withoutExt = preg_replace('/\\.[^.\\s]{3,4}$/', '', $g->picture_name);
					$ext = pathinfo($g->picture_name, PATHINFO_EXTENSION);
					$picture_name = $withoutExt.'_thumb.'.$ext;
					$foldername = 'assets/files/gallery/';
					?>
          <?php foreach($users as $u): ?>
            <?php if($u->user_id == $g->picture_uploader_id){$name = $u->user_firstname.' '.$u->user_lastname;} ?>
            <?php endforeach;?>
          	<span class="rollover" ></span>
						<a class="item image" href="<?php echo base_url().$foldername?><?=$g->gfolder_name?>/<?=$g->picture_name?>" data-sub-html="Uploaded by:<?=$name?>">
								<img class="img-responsive" src="<?php echo base_url().$foldername?><?=str_replace(' ', '%20', $g->gfolder_name)?>/<?=$picture_name;?>">
						</a>
						<?php endforeach;?>
				</div>
			</div>
		</div>

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

<!-- lightgallery plugins -->
<script src="<?php echo base_url();?>assets/js/lightgallery.min.js"></script>
<script src="<?php echo base_url();?>assets/js/lg-thumbnail.min.js"></script>
<script src="<?php echo base_url();?>assets/js/lg-fullscreen.min.js"></script>
<script src="<?php echo base_url();?>assets/js/video.js"></script>
<script src="<?php echo base_url();?>assets/js/sweetalert.min.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery.justifiedGallery.min.js"></script>
<!-- ace scripts -->
<script src="<?php echo base_url(); ?>assets/js/ace-elements.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/ace.min.js"></script>


<!-- inline scripts related to this page -->
<script>
	//thumbnails without animation
	var $thumb = $('#thumbnials-without-animation');
	if ($thumb.length) {
		$thumb.justifiedGallery({
			rowHeight: 200,
			margins: 6,
		}).on('jg.complete', function() {
			$thumb.lightGallery({
				thumbnail: true,
				animateThumb: false,
				showThumbByDefault: false
			});
		});
	};

	// Fixed size
	$('.fixed-size').lightGallery({
		selector: '.item',
		width: '700px',
		height: '470px',
		mode: 'lg-fade',
		addClass: 'fixed-size',
		counter: false,
		download: false,
		startClass: '',
		enableSwipe: false,
		enableDrag: false,
		speed: 500,
    videojs: true
	});
</script>
</body>

</html>
