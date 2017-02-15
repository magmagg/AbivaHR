<h3 class="header smaller lighter blue">Folders</h3>
<table class="table table-striped table-bordered table-hover" id="dataTables-example1">
	<thead>
		<tr>
			<th style="width:5%">#</th>
			<th style="width:65%">Folder</th>
			<th style="width:30%">Action</th>
		</tr>
	</thead>
	<tbody>
		<?php
    $count = 1;
    foreach($folders as $d):
    ?>

			<tr id="folders<?=$d->ffolder_id?>">
				<td>
					<?=$count?>
				</td>
				<td>
					<?=$d->ffolder_name?>
				</td>
				<td>
					<center>
						<button class="btn btn-white btn-info viewfiles" id="<?=$d->ffolder_id?>"><i class="ace-icon fa fa-folder-open bigger-130"></i></button>
						<button class="btn btn-white btn-danger deletefolder" id="<?=$d->ffolder_id?>" data-foldername="<?=$d->ffolder_name?>"><i class="ace-icon fa fa-trash-o bigger-130"></i></button>
					</center>
				</td>
			</tr>
			<?php $count++; ?>
			<?php endforeach; ?>
	</tbody>
</table>


<script type="text/javascript">
	$(document).ready(function() {
		$(".viewfiles").click(function(e) {
			e.preventDefault();
			$('#spinner').show();
			var id = $(this).attr('id');
			var departmentid = "<?php echo $departmentid;?>";
			$('#loadingdiv').fadeOut('fast', function() {
				$('#loadingdiv').empty();
				$("#loadingdiv").load('<?php echo base_url().'AdminDept/load_files/'; ?>' + id + "/" + departmentid,
					function() {
						$('#spinner').hide();
						$('#loadingdiv').fadeIn('slow');
						load_files();

					});
			});
		});
	});
</script>

<script>
	var table = {};

	function load_files() {
		table.intro = $('#dataTables-example2').DataTable({
			responsive: true
		});
	}
</script>

<script type="text/javascript">
	$(document).ready(function() {
		$(".deletefolder").click(function(e) {
			e.preventDefault();
			var id = $(this).attr('id');
			var foldername = $(this).attr('data-foldername');
			swal({
				title: "Are you sure?",
				text: "Please type " + foldername + " to delete:",
				type: "input",
				showCancelButton: true,
				closeOnConfirm: false,
				inputPlaceholder: "Write something",
			}, function(inputValue) {
				if (inputValue === false) {
					swal.showInputError("You need to write something!");
					return false;
				}
				if (inputValue === "") {
					swal.showInputError("You need to write something!");
					return false
				}
				if (inputValue == foldername) {
					$.ajax({
						type: 'POST',
						url: "<?php echo base_url();?>AdminDept/delete_folder_files/" + id,
						success: function(data) {

							$('#folders' + id).fadeOut('slow', function() {
								table.intro.row('#filesedit' + id).remove().draw(false);
								console.log('#filesedit' + id);
							});
							swal("Deleted!", "The folder has been deleted.", "success");
						}
					});
				} else {
					swal.showInputError("Folder names do not match!");
					return false
				}
			});
		});
	});
</script>
