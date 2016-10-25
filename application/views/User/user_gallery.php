<div class="row">
    <div class="col-xs-12">
      <div>

		<h3 class="header smaller lighter blue">Albums</h3>
    <?php
        if(!empty($gallery))
           {

             ?>

					<ul class="ace-thumbnails clearfix">
            <?php foreach($gallery as $g): ?>
              <?php
              $withoutExt = preg_replace('/\\.[^.\\s]{3,4}$/', '', $g->picture_name);
              $ext = pathinfo($g->picture_path, PATHINFO_EXTENSION);
              $picture_name = $withoutExt.'_thumb.'.$ext;
              $foldername = 'assets/files/gallery/'; ?>
              <li>
                <a href="<?php echo base_url();?>User/view_gallery/<?=$g->gfolder_id?>" data-rel="colorbox">
                  <div style="width:150px; height:150px; background: url(<?php echo base_url().$foldername?><?=str_replace(' ', '%20', $g->gfolder_name)?>/<?=$picture_name?>) no-repeat; background-size:cover; background-position:center;"></div>
                    <div class="text">
                    <div class="inner"><?=$g->gfolder_name?></div>
                  </div>
                </a>
              </li>
            <?php endforeach;?>

            <?php }
                    else
                    {
                      ?>
                       <p class="alert alert-danger">
                         No pictures to show.
                      </p>

                  <?php
                    }
                    ?>

					</ul>
				</div><!-- PAGE CONTENT ENDS -->
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

<!-- ace scripts -->
<script src="<?php echo base_url(); ?>assets/js/ace-elements.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/ace.min.js"></script>

<!-- inline scripts related to this page -->
</body>

</html>
