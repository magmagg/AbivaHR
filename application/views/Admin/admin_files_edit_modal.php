<div id="myModal" class="modal fade" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="blue bigger">Please fill the following form fields</h4>
			</div>
			<form method="POST" enctype="multipart/form-data" action="<?php echo base_url();?>Admin/do_update_one_file" id="updatingform">
				<div class="modal-body">
					<div class="row">
						<div class="col-xs-12 col-sm-5">
							<div class="space"></div>
							<input type="hidden" name="foldername" id="foldername">
							<input type="hidden" name="filechanged" id="filechanged" value="0">
        		<input type="file" name="uploadfile" id="fileinput"/>
							<span class="help-block">If no file is chosen, Version will not be affected, Only the display name.</span>
								<span class="help-block">*Up to 1Gb only</span>
						</div>
						<input type="hidden" name="old_file_id" id="old_file_id">

						<div class="col-xs-12 col-sm-7">
							<div class="form-group">
								<label for="form-field-select-3">Display name</label>
								<div>
									<input type="text" name="displayname" id="displayname" placeholder="Display name" required/>
								</div>
							</div>

							<div class="space-4"></div>

							<div class="form-group">
								<label for="form-field-username">Revision</label>

								<div>
									<div class="radio">
										<label>
											<input name="revision"  type="radio" class="ace" value="0" checked />
											<span class="lbl"> Minor Revision</span>
										</label>
										<label>
											<input name="revision" type="radio" class="ace" value="1" />
											<span class="lbl"> Major Revision</span>
										</label>
									</div>
								</div>

							</div>

							<div class="space-4"></div>


						</div>
					</div>
				</div>

				<div class="modal-footer">
					<button class="btn btn-sm" data-dismiss="modal">
						<i class="ace-icon fa fa-times"></i> Cancel
					</button>

					<button class="btn btn-sm btn-primary" id="submit_button" type="submit">
						<i class="ace-icon fa fa-check"></i> Save
					</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script>
var frm = $('#updatingform');
frm.submit(function (ev) {


var fd = new FormData();//empty FormData object
$.each(frm.serializeArray(), function(i, item) {
  //add form fields one by one to our FormData
  fd.append(item.name, item.value);
});
frm.find('input[type=file]').each(function(){
  //for fields with "multiple" file support
  //field name should be something like `myfile[]`

  var files = $(this).data('ace_input_files');
  if(files && files.length > 0) {
     for(var f = 0; f < files.length; f++) {
       fd.append('file', files[f]);
    }
  }
});

		$.ajax({
				url: frm.attr('action'),
				data: fd,
				type: frm.attr('method'),
        processData: false,  // tell jQuery not to process the data
        contentType: false,  // tell jQuery not to set contentType
				success: function (data) {
					var mydata = JSON.parse(data);
					console.log(mydata);
					$('#myModal').modal('hide');
					$('#filesedit'+mydata.id).fadeOut('fast', function() {
						$('#filesedit'+mydata.id).find('td:eq(1)').text(mydata.displayname);
						$('#filesedit'+mydata.id).find('td:eq(1)').append(mydata.updatedname);
					$('#filesedit'+mydata.id).find('td:eq(2)').text(mydata.version);
					$('#filesedit'+mydata.id).fadeIn('slow');
					new PNotify({
					title: 'Update',
					text: 'File updated!',
					type: 'success'
					});
					});
				}
		});
		ev.preventDefault();
	});
</script>

<script>
$( "#fileinput" ).change(function() {
	$( "#filechanged" ).val(1);
});
</script>
