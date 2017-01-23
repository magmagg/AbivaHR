<div class="row">
    <div class="col-xs-12">
        <!-- PAGE CONTENT BEGINS -->
        <form role="form" method="POST" action="<?php echo base_url();?>Admin/<?=$function?>">
        <button type="submit" id="post_button" class="btn btn-success pull-right">Publish</button>
        <h3 class="header smaller lighter blue"><?=$title?></h3>
        <input type="hidden" name="policy_id" value="<?=$id?>">
        <textarea name="content"><?=$content?></textarea>
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
<script src="<?php echo base_url(); ?>assets/js/tinymce.min.js"></script>
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script>
    tinymce.init({
        selector: 'textarea',
        plugins: "link advlist code hr wordcount table preview colorpicker textcolor searchreplace",
        toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link',
        toolbar2: 'preview | forecolor backcolor fontsizeselect fontselect | searchreplace',

        height: "500",
        link_list: [{
            title: 'TinyMCE',
            value: 'http://www.tinymce.com'
        }, {
            title: 'Moxiecode',
            value: 'http://www.ephox.com'
        }, {
            title: 'TinyMCE resources',
            menu: [{
                title: 'TinyMCE documentation',
                value: 'http://www.tinymce.com/docs/'
            }, {
                title: 'TinyMCE forum',
                value: 'http://www.tinymce.com/forum/'
            }]
        }]
    });
</script>
<!-- ace scripts -->
<script src="<?php echo base_url(); ?>assets/js/ace-elements.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/ace.min.js"></script>

<!-- inline scripts related to this page -->
</body>

</html>
