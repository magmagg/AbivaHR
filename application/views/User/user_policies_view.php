<div class="row">
    <div class="col-xs-12">
        <!-- PAGE CONTENT BEGINS -->
        <!-- Button trigger modal -->
        <h3 class="header smaller lighter blue">Policies</h3>

        <table class="table table-striped table-bordered table-hover we" id="dataTables-example">
            <thead>
                <tr>
                    <th>#</th>
                    <th>ID</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                <?php $count = 1; ?>
                <?php foreach($policies as $p): ?>
                <tr>
                    <td>
                        <?=$count;?>
                    </td>
                    <td>
                        <?=$p->policy_title?>
                    </td>
                    <td>
                      <a href="<?php echo base_url();?>User/view_contents_of_main/<?=$p->policy_id?>">View</a>
                                </td>
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


<!-- inline scripts related to this page -->
</body>

</html>
