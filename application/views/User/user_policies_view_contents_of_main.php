<div class="row">
    <div class="col-xs-12">
        <!-- PAGE CONTENT BEGINS -->
        <!-- Button trigger modal -->

        <h3 class="header smaller lighter blue">Policies</h3>

        <?php foreach($policies as $p): ?>
        <?php $policy_id = $p->policy_id; ?>
        <ul>
            <li><a href="<?php echo base_url();?>User/view_main_page_policy/<?=$p->policy_id?>/0">
                <?=$p->policy_title?>
              </a>
                    <?php foreach($sub1 as $s1): ?>
                    <?php if($policy_id == $s1->policy_id_fk): ?>
                    <ul>
                        <li><a href="<?php echo base_url();?>User/view_main_page_policy/<?=$s1->sub1_id?>/1">
                            <?=$s1->sub1_title?>
</a>
                                <?php foreach($sub2 as $s2):?>
                                <?php if($s2->sub1_id_fk == $s1->sub1_id):?>
                                <ul>
                                    <li><a href="<?php echo base_url();?>User/view_main_page_policy/<?=$s2->sub2_id?>/2">
                                        <?=$s2->sub2_title?>
                                      </a>
                                            <?php foreach($sub3 as $s3):?>
                                            <?php if($s3->sub2_id_fk == $s2->sub2_id):?>
                                            <ul>
                                                <li><a href="<?php echo base_url();?>User/view_main_page_policy/<?=$s3->sub3_id?>/3">
                                                    <?=$s3->sub3_title?>
                                                  </a>
                                                </li>
                                            </ul>
                                            <?php endif;?>
                                            <?php endforeach;?>
                                    </li>
                                </ul>
                                <?php endif;?>
                                <?php endforeach;?>
                        </li>
                    </ul>
                    <?php endif; ?>
                    <?php endforeach;?>
            </li>
        </ul>
        <?php endforeach; ?>

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
<!-- DataTables JavaScript -->
<script src="<?php echo base_url();?>assets/js/sweetalert.min.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery.validate.min.js"></script>
<!-- ace scripts -->
<script src="<?php echo base_url(); ?>assets/js/ace-elements.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/ace.min.js"></script>

<!-- inline scripts related to this page -->
</body>

</html>
