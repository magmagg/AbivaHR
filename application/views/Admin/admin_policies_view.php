<div class="row">
    <div class="col-xs-12">
        <!-- PAGE CONTENT BEGINS -->
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
            Create page
        </button>

        <h3 class="header smaller lighter blue">Policies</h3>

        <table class="table table-striped table-bordered table-hover we" id="dataTables-example">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Page</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                <?php $count = 1; ?>
                <?php foreach($policies as $p): ?>
                <?php $policy_id = $p->policy_id; ?>
                <tr>
                    <td>
                        <?=$count;?>
                    </td>
                    <td><i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                        <?=$p->policy_title?>
                    </td>
                    <td>
                        <div class="hidden-sm hidden-xs btn-group">
                            <a href="#" role="button" class="blue sub1modal" data-toggle="modal" id="<?=$p->policy_id?>" class="tooltip-info" data-rel="tooltip" title="Add Page">
                                <button class="btn btn-xs btn-success">
                                    <i class="ace-icon fa fa-plus bigger-120"></i>
                                </button>
                            </a>

                            <a href="<?php echo base_url();?>Admin/edit_main_policy_page/<?=$p->policy_id?>" class="tooltip-info" data-rel="tooltip" title="Edit">
                                <button class="btn btn-xs btn-info editbutton">
                                    <i class="ace-icon fa fa-pencil bigger-120"></i>
                                </button>
                            </a>

                            <a href="#" onclick="foo()" class="tooltip-info" data-rel="tooltip" title="Delete">
                                <button class="btn btn-xs btn-danger">
                                    <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                </button>
                            </a>

                            <a href="<?php echo base_url();?>Admin/view_main_page_policy/<?=$p->policy_id?>" class="tooltip-info" data-rel="tooltip" title="View">
                                <button class="btn btn-xs btn-light">
                                    <i class="ace-icon fa fa-eye bigger-120"></i>
                                </button>
                            </a>

                        </div>
                        <center>
                            <div class="hidden-md hidden-lg">
                                <div class="inline pos-rel">
                                    <button class="btn btn-minier btn-primary dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                        <i class="ace-icon fa fa-cog icon-only bigger-110"></i>
                                    </button>

                                    <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">

                                        <li>
                                            <a href="#" role="button" class="blue sub1modal" data-toggle="modal" id="<?=$p->policy_id?>" class="tooltip-info" data-rel="tooltip" title="Add page">
                                                <span class="green">
                                          <i class="ace-icon fa fa-plus bigger-120"></i>
                                        </span>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="<?php echo base_url();?>Admin/edit_main_policy_page/<?=$p->policy_id?>" class="tooltip-info" data-rel="tooltip" title="Edit">
                                                <span class="blue">
                                          <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                                        </span>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#" onclick="foo()" class="tooltip-error" data-rel="tooltip" title="Delete">
                                                <span class="red">
                                          <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                        </span>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="<?php echo base_url();?>Admin/view_main_page_policy/<?=$p->policy_id?>" class="tooltip-success" data-rel="tooltip" title="View">
                                                <span class="light">
                                          <i class="ace-icon fa fa-eye bigger-120"></i>
                                        </span>
                                            </a>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </center>
                    </td>
                </tr>
                <!-- #007fff -->
                <!--                 SUB 1                          -->
                <?php foreach($sub1 as $s1): ?>
                <?php if($policy_id == $s1->policy_id_fk): ?>
                <tr>
                    <td>
                        <?=$count;?>
                    </td>
                    <td style="padding-left:2.5em"><i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                        <?=$s1->sub1_title?>
                    </td>
                    <td>
                        <div class="hidden-sm hidden-xs btn-group">
                            <a href="#" role="button" class="blue sub2modal" data-toggle="modal" id="<?=$s1->sub1_id?>" class="tooltip-info" data-rel="tooltip" title="Edit">
                                <button class="btn btn-xs btn-success">
                                    <i class="ace-icon fa fa-plus bigger-120"></i>
                                </button>
                            </a>

                            <a href="<?php echo base_url();?>Admin/edit_sub1_policy_page/<?=$s1->sub1_id?>" class="tooltip-info" data-rel="tooltip" title="View">
                                <button class="btn btn-xs btn-info editbutton">
                                    <i class="ace-icon fa fa-pencil bigger-120"></i>
                                </button>
                            </a>

                            <a href="#" onclick="foo()" class="tooltip-info" data-rel="tooltip" title="Delete">
                                <button class="btn btn-xs btn-danger">
                                    <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                </button>
                            </a>

                            <a href="<?php echo base_url();?>Admin/view_sub1_page_policy/<?=$s1->sub1_id?>" class="tooltip-info" data-rel="tooltip" title="View">
                                <button class="btn btn-xs btn-light">
                                    <i class="ace-icon fa fa-eye bigger-120"></i>
                                </button>
                            </a>

                        </div>
                        <center>
                            <div class="hidden-md hidden-lg">
                                <div class="inline pos-rel">
                                    <button class="btn btn-minier btn-primary dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                        <i class="ace-icon fa fa-cog icon-only bigger-110"></i>
                                    </button>

                                    <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">

                                        <li>
                                            <a href="#" role="button" class="blue sub2modal" data-toggle="modal" id="<?=$s1->sub1_id?>" class="tooltip-info" data-rel="tooltip" title="Edit">
                                                <span class="green">
                                          <i class="ace-icon fa fa-plus bigger-120"></i>
                                        </span>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="<?php echo base_url();?>Admin/edit_sub1_policy_page/<?=$s1->sub1_id?>" class="tooltip-info" data-rel="tooltip" title="View">
                                                <span class="blue">
                                          <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                                        </span>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#" onclick="foo()" class="tooltip-error" data-rel="tooltip" title="Delete">
                                                <span class="red">
                                          <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                        </span>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="<?php echo base_url();?>Admin/view_sub1_page_policy/<?=$s1->sub1_id?>" class="tooltip-success" data-rel="tooltip" title="View">
                                                <span class="light">
                                          <i class="ace-icon fa fa-eye bigger-120"></i>
                                        </span>
                                            </a>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </center>
                    </td>
                </tr>

                <?php foreach($sub2 as $s2):?>
                <?php if($s2->sub1_id_fk == $s1->sub1_id):?>
                <tr>
                    <td>
                        <?=$count;?>
                    </td>
                    <td style="padding-left:5em"><i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                        <?=$s2->sub2_title?>
                    </td>
                    <td>
                        <div class="hidden-sm hidden-xs btn-group">
                            <a href="#" role="button" class="blue sub3modal" data-toggle="modal" id="<?=$s2->sub2_id?>" class="tooltip-info" data-rel="tooltip" title="Edit">
                                <button class="btn btn-xs btn-success">
                                    <i class="ace-icon fa fa-plus bigger-120"></i>
                                </button>
                            </a>

                            <a href="<?php echo base_url();?>Admin/edit_sub2_policy_page/<?=$s2->sub2_id?>" class="tooltip-info" data-rel="tooltip" title="View">
                                <button class="btn btn-xs btn-info editbutton">
                                    <i class="ace-icon fa fa-pencil bigger-120"></i>
                                </button>
                            </a>

                            <a href="#" onclick="foo()" class="tooltip-info" data-rel="tooltip" title="Delete">
                                <button class="btn btn-xs btn-danger">
                                    <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                </button>
                            </a>

                            <a href="<?php echo base_url();?>Admin/view_sub2_page_policy/<?=$s2->sub2_id?>" class="tooltip-info" data-rel="tooltip" title="View">
                                <button class="btn btn-xs btn-light">
                                    <i class="ace-icon fa fa-eye bigger-120"></i>
                                </button>
                            </a>

                        </div>
                        <center>
                            <div class="hidden-md hidden-lg">
                                <div class="inline pos-rel">
                                    <button class="btn btn-minier btn-primary dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                        <i class="ace-icon fa fa-cog icon-only bigger-110"></i>
                                    </button>

                                    <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">

                                        <li>
                                            <a href="#" role="button" class="blue sub3modal" data-toggle="modal" id="<?=$s2->sub2_id?>" class="tooltip-info" data-rel="tooltip" title="Edit">
                                                <span class="green">
                                          <i class="ace-icon fa fa-plus bigger-120"></i>
                                        </span>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="<?php echo base_url();?>Admin/edit_sub2_policy_page/<?=$s2->sub2_id?>" class="tooltip-info" data-rel="tooltip" title="View">
                                                <span class="blue">
                                          <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                                        </span>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#" onclick="foo()" class="tooltip-error" data-rel="tooltip" title="Delete">
                                                <span class="red">
                                          <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                        </span>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="<?php echo base_url();?>Admin/view_sub2_page_policy/<?=$s2->sub2_id?>" class="tooltip-success" data-rel="tooltip" title="View">
                                                <span class="light">
                                          <i class="ace-icon fa fa-eye bigger-120"></i>
                                        </span>
                                            </a>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </center>
                    </td>
                </tr>
                <?php foreach($sub3 as $s3):?>
                <?php if($s3->sub2_id_fk == $s2->sub2_id):?>
                <tr>
                    <td>
                        <?=$count;?>
                    </td>
                    <td style="padding-left:7.5em"><i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                        <?=$s3->sub3_title?>
                    </td>
                    <td>
                        <div class="hidden-sm hidden-xs btn-group">
                            <a href="<?php echo base_url();?>Admin/edit_sub3_policy_page/<?=$s3->sub3_id?>" class="tooltip-info" data-rel="tooltip" title="View">
                                <button class="btn btn-xs btn-info editbutton">
                                    <i class="ace-icon fa fa-pencil bigger-120"></i>
                                </button>
                            </a>

                            <a href="#" onclick="foo()" class="tooltip-info" data-rel="tooltip" title="Delete">
                                <button class="btn btn-xs btn-danger">
                                    <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                </button>
                            </a>

                            <a href="<?php echo base_url();?>Admin/view_sub3_page_policy/<?=$s3->sub3_id?>" class="tooltip-info" data-rel="tooltip" title="View">
                                <button class="btn btn-xs btn-light">
                                    <i class="ace-icon fa fa-eye bigger-120"></i>
                                </button>
                            </a>

                        </div>
                        <center>
                            <div class="hidden-md hidden-lg">
                                <div class="inline pos-rel">
                                    <button class="btn btn-minier btn-primary dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                        <i class="ace-icon fa fa-cog icon-only bigger-110"></i>
                                    </button>

                                    <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                        <li>
                                            <a href="<?php echo base_url();?>Admin/edit_sub3_policy_page/<?=$s3->sub3_id?>" class="tooltip-info" data-rel="tooltip" title="View">
                                                <span class="blue">
                                          <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                                        </span>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#" onclick="foo()" class="tooltip-error" data-rel="tooltip" title="Delete">
                                                <span class="red">
                                          <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                        </span>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="<?php echo base_url();?>Admin/view_sub3_page_policy/<?=$s3->sub3_id?>" class="tooltip-success" data-rel="tooltip" title="View">
                                                <span class="light">
                                          <i class="ace-icon fa fa-eye bigger-120"></i>
                                        </span>
                                            </a>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </center>
                    </td>
                </tr>
                <?php endif;?>
                <?php endforeach;?>
                <?php endif;?>
                <?php endforeach;?>
                <?php endif; ?>
                <?php endforeach;?>
                <!--                 SUB 1                          -->
                <!-- #007fff -->

                <?php $count++; ?>
                <?php endforeach; ?>
            </tbody>
        </table>

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
<script src="<?php echo base_url(); ?>assets/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bower_components/datatables-responsive/js/dataTables.responsive.js"></script>

<script src="<?php echo base_url();?>assets/js/sweetalert.min.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery.validate.min.js"></script>
<!-- ace scripts -->
<script src="<?php echo base_url(); ?>assets/js/ace-elements.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/ace.min.js"></script>

<script>
    var table = {};
    $(document).ready(function() {
        table.intro = $('#dataTables-example').DataTable({
            responsive: true
        });
    });
</script>

<script>
    $(document).ready(function() {
        $(".sub1modal").click(function(e) {
            e.preventDefault();
            $('#policy_id_fk').val($(this).attr("id"));
            $('#myModal_edit').modal('show');
        });
    });
</script>

<script>
    $(document).ready(function() {
        $(".sub2modal").click(function(e) {
            e.preventDefault();
            $('#sub1_id_fk').val($(this).attr("id"));
            $('#myModal_sub2').modal('show');
        });
    });
</script>

<script>
    $(document).ready(function() {
        $(".sub3modal").click(function(e) {
            e.preventDefault();
            $('#sub2_id_fk').val($(this).attr("id"));
            $('#myModal_sub3').modal('show');
        });
    });
</script>



<!-- inline scripts related to this page -->
</body>

</html>
