<div class="row">
	<div class="col-xs-12">
		<!-- PAGE CONTENT BEGINS -->
		<div class="panel-heading">
			<h3 class="header smaller lighter blue">
        Announcements
      </h3>
		</div>
		<!-- /.panel-heading -->
		<?php
        if(!empty($announcements))
           {
             $count = 1;

             foreach($announcements as $a)
             {
                 if(($count % 2) == 1)
                 {
                   $time = strtotime($a->ann_timestamp);
									 echo $count;

                     ?>
			<div class="panel-body">
				<ul class="timeline">
					<li>
						<div class="timeline-badge"><i class="fa fa-check"></i>
						</div>
						<div class="timeline-panel">
							<div class="widget-header">
								<h4 class="widget-title"><?=$a->ann_title?></h4>
								<p><small class="text-muted">
                                              <i class="fa fa-clock-o"></i>
                                              <?=$a->ann_timestamp?>
                                            </small>
								</p>
							</div>
							<div class="space-12"></div>

							<div class="timeline-body">
								<p>
									<?=$a->ann_content?>
								</p>
							</div>

							<small><?php echo humanTiming($time); ?> ago </small>
						</div>
					</li>
					<?php
            $count +=1;
              }
                else
                {
                  $time = strtotime($a->ann_timestamp);
									echo $count;
            ?>

						<li class="timeline-inverted">
							<div class="timeline-badge warning"><i class="fa fa-credit-card"></i>
							</div>
							<div class="timeline-panel">
								<div class="widget-header">
									<h4 class="widget-title"><?=$a->ann_title?></h4>
									<p><small class="text-muted">
                                              <i class="fa fa-clock-o"></i>
                                              <?=$a->ann_timestamp?>
                                            </small>
								</div>
								<div class="space-12"></div>

								<div class="timeline-body">

									<p>
										<?=$a->ann_content?>
									</p>
								</div>
								<small><?php echo humanTiming($time); ?> ago </small>
							</div>
						</li>
				</ul>
				<?php
				$count +=1;
			}
		}
	}
 else
 {
	?>
					<p class="alert alert-danger">
						No announcements to show.
					</p>

					<?php	 }

         function humanTiming ($time)
                            {
                                $time = time() - $time; // to get the time since that moment
                                $time = ($time<1)? 1 : $time;
                                $tokens = array (
                                    31536000 => 'year',
                                    2592000 => 'month',
                                    604800 => 'week',
                                    86400 => 'day',
                                    3600 => 'hour',
                                    60 => 'minute',
                                    1 => 'second'
                                );

                                foreach ($tokens as $unit => $text) {
                                    if ($time < $unit) continue;
                                    $numberOfUnits = floor($time / $unit);
                                    return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
                                }

                            }

             ?>
			</div>
			<!-- /.panel-body -->



			<!-- PAGE CONTENT ENDS -->
	</div>
	<!-- /.col -->
</div>
<!-- /.row -->


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

<!-- ace scripts -->
<script src="<?php echo base_url(); ?>assets/js/ace-elements.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/ace.min.js"></script>

<!-- inline scripts related to this page -->
</body>

</html>
