<div class="row">
	<div class="col-xs-12">
		<h3 class="header smaller lighter blue"><?=$galleryname?><a href="<?php echo base_url();?>User/upload_videos/<?=$galleryid?>"><button class="btn btn-success pull-right">Add Videos</button></a>
</h3>


		<?php $i = 1;
			        $j = 1;
			        $foldername = 'assets/files/videos/';?>
		<?php foreach($videos as $g): ?>
		<?php $videopath = base_url().$foldername.str_replace(' ', '%20', $g->vfolder_name).'/'.$g->video_name;
								$ext = pathinfo($g->video_name, PATHINFO_EXTENSION);
					?>

		<div style="display:none;" id="video<?=$j?>">
			<video class="lg-video-object lg-html5 video-js vjs-default-skin" controls preload="auto">
				<source src="<?=$videopath?>" type="video/<?=$ext?>"> Your browser does not support HTML5 video.
			</video>
		</div>
		<?php $j++; ?>
		<?php endforeach;?>



		<div id="demo-gallery mrb50">
			<div id="thumbnials-without-animation" class="list-unstyled fixed-size">

				<?php foreach($videos as $g): ?>
				<?php
						      $withoutExt = preg_replace('/\\.[^.\\s]{3,4}$/', '', $g->video_name);
						      $picture_name = $withoutExt.'.png';

						      $videopath = base_url().$foldername.str_replace(' ', '%20', $g->vfolder_name).'/'.$g->video_name;
						      $videothumb = base_url().$foldername.str_replace(' ', '%20', $g->vfolder_name).'/'.$picture_name;
						      ?>
					<span class="rollover"></span>
					<a class="item" data-poster="<?=$videothumb?>" data-sub-html="video caption1" data-html="#video<?=$i?>">
													<img src="<?=$videothumb?>" />	</a>
					<?php $i++;?>
					<?php endforeach;?>
			</div>
		</div>


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
<script src="<?php echo base_url();?>assets/js/video.js"></script>
<script src="<?php echo base_url();?>assets/js/lg-thumbnail.min.js"></script>
<script src="<?php echo base_url();?>assets/js/lg-video.min.js"></script>
<script src="<?php echo base_url();?>assets/js/lg-fullscreen.min.js"></script>
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
