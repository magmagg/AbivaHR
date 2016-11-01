<div class="row">
    <div class="col-xs-12">
        <div>

            <h3 class="header smaller lighter blue">Manage <?=$galleryname?><button id="submit_form" class="btn btn-danger pull-right">Delete</button></a></h3>

           <form method="POST" action="<?php echo base_url();?>Admin/delete_videos" id="delete_videos" >
            <ul class="ace-thumbnails clearfix">

                <?php foreach($videos as $g): ?>
                <?php
                $foldername = 'assets/files/videos/';
                $withoutExt = preg_replace('/\\.[^.\\s]{3,4}$/', '', $g->video_name);
                $picture_name = $withoutExt.'.png';

                $videothumb = base_url().$foldername.str_replace(' ', '%20', $g->vfolder_name).'/'.$picture_name;
              ?>
                    <li id="li<?=$g->video_id?>">
                        <img src="<?=$videothumb?>" style="width:150px;height:150px;"><div class="text">
                        </div>
                        <center>
                            <input type="checkbox" name="videos[]" id="c_b" value="<?=$g->video_id?>">
                            <input type="hidden" name="return" value="<?=$galleryid?>">
                        </center>
                        <div class="tools tools-top">
                            <a href="#" onclick="foo(<?=$g->video_id?>)">
                                <i class="ace-icon fa fa-times red"></i>
                            </a>
                        </div>

                    </li>
                    <?php endforeach;?>
                  </form>
            </ul>
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
<script src="<?php echo base_url();?>assets/js/sweetalert.min.js"></script>

<!-- ace scripts -->
<script src="<?php echo base_url(); ?>assets/js/ace-elements.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/ace.min.js"></script>

<!-- inline scripts related to this page -->
</body>

<script>
    function foo(id) {
        swal({
                title: "Are you sure?",
                text: "You will not be able to recover this picture!",
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
                        url: "<?php echo base_url();?>Admin/delete_one_video/" + id,
                        success: function(data) {
                            $('#li' + id).fadeOut('slow', function() {
                                $('#li' + id).remove();
                            });
                            swal("Deleted!", "Picture deleted!", "success");
                        }
                    });
                } else {}
            });
    }
</script>

<script>
$( "#submit_form" ).click(function()
{
  swal({
          title: "Are you sure?",
          text: "You will not be able to recover deleted videos!",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Yes, delete it!",
          closeOnConfirm: false
      },
      function(isConfirm) {
          if (isConfirm) {

            $( "#delete_videos" ).submit();
          } else {}
      });
});
</script>


</html>
