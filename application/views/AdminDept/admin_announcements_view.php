<div class="row">
<div class="col-xs-12">
  <!-- PAGE CONTENT BEGINS -->
  <!-- Button trigger modal -->
  <h3 class="header smaller lighter blue">Announcements by Department</h3>

    <table class="table table-striped table-bordered table-hover we" id="dataTables-example">
      <thead>
        <tr>
          <th>Department ID</th>
          <th>Department</th>
          <th>View</th>
        </tr>
      </thead>

      <tbody>
        <?php foreach($departments as $d): ?>

        <tr id="<?=$d->department_id?>">
          <td>
            <?=$d->department_id?>
          </td>
          <td class="title<?=$d->department_id?>">
              <?=$d->department_name?>
          </td>
          <td>
                <button class="btn btn-block btn-success" onclick="location.href='<?php echo base_url();?>Admin/view_announcements_by_dept/<?=$d->department_id?>'"><i class="ace-icon fa fa-eye bigger-120"></i></button>
          </td>
        </tr>

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

<script src="<?php echo base_url(); ?>assets/js/select2.full.min.js"></script>

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

<script type="text/javascript">
$(document).ready(function() {
$(".js-example-placeholder-multiple").select2({
  placeholder: "Select Department"

});
});
</script>

<script type="text/javascript">
$(document).ready(function() {
$(".js-example-placeholder-single").select2({
placeholder: "Select Department"

});
});
</script>

<script type="text/javascript">
$(document).ready(function() {
    var selectme = $('#select1');
    function selectall_func() {
      selectme.select2('destroy').find('option').prop('selected', 'selected').end().select2()
    }

    function selectnone_func() {
      selectme.select2('destroy').find('option').prop('selected', false).end().select2({placeholder:"Select department"})
    }
    $("#selectall").click(selectall_func);
    $("#selectnone").click(selectnone_func);
});
</script>
<script type="text/javascript">
$(document).ready(function() {
  var selectme2 = $('#select2');


  function selectall_func() {
    selectme2.select2('destroy').find('option').prop('selected', 'selected').end().select2()
  }

  function selectnone_func() {
    selectme2.select2('destroy').find('option').prop('selected', false).end().select2({placeholder:"Select department"})
  }
  $("#selectall2").click(selectall_func);
  $("#selectnone2").click(selectnone_func);
});
</script>

<script>
$().ready(function() {
  // validate signup form on keyup and submit
  $("#announcement_form").validate({
    rules: {
      title: {
        required: true
      },
      content: {
        required: true
      },
      departments: {
        required: true
      }
    },
    submitHandler: function() {
      var frm = $('#announcement_form');
      $.ajax({
        type: frm.attr('method'),
        url: frm.attr('action'),
        data: frm.serialize(),
        beforeSend: function() {
          $("#post_button").html('Posting<img width="30" height="20" src="<?php echo base_url();?>assets/img/myloading.gif"> ');
        },
        success: function(data) {
          var editButton = "<button class=\"btn btn-block btn-white btn-info editmodalshow\" onclick=\"editModal("+data.ann_id+")\"><i class=\"ace-icon fa fa-pencil bigger-120\"></i></button>";
          var deleteButton = "<button class=\"btn btn-block btn-white btn-danger\"  onclick=\"foo(" + data.ann_id + ")\"><i class=\"ace-icon fa fa-trash-o bigger-120\"></i></button>";
          $("#post_button").html('Post');
          var MyUniqueID = data.ann_id; // this is the uniqueId.
          var rowIndex = $('#dataTables-example').dataTable().fnAddData([
            data.ann_id,
            data.ann_title,
            data.ann_content,
            data.ann_time,
            editButton,
            deleteButton
          ]);
          var row = $('#dataTables-example').dataTable().fnGetNodes(rowIndex);
          $(row).attr('id', MyUniqueID);

          $('#myModal').modal('hide');
          $('#announcement_form').trigger("reset");
          $('#form-field-textarea').val('');
          $('#select1').select2('destroy').find('option').prop('selected', false).end().select2({placeholder:"Select department"});

          swal({
            title: "Success!!",
            text: "Announcement posted!",
            type: "success",
            confirmButtonText: "Ok"
          });
        },
        dataType: "json"
      });
      return false;
    }
  });

});
</script>

<script>
function foo(id) {
  swal({
      title: "Are you sure?",
      text: "You will not be able to recover this announcement!",
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
          url: "<?php echo base_url();?>Admin/delete_one_announce/" + id,
          success: function(data) {

            $('#' + id).fadeOut('slow', function() {
              table.intro.row('#' + id).remove().draw(false);
            });
            swal("Deleted!", "Your announcement has been deleted.", "success");
          }
        });
      } else {}
    });
}
</script>

<script>
function editModal(id)
{
event.preventDefault();
$.ajax({
  type: 'POST',
  url: "<?php echo base_url();?>Admin/get_one_announcement/",
  data: {
    annID: id
  },
  success: function(data) {
    console.log(data);
    $('#myModal_edit').modal('show');
    $('#ann_id').val(data.announcement[0].ann_id);
    $('#title').val(data.announcement[0].ann_title);
    $('textarea#form-field-8').val(data.announcement[0].ann_content);

    var selectedoptions = [];
    $('select#select2').empty();
    $.each(data.departments, function(key, value) {
      $('select#select2')
        .append($('<option>', {
            value: data.departments[key].department_id
          })
          .text(data.departments[key].department_name));


      $.each(data.announcement, function(key1, value1) {
        if (data.announcement[key1].ann_department_fk == data.departments[key].department_id) {
          selectedoptions.push(data.departments[key].department_id);
        }
      });

    });
    $("select#select2").val(selectedoptions);


  },
  dataType: "json"
});
}
</script>

<script type="text/javascript">
  var frm = $('#edit_form');
  frm.submit(function (ev) {
      $.ajax({
          type: frm.attr('method'),
          url: frm.attr('action'),
          data: frm.serialize(),
          success: function (data) {
              var mydata = JSON.parse(data);
              $('#myModal_edit').modal('hide');
              $('#'+mydata.id).fadeOut('fast', function() {
              $('#'+mydata.id).find('td:eq(1)').text(mydata.title);
              $('#'+mydata.id).find('td:eq(2)').text(mydata.content);
              $('#'+mydata.id).find('td:eq(3)').text(mydata.timestamp);
                $('#'+mydata.id).fadeIn('slow');
              });
          }
      });

      ev.preventDefault();
  });
</script>

<!-- inline scripts related to this page -->
</body>

</html>
